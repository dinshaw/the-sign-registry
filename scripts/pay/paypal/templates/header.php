<?php
# Soap Header

$SOAPrequest = <<< End_Of_Quote
<?xml version="1.0" encoding="UTF-8"?>
<SOAP-ENV:Envelope
  xmlns:xsi="http://www.w3.org/1999/XMLSchema-instance"
  xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/"
  xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
  xmlns:xsd="http://www.w3.org/1999/XMLSchema"
  SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
   <SOAP-ENV:Header>
      <RequesterCredentials xmlns="urn:ebay:api:PayPalAPI"
SOAP-ENV:mustUnderstand="1">
         <Credentials xmlns="urn:ebay:apis:eBLBaseComponents">
            <Username>$this->_user</Username>
            <Password>$this->_pwd</Password>
            <Subject/>
         </Credentials>
      </RequesterCredentials>
   </SOAP-ENV:Header>
End_Of_Quote;
?>
