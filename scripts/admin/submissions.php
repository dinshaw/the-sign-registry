<?php

if(isset($_REQUEST['action']) && $_REQUEST['action'] == "update"){
	$status = $_REQUEST['status'];
	$id = $_REQUEST['id'];
	
	$sql = "UPDATE submissions SET status = '$status' WHERE id = '$id'";
	$query = mysql_query($sql);
}


include 'scripts/admin/get_submissions.php';
$tpl->display('admin/submissions.tpl');
?>