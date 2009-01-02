<?php
$error = '';
	
if(isset($_POST['step1']) || isset($_POST['save1'])){
	error_log("****************");
	//set error check depending if they have already registered a user
	
	//REGISTRATN IS LOGGED IN (REGISTRATION OR LOGIN) AND NEW RECIPIENT
	$post_fields = array();

	if(isset($_SESSION['userID']) && !isset($_POST['recID'])){
		$post_fields = array('sal_2','firstName_2','lastName_2','address_2','address2_2','city_2','state_2','country_2','zip_2','tel_2','tel2_2','email_2');
		
	//NEW REGISTRANT BUT EXSISTING RECIPIENT (FOUND DOUBLE EMAIL ADDRESSS WORKFLOW)
	}elseif(!isset($_SESSION['userID'])  && isset($_POST['recID'])){
		$post_fields = array('sal','firstName','lastName','address','address2','city','state','country','zip','tel','tel2','email','tc','dob_day','dob_month','dob_year');
		
	//NEW REGISTRANT AND NEW RECIPIENT
	}elseif(!isset($_SESSION['userID'])  && !isset($_SESSION['recID'])){
		$post_fields = array('sal','firstName','lastName','address','address2','city','state','country','zip','tel','tel2','email','tc','dob_day','dob_month','dob_year',
		/*recipient error messages*/ 'sal_2','firstName_2','lastName_2','address_2','address2_2','city_2','state_2','country_2','zip_2','tel_2','tel2_2','email_2');
	}
	
	//filter imput for post fields and put ion $clean array
	$clean = array();
	foreach($post_fields as $key){
		if(isset($_POST[$key])) $clean[$key] = $_POST[$key];
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
	'reg_emailDouble' => "The email address you entered is already in our database.\n Please login or make necessary changes.\n",
	//'reg_emailDouble' => "The email address you entered is already.  Please verify below or make necessary changes.\n",
	
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
	'emailDouble_2' => "The recipient email you entered is already in our database. Please verify below or make the necessary changes.\n",
	'nameDouble' =>  "Our database has another user with the same name. Please verify below or make necessary changes.\n"
	);
	
	
	//check for values and assign errors unless the are in the optionalValues array
	foreach($clean as $key => $val){
		//do omisions
		$optionalValues = array('dob_day','dob_month','dob_year','address_2','tel2','tel2_2');
		
		if(!in_array($key,$optionalValues)){
			//assign error
			if(!$val){
				if(isset($errors[$key])) $error .= $errors[$key];
			}
		}
	}

	/* start special errors */
	
	//check for valid registrant email address if one has been entered
	if (isset($clean['email']))
	{
		$goodEmail = valid_email($clean['email']);
		
		if(!$goodEmail){
			$error .= $errors['invalidEmail'];
		}else{
			//check if the email already exists
			$email = $clean['email'];
			$sql = "select * from users where email = '$email'";
			$result = mysql_query($sql);
			$rows = mysql_num_rows($result);		
			if ($rows>0){$error .= $errors['reg_emailDouble'];}
		}			
	}
	//check for valid recipient email address if one has been entered
	if (isset($clean['email_2']))
	{
		$goodEmail = valid_email($clean['email_2']);
		if(!$goodEmail){
			$error .= $errors['invalidEmail_2'];
		}else{
			//check if the email already exists
			$email_2 = $clean['email_2'];
			$sql = "select id, CONCAT(first_name,' ',last_name) AS name, email, city, state from users where email = '$email_2'";
			$query = mysql_query($sql) or die(mysql_error());
			$rows = mysql_num_rows($query);	
			$result = mysql_fetch_array($query);		
			
			if ($rows>0){
				$error .= $errors['emailDouble_2'];
				
				//ASSIGN THE EMAIL DOUBLE INFO TO DISPLAY THE USER AS A POSSIBLE RECIPIENT
				extract($result);
				$tpl->assign('recDoubleID',$id);
				$tpl->assign('recDoubleName',$name);
				$tpl->assign('recDoubleCity',$city);
				$tpl->assign('recDoubleState',$state);
				$tpl->assign('recDoubleEmail',$email);
			}
		}			
	}
	
	//CHECK IF THE NAME MATCHS AN EXOSTING USER
	if(isset($clean['firstName_2']) && isset($clean['lastName_2'])){
		$firstName_2 = $clean['firstName_2'];
		$lastName_2 = $clean['lastName_2'];
		$sql = "select id, CONCAT(first_name,' ',last_name) AS name, email, city, state from users where CONCAT(first_name,' ',last_name) = CONCAT('$firstName_2',' ','$lastName_2')";
		$query = mysql_query($sql);
		$rows = mysql_num_rows($query);	
		$result = mysql_fetch_array($query);		
		if ($rows>0){
			$error .= $errors['nameDouble'];
			
			//ASSIGN THE NAME DOUBLE INFO TO DISPLAY THE USER AS A POSSIBLE RECIPIENT
			extract($result);
			$tpl->assign('recDoubleID',$id);
			$tpl->assign('recDoubleName',$name);
			$tpl->assign('recDoubleCity',$city);
			$tpl->assign('recDoubleState',$state);
			$tpl->assign('recDoubleEmail',$email);
		}
	}
	
	if(isset($_POST['email']) && isset($_POST['email_2']) && isset($clean['email']) == isset($clean['email_2']) && $clean['email'] == $clean['email_2']) {
		$error .= $errors['emailMatch'];
	}
	
	//dob check
	
	if(in_array('dob_day',$post_fields)){
	
		if(!$clean['dob_day'] || !$clean['dob_month'] || !$clean['dob_year']){
			$error .= $errors['dob'];
			
		}else{
			$clean['dob'] = $clean['dob_year'] . "-" . $clean['dob_month'] . "-" . $clean['dob_day'];
		}
	}
		
	//registrant reassign
	foreach($clean as $key => $val){
		error_log($key);
		$tpl->assign($key,$val);
	}
	
	
	
}elseif(isset($_POST['step2']) || isset($_POST['save2'])){
		
		if(!$_POST['description']){ $error = "Please enter a description of the sign that you would like to register";}
		if(!ctype_digit($_POST['prepaids'])){ $error = "Please enter the number of prepaid attempts you would like for this sign registration";}
		
		$prepaids = $_POST['prepaids'];
		$description = $_POST['description'];
		
		$tpl->assign('description',$description);
		$tpl->assign('prepaids',$prepaids);
		
}elseif(isset($_POST['cc'])){
	//creadit card errors
}
?>