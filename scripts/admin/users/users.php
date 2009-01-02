<?php
if($_POST['action'] == "edit"){
	$tpl->assign('error','Edit users has not been activated.');
	include "scripts/admin/users/get_users.php";
	$tpl->display('admin/users/users.tpl');	
	
}elseif($_POST['delete']){
	$id = $_POST['id'];
	$sql = "delete from users where id = '$id'";
	$result = mysql_query($sql);
	include "scripts/admin/users/get_users.php";
	$tpl->display('admin/users/users.tpl');
	
}elseif($_POST['action'] == "suspend"){
	$id = $_POST['id'];
	$sql = "update users set status = '0' where id = '$id'";
	$result = mysql_query($sql);
	include "scripts/admin/users/get_users.php";
	$tpl->display('admin/users/users.tpl');
}else{
	include "scripts/admin/users/get_users.php";
	$tpl->display('admin/users/users.tpl');	
}
?>