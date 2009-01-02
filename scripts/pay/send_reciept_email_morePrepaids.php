<?php

//GET THE INFO WE NEED
$sql = "SELECT sal, last_name, email FROM users WHERE id = '$userID'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);
extract($result);


$today = date("d\/m\/y");
if($_POST['validation']){
	$validation = $_POST['validation'];
}else{
	$subID = $_SESSION['subID'];
	$sql = "SELECT text FROM submissions WHERE id = '$subID'";
	$query = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($query);
	$validation = $row['text'];
}

$html = '<fieldset><legend>Dear ' . $sal . ' ' . $last_name . ',</legend>
This email will serve as a receipt for your recent visit to The Sign Registry on '.$today.'.<br /><br />

You have purchased '.$vals.' additional validation attempts for your account:<br /><br />
 
Thank you for visiting The Sign Registry.
<br />
<br />
-'. __CFG_EmailSig . '<fieldset>';

$encodedChars = array('&nbsp;','&prime;','<br>','<br />');
$decodeChars = array(" ","'","\n","\n");
$text = strip_tags(str_replace($encodedChars,$decodeChars,$html));

$subject = "Validation reciept from TheSignRegistry.com";
mail_multi_alt($email,__CFG_MPEmailBoundary,$subject,$text,$html,$id);

?>