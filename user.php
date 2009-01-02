<?php
include 'inc/php/ssl_redirect.php';

require_once "inc/php/db_config.php";
require "inc/php/session_functions.php";
//ini_set('session.use_cookies',0);
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
	
	if($_REQUEST['mode'] == "login"){
		include "scripts/login/login.php";

	}elseif($_REQUEST['sid'] == md5(session_id()) ){
		$tpl->assign('welcome_name',$_SESSION['welcome_name']);
	
		//do all auth functions
		if($_REQUEST['mode'] == "reg"){
			include "scripts/reg/register.php";
	
		}elseif($_REQUEST['mode'] == "val"){
			include "scripts/val/validate.php";
		
		}elseif($_REQUEST['mode'] == "add_vals"){
			include "scripts/val/add_vals.php";
		
		}elseif($_REQUEST['mode'] == "pay"){
			include "scripts/pay/payment.php";
		
		}elseif($_REQUEST['mode'] == "editProfile"){
			include "scripts/edit_user/edit_user_details.php";
		
		}elseif($_REQUEST['mode'] == "changePassword"){
			include "scripts/edit_user/change_password.php";
		
		}else{
			$id = $_SESSION['userID'];
			include 'scripts/users/get_info.php';
			$tpl->assign('sid',md5(session_id()) );
			$tpl->display('welcome.tpl');
		}

	}else{
		$tpl->display('login.tpl');
	}

}else{
	$tpl->display('login.tpl');
}

?>
