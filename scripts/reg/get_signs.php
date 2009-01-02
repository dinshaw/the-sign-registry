<?php

$userID = $_SESSION['userID'];

//get all the unpaid signs
$sql = "SELECT s.id AS id, CONCAT(u.first_name,'&nbsp;',u.last_name) AS name, CONCAT(LEFT(s.description,25),'...') AS description, s.prepaids AS prepaids, DATE_FORMAT(s.reg_date,'%a, %b %D, %y') AS date
FROM signs s, users u
WHERE s.reg_id = '$userID' AND s.rec_id = u.id AND s.status = 0";


$query = mysql_query($sql);

//VARS FOR GET TOTALS SCRIPT FOR CHECKOUZT PAGE
$numUnpaidSigns = mysql_num_rows($query);
$totalExtraValidationAtempts = "0";
$signs = array();
$signList = '';
while($rows = mysql_fetch_array($query)){
	$sign = array();
	
	$sign['name'] = $rows['name'];
	$sign['description'] = $rows['description'];
	$sign['prepaids'] = $rows['prepaids'];
		//total the number of extra validation atempts for the checkoutpage
		$extraValidations = $rows['prepaids'] - __CFG_DefaultValidations;
		$totalExtraValidationAtempts += $extraValidations;
	if(isset($rows['address2'])) $sign['address2'] = $rows['address2'];
	$sign['date'] = $rows['date'];
	$sign['id'] = $rows['id'];
	
	if($signList) 
		$signList .= $rows['id'] . ",";
	else
		$signList .= $rows['id'];
	
	$signs[] = $sign;
}

$tpl->assign('signLoop',$signs);
$tpl->assign('signList',$signList);


$tpl->assign('numUnpaidSigns',$numUnpaidSigns);

//IF USER TYPE IS reg_rec THEN OFFER THEM MORE VALIDATIONS ATTEMPTS
# if they are just a rec then they will not see this screen
if($_SESSION['valid_user'] == "reg_rec"){
	
	$sql = "SELECT prepaids FROM users WHERE id = '$userID'";
	$query = mysql_query($sql);
	$result = mysql_fetch_array($query);
	$prepaids = $result['prepaids'];
	
	$sql = "SELECT count(*) AS count FROM signs WHERE rec_id = '$userID'";
	$query = mysql_query($sql);
	$result = mysql_fetch_array($query);
	$count = $result['count'];
	
	$tpl->assign('extraVals','yes');
	$tpl->assign('selfVals',$_SESSION['selfVals']);
	$tpl->assign('count',$count);
	$tpl->assign('prepaids',$prepaids);
}

?>