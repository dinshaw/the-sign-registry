<!-- <%$smarty.template%> -->
<%include file="header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>

<div id="reg">

<h2 class="lr">REGISTER A SIGN <span>Step 3</span></h2>
<h3>Confirm your sign details here</h3>

<%if $msg %><p class="red"><%$msg|nl2br%></p><%/if%>

<table >
	<tr>
		<td valign="top">
		
<ul id="reg_info">
	<li class="title">Your personal details:</li>
	<li>Name: <span><%$name%></span></span></li>
	<li>Email: <span><%$email%></span></li>
	<li>Address: <span><%$address%><%if $address2%>, <%$address2%><%/if%></span></li>
	<li>City: <span><%$city%></span></li>
	<li>State: <span><%$state%></span></li>
	<li>Country: <span><%$country%></span></li>
	<li>Tel: <span><%$tel%><%if $tel2%>, <%$tel2%><%/if%></span></li>
</ul>

		</td>
		<td valign="top">
		
<table class="return" align="right">
	<tr class="title">
		<th colspan="6" >Registered signs awaiting payment</th>
	</tr>
	
	<tr>
		<th>Recipient Name</th>
		<th>Sign Description</th>
		<th>Pre-paids</th>
		<th>Reg date</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	
	
	<%section name=signList loop=$signLoop%>
	<form action="user.php?sid=<%$sid%>" method="post">
	<input type="hidden" name="mode" value="reg" />
	<input type="hidden" name="action" value="edit" />
	<input type="hidden" name="signID" value="<%$signLoop[signList].id%>" />
	<tr class="<%if $smarty.section.index is odd %>grey<%/if%>">
		<td><%$signLoop[signList].name%></td>
		<td><%$signLoop[signList].description%></td>
		<td><%$signLoop[signList].prepaids%></td>
		<td><nobr><%$signLoop[signList].date%></nobr></td>
		<td><input type="submit" name="edit_sign" value="Edit" class="dollar" /></td>
		<td><input type="submit" name="delete_sign" value="Delete" class="dollar" onClick="return confirm('Are you sure you wnt to delete sign #<%$signLoop[signList].id%>');" /></td>
	</tr>
	</form>
	<%/section%>
	<form action="user.php?sid=<%$sid%>" method="post">
	<input type="hidden" name="mode" value="pay" />
	<input type="hidden" name="action" value="checkout" />
	<input type="hidden" name="pay_for" value="reg" />
	
	
<%if $extraValsLoop or $self_vals%>

	<tr class="title">
		<th colspan="6">Your cart curently contains the following additional validations for purchase:</th>
	</tr>
	<%if $self_vals%>
	<tr>
		<th colspan="3">Your account</th>
		<th colspan="3"><%$self_vals%></th>
	</tr>
	<%/if%>
	
	<%if $extraValsLoop%>
	<%section name=extraValsList loop=$extraValsLoop%>
	<tr>
		<th colspan="3"><%$extraValsLoop[extraValsList].name%></th>
		<th colspan="3"><%$extraValsLoop[extraValsList].extraVals%></th>
	</tr>
	
	<%/section%>
	<%/if%>
<%/if%>

</table>
			</td>
		</tr>
	</table>

<div class="lr"><a href="user.php?sid=<%$sid%>&mode=reg&action=reg&new_sign=true" class="button">Register another sign</a><span><input type="submit" name="checkout" value="Checkout" class="button" /></span></div>
</form
></div>
 
<%include file="footer.tpl"%>
