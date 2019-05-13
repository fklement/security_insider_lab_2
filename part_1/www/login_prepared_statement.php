<?php
ini_set("include_path", ".:etc/:pages/");

include_once ("htb.inc");
include_once ("config.php");

session_set_cookie_params($htbconf['bank/cookievalidity']);
session_name($htbconf['bank/sid']);
session_start();

set_error_handler('errorHandler');

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$hostname = $_SERVER['HTTP_HOST'];

$link = new mysqli($htbconf['db/.server'], $htbconf['db/.login'], $htbconf['db/.pwd'], $htbconf['db/.name']) or die('Error connecting to database');
$link->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

// Prepares the SQL statement for execution
$stmt = $link->prepare("SELECT * FROM " . $htbconf['db/users'] . " WHERE " . $htbconf['db/users.username'] . "= ? AND " . $htbconf['db/users.password'] . "= ?");
// Binds the username and the password to the prepared statement as string parameters
$stmt->bind_param('ss', $username, $password);

$_SESSION['loggedin'] = false;
// Executes the SQL statement
if ($stmt->execute()) {
	// Gets the result set from the prepared statement
	if ($result = $stmt->get_result()) {
		$row = $result->fetch_row();
		if ($row) {
			$_SESSION['loggedin'] = true;
			$_SESSION['userid'] = $row[0];
			$_SESSION['user'] = $row[2];
			$_SESSION['name'] = $row[3];
			$_SESSION['firstname'] = $row[4];
			$_SESSION['time'] = strtotime($row[5]);
			$_SESSION['lastlogin'] = strtotime($row[6]);
			$_SESSION['lastloginip'] = $row[7];
			
			// Prepares the SQL statement for execution
			$stmt = $link->prepare("UPDATE " . $htbconf['db/users'] . " set " . $htbconf['db/users.lasttime'] . "=now(), " . $htbconf['db/users.lastip'] . "='" . $_SERVER['REMOTE_ADDR'] . "' where " . $htbconf['db/users.username'] . "=? and " . $htbconf['db/users.password'] . "=?");
			// Binds the username and the password to the prepared statement as string parameters
			$stmt->bind_param('ss', $username, $password);
			if (!$stmt->execute()) $_SESSION['warning'].= "<p>Unable to update login time and login ip.</p><p>Please report this to your system administrator.</p>";
			htb_redirect(htb_pageurl("htbmain"));
		} else {
			$_SESSION['error'].= "<p>Your password or username is wrong!</p>";
			htb_redirect(htb_getbaseurl());
			exit();
		}
		$result->free();
	}
} else {
	$_SESSION['warning'] = "<p>Something went wrong during your attempt to log in.</p><p>Please contact the system administrator</p>";
	htb_redirect(htb_getbaseurl());
	exit();
}
$link->close();
?>