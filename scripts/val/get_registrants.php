<?php
$userID = $_SESSION['userID'];

$sql = "SELECT CONCAT(u.first_name,' ',last_name) AS name, u.email, u.id, DATE_FORMAT(u.reg_date,'%a, %b %D, %y') AS date, u.status, count(*) as count
		FROM users u, signs s
		WHERE s.reg_id = u.id AND s.rec_id = '$userID'
		GROUP BY u.id";
		
$query = mysql_query($sql);
$numRows = mysql_num_rows($query);

if($numRows == 1){
	$rows = mysql_fetch_array($query);

	//if there is one registrant then creaete the registration sentance
	$tpl->assign('registrantID',$rows['id']);
	$tpl->assign('registrantName',$rows['name']);

}else{//if there are multiple registrants then create the list.
	$registrants = array();
	while($rows = mysql_fetch_array($query)){
		$registrant = array();
		
		$registrant['name'] = $rows['name'];
		$registrant['email'] = $rows['email'];
		$registrant['date'] = $rows['date'];
		$registrant['id'] = $rows['id'];
		$registrant['status'] = $rows['status'];	
		$registrant['count'] = $rows['count'];
		
		$registrants[] = $registrant;
	}
}
$tpl->assign('registrantsLoop',$registrants);


?>