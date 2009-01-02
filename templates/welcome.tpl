<!-- <%$smarty.template%> -->
<%include file="header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>


<h2>LOGIN SUCCESS!</h2>
<p>Please review your contact information</p>

<p>Please review your contact details and personal information below.  If you would like to update the information click <a href="user.php?mode=editProfile&sid=<%$sid%>">here</a> or on the <nobr><em>Edit My Profile</em></nobr> link in the left hand menu.</p>

<p>If your personal details are correct please proceed to either <a href="user.php?mode=reg&action=reg&sid=<%$sid%>">The Registration Room</a> or <a href="user.php?mode=val&sid=<%$sid%>">The Validation Room</a> or click the <a href="user.php?mode=add_vals&sid=<%$sid%>">Add Validations</a> link to purchase more validation atempts for your self or ony of your sign recipients.</p>

<ul id="reg_info">
	<li class="title">Your personal details:</li>
	<li>Name: <span><%$first_name%> <%$last_name%></span></span></li>
	<li>Email: <span><%$email%></span></li>
	<li>Address: <span><%$address%><%if $address2%>, <%$address2%><%/if%></span></li>
	<li>City: <span><%$city%></span></li>
	<li>State: <span><%$state%></span></li>
	<li>Country: <span><%$country%></span></li>
	<li>Tel: <span><%$tel%><%if $tel2%>, <%$tel2%><%/if%></span></li>
</ul>
 

<%if $recipientLoop %>
<!-- if there are previousl registered recipients then display them -->

<table class="return" id="recipients">
	<tr class="title">
		<th colspan="5" >Previously Registered Signs</th>
	</tr>
	
	<tr>
		<th>Register a new sign</th>
		<th>Name</th>
		<th>Email</th>
		<th>Description</th>
		<th>Reg date</th>
	</tr>

	<%section name=recipientList loop=$recipientLoop%>

	<tr class="<%if $smarty.section.index is odd %>grey<%/if%>">
		<form action="user.php?sid=<%$sid%>" method="post">
		<input type="hidden" name="mode" value="reg" />
		<input type="hidden" name="action" value="reg" />
		<input type="hidden" name="regID" value="<%$regID%>" />
		<input type="hidden" name="recID" value="<%$recipientLoop[recipientList].id%>" />
	
		<td><input type="submit" name="step1" value="Register another sign for this person" /></td>
		</form>
		<td><%$recipientLoop[recipientList].name%></td>
		<td><%$recipientLoop[recipientList].email%></td>
		<td><%$recipientLoop[recipientList].description%></td>
		<td><%$recipientLoop[recipientList].date%></td>
		<form action="registrantsLoopindex.php" method="post">		
		<input type="hidden" name="mode" value="reg" />
		<input type="hidden" name="action" value="edit" />
		<input type="hidden" name="recID" value="<%$recipientLoop[recipientList].id%>" />
	</tr>
	</form>
	<%/section%>
</table>
<%/if%>

<%if $signLoop%>
<!-- table to display signs registered to this person and pending validation attemplte -->
<table class="return" >
	<%if $pendingVals %>
	<tr class="title">
		<th colspan="6" >You have <%$pendingVals%> pending validation submission<%if $pendingVals > 1%>s<%/if%> and <%$prepaids%> prepaid attempts left</th>
	</tr>
	<%/if%>
	<tr class="title">
		<th colspan="6" >Signs registered to you</th>
	</tr>
	
	
	<tr>
		<th>Recipient Name</th>
<!-- 		<th>Sign Description</th> -->
		<th>Reg date</th>
	</tr>
	
	
	<%section name=signList loop=$signLoop%>
	<form action="user.php?sid=<%$sid%>" method="post">
	<input type="hidden" name="mode" value="reg" />
	<input type="hidden" name="action" value="edit" />
	<input type="hidden" name="signID" value="<%$signLoop[signList].id%>" />
	<tr class="<%if $smarty.section.index is odd %>grey<%/if%>">
		<td><%$signLoop[signList].name%></td>
		<!-- <td><%$signLoop[signList].description%></td>-->
		<td><nobr><%$signLoop[signList].date%></nobr></td>
	</tr>
	</form>
	<%/section%>
</table>
<%/if%>

<div class="lr"><a href="user.php?mode=reg&action=reg&sid=<%$sid%>"><img src="templates/img/splash/reg-room.png" alt="Registration Room" border="0" /></a><span><a href="user.php?mode=val&sid=<%$sid%>"><img src="templates/img/splash/val-room.png" alt="Validation Room" /></a></span></div>

<%include file="footer.tpl"%>
