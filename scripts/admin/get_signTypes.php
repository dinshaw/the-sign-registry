<?php
//GET SIGN TYPES

$sql = "SELECT id, name FROM sign_types";
$query = mysql_query($sql);

$signTypes = array();
while($rows = mysql_fetch_array($query)){
	$type = array();
	
	$type['name'] = $rows['name'];
	$type['id'] = $rows['id'];
	
	$signTypes[] = $type;
}
$tpl->assign('typeLoop',$signTypes);
?>