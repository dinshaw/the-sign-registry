<?php
if(isset($_SESSION['self_vals'])) $tpl->assign('self_vals',$_SESSION['self_vals']);

if(isset($_SESSION['extra_vals'])){

	$pairs = explode(",",$_SESSION['extra_vals']);
	
	//print_r($pairs);
	
	$extraVals = array();

	foreach($pairs AS $key => $val){
		list($val_id, $numVals) = explode("-",$val);
		$extraVals[$val_id]= $numVals;
	}
	
	
	
	//print_array($extraVals);
	$extraValsLoop = array();
	$total_extra_vals = 0;
	
	foreach($extraVals AS $key => $val){
		$sql = "SELECT CONCAT(first_name,' ',last_name) AS name
				FROM users
				WHERE id = '$key'";
				
		$query = mysql_query($sql);
		$result = mysql_fetch_array($query);
		$extraVals['name'] = $result['name'];
		$extraVals['id'] = $key;
		$extraVals['extraVals'] = $val;
		$extraVals['total'] = $val * __CFG_ValidationPrice;
		
		$extraValsLoop[] = $extraVals;
		
		//total numbers extra vals for reciept
		$total_extra_vals += $val;
		

	}
	$total_extra_vals += $_SESSION['self_vals'];
	$tpl->assign('extraValsLoop',$extraValsLoop);
	//print_array($extraVals);
	
}







?>