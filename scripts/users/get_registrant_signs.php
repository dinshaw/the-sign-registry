<?php
if(!$id){
	$userID = $_SESSION['userID'];
}else{
	$userID = $id;
}

$sql = "SELECT CONCAT(u.first_name,' ',last_name) AS name, u.email, u.id, DATE_FORMAT(u.reg_date,'%a, %b %D, %y') AS date, s.status, CONCAT(LEFT(description,30),'...') AS description, s.id AS sign_id
		FROM users u, signs s
		WHERE s.rec_id = u.id AND s.reg_id = '$userID'";

$query = mysql_query($sql);

$recipients = array();
while($rows = mysql_fetch_array($query)){
	$recipient = array();
	
	$recipient['name'] = $rows['name'];
	$recipient['email'] = $rows['email'];
	// $recipient['count'] = $rows['count'];
	$recipient['date'] = $rows['date'];
	$recipient['id'] = $rows['id'];
	$recipient['description'] = $rows['description'];
	$recipient['status'] = $rows['status'];
	$recipient['sign_id'] = $rows['sign_id'];	
	
	$recipients[] = $recipient;
}

$tpl->assign('recipientLoop',$recipients);



?>