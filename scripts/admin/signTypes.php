<?php

if($_REQUEST['mode'] == "signTypes"){

	if(isset($_REQUEST['action'])){

	if($_REQUEST['action'] == "add"){
		if($_POST['name'] && ctype_alnum($_POST['name'])){
			$name = $_POST['name'];
			$sql = "INSERT INTO sign_types (name) values ('$name')";
			$query = mysql_query($sql);
		}else{
			$tpl->assign('msg','Please enter a type name');
		}
	}elseif($_REQUEST['action'] == "edit"){
		$id = $_REQUEST['id'];
		$sql = "SELECT name, id FROM sign_types WHERE id = '$id'";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		$tpl->assign('name',$row['name']);
		$tpl->assign('id',$row['id']);
		$tpl->assign('edit',"true");
		
	}elseif($_REQUEST['action'] == "update"){
		$name = $_REQUEST['name'];
		$id = $_REQUEST['id'];
		$sql = "UPDATE sign_types SET name = '$name' WHERE id = '$id'";
		$query = mysql_query($sql);
		
	}elseif($_REQUEST['action'] == "delete"){
		$id = $_REQUEST['id'];
		$sql = "DELETE FROM sign_types WHERE id = '$id'";
		$query = mysql_query($sql) or die(mysql_error());
	}
}
}

include 'scripts/admin/get_signTypes.php';
$tpl->display('admin/signTypes.tpl');



?>