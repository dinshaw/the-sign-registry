<?php
$post_fields = array();
	

$post_fields = array(
# Billing address
'FirstName','LastName','PayerStreet1','PayerStreet2','PayerCity','PayerState','PayerPostalCode','PayerCountry', 'IPAddress',
# CC DATA
'CreditCardType','CreditCardNumber','CVV2','ExpMonth','ExpYear'
);
	
//filter imput for post fields and put ion $clean array
$clean = array();
foreach($post_fields as $key){
	$clean[$key] = $_POST[$key];
}

$errors = array(
//registrant errors
'sal' => "Please indicate a salutation.\n",
'FirstName' => "Please enter your first name.\n",
'LastName' => "Please enter your last name.\n",
'PayerStreet1' => "Please enter your street address.\n",
'PayerCity' => "Please enter your city.\n",
'PayerState' => "Please enter your state / province.\n",
'PayerCountry' => "Please enter your country.\n",
'PayerPostalCode' => "Please enter your zip.\n",
'CreditCardType' => "Please enter credit card type.\n",
'CreditCardNumber' => "Please credit card number.\n",
'CVV2' => "Please enter CVV2 number.\n",
'ExpMonth' => "Please enter credit card expriation month.\n",
'ExpYear' => "Please enter credit card expriation day.\n",
'IPAddress' => "Problem with IP Address. Please contact us.\n"
);


//check for values and assign errors unless the are in the optionalValues array
foreach($clean as $key => $val){
	//do omisions
	$optionalValues = array();
	
	if(!in_array($key,$optionalValues)){
		//assign error
		if(!$val){
			$error .= $errors[$key];
		}
	}
}

/* start special errors */
# none

# reassign
foreach($clean as $key => $val){
	$tpl->assign($key,$val);
}
?>