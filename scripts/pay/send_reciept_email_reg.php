<?php

//GET THE INFO WE NEED
$sql = "SELECT sal, last_name, email FROM users WHERE id = '$userID'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);
extract($result);

$today = date("m\/d\/y");
 
if($numSigns == 1){
	$numSigns .= " sign";
}elseif($numSigns > 1){
	$numSigns .= " signs";
}else{
	unset($numSigns);
}

//include 'scripts/val/get_extra_vals.php';

$html = '<fieldset><legend>Dear ' . $sal . ' ' . $last_name . ',</legend>
This email will serve as a receipt for your recent purchase at The Sign Registry.<br /><br />

Our records show that on '. $today .' you '; 

if($numSigns){
	$html .= 'registered '.$numSigns;
}

if($extraValsLoop || $self_vals){
	if($numSigns){
		$html .= ' and ';
	}
	$html .= 'purchased '.$total_extra_vals.' extra validation attempts ';
}	

$html .= ' for a total charge of $'.$amount.'.<br /><br />';

	$html .= '
	<table>';
//CREATE THE SIGN RECIEPT TABLE
if($numSigns){
	$html .= '
		<tr class="title">
			<th colspan="2">Signs Registered</th>
		</tr>';
	
	//iinsert sign rows
	$html .= $signs;
}


if($extraValsLoop || $_SESSION['self_vals']){

	$html .= 	'
	<tr class="title">
		<th colspan="2">Additional validations purchased:</th>
	</tr>';
	
	if($_SESSION['self_vals']){
		$html .= 	'
		<tr>
			<th>Your account</th>
			<th>'.$_SESSION['self_vals'].'</th>
		</tr>';
	}
	
	if($extraValsLoop){
		//print_array($extraValsLoop);
		foreach($extraValsLoop AS $arr){
			$html .= 	'<tr>
				<th>'.$arr["name"].'</th>
				<th>'.$arr["extraVals"].'</th>
			</tr>';
		}
	}
}

unset($_SESSION['self_vals']);
unset($_SESSION['extra_vals']);

$html .= '
</table><br /><br />';


$html .= 'Thank you for visiting The Sign Registry.
<br />
<br />
-'. __CFG_EmailSig;

$encodedChars = array('&nbsp;','&prime;','<br>','<br />');
$decodeChars = array(" ","'","\n","\n");
$text = strip_tags(str_replace($encodedChars,$decodeChars,$html));

$subject = "Payment reciept from TheSignRegistry.com";
mail_multi_alt($email,__CFG_MPEmailBoundary,$subject,$text,$html,$id);

//echo $html;

?>