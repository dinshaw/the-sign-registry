<?php
$tpl->assign('sid',md5(session_id()));

$userID = $_SESSION['userID'];

include 'scripts/val/get_registrants.php';

$sql = "SELECT prepaids FROM users WHERE id = '$userID'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);
$tpl->assign('prepaids',$result['prepaids']);


if(isset($_POST['validate'])){
	
	//check fields and reassign variables
	if(!$_POST['validation']) $error = "Please enter the details of your experience.";
	
	if(!$error){
	
		//get vrs from psge
		$validation = $_POST['validation'];
		if(ctype_digit($_POST['registrantID'])) $registrantID = $_POST['registrantID'];
		
		//insesrt submission
		$sql = "INSERT INTO submissions (text, reg_id, rec_id, status, dateTime) values ('$validation','$registrantID', '$userID', 0, now())"; 
		mysql_query($sql);
		$submissionID = mysql_insert_id();
		
		
		
		if($_POST['prepaids'] <= 0){
		
			//DISPLAY THANK YOU

			$msg = "Thank you for visiting The Sign Registry Validation Room and entering your After Death Communication. You are currently out of paid validation attempts. Your submission has been registered but you will not receive confirmation until you add validation attempts to your account.  Please purchase additional attempts by clicking the Add Validations to the left. You will not have to re-enter your After Death Communication.\n";
			$tpl->assign('msg',$msg);
			
			
			if ($_SERVER['HTTP_X_FORWARD_FOR'])
				$ip = $_SERVER['HTTP_X_FORWARD_FOR'];
			else
				$ip = $_SERVER['REMOTE_ADDR'];
			$tpl->assign('IPAddress',$ip);
			
			$tpl->assign('sid',md5(session_id()));
			
			$id = $_SESSION['userID'];
			
			$_SESSION['subID'] = $submissionID;
			
			include 'scripts/users/get_info.php';
			
		}else{
		//IF THE USER HAS PREPAID ATTEMPTS LEFT THEN SUBTRACT 1 AND SET STATUS TO 1
	
			//remove prepaid atempt
			$sql = "UPDATE users SET prepaids = prepaids - 1 WHERE id = '$userID'";
			mysql_query($sql);
			
			//SET THE STATUS TO 1 "PAID"
			$sql = "UPDATE submissions SET status = 1 WHERE id = '$submissionID'";
			mysql_query($sql);
			
			//SEND SUBMISSION CONFIRMATION EMAIL
			include 'scripts/pay/send_reciept_email_val.php';
		}
		//DISPLAY THANK YOU
		$tpl->display('val/validate_thankyou.tpl');
	
	}else{
		$tpl->assign('msg',$error);
		$tpl->display('val/validate.tpl');
	}
	
}else{
	
	$tpl->display('val/validate.tpl');
}



?>