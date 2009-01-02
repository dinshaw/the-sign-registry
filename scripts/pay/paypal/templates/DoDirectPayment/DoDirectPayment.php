<?php

$values = $this->_values;

$SOAPrequest .= <<< End_of_quote
   <SOAP-ENV:Body>
      <DoDirectPaymentReq xmlns="urn:ebay:api:PayPalAPI">
         <DoDirectPaymentRequest>
            <Version
              xmlns="urn:ebay:apis:eBLBaseComponents"
            >1.0</Version>
            <DoDirectPaymentRequestDetails 
              xmlns="urn:ebay:apis:eBLBaseComponents"
            >
               <PaymentAction>{$values['PaymentAction']}</PaymentAction>
               <PaymentDetails>
                  <OrderTotal
                    currencyID="{$values['CurrencyID']}"
                    xmlns="urn:ebay:apis:eBLBaseComponents"
                  >{$values['OrderTotal']}</OrderTotal>
               	<ShipToAddress>
                        <Name>{$values['ShipToName']}</Name>
               			<Street1>{$values['ShipToStreet1']}</Street1>
                        <Street2>{$values['ShipToStreet2']}</Street2>
                        <CityName>{$values['ShipToCity']}</CityName>
                        <StateOrProvince>{$values['ShipToState']}</StateOrProvince>
                        <Country>{$values['ShipToCountry']}</Country>
                        <PostalCode>{$values['ShipToPostalCode']}</PostalCode>              		
               	</ShipToAddress>
                <NotifyURL>{$values['NotifyURL']}</NotifyURL>
                <Custom>{$values['Custom']}</Custom>
                <InvoiceID>{$values['InvoiceID']}</InvoiceID>
                  
               </PaymentDetails>
               <CreditCard>
                  <CreditCardType>{$values['CreditCardType']}</CreditCardType>
                  <CreditCardNumber>{$values['CreditCardNumber']}</CreditCardNumber>
                  <ExpMonth>{$values['ExpMonth']}</ExpMonth>
                  <ExpYear>{$values['ExpYear']}</ExpYear>
                  <CardOwner>
                     <Payer>{$values['PayerEmail']}</Payer>
                     <PayerName>
                       <FirstName>{$values['FirstName']}</FirstName>
                       <LastName>{$values['LastName']}</LastName>
                     </PayerName>
                     <Address>
                        <Street1>{$values['PayerStreet1']}</Street1>
                         <Street2>{$values['PayerStreet2']}</Street2>
                        <CityName>{$values['PayerCity']}</CityName>
                        <StateOrProvince>{$values['PayerState']}</StateOrProvince>
                        <Country>{$values['PayerCountry']}</Country>
                        <PostalCode>{$values['PayerPostalCode']}</PostalCode>
                     </Address>
                  </CardOwner>
                  <CVV2>{$values['CVV2']}</CVV2>
               </CreditCard>
               <IPAddress>{$values['IPAddress']}</IPAddress>
            </DoDirectPaymentRequestDetails>
         </DoDirectPaymentRequest>
      </DoDirectPaymentReq>
   </SOAP-ENV:Body>
   
End_of_quote;



?>