<?php
//get the years staring with this year for 100 years
$yearLoop = get_years(0,100);
$tpl->assign('yearLoop',$yearLoop);

//fill in the form
//include 'scripts/reg/test_data.php';

$tpl->assign('signPrice',__CFG_SignPrice);
$tpl->assign('defaultValidations',__CFG_DefaultValidations);

if( isset($_POST['action']) ){

	if($_POST['action'] == "reg"){

		include 'scripts/reg/error_check.php';

		if(!$error){
			include 'scripts/reg/process_step1.php';
			include 'scripts/reg/get_overview_info.php';

			//if the user is registering goto step2			
			$tpl->display('reg/step2.tpl');

		}else{
			//return step1 errors
			$tpl->assign('msg',$error);

			//if the user is registering redisplay step1
			$tpl->display('reg/step1.tpl');
		}

	}else{

		$tpl->display('reg/step1.tpl');
	}
}else{

	$tpl->display('reg/step1.tpl');
}
?>
