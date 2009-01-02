<?php
$recID = $_SESSION['recID'];
$userID = $_SESSION['userID'];
//GET THE INFO WE NEED
$sql = "SELECT sal AS recSal, last_name AS recLastName, email FROM users WHERE id = '$recID'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);
extract($result);

$sql = "SELECT first_name AS regFirstName, last_name AS regLastName FROM users WHERE id = '$userID'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);
extract($result);

$html = '<fieldset><legend>Dear ' . $recSal . ' ' . $recLastName . ',</legend>
<strong>' . $regFirstName . ' ' . $regLastName . '</strong> has registered a sign at <a href="http://www.TheSignRegistry.com">The Sign Registry</a> that he/she plans on leaving for you after his/her physical death.<br /><br />

The purpose of <a href="http://www.TheSignRegistry.com">The Sign Registry</a> is to help prove that our consciousness survives our physical death. <a href="http://www.TheSignRegistry.com">The Sign Registry</a> is a service offered by <http://www.foreverfamilyfoundation.org">Forever Family Foundation</a>, a non-profit, non-sectarian organization that supports the premise that life does not end with physical death, furthers the understanding of Afterlife Science and survival of consciousness, and offers support to the bereaved. The active members of the organization along with the executive board include published scientists, researchers and philosophers who have researched and worked for years to confirm an existence beyond this physical world.<br /><br />

If you believe you have received an after death communication from <strong>' . $regFirstName . ' ' . $regLastName . '</strong> following his passing, you will be able to log onto our website at <a href="http://www.TheSignRegistry.com">www.TheSignRegistry.com</a> to confirm that the sign you received matches. What greater gift could there be than the knowledge that your loved ones are still with you after their physical death.<br /><br />

While none of us knows what the future holds, this gift may not present itself for many years. Rest assured <a href="http://www.TheSignRegistry.com">The Sign Registry</a> will maintain the after death communication that <strong>' . $regFirstName . ' ' . $regLastName . '</strong> has left for you today.<br /><br />

Please keep a copy of this email with your login email and password in a safe place so you may have access to it when needed.<br /><br />

To learn more about the science that supports survival of consciousness, please visit <a href="http://www.foreverfamilyfoundation.org">www.foreverfamilyfoundation.org</a>, and consider becoming a member; membership is free.<br /><br />
Your username is: <strong>' . $email . '</strong><br />
Your password for this sign is: <strong>' . $rec_password . '</strong>
<br />
<br />
-'. __CFG_EmailSig;

$encodedChars = array('&nbsp;','&prime;','<br>','<br />');
$decodeChars = array(" ","'","\n","\n");
$text = strip_tags(str_replace($encodedChars,$decodeChars,$html));

$subject = $regFirstName . " " . $regLastName . " has registered a sign for you.";
mail_multi_alt($email,__CFG_MPEmailBoundary,$subject,$text,$html,$recID);

?>