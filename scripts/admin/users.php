<?php

if( isset($_REQUEST['action']) && $_REQUEST['action'] == "update"){
//update
}


include 'scripts/admin/get_users.php';
$tpl->display('admin/users.tpl');
?>