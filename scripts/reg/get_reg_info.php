<?php
if($_SESSION['recID']) $recID = $_SESSION['recID'];
if($_SESSION['userID']) $userID = $_SESSION['userID'];

$sql = "SELECT CONCAT(first_name,' ',last_name) AS name, email, address, address2, city, state, country, tel, tel2, dob
FROM users WHERE id = '$userID'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);
extract($result);


$tpl->assign('welcome_name',$_SESSION['welcome_name']);
$tpl->assign('name',$name);
$tpl->assign('email',$email);
$tpl->assign('address',$address);
$tpl->assign('address2',$address2);
$tpl->assign('city',$city);
$tpl->assign('state',$state);
$tpl->assign('country',$country);
$tpl->assign('tel',$tel);
$tpl->assign('tel2',$tel2);
$tpl->assign('dob',$dob);


?>