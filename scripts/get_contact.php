<?php
$tpl->assign('address', __CFG_Address);
$tpl->assign('address2', __CFG_Address2);
$tpl->assign('phone', __CFG_Contact_Phone);
$tpl->assign('email', __CFG_Contact_Email);

$tpl->display('contact.tpl');
?>