<?php
include 'scripts/admin/search_sqls.php';

include 'inc/php/paging.php';

$sql = "SELECT CONCAT(u.first_name,' ',u.last_name) AS name, u.id AS id, u.email AS email, status, 
CASE 
	WHEN u.type = 1
		THEN 'Regisrant'
	WHEN  u.type = 2
		THEN 'Recipient'
	WHEN  u.type = 3
		THEN 'Registrant / Recipient'
	ELSE 'Unknown'
END AS type,
u.reg_date AS reg_date
FROM users u ";
if (isset($searchSql)) $sql .= $searchSql; 

 
 $query = mysql_query($sql) or die(mysql_error());
 
 $users = array();
 
 while($result = mysql_fetch_array($query)){
 	$user= array();
	
 	$user['id'] = $result['id'];
	$user['name'] = $result['name'];
	$user['status'] = $result['status'];
	$user['type'] = $result['type'];
	$user['email'] = $result['email'];
	$user['reg_date'] = $result['reg_date'];

	
	$users[] = $user;
}
$tpl->assign('userLoop',$users);


?>