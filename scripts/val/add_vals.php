<?php
$tpl->assign('sid',md5(session_id()));

if($_POST['action'] == "add"){
	
	if($_POST['userID']){
	
		//IF IT IS self_vals
		if($_POST['userID'] == $_SESSION['userID']){
			$_SESSION['self_vals'] += $_POST['vals'];
		}else{
			//SET THE SESSION VARIABLE self_vals TO userID-#vals,userID-#vals
			if($_SESSION['extra_vals']) $_SESSION['extra_vals'] .= ",";
			
			$_SESSION['extra_vals'] .= $_POST['userID']."-".$_POST['vals'];
		}
	}
}




include 'scripts/reg/get_overview_info.php';

include 'scripts/reg/get_recipients.php';

//EXTRACT THE EXTA VALS & SELF VALS DETAILS FROM THE SESION
include 'scripts/val/get_extra_vals.php';

$tpl->assign('userID',$_SESSION['userID']);
$tpl->display('val/more_vals.tpl');


?>