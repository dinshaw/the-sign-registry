<?php
//PREVIOUSLY REGISTERED SIGNS (FPR REGISTRANT)
//include 'scripts/reg/get_recipients.php';
include 'scripts/users/get_recipient_signs.php';
include 'scripts/users/get_registrant_signs.php';


$sql = "SELECT first_name, last_name, email, address, address2, city, state, country, tel, tel2, dob, zip, prepaids
FROM users 
WHERE id = '$userID'";

$query = mysql_query($sql) or die(mysql_error());
$result = mysql_fetch_array($query);
extract($result);

$tpl->assign('welcome_name',$_SESSION['welcome_name']);
$tpl->assign('first_name',$first_name);
$tpl->assign('last_name',$last_name);
$tpl->assign('email',$email);
$tpl->assign('address',$address);
$tpl->assign('address2',$address2);
$tpl->assign('city',$city);
$tpl->assign('state',$state);
$tpl->assign('country',$country);
$tpl->assign('tel',$tel);
$tpl->assign('tel2',$tel2);
$tpl->assign('dob',$dob);
$tpl->assign('zip',$zip);
$tpl->assign('prepaids',$prepaids);

include 'scripts/pay/convert_info_for_payment.php';
	
?>