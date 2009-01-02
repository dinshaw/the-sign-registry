<?php
#-------------------------------------
# @copyright 2005 PayPal, Inc
# @author colson
# @license (CPL 1.0) http://opensource.org/licenses/cpl1.0.txt
# @link http://www.paypaltech.com
#-------------------------------------
class PayPal
{
  #/************************
  # Sandbox Settings
  var $_apiURL = "https://api.sandbox.paypal.com/2.0/";
  // Enter the full path to the API certificate.
  var $_cert = "/home/thesignr/public_html/cert_key_pem_sandbox.txt";
  var $_user = "info_api2.dinshawdesign.com";
  var $_pwd = "sandbox";    
  #*************************/
  
  /*************************
  # Live API URL
  var $_apiURL = "https://api.paypal.com/2.0/";  
  var $_cert = "/full/path/to/cert/cert_key_pem.txt";
  var $_user = "my_live_username_api1.paypal.com";
  var $_pwd = "123456789";   
  #*********************/

#---- do not edit below this line -------
  
  var $_filename;
  
  var $_soapheader = "scripts/pay/paypal/templates/header.php";
  
  var $_soapfooter = "scripts/pay/paypal/templates/footer.php";

  var $_subject = null;
  # @private
  var $_request;
  # @private
  var $_result;
  # @private
  var $_xmlArray;
  
  var $_call;
  
  var $_errors;

  # @public function setCall
  function setCall($call, $values)
  {
    $this->_filename = "scripts/pay/paypal/templates/" . $call . "/" . $call .".php";
    $this->_values = $values;
    $this->_call = $call;
  }
  # @private function setCert
  function setCert($path)
  {
    $this->_cert = $path;
  }
  # @public function setHeader
  function setHeader($user, $pwd, $subject = null)
  {
    $this->_user = $user;
    $this->_pwd = $pwd;
    $this->_subject = $subject;
   
  }

  function getCall() #@private function
  {
    # Make the Soap Header available to us
    require_once("$this->_soapheader");
    # Everything is stored in the $SOAPrequest variable
    require_once("$this->_filename");
    require_once("$this->_soapfooter");
    # A fully stacked XML call
    $this->_request = $SOAPrequest;
    
  }
  
  function execute()
  {
  	$this->getCall();
  	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"$this->_apiURL");
	curl_setopt($ch, CURLOPT_SSLCERT, $this->_cert);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "$this->_request");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	// the three curl settings below are for GoDaddy hosted accounts:
	// curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);
	// curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
	// curl_setopt($ch, CURLOPT_PROXY, "http://64.202.165.130:3128");


	
	$xmlResponse = curl_exec($ch);
	$this->_result = $xmlResponse;
	
	if (curl_error($ch))
	{
		printf("Error %s: %s", curl_errno($ch), curl_error($ch));
	}
	curl_close ($ch);
	
  }
  
  function xml2array ()
  {
  	require_once('scripts/pay/paypal/includes/xml2array.php');
  	$this->_xmlArray = XML_unserialize($this->_result);
  
  }
  
  function getResult()
  {
  	$this->execute();
  	$this->XML2array();
  	# Log the results.
  	
  	# Return the results - SOAP-ENV:Body payload only.

  	if ($this->_call == "SetExpressCheckout")
  	{
  		$rKey = "SetExpressCheckoutResponse";
  		$error = $this->_xmlArray["SOAP-ENV:Envelope"]["SOAP-ENV:Body"][$rKey][Errors]; 
  	}
  	elseif($this->_call == "GetExpressCheckout")
  	{
  		$rKey = "GetExpressCheckoutDetailsResponse";
  		$error = $this->_xmlArray["SOAP-ENV:Envelope"]["SOAP-ENV:Body"][$rKey][Errors];   		
  	}
  	elseif($this->_call == "DoExpressCheckout")
  	{
  		$rKey = "DoExpressCheckoutPaymentResponse"; 
  		# The whole reason for this section of code: DoExpCheckout puts errors a level
  		# deeper. This conditional catches this so that errors are all on the same level
  		# and accessible through the getErrors() method.
  		$error = $this->_xmlArray["SOAP-ENV:Envelope"]["SOAP-ENV:Body"][$rKey][Errors][0]; 		
  	}
  	elseif($this->_call == "DoDirectPayment")
  	{
  		$rKey = "DoDirectPaymentResponse";
  		$error = $this->_xmlArray["SOAP-ENV:Envelope"]["SOAP-ENV:Body"][$rKey][Errors]; 
  	}
  	else
  	{
  		die('Invalid Response from class');
  	}
	
	if($this->_xmlArray["SOAP-ENV:Envelope"]["SOAP-ENV:Body"][$rKey][Ack] == "Failure")
	{
		$this->_errors = $error;
	}
	return $this->_xmlArray["SOAP-ENV:Envelope"]["SOAP-ENV:Body"][$rKey];
  }

  function getErrors()
  {
  	return $this->_errors;
  }
# End of Class
}
?>