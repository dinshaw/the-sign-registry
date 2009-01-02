<?php
//see if "Add / Edit" submit button was pressed on config.tpl
if(isset($_POST['add_edit'])){
	if(!$_POST['config_name'] || !$_POST['config_value'] || !$_POST['config_description']){
		$errors = "Please fill in all the fields";
	}else{
		$config_name = $_POST['config_name'];
		$sql = "select * from config where name = '$config_name'";
		$query = mysql_query($sql);
		$num = mysql_num_rows($query);
		if(!$_POST['id'] && $num >= 1){
			$errors = "That name is already in use.";
		}
	}
	if(!$errors){
		$id = $_POST['id'];
		$adminID = $_POST['adminID'];
		$config_name = $_POST['config_name'];
		$config_value = $_POST['config_value'];
		$config_description = $_POST['config_description'];
		$config_description = ereg_replace('"','&quot;',$config_description);
		
		if(!$id){
			$sql = "insert into config (name,value,description,changeBy) values ('$config_name','$config_value','$config_description','$adminID')";
			$query = mysql_query($sql);
			$tpl->assign('msg',$config_name.' was added to the config DB.');
		}else{
			$sql = "update config set name = '$config_name', value = '$config_value', description = '$config_description', changeBy = '$adminID' where id = '$id'";
			$query = mysql_query($sql);
			$tpl->assign('msg',$config_name.' was updated.');
		}
			
	}else{
		$tpl->assign('msg',$errors);
	}
	
}elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
	$id = $_POST['id'];
	$sql = "delete from config where id = '$id'";
	$query = mysql_query($sql);
	
}elseif(isset($_POST['action']) && $_POST['action'] == "edit"){
	$id = $_POST['id'];
	$sql = "select * from config where id = '$id'";
	$query = mysql_query($sql);
	$row = mysql_fetch_array($query);
	
	$config_name = $row['name'];
	$config_value = $row['value'];
	$config_description = $row['description'];
	
	$tpl->assign('id',$id);
	$tpl->assign('config_name',$config_name);
	$tpl->assign('config_value',$config_value);
	$tpl->assign('config_description',$config_description);
}
	
	
		
include 'scripts/admin/config/get_config.php';
$tpl->display('admin/config/config.tpl');
?>

