<?php
#-------------------------------------
# @copyright 2005 PayPal, Inc
# @author colson@paypaltech.com
# @license (CPL 1.0) http://opensource.org/licenses/cpl1.0.txt
# @link http://www.paypaltech.com
#-------------------------------------

include_once('PayPal.class.php');

# Do not change the array key names - change the values only!


#/******************
# SetExpressCheckout.
$vals = array
	(
	"Return" => 'http://www.thesignregistry.com/index.php?mode=pay&action=success', 
	"CancelReturn" => 'http://www.thesignregistry.com/index.php?mode=pay&action=fail&error=123',
	"CurrencyID" => "USD",
	"OrderTotal" => $_POST['total']
	);

$paypal =& new PayPal();
$paypal->setCall('SetExpressCheckout', $vals);
$result = $paypal->getResult();


#********************/

#/**************************
# GetExpressCheckout (GEC)
$_GET['token'] = $token; # This input should really be scrubbed;
$_GET['PayerID'] = $payerId; # You need the PayerID for the DoExpressCheckout API call.
$vals = $token;
$paypal =& new PayPal();
$paypal->setCall('GetExpressCheckout', $vals);
$result = $paypal->getResult();
print_r($paypal->_errors);

#***************************/

#/**************************
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



# dumps the result array to the screen
$errors = $paypal->getErrors();
print "<br />---------------- full dump ----------------<br />";
print "<pre>";
var_dump($result);
print "</pre>";
print "<br />---------------- errors ----------------<br />";
print "<pre>";
var_dump($errors);
print "</pre>";
?>