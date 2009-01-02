<?php
//PREVIOUSLY REGISTERED RECIPIENTS
include 'scripts/reg/get_recipients.php';

//SIGNS REGISTERED TO YOU ((YOU ARE THE RECIPIENT)
$sql = "SELECT s.id AS id, CONCAT(u.first_name,'&nbsp;',u.last_name) AS name, u.id AS userID, CONCAT(LEFT(s.description,25),'...') AS description, s.prepaids AS prepaids, DATE_FORMAT(s.reg_date,'%a, %b %D, %y') AS date
FROM signs s, users u
WHERE s.rec_id = '$userID' 
AND s.reg_id = u.id 
AND s.status = 1";

//SUBMITED VALIDATION ATTEMPTS
$query = mysql_query($sql) or die(mysql_error());

$signs = array();
$signList = '';

while($rows = mysql_fetch_array($query)){
	$sign = array();
	
	$sign['name'] = $rows['name'];
	$sign['description'] = $rows['description'];
	$sign['prepaids'] = $rows['prepaids'];
	$sign['address2'] = $rows['address2'];
	$sign['date'] = $rows['date'];
	$sign['id'] = $rows['id'];
	$sign['userID'] = $rows['userID'];
	
	if($signList) 
		$signList .= $rows['id'] . ",";
	else
		$signList .= $rows['id'];
	
	$signs[] = $sign;
}
//NUMMBER OF PENDING (status 1) VALIDATIONS
$sql = "SELECT count(*) AS count FROM submissions WHERE rec_id = '$userID' AND status = '1'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);
$tpl->assign('pendingVals',$result['count']);

$tpl->assign('signLoop',$signs);
$tpl->assign('signList',$signList);
?>