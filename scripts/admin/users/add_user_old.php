<?php

if($_POST['errorCheck'] =="on"){
	$errors = array(
	'email' => "Enter an email address.\n",
	'validEmail' => "That does not appear to be a valid email address.\n",
	'emailDouble' => "That email address is already in our database.\n"
	);
	
	$email = $_POST['email'];
	$name = $_POST['name'];
	//don't knnow where these are coming from but the rte function can't handle them
	$bodyContent = str_replace("\n","",$_POST['bodyContent']);
	$bodyContent = str_replace("\r","",$bodyContent);
	//take out the ' from the body text - MAKE SURE TO ONLY USE SINGLE QUOTE TO CONTAIN CONTENT
	$bodyContent = str_replace("'","&#39;",$bodyContent);
		
	if (!$_POST['email'])
	{
		$error .= $errors['email'];
	}
	else
	{
		$goodEmail = valid_email($_POST['email']);
		if (!$goodEmail)
		{
			$error .= $errors['validEmail'];
		}
		
		$sql = "select * from users where email = '$email'";
		$result = mysql_query($sql);
		$rows = mysql_fetch_array($result);		
		$listStatus = $rows['email_list'];
		$id = $rows['id'];
		
		if (mysql_num_rows($result)>0)
		{
			//are they already getting the email? If so, show the found double msg
			if($listStatus == '1'){		
				unset($email);
				$error .= $errors['emailDouble'];
			}
		}
	}
	
	if (!$error)
	{
		if($listStatus == '0'){
			$sql = "update users set email_list = '1' where id = '$id'";
			$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
			unset($name);
			unset($email);
			$msg = "Thank you, your account has been updated.\n You will now receive the emails.";
		}else{
			$sql = "insert into users (username, email, status, email_list, dateTime) values ('$name', '$email','0','1',NOW())";
			$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
			
			$id = mysql_insert_id();
			
			$bodyContent = stripslashes($bodyContent);
			$text = strip_tags($bodyContent) . "
			
			Hello " . $name . "

			Thanks for signing up for the " . __CFG_SiteName . " email list.
			If you got this by mistake there are instructions at the bottom to unsubscribe.
			
			" . __CFG_AdminEmailName . "
			" . __CFG_SiteUrl . "
			
			";
			
			$html = stripslashes($bodyContent) . "<br /><br />Hello $name,<br />
			Thanks for signing up for the <a href='" . __CFG_SiteUrl . "'>" . __CFG_SiteName . "</a> email list.<br />
			If you got this by mistake there are instructions at the bottom to unsubscribe.<br />" . __CFG_AdminEmailName . "<br />
			<a href='" . __CFG_SiteUrl . "'>" . __CFG_SiteName . "</a><br />";
			
			$welcomeSubject = "Hello and welcome to " . __CFG_SiteName . "'s email list!";
			
			$msg = "Thank you, your email address has been added to the list.";
			mail_multi_alt($email,__CFG_MPEmailBoundary,$welcomeSubject,$text,$html,$id);
			
			unset($name);
			unset($email);
		}
	}else{
		$tpl->assign('error',$error);
		$tpl->assign('name',stripslashes($name));
		$tpl->assign('email',$email);
		$tpl->assign('bodyContent',stripslashes($bodyContent));
	}
}

$tpl->display('admin/users/add_user.tpl');

?>