<?php
require_once "inc/php/db_config.php";
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
		include "scripts/admin/adminlogin.php";

	}elseif(isset($_REQUEST['sid']) && $_REQUEST['sid'] == md5(session_id()) ){
	
		$tpl->assign('admin_name',$_SESSION['admin_name']);
		$tpl->assign('sid',md5(session_id()));
	
		if($_REQUEST['mode'] == "home"){
			include "scripts/get_home.php";
			$tpl->display('home.tpl');
	
		}elseif($_REQUEST['mode'] == "config"){
			include "scripts/admin/config/config.php";
		
		}elseif($_REQUEST['mode'] == "accounts"){
			include "scripts/admin/accounts/accounts.php";
		
		}elseif($_REQUEST['mode'] == "email"){
			include "scripts/admin/email/post_emails.php";
	
		}elseif($_REQUEST['mode'] == "users"){
			include "scripts/admin/users.php";
	
		}elseif($_REQUEST['mode'] == "signs"){
			include 'scripts/admin/signs.php';
	
		}elseif($_REQUEST['mode'] == "submissions"){
			include "scripts/admin/submissions.php";

		}elseif($_REQUEST['mode'] == "signTypes"){
			include "scripts/admin/signTypes.php";
	
		}elseif($_REQUEST['mode'] == "signDetails"){
			include "scripts/admin/signDetials.php";
	
		}elseif($_REQUEST['mode'] == "userDetails"){
			$id = $_REQUEST['id'];
			include "scripts/users/get_info.php";
			$tpl->display('admin/userDetails.tpl');
		
		}elseif ($_REQUEST['mode'] == 'logout'){
			session_destroy();
			$tpl->display('admin/login/login.tpl');
		}else{
			$tpl->display('admin/login/success.tpl');
		}
		
	}else{
	
		include "scripts/admin/adminlogin.php";
	}
}else{

	include "scripts/admin/adminlogin.php";

}

?>
