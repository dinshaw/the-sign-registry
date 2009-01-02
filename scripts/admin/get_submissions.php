<?php

include 'scripts/admin/search_sqls.php';

include 'inc/php/paging.php';

$sql = "SELECT CONCAT(u.first_name,' ',u.last_name) AS rec_name, u.id AS rec_id, CONCAT(u2.first_name,' ',u2.last_name) AS reg_name, u2.id AS reg_id, s.id AS sub_id, s.text AS submission_text, s.status AS status, s.dateTime AS sub_date
FROM users u, submissions s LEFT OUTER JOIN users u2 ON s.reg_id = u2.id
WHERE s.rec_id = u.id ";
if (isset($searchSql)) $sql .= $searchSql; 
$sql .= " LIMIT $start, $limit";

 $query = mysql_query($sql) or die(mysql_error());
 
 $submissions = array();
 
 while($result = mysql_fetch_array($query)){
 	$submission= array();
	
 	$submission['sub_id'] = $result['sub_id'];
	$submission['description'] = $result['submission_text'];
	$submission['status'] = $result['status'];
	$submission['sub_date'] = $result['sub_date'];
	$submission['reg_name'] = $result['reg_name'];
	$submission['rec_name'] = $result['rec_name'];
	$submission['sub_id'] = $result['sub_id'];
	$submission['rec_id'] = $result['rec_id'];
	$submission['reg_id'] = $result['reg_id'];
	
	$submissions[] = $submission;
}
$tpl->assign('submissionLoop',$submissions);


?>