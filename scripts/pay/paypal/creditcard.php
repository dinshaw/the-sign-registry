<?php

#-------------------------------------
# @copyright 2005 PayPal, Inc
# @author colson@paypaltech.com
# @license (CPL 1.0) http://opensource.org/licenses/cpl1.0.txt
# @link http://www.paypaltech.com
#-------------------------------------

include_once('PayPal.class.php');

# Do not change the array key names - change the values only!

/******************
# SetExpressCheckout.
$vals = array
	(
	"Return" => 'http://www.thesignregistry.com/index.php?mode=pay&action=success', 
	"CancelReturn" => 'http://www.thesignregistry.com/index.php?mode=pay&action=fail&error=123',
	"CurrencyID" => "USD",
	"OrderTotal" => "5.00"
	);

$paypal =& new PayPal();
$paypal->setCall('SetExpressCheckout', $vals);
$result = $paypal->getResult();


#********************/

/**************************
# GetExpressCheckout (GEC)
$_GET['token'] = $token; # This input should really be scrubbed;
$_GET['PayerID'] = $payerId; # You need the PayerID for the DoExpressCheckout API call.
$vals = $token;
$paypal =& new PayPal();
$paypal->setCall('GetExpressCheckout', $vals);
$result = $paypal->getResult();
print_r($paypal->_errors);

#***************************/

/**************************
# DoExpressCheckout

	// Stack vars into an array
$vals = array
	(
	"Token" => "$Token", # From GEC Call
	"PayerID" => "$PayerID", # From GEC Call
	"PaymentAction"=> "$PaymentAction", # 'Sale' or 'Authorization' (this sdk does not do capture yet)
	"CurrencyID" => "$CurrencyID",
	"OrderTotal" => "$OrderTotal"
	);

$paypal =& new PayPal();
$paypal->setCall('DoExpressCheckout', $vals);
$result = $paypal->getResult();
$errors = $paypal->getErrors();


#***************************/

#/*************************
# DoDirectPayment
if($_POST['pay_for'] == 'reg'){
	$OrderTotal = $_POST['OrderTotal'];
}elseif($_POST['pay_for'] == 'val'){
	$OrderTotal = __CFG_ValidationPrice * $_POST['vals'];
}elseif($_POST['pay_for'] == 'morePrepaids'){
	$OrderTotal = __CFG_ValidationPrice * $_POST['vals'];
}

$vals = array
	(
	"PaymentAction" => "Sale", # Sale or Auth * REQUIRED
	"CurrencyID" => "USD", # 3 digit country code * REQUIRED
	"OrderTotal" => $OrderTotal, # Total amount (inc. sh/h) * REQUIRED

	#Credit Card Details 
	"FirstName" => $_POST['FirstName'], # * REQUIRED
	"LastName" => $_POST['LastName'], # * REQUIRED
	"CreditCardType" => $_POST['CreditCardType'], # * REQUIRED
	"CreditCardNumber" => $_POST['CreditCardNumber'], # * REQUIRED
	"CVV2" => $_POST['CVV2'], # * REQUIRED
	"ExpMonth" => $_POST['ExpMonth'], # * REQUIRED
	"ExpYear" => $_POST['ExpYear'], # * REQUIRED
	# Credit card billing address *PayerEmail is not required-other fields are
	"PayerEmail" => $_POST['PayerEmail'], 
	"PayerStreet1" => $_POST['PayerStreet1'], # * REQUIRED
	"PayerStreet2" => $_POST['PayerStreet2'],
	"PayerCity" => $_POST['PayerCity'], # * REQUIRED
	"PayerState" => $_POST['PayerState'], # * REQUIRED
	"PayerPostalCode" =>$_POST['PayerPostalCode'], # * REQUIRED
	"PayerCountry" => $_POST['PayerCountry'], # *Two digit country code * REQUIRED
	# Shipping address info * These may be REQUIRED
	"ShipToName" => $_POST['FirstName'] . " " . $_POST['LastName'] , 
	"ShipToStreet1" => $_POST['PayerStreet1'],
	"ShipToStreet2" => $_POST['PayerStreet2'],
	"ShipToCity" => $_POST['PayerCity'],
	"ShipToState" => $_POST['PayerState'],
	"ShipToPostalCode" => $_POST['PayerPostalCode'],
	"ShipToCountry" =>  $_POST['PayerCountry'],
	
	# Additional fields
	"IPAddress" => $_POST['IPAddress'] # * REQUIRED
	#"NotifyURL" => "",
	#"Custom" => "",
	#"InvoiceID" => "",
	);

	
$paypal =& new PayPal();
$paypal->setCall('DoDirectPayment', $vals);
$result = $paypal->getResult();
$paypal_errors = $paypal->getErrors();
#*************************/

# dumps the result array to the screen
/* 
print "<br />---------------- full dump ----------------<br />";
print "<pre>";
var_dump($result);
print "</pre>";

# EXAMPLE RESULT
array(17) {
  ["Timestamp attr"]=>
  array(1) {
    ["xmlns"]=>
    string(31) "urn:ebay:apis:eBLBaseComponents"
  }
  ["Timestamp"]=>
  string(20) "2006-01-18T00:29:28Z"
  ["Ack attr"]=>
  array(1) {
    ["xmlns"]=>
    string(31) "urn:ebay:apis:eBLBaseComponents"
  }
  ["Ack"]=>
  string(7) "Success"
  ["CorrelationID attr"]=>
  array(1) {
    ["xmlns"]=>
    string(31) "urn:ebay:apis:eBLBaseComponents"
  }
  ["CorrelationID"]=>
  string(13) "68845c657e8bc"
  ["Version attr"]=>
  array(1) {
    ["xmlns"]=>
    string(31) "urn:ebay:apis:eBLBaseComponents"
  }
  ["Version"]=>
  string(8) "1.000000"
  ["Build attr"]=>
  array(1) {
    ["xmlns"]=>
    string(31) "urn:ebay:apis:eBLBaseComponents"
  }
  ["Build"]=>
  string(6) "1.0006"
  ["Amount attr"]=>
  array(2) {
    ["xsi:type"]=>
    string(18) "cc:BasicAmountType"
    ["currencyID"]=>
    string(3) "USD"
  }
  ["Amount"]=>
  string(5) "50.00"
  ["AVSCode attr"]=>
  array(1) {
    ["xsi:type"]=>
    string(9) "xs:string"
  }
  ["AVSCode"]=>
  string(1) "X"
  ["CVV2Code attr"]=>
  array(1) {
    ["xsi:type"]=>
    string(9) "xs:string"
  }
  ["CVV2Code"]=>
  string(1) "M"
  ["TransactionID"]=>
  string(17) "5U3737953V7396726"
}
# END EXAMPLE RESULT
print "<br />---------------- errors ----------------<br />";
print "<pre>";
var_dump($paypal_errors);
print "</pre>";
*/
if(!$paypal_errors){
	$amount = $result['Amount'];
	include 'scripts/pay/do_pay_success.php';
}else{
	foreach($paypal_errors AS $key => $val){
		if(!is_array($val) && $val != "Error" && !ctype_digit($val)){
			$paypal_error .= $val . ".\n";
		}
	}
	
	$tpl->assign('msg',$paypal_error);
	
	
	
	$tpl->assign('sid',md5(session_id()));
	include 'scripts/val/get_extra_vals.php';
	include 'scripts/pay/get_total.php';
}
?>