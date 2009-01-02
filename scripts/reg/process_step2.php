<?php
//IF the sign is already there then this is a page refreash.  dont create a new sign
if(!isset($_SESSION['signID'])){

	$userID = $_POST['userID'];
	$recID = $_POST['recID'];
	
	//create identification key for sign
	$sign_key = substr(md5(mt_rand()),0,10);
	
	//SET PREPAIDS
	$prepaids += __CFG_DefaultValidations;
	
	//add sign
	$sql = "INSERT INTO signs (description, reg_id, rec_id, sign_key, prepaids, status, reg_date) 
	VALUES ('$description', '$userID', '$recID', '$sign_key', '$prepaids','0',now())";
	
	$query= mysql_query($sql);
	$_SESSION['signID'] = mysql_insert_id();
	//if it  is not an edit then change the recipient status to reflect a registrered sign
	if($_POST['step2']){
		$sql = "UPDATE users SET status = '1' WHERE id = '$recID'";
		$query= mysql_query($sql);
	}
	
	//SEE IF THERE IS A PASSWORD FOR THE RECIPIENT YET OR IF IT IS A NEW RECIPIENT THEN SET A PASSWORD
	$sql = "SELECT passwd FROM users WHERE id = '$recID'";
	$query = mysql_query($sql);
	$result = mysql_fetch_array($query);
	$existing_pass = $result['passwd'];
	if(!$existing_pass){
		//THERE IS NO PASSWORD
		//create password for registrant
		$rec_password = substr(md5(mt_rand()),0,10);
		
		$sql = "UPDATE users SET passwd = password('$rec_password') WHERE id = '$recID'";
		mysql_query($sql);
	}else{
		$rec_password = "Your password was sent in your welcome email. If you have lost your password, click on the forgot password link at www.thesignregistry.com.";
	}
	// error_log($rec_password);
	include 'scripts/reg/send_rec_email.php';
	
}else{
	$signID = $_SESSION['signID'];
	
	$prepaids += __CFG_DefaultValidations;
	$sql = "UPDATE signs SET description = '$description', prepaids = '$prepaids' WHERE id = '$signID' ";
	mysql_query($sql);
}


$tpl->assign('welcome_name',$_SESSION['welcome_name']);
$tpl->assign('sid',md5(session_id()));

?>
