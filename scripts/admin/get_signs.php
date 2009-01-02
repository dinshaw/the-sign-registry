<?php

//GET SIGN TYPES
include 'scripts/admin/get_signTypes.php';

include 'scripts/admin/search_sqls.php';
 
include 'inc/php/paging.php';

$sql = "SELECT s.id AS sign_id, LEFT(s.description, 30) AS description, s.type AS type, s.status AS status, s.reg_date AS reg_date, CONCAT(u.first_name,' ',u.last_name) AS reg_name, u.id AS reg_id, CONCAT(u2.first_name,' ',u2.last_name) AS rec_name, u2.id AS rec_id,  su.id AS sub_id
FROM users u, users u2, signs s LEFT JOIN submissions su ON su.sign_id = s.id
WHERE s.reg_id = u.id AND s.rec_id = u2.id ";
 if (isset($searchSql)) $sql .= $searchSql; 
$sql .= " LIMIT $start, $limit";


$query = mysql_query($sql) or die ($sql . "<br />" . mysql_error());
 
$signs = array();
 
while($result = mysql_fetch_array($query)){
 	$sign= array();
	
 	$sign['sign_id'] = $result['sign_id'];
	$sign['description'] = $result['description'];
	$sign['type'] = $result['type'];
	$sign['status'] = $result['status'];
	$sign['reg_date'] = $result['reg_date'];
	$sign['reg_name'] = $result['reg_name'];
	$sign['rec_name'] = $result['rec_name'];
	$sign['sub_id'] = $result['sub_id'];
	$sign['reg_id'] = $result['reg_id'];
	$sign['rec_id'] = $result['rec_id'];
	
	$signs[] = $sign;
}
$tpl->assign('signLoop',$signs);


?>