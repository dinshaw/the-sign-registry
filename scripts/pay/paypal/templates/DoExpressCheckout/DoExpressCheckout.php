<?php

$values = $this->_values;

$SOAPrequest .= <<< End_of_quote
<SOAP-ENV:Body>
      <DoExpressCheckoutPaymentReq xmlns="urn:ebay:api:PayPalAPI">
         <DoExpressCheckoutPaymentRequest>
            <Version
              xmlns="urn:ebay:apis:eBLBaseComponents"
            >1.0</Version>
            <DoExpressCheckoutPaymentRequestDetails
              xmlns="urn:ebay:apis:eBLBaseComponents"
            >
               <Token>{$values['Token']}</Token>
               <PaymentAction>{$values['PaymentAction']}</PaymentAction>
               <PayerID>{$values['PayerID']}</PayerID>
               <PaymentDetails>
                  <OrderTotal
                    xmlns="urn:ebay:apis:eBLBaseComponents"
                    currencyID="{$values['CurrencyID']}"
                  >{$values['OrderTotal']}</OrderTotal>
               </PaymentDetails>
            </DoExpressCheckoutPaymentRequestDetails>
         </DoExpressCheckoutPaymentRequest>
      </DoExpressCheckoutPaymentReq>
   </SOAP-ENV:Body>
   
End_of_quote;
   
?>