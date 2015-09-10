<?php

require_once('include/xtemplate.class.php');
session_start();

// application environment: devel|test|prod
$ENV = 'prod';

if ($ENV == 'devel') {
	// devel: display all errors except notices
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set("display_errors", 1); 
	ini_set("display_startup_errors", 1); 

} else {
	// production: turn off all error reporting
	error_reporting(0);
	ini_set("display_errors", 0); 
	ini_set("display_startup_errors", 0); 
}

// set request routing info
$SECTION = $_REQUEST['section'];
$VIEW    = $_REQUEST['view'];

// assign default values if none provided
if (!$SECTION) $SECTION = 'home';
if (!$VIEW) $VIEW = 'index';

// global paths
$DIR_HTTP_ROOT = dirname($_SERVER['SCRIPT_FILENAME']);
$DIR_CMS       = "$DIR_HTTP_ROOT/cms";
$DIR_SECTIONS  = "$DIR_HTTP_ROOT/sections";
$DIR_SECTION   = "$DIR_SECTIONS/$SECTION";

// auto load header/meta elements
if (file_exists("cms/$SECTION/meta.txt")) {
	$arr_meta = file("cms/$SECTION/meta.txt");
	foreach ($arr_meta as $item) {
		preg_match("/^([^\:]+)\: (.+)$/", $item, $matches);
		$meta[$matches[1]] = $matches[2];
	}
}
$TITLE = isset($meta['title']) ? 'Ciao-Petro.com: ' . $meta['title'] : 'Ciao-Petro.com: ' . ucfirst($SECTION);
$DESCRIPTION = $meta['description'] ? $meta['description'] : "Creating websites from server-side to design.";
$KEYWORDS = $meta['keywords'] ? $meta['keywords'] : 'web,development,design,server,php,sql';

// auto load section style and javascript
if (file_exists("css/$SECTION.css")) $style = "<link type=\"text/css\" rel=\"stylesheet\" href=\"/css/$SECTION.css\" />";
if (file_exists("js/$SECTION.js")) $script = "<srcipt language=\"javascript\" src=\"/js/$SECTION.js\"></script>";

// set html elements current section for nav bar
${'nav_' . $SECTION} = 'nav_on';

if ($ENV == 'devel') {
	// devel: debug info
	print <<<eod
	<div class="debug_top">
	section: $SECTION |
	view: $VIEW |
	path: $DIR_SECTION/$VIEW.php
	</div>
eod;
}

// handle login and admin access
/*
if ($_POST['login'] == 'Login' && $_POST['username'] && $_POST['password']) {
	require_once('include/Auth.class.php');
	$auth = new Auth('data/users.txt');
	if ($auth->verify($_POST['username'], $_POST['password'])) {
		// print "verified!<br />";
		$_SESSION['username'] = $_POST['username'];
	}

} else if ($_POST['logout']) {
	session_destroy();
	header('Location: /');

} else if ($SECTION == 'admin' && !isset($_SESSION['username'])) {
	header('Location: /login');
}

// display global header elements
$display_login = ($_GET['login'] == 1 && !isset($_SESSION['username'])) ? 'block' : 'none';	
$display_user  = isset($_SESSION['username']) ? 'block' : 'none';
$mission       = join('', @file('cms/header/mission.txt'));
*/
include('include/header.inc.php');

// route request
if ($ENV == 'devel') {
	// devel: display errors in main content
	include("$DIR_SECTION/$VIEW.php");

} else {
	// prod: turn off error display
	@include("$DIR_SECTION/$VIEW.php");
}

include('include/footer.inc.php');

?>