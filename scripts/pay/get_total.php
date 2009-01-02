<?php
if($_POST['pay_for'] == 'reg'){
	include 'scripts/reg/get_signs.php';
	
	$signTotal = $numUnpaidSigns * __CFG_SignPrice;
	
	$prepaidTotal = $totalExtraValidationAtempts * __CFG_ValidationPrice;
	
	$grandTotal = $signTotal + $prepaidTotal;
	# IF THE reg_rec HAS ADDED ADDITIONAL SEELFPAID VALIDATION ATEMPTS
	if(isset($_SESSION['self_vals'])){
		$selfValTotal = $_SESSION['self_vals'] * __CFG_ValidationPrice;
		$tpl->assign('selfValTotal',$selfValTotal);
		$tpl->assign('selfVals',$_SESSION['self_vals']);
		$grandTotal += $selfValTotal;
	}
	
	if(isset($extraValsLoop)){
		foreach($extraValsLoop AS $array){
			$grandTotal += $array['total'];
		}
	}
	
	
	$tpl->assign('numUnpaidSigns',$numUnpaidSigns);
	$tpl->assign('signTotal',$signTotal);
	$tpl->assign('totalExtraValidationAtempts',$totalExtraValidationAtempts);
	$tpl->assign('prepaidTotal',$prepaidTotal);
	$tpl->assign('grandTotal',$grandTotal);

	$tpl->display('pay/pay_1.tpl');
	
}
?>