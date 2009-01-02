<?php
include "inc/php/paging.php";

$sql = "select * from adminlogin order by id asc LIMIT $start, $limit";

$query = mysql_query($sql);

while($rows = mysql_fetch_array($query))
{
	$accounts = array();
	
	$accounts['id'] = $rows['id'];
	$accounts['username'] = $rows['username'];
	$accounts['email'] = $rows['email'];
	
	$accountList[] = $accounts;
}

$tpl->assign('accountLoop', $accountList);


?>