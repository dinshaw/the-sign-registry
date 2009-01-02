<?php

$id = $_SESSION['userID'];
$sql = "select * from users where id = '$id'";
$query = mysql_query($sql);
$rows = mysql_fetch_array($query);
$email = $rows['email'];

$errors = array(
'details' => "Please fill in all the fields.\n",
'nomatch' => "Your new password fields do not match.\n",
'badpassword' => "Wrong old password.\n",
);

if($_POST['changePassword']){

	if(!$_POST['passwd'] || !$_POST['passwd2'] || !$_POST['oldpassword']){
		$error .= $errors['details'];
		
	}else{
		$oldpassword = $_POST['oldpassword'];
		//check for password match for user 
		$sql = "SELECT * FROM users WHERE id = '$id' AND passwd = password('$oldpassword')";
		$query = mysql_query($sql);
		$num  = mysql_num_rows($query);
	
		if($num < 1){
			$error .= $errors['badpassword'];
		}
	}

	if($_POST['passwd'] != $_POST['passwd2']){
		$error .= $errors['nomatch'];
	}
	
	if($error){
		$tpl->assign('msg',$error);
	}else{
		$passwd = $_POST['passwd'];
		$sql = "UPDATE users SET passwd = password('$passwd') where id = '$id'";
		$query = mysql_query($sql);
		$tpl->assign('msg','Your password has been changed');
	}
}
$tpl->assign('sid',md5(session_id()));
$tpl->display('edit_user/change_password.tpl');
?>