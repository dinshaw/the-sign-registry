<?php
$errors = array(
'details' => "Please fill in all the fields.\n",
'nomatch' => "Your passwords do not match.\n",
'validEmail' => "That does not appear to be a valid email address.\n",
);

if($_POST['errorCheck'] == "on"){

	if(!$_POST['username'] && !$_POST['passwd'] && !$_POST['passwd2'] && !$_POST['email']){
		$error .= $errors['details'];
	}else{
		$goodEmail = valid_email($_POST['email']);
		if (!$goodEmail)
		{
			$error .= $errors['validEmail'];
		}
		
		if($_POST['passwd'] != $_POST['passwd2']){
			$error .= $errors['nomatch'];
		}
	}
	
	if($error){
		$tpl->assign('username',$_POST['username']);
		$tpl->assign('email',$_POST['email']);
		$tpl->assign('error',$error);
		include "scripts/admin/accounts/get_accounts.php";
		$tpl->display('admin/accounts/accounts.tpl');
		exit;
	}else{
		
		$username = $_POST['username'];
		$password = $_POST['passwd'];
		$email = $_POST['email'];
		
		$sql = "insert into adminlogin (username, passwd, email) values ('$username', password('$password'),'$email')";
		$query = mysql_query($sql);
	}
}
?>