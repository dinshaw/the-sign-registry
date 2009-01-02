<?php
//assign the variables for insert
foreach($clean as $key => $val){
	${$key} = $val;
}


//if registrant is a new uers add registrant
if(!isset($_SESSION['userID'])){

	//create password for registrant
	$reg_password = substr(md5(mt_rand()),0,10);
	
	//insert
	$sql = "INSERT INTO users (email, passwd, type, sal, first_name, last_name, address, address2, city, state, zip, country, tel, tel2, dob, reg_date, status) VALUES ('$email', password('$reg_password'), '1', '$sal', '$firstName', '$lastName', '$address', '$address2', '$city', '$state', '$zip', '$country', '$tel', '$tel2', '$dob', now(),0)";

	$query= mysql_query($sql);
	
	//GET AND REGISTER THE userID
	$_SESSION['userID'] = $userID =  mysql_insert_id();
	$_SESSION['welcome_name'] = $sal . " " . ucfirst(strtolower($lastName));
	$_SESSION['valid_user'] = 'reg';
	$tpl->assign('valid_user','reg');
	
	include 'scripts/reg/send_reg_email.php';

}else{
	$userID = $_SESSION['userID'];
	
	//IF REG WAS SUCCESSFUL THEN CHANGE USER STATUS TO FROM 2(rec) TO 3(recReg) IF APLICABLE -- this shoud be i
	if($_SESSION['valid_user'] == "rec"){
		$sql = "UPDATE users SET type = 3 WHERE id = '$userID'";
		$query = mysql_query($sql);
		$_SESSION['valid_user'] = "reg_rec";
	}
}

	
//if recipient is a new uers add recipient
if(!isset($_POST['recID'])){
	
	$sql = "INSERT INTO users (email,type, sal, first_name, last_name, address, address2, city, state, zip, country, tel, tel2, dob, reg_date, status) VALUES ('$email_2', '2', '$sal_2', '$firstName_2', '$lastName_2', '$address_2', '$address2_2', '$city_2', '$state_2', '$zip_2', '$country_2', '$tel_2', '$tel2_2', '$dob', now(),0)";
	$query= mysql_query($sql);
	//get recID
	$recID = mysql_insert_id();
	$_SESSION['recID'] = $recID;
}else{
	$recID = $_POST['recID'];
	$_SESSION['recID'] = $_POST['recID'];
}


// error_log("rec = " . $email_2 . " "  . $rec_password);
// error_log("reg = " . $email . " " . $reg_password);

$tpl->assign('welcome_name',$_SESSION['welcome_name']);
	
//assign the ids
$tpl->assign('userID',$userID);
$tpl->assign('recID',$recID);
$tpl->assign('sid',md5(session_id()));
?>
