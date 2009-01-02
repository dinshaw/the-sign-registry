<?php

$values = $this->_values;

$SOAPrequest .= <<< End_of_quote
<SOAP-ENV:Body>
      <SetExpressCheckoutReq xmlns="urn:ebay:api:PayPalAPI">
         <SetExpressCheckoutRequest xsi:type="ns:SetExpressCheckoutRequestType">
            <Version
              xmlns="urn:ebay:apis:eBLBaseComponents"
              xsi:type="xsd:string"
            >1.0</Version>
            <SetExpressCheckoutRequestDetails xmlns="urn:ebay:apis:eBLBaseComponents">
               <OrderTotal
                 xmlns="urn:ebay:apis:eBLBaseComponents"
                 currencyID="{$values['CurrencyID']}"
                 xsi:type="cc:BasicAmountType"
               >{$values['OrderTotal']}</OrderTotal>
               <ReturnURL xsi:type="xsd:string">{$values['Return']}</ReturnURL>
               <CancelURL xsi:type="xsd:string">{$values['CancelReturn']}</CancelURL>
            </SetExpressCheckoutRequestDetails>
         </SetExpressCheckoutRequest>
      </SetExpressCheckoutReq>
   </SOAP-ENV:Body>
End_of_quote;


?>