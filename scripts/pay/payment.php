<?php
if(isset($_REQUEST['editCart'])){
	
	include 'scripts/reg/get_reg_info.php';
	
	include 'scripts/reg/get_rec_info.php';
	
	include 'scripts/reg/get_signs.php';
	
	include 'scripts/val/get_extra_vals.php';
	
	$tpl->assign('sid',md5(session_id()));
	
	$tpl->display('reg/step3.tpl');
	
}elseif($_REQUEST['action'] == "pay"){ 

	if($_POST['payment_type'] == "cc"){
		include 'scripts/pay/error_check.php';
		
		if(!$error){
			include 'scripts/pay/paypal/creditcard.php';
			
		}else{
			$tpl->assign('msg',$error);
			
			$tpl->assign('sid',md5(session_id()));
			include 'scripts/val/get_extra_vals.php';
			include 'scripts/pay/get_total.php';
		}
			
	}elseif($_POST['payment_type'] == "pp"){
		include 'scripts/pay/paypal/paypal.php';
	}
	
}elseif($_REQUEST['action'] == "checkout"){ 

	//GET THE USERS IP (JUST FOR THE HELL OF IT)
	if (isset($_SERVER['HTTP_X_FORWARD_FOR']))
		$ip = $_SERVER['HTTP_X_FORWARD_FOR'];
	else
		$ip = $_SERVER['REMOTE_ADDR'];
	$tpl->assign('IPAddress',$ip);
	
	$tpl->assign('sid',md5(session_id()));
	
	$id = $_SESSION['userID'];

	include 'scripts/val/get_extra_vals.php';
	
	include 'scripts/users/get_info.php';
	
	include 'scripts/pay/get_total.php';
	

	
}


?>