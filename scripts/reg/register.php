<?php
//get the years staring with this year for 100 years
$yearLoop = get_years(0,100);
$tpl->assign('yearLoop',$yearLoop);

if($_SESSION['valid_user']) include 'scripts/reg/get_recipients.php';
$tpl->assign('sid',md5(session_id()));

//include 'scripts/reg/test_data.php';

$tpl->assign('signPrice',__CFG_SignPrice);
$tpl->assign('defaultValidations',__CFG_DefaultValidations);

if($_REQUEST['action'] == "reg"){

	include 'scripts/reg/error_check.php';
	
	if(isset($_POST['step1']) || isset($_POST['save1'])){
	
		if(!$error){
			include 'scripts/reg/process_step1.php';
			include 'scripts/reg/get_overview_info.php';
			
			//if the user is registered goto step2	 and erase the current sign id so we can make a new one
			unset($_SESSION['signID']);	
			$tpl->display('reg/step2.tpl');
					
		}else{
			//return step1 errors
			$tpl->assign('msg',$error);
			
			//if the user is registering redisplay step1
			$tpl->display('reg/step1.tpl');
		}
	
	}elseif(isset($_POST['step2']) || isset($_POST['save2'])){
	
		if(!$error){
		
			include 'scripts/reg/process_step2.php';
			
			include 'scripts/reg/get_reg_info.php';
			
			include 'scripts/reg/get_rec_info.php';
			
			include 'scripts/reg/get_signs.php';
			
			$tpl->display('reg/step3.tpl');
			
		}elseif($_POST['add_vals_to_recip']){
			
		}else{
		
			include 'scripts/reg/get_overview_info.php';
			
			//return step2 errors
			$tpl->assign('msg',$error);
			$tpl->assign('userID',$userID);
			$tpl->assign('recID',$recID);
			
			if($_POST['save2']){
				$tpl->assign('edit',"true");
			}
			
			
			$tpl->display('reg/step2.tpl');
		}
	
	//unregister the sign id if we are going to make a new one	
	}else{
	
		$_SESSION['signID'] = '';
		unset($_SESSION['signID']);
		$tpl->display('reg/step1.tpl');
	}
	
}elseif($_POST['action'] == "edit"){
	
	if(isset($_POST['delete_sign'])){
	
		if($_SESSION['userID'] && $_POST['signID']){
			$signID = $_POST['signID'];
			$sql = "DELETE FROM signs WHERE id = '$signID'";
			$query = mysql_query($sql);
			
			$msg = "Sign #" . $signID . " was deleted.";
			$tpl->assign('msg',$msg);
		}
		include 'scripts/reg/get_reg_info.php';
		include 'scripts/reg/get_rec_info.php';
		include 'scripts/reg/get_signs.php';
		$tpl->display('reg/step3.tpl');
		
	}elseif(isset($_POST['delete_recip'])){
		if($_SESSION['userID'] && $_POST['recID']){
			$recID = $_POST['recID'];
			$sql = "DELETE FROM users WHERE id = '$recID' AND status = '0'";
			$query = mysql_query($sql);
			
			$tpl->assign('msg','Recipient was deleted');
		}
		include 'scripts/reg/get_reg_info.php';
		include 'scripts/reg/get_rec_info.php';
		include 'scripts/reg/get_signs.php';
		$tpl->display('reg/step3.tpl');
		
	}elseif($_POST['edit_sign']){
		$signID = $_POST['signID'];
		$sql = "SELECT description, rec_id, prepaids 
				FROM signs 
				WHERE id = '$signID'";
		
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
		
		$description = $row['description'];
		$prepaids = $row['prepaids'] - __CFG_DefaultValidations;
		
		$_SESSION['signID'] = $signID; 
		$_SESSION['recID'] = $row['rec_id']; 		
		
		$tpl->assign('description',$description);
		$tpl->assign('signID',$signID);
		$tpl->assign('prepaids',$prepaids);
		$tpl->assign('edit','true');
		
		include 'scripts/reg/get_overview_info.php';
		$tpl->display('reg/step2.tpl');	
	}

}else{
	
	$tpl->assign('sign_price',__CFG_SignPrice);
	$tpl->assign('default_prepaids',__CFG_DefaultPrepaids);
	$tpl->display('reg/step1.tpl');
}
?>
