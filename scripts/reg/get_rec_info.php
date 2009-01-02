<?php
$recID = $_SESSION['recID'];
// $regID = $_SESSION['regID'];
// 
// $sql = "SELECT CONCAT(first_name,' ',last_name) AS name FROM users WHERE id = '$regID'";
// $query = mysql_query($sql);
// $result = mysql_fetch_array($query);
// $reg_name = $result['name'];


$sql = "SELECT CONCAT(first_name,' ',last_name) AS name FROM users WHERE id = '$recID'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);
$rec_name = $result['name'];

$tpl->assign('rec_name',$rec_name);
// $tpl->assign('reg_name',$reg_name);

?>