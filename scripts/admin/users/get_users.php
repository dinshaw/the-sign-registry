<?php
//clear all search values
$postVars = array();
$searchVars = array();
$searchSql = "";

if($_REQUEST['action'] == "search"){

	//list the possible search criteria
	$postVars = array('email','name','gender');
	
	//check if there is a corosponding search value
	foreach($postVars as $var){
		if($_POST[$var]){
			//list filled search vlues
			$searchVars[$var] = $_POST[$var];
		}
	}
	//build sql with - like %asd%
	foreach($searchVars as $var => $val){
		if($searchSql)
			$searchSql .= " and ";
		else
			$searchSql = "where ";

		$searchSql .= $var . " like '%" . $val . "%'";
			
		$tpl->assign($var, $val);	
	}
	
	//check date range
	if($_POST['s_dob_year'] && $_POST['e_dob_year']){
		$s_year = $_POST['s_dob_year'];
		$e_year = $_POST['e_dob_year'];
		if($searchSql)
			$searchSql .= " and ";
		else
			$searchSql = "where ";
			
			$searchSql .= "YEAR(dob)" . " BETWEEN '" . $s_year . "' AND '" . $e_year . "'";
			$tpl->assign('s_dob_year', $s_year);
			$tpl->assign('e_dob_year', $e_year);
	}
	if($_POST['s_dob_month'] && $_POST['e_dob_month']){
		$s_month = $_POST['s_dob_month'];
		$e_month = $_POST['e_dob_month'];
		if($searchSql)
			$searchSql .= " and ";
		else
			$searchSql = "where ";
			
			$searchSql .= "month(dob)" . " BETWEEN '" . $s_month . "' AND '" . $e_month . "'";
			$tpl->assign('s_dob_month', $s_month);
			$tpl->assign('e_dob_month', $e_month);
	}
	if($_POST['s_dob_day'] && $_POST['e_dob_day']){
		$s_day = $_POST['s_dob_day'];
		$e_day = $_POST['e_dob_day'];
		if($searchSql)
			$searchSql .= " and ";
		else
			$searchSql = "where ";
			
			$searchSql .= "DAYOFMONTH(dob)" . " BETWEEN '" . $s_day . "' AND '" . $e_day . "'";
			$tpl->assign('s_dob_day', $s_day);
			$tpl->assign('e_dob_day', $e_day);
	}
	
	$tpl->assign('search','1');
}

include "inc/php/paging.php";

$sql = "SELECT id, name, email, dob, gender, reg_date FROM users $searchSql ORDER BY id ASC LIMIT $start, $limit";
$query = mysql_query($sql) or die(mysql_error());

while($rows = mysql_fetch_array($query))
{
	$users = array();
	
	$users['id'] = $rows['id'];
	$users['name'] = $rows['name'];
	$users['email'] = $rows['email'];
	$users['dob'] = $rows['dob'];
	$users['gender'] = $rows['gender'];
	$users['reg_date'] = $rows['reg_date'];
	
	
	$usersList[] = $users;
}

//how many userson the email list?
$emailCountSql = "select count(*) from users";
$emailCountResult = mysql_query($emailCountSql);
$emailCountRow = mysql_fetch_array($emailCountResult, MYSQL_ASSOC);
$emailCount = $emailCountRow["count(*)"];

//assign loop and other stuff
$tpl->assign('emailCount', $emailCount);
$tpl->assign('usersLoop', $usersList);


?>