<?php
$sql = "select * from config";
$query = mysql_query($sql);

while($rows = mysql_fetch_array($query)){
	$config = array();
	
	$config['id'] = $rows['id'];
	$config['config_name'] = $rows['name'];
	$config['value'] = $rows['value'];
	$config['description'] = $rows['description'];
	$config['lastChange'] = $rows['lastChange'];
	$config['changeBy'] = $rows['changeBy'];
	
	$configList[] = $config;
}
$tpl->assign('configLoop',$configList);
?>

