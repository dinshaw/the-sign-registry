<?php
if(!$_POST['validation']) $msg = "Please enter the details of your experience.";

foreach($_POST AS $var => $val){
	${$var} = $val;
	$tpl->assign($var,$val);
}

?>