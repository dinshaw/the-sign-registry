<?php
$sql = "select * from config";
$query = mysql_query($sql);

while($rows = mysql_fetch_array($query)){
	$cfgVar = array();
	$cfgName = $rows['name'];
	$cfgVar[$cfgName] = $rows['value'];
	$cfgVarList[] = $cfgVar;
}

foreach($cfgVarList as $arr){
	foreach($arr as $var => $val){
		if(!defined($var)){
			define($var,$val);
		}
	}
}
?>