<?php
$userID = $_SESSION['userID'];
$amount = $_POST['OrderTotal'];

if($_POST['pay_for'] == 'reg'){
	//update prepaid counts and status
	$sql = "SELECT s.id AS id, s.prepaids AS prepaids, s.rec_id as rec_id, s.reg_date AS dateTime, CONCAT(LEFT(s.description,25),'...') AS description, CONCAT(u.first_name,' ',u.last_name) AS recName
			FROM signs s, users u
			WHERE s.reg_id = '$userID' AND s.status = '0' AND u.id = s.rec_id";
			
	$query = mysql_query($sql) or die(mysql_error());
	
	$prepaids = array();
	$signs = "<tr><th>Recipient Name</th><th>Registration date</th></tr>";
	$numSigns = 0;
	while($rows = mysql_fetch_array($query)){
	
		// GATHER THE ID'S OF THE USERS WHO ARE RECEIVING PREPAIDS FROM THE PAYMEBT OF THESE SIGNS
		// THE UPDATE TO THIER PROFILE HAPPES IN THE NEXT LOOP
		$prepaids[$rows['rec_id']] = $rows['prepaids'];
		
		//GET SIGNS FOR EMAIL RECIEPT
		$signs .= '<tr><td> ' . $rows['recName'] . ' </td><td> ' . $rows['dateTime'] . ' </td></tr>';
		
		// UPDATE EACH SIGN THAT WAS PAID WITH A "PAID" STATUS
		$id = $rows['id'];
		
		//RECORD THE NUMBER OF SIGNS
		$numSigns++;
		
		$sql = "UPDATE signs SET status = '1' WHERE id = '$id'";
		$signQuery = mysql_query($sql);
	
	}
	unset($_SESSION['signID']);
	
	foreach($prepaids AS $id => $prepaid){
		$sql = "UPDATE users SET prepaids = prepaids + '$prepaid' WHERE id = '$id'";
		$query = mysql_query($sql) or die(mysql_error());
	}
	
	//UPDATE SELF VALS
	if($_SESSION['self_vals']){
		$selfVals = $_SESSION['self_vals'];
		$sql = "UPDATE users SET prepaids = prepaids + '$selfVals' WHERE id = '$userID'";
		$query = mysql_query($sql);
		
	}
	
	//UPDATE other extra vals
	if($_SESSION['extra_vals']){
		include 'scripts/val/get_extra_vals.php';
		if($extraValsLoop){
			foreach($extraValsLoop AS $array){
				$extra_val_id = $array['id'];
				$extra_val_vals = $array['extraVals'];
				$sql = "UPDATE users SET prepaids = prepaids + '$extra_val_vals' WHERE id = '$extra_val_id'";
				$query = mysql_query($sql);
		
			}
		}

	}
	
	// GET THE RECEIPT DETAILS
	
	
	$tpl->assign('sid',md5(session_id()));
	
	$tpl->assign('numSigns',$numSigns);
	
	include 'scripts/pay/send_reciept_email_reg.php';
	
	$tpl->display('pay/success_reg.tpl');
	
}elseif($_POST['pay_for'] == "val"){

	$vals = $_POST['vals'] -1;
	$sql = "UPDATE users SET prepaids = prepaids + '$vals' WHERE id = '$userID'";
	$query = mysql_query($sql);
	include 'scripts/pay/send_reciept_email_val.php';
	$tpl->assign('sid',md5(session_id()));
	
	$tpl->display('pay/success_val.tpl');
	
}elseif($_POST['pay_for'] == "morePrepaids"){

	$vals = $_POST['vals'];
	$sql = "UPDATE users SET prepaids = prepaids + '$vals' WHERE id = '$userID'";
	$query = mysql_query($sql);
	include 'scripts/pay/send_reciept_email_morePrepaids.php';
	$tpl->assign('sid',md5(session_id()));
	
	$tpl->display('pay/success_morePrepaids.tpl');
}

?>