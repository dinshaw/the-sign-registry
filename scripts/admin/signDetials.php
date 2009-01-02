<?php
$signID = $_REQUEST['signID'];

$sql = "SELECT s.description, CONCAT(u.first_name,' ',u.last_name) AS reg_name, u.id AS reg_id, CONCAT(u2.first_name,' ',u2.last_name) AS rec_name, u2.id AS rec_id, s.rec_id, s.prepaids 
		FROM signs s,users u,users u2
		WHERE s.id = '$signID' AND s.reg_id = u.id AND s.rec_id = u2.id";

$query = mysql_query($sql);
$row = mysql_fetch_array($query);

$description = $row['description'];
$prepaids = $row['prepaids'];
$reg_name = $row['reg_name'];
$rec_name = $row['rec_name'];
$rec_id = $row['rec_id'];
$reg_id = $row['reg_id'];

$tpl->assign('description',$description);
$tpl->assign('signID',$signID);
$tpl->assign('reg_name',$reg_name);
$tpl->assign('rec_name',$rec_name);
$tpl->assign('rec_id',$rec_id);
$tpl->assign('reg_id',$reg_id);

include 'scripts/admin/get_possible_vals.php';

$tpl->display('admin/signDetails.tpl');








?>