<?php

$token = $this->_values;

$SOAPrequest .= <<< End_of_quote
<SOAP-ENV:Body>
      <GetExpressCheckoutDetailsReq xmlns="urn:ebay:api:PayPalAPI">
         <GetExpressCheckoutDetailsRequest xsi:type="ns:SetExpressCheckoutRequestType">
            <Version
              xmlns="urn:ebay:apis:eBLBaseComponents"
              xsi:type="xsd:string"
            >1.0</Version>
            <Token>$token</Token>
         </GetExpressCheckoutDetailsRequest>
      </GetExpressCheckoutDetailsReq>
 </SOAP-ENV:Body>
End_of_quote;


?>