<?php
//check date range
if($_POST['s_dob_year'] && $_POST['e_dob_year']){
	$s_year = $_POST['s_dob_year'];
	$e_year = $_POST['e_dob_year'];
	if($postFilter)
		$postFilter .= " and ";
	else
		$postFilter = "where ";
		
		$postFilter .= "YEAR(dob)" . " BETWEEN '" . $s_year . "' AND '" . $e_year . "'";
}

if($_POST['s_dob_month'] && $_POST['e_dob_month']){
	$s_month = $_POST['s_dob_month'];
	$e_month = $_POST['e_dob_month'];
	if($postFilter)
		$postFilter .= " and ";
	else
		$postFilter = "where ";
		
		$postFilter .= "month(dob)" . " BETWEEN '" . $s_month . "' AND '" . $e_month . "'";
}
if($_POST['s_dob_day'] && $_POST['e_dob_day']){
	$s_day = $_POST['s_dob_day'];
	$e_day = $_POST['e_dob_day'];
	if($postFilter)
		$postFilter .= " and ";
	else
		$postFilter = "where ";
		
		$postFilter .= "DAYOFMONTH(dob)" . " BETWEEN '" . $s_day . "' AND '" . $e_day . "'";
}

if($_POST['gender']){
	$gender = $_POST['gender'];
	if($postFilter)
		$postFilter .= " and ";
	else
		$postFilter = "where ";
		
		$postFilter .= "gender" . " = '" . $gender . "'";
}
	



?>