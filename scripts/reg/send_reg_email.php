<?php
$html = '<fieldset><legend>Hello ' . $_SESSION['welcome_name'] . ',</legend>
You have successfully registered at the The Sign Registry web site.<br />
Your username is: <b>'.$email.'</b>.<br />
Your password is: <b>'.$reg_password.'</b><br />
<br>
-'. __CFG_EmailSig . '</fieldset>';

$encodedChars =array('&nbsp;','&prime;','<br>','<br />');
$decodeChars = array(" ","'","\n","\n");
$text = strip_tags(str_replace($encodedChars,$decodeChars,$html));

//mail($_POST['email'],'Your new admin password',$adminEmail,$adminHeaders);
mail_multi_alt($email,__CFG_MPEmailBoundary,'TheSignRegistry.com Welcome Email',$text,$html,$_SESSION['userID']);

?>