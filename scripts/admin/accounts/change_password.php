<?php
$id = $_POST['id'];
$sql = "select * from adminlogin where id = '$id'";
$query = mysql_query($sql);
$rows = mysql_fetch_array($query);
$username = $rows['username'];

$errors = array(
'details' => "Please fill in all the fields.\n",
'nomatch' => "Your passwords do not match.\n",
'badpassword' => "Wrong password.\n",
);

if($_POST['errorCheck'] == "on"){

	if(!$_POST['passwd'] && !$_POST['passwd2'] && !$_POST['oldpassword']){
		$error .= $errors['details'];
	}else{
		$oldpassword = $_POST['oldpassword'];
		$sql = "select * from adminlogin where id = '$id' and passwd = password('$oldpassword')";
		$query = mysql_query($sql);
		$num  = mysql_num_rows($query);
		if($num < 1){
			$error .= $errors['badpassword'];
		}

		if($_POST['passwd'] != $_POST['passwd2']){
			$error .= $errors['nomatch'];
		}
	}
	
	if($error){
		$tpl->assign('error',$error);
		
	}else{
		$passwd = $_POST['passwd'];
		$sql = "update adminlogin set passwd = password('$passwd') where id = '$id'";
		$query = mysql_query($sql);
		$tpl->assign('error','Your password has been changed');
		include 'scripts/admin/accounts/get_accounts.php';
		$tpl->display('admin/accounts/accounts.tpl');
		exit;
	}
}
$tpl->assign('username',$username);
$tpl->assign('id',$id);
$tpl->display('admin/accounts/change_password.tpl');
?>