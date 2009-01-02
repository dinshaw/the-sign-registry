<?php
//after login there is a userID, after registration there is a regID.
if($_SESSION['userID'])
	$id = $_SESSION['userID'];
elseif($_SESSION['regID'])
	$id = $_SESSION['regID'];

if($_POST['save']){
	include 'scripts/edit_user/error_check.php';

	if(!$error){
		$sql = "UPDATE users SET address = '$address', address2 = '$address2', city = '$city', state = '$state', country = '$country', zip = '$zip', tel = '$tel', tel2 = '$tel2', email = '$email' WHERE id = '$id'";
		$query = mysql_query($sql) or die(mysql_error());
	}else{
		$tpl->assign('msg',$error);
	}
}

//get detials
$sql = "SELECT email, sal, first_name, last_name, address, address2, city, state, zip, country, tel, tel2, dob
FROM users 
WHERE id = '$id'";

$query = mysql_query($sql);
$result = mysql_fetch_array($query);
extract($result);
list($dob_year,$dob_month,$dob_day) = explode("-",$dob);

$tpl->assign('email',$email);
$tpl->assign('sal',$sal);
$tpl->assign('firstName',$first_name);
$tpl->assign('lastName',$last_name);
$tpl->assign('address',$address);
$tpl->assign('address2',$address2);
$tpl->assign('city',$city);
$tpl->assign('state',$state);
$tpl->assign('zip',$zip);
$tpl->assign('country',$country);
$tpl->assign('tel',$tel);
$tpl->assign('tel2',$tel2);
$tpl->assign('dob_day',$dob_day);
$tpl->assign('dob_month',$dob_month);
$tpl->assign('dob_year',$dob_year);

$tpl->assign('userID',$_SESSION['userID']);
$tpl->assign('sid',md5(session_id()));
$tpl->display('edit_user/edit_details.tpl');
	

?>