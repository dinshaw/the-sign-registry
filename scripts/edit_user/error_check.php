<?php

//set error check depending if they have already registered a user
$post_fields = array();

$post_fields = array('address','address2','city','state','country','zip','tel','tel2','email');
	
//filter imput for post fields and put ion $clean array
$clean = array();
foreach($post_fields as $key){
	$clean[$key] = $_POST[$key];
}

$errors = array(
//registrant errors
'sal' => "Please indicate a salutation.\n",
'firstName' => "Please enter your first name.\n",
'lastName' => "Please enter your last name.\n",
'address' => "Please enter your street address.\n",
'city' => "Please enter your city.\n",
'state' => "Please enter your state / province.\n",
'country' => "Please enter your country.\n",
'zip' => "Please enter your zip.\n",
'tel' => "Please enter a telephone number.\n",
'email' => "Please enter an email address / username.\n",
'invalidEmail' => "That does not appear to be a valid email address.\n",
'dob' => "Please enter your date of birth.\n",
'tc' => "You must read and accept the Terms &amp; Conditions before you continue.\n",
'emailDouble' => "Registrant email address is already in our database.\n",
'emailMatch' => "Registrant and Recipient email cannot be the same.\n",
//recipient error messages
'sal_2' => "Please indicate a salutation for the recipient.\n",
'firstName_2' => "Please enter a first name for the recipient.\n",
'lastName_2' => "Please enter a last name for the recipient.\n",
'address_2' => "Please enter a street address for the recipient.\n",
'city_2' => "Please enter a city for the recipient.\n",
'state_2' => "Please enter a state / province for the recipient.\n",
'country_2' => "Please enter a country for the recipient.\n",
'zip_2' => "Please enter a zip for the recipient.\n",
'tel_2' => "Please enter a telephone number for the recipient.\n",
'email_2' => "Please enter an email address / username for the recipient.\n",
'invalidEmail_2' => "Recipient email does not appear to be a valid email address.\n",
'emailDouble_2' => "Recipient email address is already in our database.\n"
);


//check for values
foreach($clean as $key => $val){
	//do omisions
	$omissions = array('tel2','address2');
	
	if(!in_array($key,$omissions)){
		//assign error
		if(!$val){
			$error .= $errors[$key];
		}
	}
}

/* start special errors */

//check for valid registrant email address if one has been entered
if ($clean['email'])
{
	$goodEmail = valid_email($clean['email']);
	
	if(!$goodEmail){
		$error .= $errors['invalidEmail'];
	}else{
		//check if the email already exists
		$email = $clean['email'];
		$sql = "select * from users where email = '$email' AND id != '$id'";
		$result = mysql_query($sql);
		$rows = mysql_num_rows($result);		
		if ($rows>0){$error .= $errors['emailDouble'];}
	}			
}

//registrant reassign
foreach($clean as $key => $val){
	${$key} = $val;
	$tpl->assign($key,$val);
}

?>