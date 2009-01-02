	<!-- <%$smarty.template%> -->
<%include file="header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>

<div id="reg">

<h2 class="lr">CHECKOUT</h2>
<h3>Please review your order and enter your payment details</h3>

<%if $msg %><p class="red"><%$msg|nl2br%></p><%/if%>


<table class="return">
	<tr class="title">
		<th colspan="4" >Additional Validation attempts for my account</th>
	</tr>
	<form action="user.php?sid=<%$sid%>" method="post">
	<input type="hidden" name="mode" value="add_vals" />
	<input type="hidden" name="action" value="add" />
	<input type="hidden" name="userID" value="<%$userID%>" />
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
		<th>additional pre-paid validation attempts for my account.</th>
		<th><input type="submit" name="submit" value="Add" /></th>
	</tr>
	</form>
	
	<tr class="title">
		<th colspan="4" >Additional Validation attempts for my recipients' accounts</th>
	</tr>
	<%section name=recList loop=$recipientLoop%>
	<form action="user.php?sid=<%$sid%>" method="post">
	<input type="hidden" name="action" value="add" />
	<input type="hidden" name="mode" value="add_vals" />
	<input type="hidden" name="userID" value="<%$recipientLoop[recList].id%>" />
	<tr>
		<th>I would like to purchase</th>
		<th><select name="vals">
		<option value="0">0 (remove)</option>
		<option value="1" selected>1 ($5.00)</option>
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
		<th>additional pre-paid validation attempts for<br /><%$recipientLoop[recList].name%>'s sccount.</th>
		<th><input type="submit" name="submit" value="Add" /></th>
	</tr>
	</form>
	<%/section%>
	<tr>
		<th colspan="4"><a href="user.php?sid=<%$sid%>&mode=pay&editCart=true" class="button">Checkout</a></th>
	</tr>
</table>

<%if $extraValsLoop or $self_vals%>
<table class="return">
	<tr class="title">
		<th colspan="2">Your cart curently contains the following additional validations for purchase:</th>
	</tr>
	<%if $self_vals%>
	<tr>
		<th>Your account</th>
		<th><%$self_vals%></th>
	</tr>
	<%/if%>
	
	<%if $extraValsLoop%>
	<%section name=extraValsList loop=$extraValsLoop%>
	<tr>
		<th><%$extraValsLoop[extraValsList].name%></th>
		<th><%$extraValsLoop[extraValsList].extraVals%></th>
	</tr>
	<%/section%>
	
	<%/if%>
	
</table>
<%/if%>
</div>
 
<%include file="footer.tpl"%>
