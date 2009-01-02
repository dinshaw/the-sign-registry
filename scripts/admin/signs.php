<?php

if(isset($_REQUEST['action']) && $_REQUEST['action'] == "update"){
	$type = $_REQUEST['type'];
	$id = $_REQUEST['signID'];
	$status = $_REQUEST['status'];
	
	$sql = "UPDATE signs SET type = '$type', status = '$status' WHERE id = '$id'";
	$query = mysql_query($sql);
}


include 'scripts/admin/get_signs.php';
$tpl->display('admin/signs.tpl');
?>