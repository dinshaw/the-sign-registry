<?php
require_once "inc/php/db_config.php";
require "inc/php/session_functions.php";
//ini_set('session.use_cookies',0);

include 'inc/php/ssl_redirect.php';

session_name('TheSignRegistry');
session_set_save_handler('_open','_close','_read','_write','_destroy','_clean');
session_start();

//include all external files
require 'libs/Smarty.class.php';
require 'inc/php/functions.php';

//create new tpl object
$tpl = new smarty;

//define paramiters
$tpl->compile_check = true;
//$tpl->debugging = true;
$tpl->left_delimiter = "<%";
$tpl->right_delimiter = "%>";

//open the database connection  and get the __CFG_config vars
db_connect(); 

include 'inc/php/get_config_vars.php';
//assign email for contact
$tpl->assign('contactEmail', __CFG_ContactEmail);

//get location
if(isset($_REQUEST['currPage'])){
	$currPage = $_REQUEST['currPage'];
	$tpl->assign('currPage',$currPage);	
}

if (isset($_REQUEST['mode'])){
	
	if ($_REQUEST['mode'] == 'logout'){
		
		// Unset all of the session variables.
		$_SESSION = array();
	
		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		/*if (isset($_COOKIE[session_name('TheSignRegistry')])) {
			setcookie(session_name('TheSignRegistry'), '', time()-42000, '/');
		}*/
	
		// Finally, destroy the session.
		session_destroy();
	}

	if($_REQUEST['mode'] == "login"){
		include "scripts/login/login.php";
	
	}elseif($_REQUEST['mode'] == "reg"){
		include "scripts/reg/reg_init.php";

	}elseif($_REQUEST['mode'] == "forgotPw"){
		include "scripts/login/forgotPw.php";

	}elseif($_REQUEST['mode'] == "aboutUs"){
		include "scripts/login/get_aboutUs.php";
	
	}elseif($_REQUEST['mode'] == "contact"){
		include "scripts/get_contact.php";
	
	}elseif($_REQUEST['mode'] == "tc"){
		$tpl->display('reg/tc.tpl');
	
	}elseif($_REQUEST['mode'] == "pp"){
		$tpl->display('pp.tpl');
	}else{
		$tpl->display('index.tpl');
	}
}else{
	$tpl->display('index.tpl');
}

?>
