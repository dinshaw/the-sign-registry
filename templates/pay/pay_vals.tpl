	<!-- <%$smarty.template%> -->
<%include file="header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>

<div id="reg">

<h2 class="lr">CHECKOUT</h2>
<h3>Please review your order and enter your payment details</h3>

<%if $msg %><p class="red"><%$msg|nl2br%></p><%/if%>

<table class="return">
	<tr class="title">
		<th colspan="3" >Additional Validation attempts</th>
	</tr>
	<form action="user.php?sid=<%$sid%>" method="post">
	<tr>
		<th>I would like to purchase</th>
		<th><select name="vals">
		<option value="1">1 ($5.00)</option>
		<option value="2">2 ($10.00)</option>
		<option value="3">3 ($15.00)</option>
		<option value="4">4 ($20.00)</option>
		<option value="5">5 ($25.00)</option>
		<option value="6">6 ($30.00)</option>
		<option value="7">7 ($35.00)</option>
		<option value="8">8 ($40.00)</option>
		<option value="9">9 ($45.00)</option>
		<option value="10">10 ($50.00)</option>
		</select>
		<th>additional pre-paid validation attempts.</th>
	</tr>
</table>


<h2>PAY BY CREDIT CARD</h2>
<h3>Enter your payment details</h3>


<input type="hidden" name="mode" value="pay" />
<input type="hidden" name="action" value="pay" />
<input type="hidden" name="payment_type" value="cc" />
<%if $morePrepaids%>
<input type="hidden" name="pay_for" value="morePrepaids" />
<%else%>
<input type="hidden" name="pay_for" value="val" />
<%/if%>

<input type="hidden" name="OrderTotal" value="<%$grandTotal%>" />

<input type="hidden" name="IPAddress" value="<%$IPAddress%>" />

<table class="form">
	<tr>
		<th>Credit Card Type</th>
		<td><select name="CreditCardType">
		<option value="">---</option>
<option value="Visa" <%if $CreditCardType eq "Visa"%>selected="selected"<%/if%> >Visa</option>
<option value="MasterCard" <%if $CreditCardType eq "MasterCard"%>selected="selected"<%/if%> >MasterCard</option>
<option value="Discover" <%if $CreditCardType eq "Discover"%>selected="selected"<%/if%> >Discover</option>
<option value="American Express" <%if $CreditCardType eq "American Express"%>selected="selected"<%/if%> >American Express</option>
</select></td>
	</tr>
	
	<tr>
		<th>Credit Card Number</th>
		<td><input value="<%$CreditCardNumber%>" name="CreditCardNumber"></td>
	</tr>
	
	<tr>
		<th>Expiration Date:</th>
		<td><select name="ExpMonth">
<option value="1" <%if $ExpMonth eq "1"%>selected="selected"<%/if%> >01</option>
<option value="2" <%if $ExpMonth eq "2"%>selected="selected"<%/if%> >02</option>
<option value="3" <%if $ExpMonth eq "3"%>selected="selected"<%/if%> >03</option>
<option value="4" <%if $ExpMonth eq "4"%>selected="selected"<%/if%> >04</option>
<option value="5" <%if $ExpMonth eq "5"%>selected="selected"<%/if%> >05</option>
<option value="6" <%if $ExpMonth eq "6"%>selected="selected"<%/if%> >06</option>
<option value="7" <%if $ExpMonth eq "7"%>selected="selected"<%/if%> >07</option>
<option value="8" <%if $ExpMonth eq "8"%>selected="selected"<%/if%> >08</option>
<option value="9" <%if $ExpMonth eq "9"%>selected="selected"<%/if%> >09</option>
<option value="10" <%if $ExpMonth eq "10"%>selected="selected"<%/if%> >10</option>
<option value="11" <%if $ExpMonth eq "11"%>selected="selected"<%/if%> >11</option>
<option value="12" <%if $ExpMonth eq "12"%>selected="selected"<%/if%> >12</option></select> / 
<select name="ExpYear">
<option value="2006" <%if $ExpYear eq "2006"%>selected="selected"<%/if%> >2006</option>
<option value="2007" <%if $ExpYear eq "2007"%>selected="selected"<%/if%> >2007</option>
<option value="2008" <%if $ExpYear eq "2008"%>selected="selected"<%/if%> >2008</option>
<option value="2009" <%if $ExpYear eq "2009"%>selected="selected"<%/if%> >2009</option>
<option value="2010" <%if $ExpYear eq "2010"%>selected="selected"<%/if%> >2010</option>
<option value="2011" <%if $ExpYear eq "2011"%>selected="selected"<%/if%> >2011</option>
<option value="2012" <%if $ExpYear eq "2012"%>selected="selected"<%/if%> >2012</option>
<option value="2013" <%if $ExpYear eq "2013"%>selected="selected"<%/if%> >2013</option>
<option value="2014" <%if $ExpYear eq "2014"%>selected="selected"<%/if%> >2014</option>
<option value="2015" <%if $ExpYear eq "2015"%>selected="selected"<%/if%> >2015</option></select></td>
	</tr>

	<tr>
		<th>CVV2</th>
		<td><input value="<%$CVV2%>" name="CVV2" class="dollar"> (3 digit # on back of card)</td>
	</tr>
</table>

<br />

<h3>Enter your billing address</h3>

<table class="form">
	
	<tr>
		<th><span class="red">*</span> First Name</th>
		<td><input  type="text" class="text" name="FirstName" value="<%$FirstName%>" /></td>
		<th><span class="red">*</span> Last Name</th>
		<td><input  type="text" class="text" name="LastName" value="<%$LastName%>" /></td>
	</tr>
	
	<tr>
		<th><span class="red">*</span> Street Address</th>
		<td><input  type="text" class="text" name="PayerStreet1" value="<%$PayerStreet1%>" /></td>
		<th>Address (additional)</th>
		<td><input  type="text" class="text" name="PayerStreet2" value="<%$PayerStreet2%>" /></td>
	</tr>
	
	<tr>	
		<th><span class="red">*</span> City</th>
		<td><input  type="text" class="text" name="PayerCity" value="<%$PayerCity%>" /></td>
		<th><span class="red">*</span> State / Province</th>
		<td><select name="PayerState" class="text">
		<%include file="inc/statesSelect.tpl" value="$PayerState"%>
		</select></td>		
	</tr>
	
	<tr>
		<th><span class="red">*</span> Zip</th>
		<td><input  type="text" class="dollar" name="PayerPostalCode" value="<%$PayerPostalCode%>" /></td>
		<th><span class="red">*</span> Phone</th>
		<td><input  type="text" class="text" name="Phone" value="<%$tel%>" /></td>
		
	</tr>
	
	<tr>
		<td colspan="2"></td>
		<th><span class="red">*</span> Country</th>
		<td><select name="PayerCountry" class="text">
		<%include file="inc/countrySelect.tpl" value="$PayerCountry"%>
		</select></td>
	</tr>
</table>
<div class="lr">&nbsp;<span><input type="submit" name="pay" value="Pay by Credit Card" class="button" /></div>



</form>
</div>
 
<%include file="footer.tpl"%>
