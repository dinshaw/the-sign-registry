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
	"Return" => 'http://mysite.com/successful/url/', 
	"CancelReturn" => 'http://mysite.com/cancel/url/',
	"CurrencyID" => "USD",
	"OrderTotal" => "5.00"
	);

$paypal =& new PayPal();
$paypal->setCall('SetExpressCheckout', $vals);
$result = $paypal->getResult();

#********************/

#/**************************
# GetExpressCheckout (GEC)
$_GET['token'] = $token; # This input should really be scrubbed;
$_GET['PayerID'] = $payerId # You need the PayerID for the DoExpressCheckout API call.
$vals = $token;
$paypal =& new PayPal();
$paypal->setCall('GetExpressCheckout', $vals);
$result = $paypal->getResult();

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


#***************************/

#/*************************
# DoDirectPayment

$vals = array
	(
	"PaymentAction" => "Sale", # Sale or Auth * REQUIRED
	"CurrencyID" => "USD", # 3 digit country code * REQUIRED
	"OrderTotal" => "9.95", # Total amount (inc. sh/h) * REQUIRED

	#Credit Card Details 
	"FirstName" => "Lordes", # * REQUIRED
	"LastName" => "Wakahatchie", # * REQUIRED
	"CreditCardType" => "Visa", # * REQUIRED
	"CreditCardNumber" => "4229660405565795", # * REQUIRED
	"CVV2" => "123", # * REQUIRED
	"ExpMonth" => "10", # * REQUIRED
	"ExpYear" => "2008", # * REQUIRED
	# Credit card billing address *PayerEmail is not required-other fields are
	"PayerEmail" => "payer@wakahatchie.com", 
	"PayerStreet1" => "555 main st", # * REQUIRED
	"PayerStreet2" => "",
	"PayerCity" => "omaha", # * REQUIRED
	"PayerState" => "ne", # * REQUIRED
	"PayerPostalCode" => "68116", # * REQUIRED
	"PayerCountry" => "US", # *Two digit country code * REQUIRED
	# Shipping address info * These may be REQUIRED
	"ShipToName" => "Lordes Wakahatchie", 
	"ShipToStreet1" => "555 main st",
	"ShipToStreet2" => "",
	"ShipToCity" => "Omaha",
	"ShipToState" => "ne",
	"ShipToPostalCode" => "68116",
	"ShipToCountry" => "US",
	# Additional fields
	"IPAddress" => "127.0.0.1", # * REQUIRED
	"NotifyURL" => "",
	"Custom" => "",
	"InvoiceID" => "",
	);

$paypal =& new PayPal();
$paypal->setCall('DoDirectPayment', $vals);
$result = $paypal->getResult();

#*************************/

# dumps the result array to the screen
print "<pre>";
print_r($result);
print "</pre>";
print "<br />----------------------------- request------------------------ <br />";
print "<pre>";
print_r($paypal->_request);
print "<br />----------------------------- result------------------------ <br />";
print "<pre>";
print_r($paypal->_result);
print "</pre>";
?>