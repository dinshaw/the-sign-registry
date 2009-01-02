<?php
if ($_POST['email']){

	$goodEmail = valid_email($_POST['email']);
		
	if(!$goodEmail){
		$error .= "That email did not appear to be valid.\n Correct format is 'me@myDomain.co'.";
		$tpl->assign('msg',$error);
		
	}else{
		//check if the email already exists
		$email = $clean['email'] = $_POST['email'];
		$sql = "SELECT id, sal, last_name, type FROM users WHERE email = '$email'";
		$query = mysql_query($sql) or die (mysql_error());
		$result = mysql_fetch_array($query);
		$num_rows = mysql_num_rows($query);
		
		if($num_rows == 1){
			extract($result);
			$newPassword = random_string('10', '15');
			
			$sql = "UPDATE users SET passwd = password('$newPassword') WHERE id = '$id'";

			//send mail
			$html = 'Hello '.$email.',<br /> Your new password is: '.$newPassword.'<br/>Thank you,<br />'.__CFG_EmailSig;
			$encodedChars = array('&nbsp;','&prime;','<br>','<br />');
			$decodeChars = array(" ","'","\n","\n");
			$text = strip_tags(str_replace($encodedChars,$decodeChars,$html));
			
			$subject = "TheSignRegistry.com password reset request.";
			mail_multi_alt($email,__CFG_MPEmailBoundary,$subject,$text,$html,$id);

			$query = mysql_query($sql) or die(mysql_error());
			$msg = "Your new password has been sent to " . $email;
			//error_log($msg . "  " . $newPassword);
			
			$tpl->assign('msg',$msg);
			
		}elseif($num_rows > 1){
			$tpl->assign('msg','Multiple emails found.  Please contact The Sign Registry by phone or email.');
		}else{
			$tpl->assign('msg','That email is not in our database.');
		}
	}
	$tpl->display('login/forgot.tpl');
	
}else{

	if($_POST['getNewPass']){
		$tpl->assign('msg','Please enter an email address');
	}
	
	$tpl->display('login/forgot.tpl');
}
?> 