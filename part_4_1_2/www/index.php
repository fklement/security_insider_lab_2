<?php
/*
 **       Sphinx - A vulnerable Web Application
 **               An ISL IT-Sec Project
 **     Copyright (C) 2010 University of Passau,
 ** EMail:  ds@sec.uni-passau.de
 ** FILE: index.php
 ** PURPOSE: main processing and buildup of main page
 ** AUTHOR(S): Daniel Schreckling
*/
// set include path to find all necessary files
ini_set("include_path", ".:etc/:pages/");
include ("config.php");
// load basic functions
require ('htb.inc');
// set session parameteres and init it
session_set_cookie_params($htbconf['bank/cookievalidity']);
session_name($htbconf['bank/sid']);
session_start();
// start output buffering
ob_start();
// set error handler for special error handling
set_error_handler('errorHandler');
// Parse HTTP variables
global $http;
$http = array();
// Load variables in path info - an alternative to post and get...
$path_info = htb_getpathinfo();
if (is_array($path_info)) {
	while (list($k, $v) = each($path_info)) {
		$http[$k] = $v;
	}
}
if (isset($_REQUEST) && is_array($_REQUEST)) {
	while (list($k, $v) = each($_REQUEST)) {
		$http[$k] = $v;
	}
}
global $db_link, $htbconf;
// try to connect to database
$db_link = mysql_connect($htbconf['db/.server'], $htbconf['db/.login'], $htbconf['db/.pwd']);
$preventLogin = false;
// Could not connect to mysql server
if (!$db_link) {
	// inform the user and prevent login attempts
	$_SESSION['error'] = '<p>Due to maintenance work, the online banking service is currently not available.</p><p>We apolgize for this inconvenience!</p>';
	$preventLogin = true;
}
// select the DB this bank is using
if ($db_link && !mysql_select_db($htbconf['db/.name'], $db_link)) {
	$_SESSION['error'] = '<p>Due to maintenance work, the online banking service is currently not available.</p><p>We apolgize for this inconvenience!</p>';
	$preventLogin = true;
}
// Load the header of this portal
htb_load_page('htbhead');
// if the page to be loaded is the logout page simply destroy this session and go to the login screen of this page
if (isset($http['page']) && $http['page'] == "htblogout") {
	session_set_cookie_params(0);
	session_destroy();
	$http['page'] = login;
	htb_redirect(htb_getbaseurl());
}
// if the page is not set or specified but the session indicates that you are logged in, then show main page
if ((!isset($http['page']) || $http['page'] == "") && (isset($_SESSION['loggedin']) && $_SESSION['loggedin'])) {
	$http['page'] = "htbmain";
}
// In the case page is not set at this point load the login page
if (!isset($http['page'])) {
	$http['page'] = "login";
}
// you are not logged in and someone tries to load a page different from login, then deny access
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) && $http['page'] != "login") {
	$_SESSION['error'].= "<p>Access denied!</p>";
	$http['page'] = 'login';
}
?>

<!-- Lets do some layout -->
<table border="0" align="center" cellpadding="0" cellspacing="0">
	<tr class="deco">
		<td><img src="images/lt_tp_edge.gif" width="7" height="7" align="right"></td>
		<td background="images/tp.gif" height="7" width="7"></td>
		<td><img src="images/rt_tp_edge.gif" width="7" height="7" align="left"></td>
	</tr>
	<tr>
		<td background="images/lt.gif" width="7"></td>
		<td>
			<table width="300" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#dddddd">
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="0" class="tblFrame">
							<tr>
								<td bgcolor="#074188"><img src="images/isl_header2.gif" width="740" height="32" align="center"></td>
							</tr>
							<tr>
								<td>
									<table cellspacing="0" cellpadding="0" width="100%" border="0">
										<tr class="deco">
											<td bgcolor="#074188" width="160" align="center" valign="middle"><img src="images/<?php global $htbconf;
print $htbconf['bank/logo']; ?>" width="115"></td>
											<td bgcolor="#074188" colspan="3" align="center"><img src="images/haupteingang.png" align="center"></td>
										</tr>
										<tr class="deco">
											<td bgcolor="#074188" width="160" height="7" width="160"><img src="images/clear.gif" height="7" width="160"></td>
											<td valign="top" height="7" width="7"><img src="images/lt_tp_iedge.gif" width="7" height="7"></td>
											<td height="7" background="images/bt.gif"></td>
											<td valign="top" height="7" width="7"><img src="images/rt_tp_iedge.gif" width="7" height="7"></td>
										</tr>
										<tr>
											<td bgcolor="#074188" width="160" valign="top" align="center">
											<?php
global $http, $htbconf;
// decide whether to display the login page or nothing
if (isset($http['page']) && $http['page'] == "login") {
	if (!$preventLogin) htb_load_page('htblogin');
}
// or the navigation bar on the left
else htb_load_page('htbleftnav');
?>
											</td>
											<td width="7" background="images/rt.gif"></td>
											<td valign="top">
												<!-- start of content table -->
												<table width="100%" border="0" cellspacing="6" cellpadding="6" align="center">
													<tr>
														<td align="center">
														<?php
global $http;
// if there are some error, warning or success messages, display them
if (isset($_SESSION['error']) && $_SESSION['error'] != "") {
	htb_load_page('htberror');
	unset($_SESSION['error']);
	print "<br>\n";
}

if (isset($_SESSION['warning']) && $_SESSION['warning'] != "") {
	htb_load_page('htbwarning');
	unset($_SESSION['warning']);
	print "<br>\n";
}

if (isset($_SESSION['success']) && $_SESSION['success'] != "") {
	htb_load_page('htbsuccess');
	unset($_SESSION['success']);
	print "<br>\n";
}
// if the login page should be loaded then show some information otherwise load the page to be loaded
if (isset($http['page']) && $http['page'] == "login") {
	htb_load_page('htbinfo');
} else {
	htb_load_page($http['page']);
}
?>
														</td>
													</tr>
												</table>
												<!-- end of content table -->
											</td>
											<td width="7" background="images/lt.gif"></td>
										</tr>
										<tr class="deco">
											<td bgcolor="#074188" width="154"></td>
											<td width="7"><img src="images/lt_bt_iedge.gif" width="7" height="7" align="center"></td>  
											<td height="7" background="images/tp.gif"></td>
											<td width="7"><img src="images/rt_bt_iedge.gif" width="7" height="7" align="center"></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
		<td background="images/rt.gif"></td>
	</tr>
	<tr>
		<td background="images/lt.gif" width="7"></td>
		<td bgcolor="#074188" align="right"><font color="#EEEEFF"><?php echo date('l jS \of F Y h:i:s A'); ?></font></td>
		<td background="images/rt.gif" width="7"></td>
	</tr>
	<tr class="deco">
		<td><img src="images/lt_bt_edge.gif" width="7" height="7" align="right"></td>
		<td background="images/bt.gif"></td>
		<td><img src="images/rt_bt_edge.gif" width="7" height="7" align="left"></td>
	</tr>
</table>
</body>
</html>

<?php
$html = ob_get_clean();
echo $html;
?>
