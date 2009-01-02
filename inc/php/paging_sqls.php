<?php

if($_REQUEST['mode'] == "signs"){
	$sql = "SELECT count(*)
	FROM users u, users u2, signs s LEFT JOIN submissions su ON su.sign_id = s.id
	WHERE s.reg_id = u.id AND s.rec_id = u2.id ";

	if (isset($searchSql)) $sql .= $searchSql;

}elseif($_REQUEST['mode'] == "submissions"){
	$sql = "SELECT count(*)
	FROM users u, submissions s LEFT OUTER JOIN users u2 ON s.reg_id = u2.id
	WHERE s.rec_id = u.id ";
	if (isset($searchSql)) $sql .= $searchSql;

}elseif($_REQUEST['mode'] == "users"){
	$sql = "SELECT count(*) FROM users u ";
	if (isset($searchSql)) $sql .= $searchSql;
	
}elseif($_REQUEST['mode'] == "accounts"){
	$sql = "select count(*) from adminlogin";
}


?>