<?php
if (isset($_REQUEST['mode']) && isset($_REQUEST['search'])) {
	
if ($_REQUEST['mode'] == "signs" && $_REQUEST['search'] = "true"){
	
	if($_REQUEST['s_signID']){
		$s_signID = $_REQUEST['s_signID'];
		$searchSql .= "AND s.id = '$s_signID' ";
	
	}
	if($_REQUEST['s_reg_first_name']){
		$s_reg_first_name = $_REQUEST['s_reg_first_name'];
		$searchSql .= "AND u.first_name LIKE '%$s_reg_first_name%' ";
		
	}
	if($_REQUEST['s_reg_last_name']){
		$s_reg_last_name = $_REQUEST['s_reg_last_name'];
		$searchSql .= "AND u.last_name LIKE '%$s_reg_last_name%' ";
		
	}
	if($_REQUEST['s_rec_first_name']){
		$s_rec_first_name = $_REQUEST['s_rec_first_name'];
		$searchSql .= "AND u2.first_name LIKE '%$s_rec_first_name%' ";
		
	}
	if($_REQUEST['s_rec_last_name']){
		$s_rec_last_name = $_REQUEST['s_rec_last_name'];
		$searchSql .= "AND u2.last_name LIKE '%$s_rec_last_name%' ";
	}
	if($_REQUEST['s_description']){
		$s_description = $_REQUEST['s_description'];
		$searchSql .= "AND s.description like '%$s_description%' ";
	}
	if($_REQUEST['s_type']){
		$s_type = $_REQUEST['s_type'];
		$searchSql .= "AND s.type = '$s_type' ";
	}
	if($_REQUEST['s_status']){
		$s_status = $_REQUEST['s_status'];
		$searchSql .= "AND s.status = '$s_status' ";
	}
	
		//date search
		if($_REQUEST['s_from_reg_day']){
			$s_from_reg_day = $_REQUEST['s_from_reg_day'];
			$searchSql .= "AND DAYOFMONTH(s.reg_date) >= '$s_from_reg_day' ";
		}
		if($_REQUEST['s_from_reg_month']){
			$s_from_reg_month = $_REQUEST['s_from_reg_month'];
			$searchSql .= "AND MONTH(s.reg_date) >= '$s_from_reg_month' ";
		}
		if($_REQUEST['s_from_reg_year']){
			$s_from_reg_year = $_REQUEST['s_from_reg_year'];
			$searchSql .= "AND YEAR(s.reg_date) >= '$s_from_reg_year' ";
		}
		if($_REQUEST['s_to_reg_day']){
			$s_to_reg_day = $_REQUEST['s_to_reg_day'];
			$searchSql .= "AND  DAYOFMONTH(s.reg_date) <= '$s_to_reg_day' ";
		}
		if($_REQUEST['s_to_reg_month']){
			$s_to_reg_month = $_REQUEST['s_to_reg_month'];
			$searchSql .= "AND MONTH(s.reg_date) <= '$s_to_reg_month' ";
		}
		if($_REQUEST['s_to_reg_year']){
			$s_to_reg_year = $_REQUEST['s_to_reg_year'];
			$searchSql .= "AND YEAR(s.reg_date) <= '$s_to_reg_year' ";
		}
	
	

}elseif ($_REQUEST['mode'] == "submissions" && $_REQUEST['search'] = "true"){

	if($_REQUEST['s_subID']){
		$s_subID = $_REQUEST['s_subID'];
		$searchSql .= "AND s.id = '$subID' ";
	}
	if($_REQUEST['s_reg_first_name']){
		$s_reg_first_name = $_REQUEST['s_reg_first_name'];
		$searchSql .= "AND u2.first_name LIKE '%$s_reg_first_name%' ";
	}
	if($_REQUEST['s_reg_last_name']){
		$s_reg_last_name = $_REQUEST['s_reg_last_name'];
		$searchSql .= "AND u2.last_name LIKE '%$s_reg_last_name%' ";
	}
	if($_REQUEST['s_rec_first_name']){
		$s_rec_first_name = $_REQUEST['s_rec_first_name'];
		$searchSql .= "AND u.first_name LIKE '%$s_rec_first_name%' ";
	}
	if($_REQUEST['s_rec_last_name']){
		$s_rec_last_name = $_REQUEST['s_rec_last_name'];
		$searchSql .= "AND u.last_name LIKE '%$s_rec_last_name%' ";
	}
	if($_REQUEST['s_description']){
		$s_description = $_REQUEST['s_description'];
		$searchSql .= "AND s.description like '%$s_description%' ";
	}
	if($_REQUEST['s_status']){
		$s_status = $_REQUEST['s_status'];
		$searchSql .= "AND s.status = '$s_status' ";
	}
	
	//date search
	if($_REQUEST['s_from_reg_day']){
		$s_from_reg_day = $_REQUEST['s_from_reg_day'];
		$searchSql .= "AND DAYOFMONTH(s.dateTime) >= '$s_from_reg_day' ";
	}
	if($_REQUEST['s_from_reg_month']){
		$s_from_reg_year = $_REQUEST['s_from_reg_month'];
		$searchSql .= "AND MONTH(s.dateTime) >= '$s_from_reg_year' ";
	}
	if($_REQUEST['s_from_reg_year']){
		$s_from_reg_month = $_REQUEST['s_from_reg_year'];
		$searchSql .= "AND YEAR(s.dateTime) >= '$s_from_reg_year' ";
	}
	if($_REQUEST['s_to_reg_day']){
		$s_to_reg_day = $_REQUEST['s_to_reg_day'];
		$searchSql .= "AND  DAYOFMONTH(s.dateTime) <= '$s_to_reg_day' ";
	}
	if($_REQUEST['s_to_reg_month']){
		$s_to_reg_month = $_REQUEST['s_to_reg_month'];
		$searchSql .= "AND MONTH(s.dateTime) <= '$s_to_reg_month' ";
	}
	if($_REQUEST['s_to_reg_year']){
		$s_to_reg_year = $_REQUEST['s_to_reg_year'];
		$searchSql .= "AND YEAR(s.dateTime) <= '$s_to_reg_year' ";
	}

}elseif($_REQUEST['mode'] == "users" && $_REQUEST['search'] = "true"){

	
	if(isset($_REQUEST['s_id'])){
		if(!$searchSql){
			$searchSql = "WHERE ";
		}else{
			$searchSql .= " AND ";
		}
		$s_id = $_REQUEST['s_id'];
		$searchSql .= "u.id = '$s_id' ";
	}
	if($_REQUEST['s_first_name']){
		if(!$searchSql){
			$searchSql = "WHERE ";
		}else{
			$searchSql .= " AND ";
		}
		$s_first_name = $_REQUEST['s_first_name'];
		$searchSql .= "u.first_name LIKE '%$s_first_name%' ";
	}
	if($_REQUEST['s_last_name']){
		if(!$searchSql){
			$searchSql = "WHERE ";
		}else{
			$searchSql .= " AND ";
		}
		$s_last_name = $_REQUEST['s_last_name'];
		$searchSql .= "u.last_name LIKE '%$s_last_name%' ";
	}
	if($_REQUEST['s_type']){
		if(!$searchSql){
			$searchSql = "WHERE ";
		}else{
			$searchSql .= " AND ";
		}
		$s_type = $_REQUEST['s_type'];
		$searchSql .= "u.type = '$s_type' ";
	}
	//date search
	if($_REQUEST['s_from_reg_day']){
		if(!$searchSql){
			$searchSql = "WHERE ";
		}else{
			$searchSql .= " AND ";
		}
		$s_from_reg_day = $_REQUEST['s_from_reg_day'];
		$searchSql .= "DAYOFMONTH(u.reg_date) >= '$s_from_reg_day' ";
	}
	if($_REQUEST['s_from_reg_month']){
		if(!$searchSql){
			$searchSql = "WHERE ";
		}else{
			$searchSql .= " AND ";
		}
		$s_from_reg_year = $_REQUEST['s_from_reg_month'];
		$searchSql .= "MONTH(u.reg_date) >= '$s_from_reg_year' ";
	}
	if($_REQUEST['s_from_reg_year']){
		if(!$searchSql){
			$searchSql = "WHERE ";
		}else{
			$searchSql .= " AND ";
		}
		$s_from_reg_month = $_REQUEST['s_from_reg_year'];
		$searchSql .= "YEAR(u.reg_date) >= '$s_from_reg_year' ";
	}
	if($_REQUEST['s_to_reg_day']){
		if(!$searchSql){
			$searchSql = "WHERE ";
		}else{
			$searchSql .= " AND ";
		}
		$s_to_reg_day = $_REQUEST['s_to_reg_day'];
		$searchSql .= "DAYOFMONTH(u.reg_date) <= '$s_to_reg_day' ";
	}
	if($_REQUEST['s_to_reg_month']){
		if(!$searchSql){
			$searchSql = "WHERE ";
		}else{
			$searchSql .= " AND ";
		}
		$s_to_reg_month = $_REQUEST['s_to_reg_month'];
		$searchSql .= "MONTH(u.reg_date) <= '$s_to_reg_month' ";
	}
	if($_REQUEST['s_to_reg_year']){
		if(!$searchSql){
			$searchSql = "WHERE ";
		}else{
			$searchSql .= " AND ";
		}
		$s_to_reg_year = $_REQUEST['s_to_reg_year'];
		$searchSql .= "YEAR(u.reg_date) <= '$s_to_reg_year' ";
	}
}
}
	
		





?>