<!-- <%$smarty.template%> -->
<%include file="header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>

<div id="reg">


<h2 class="lr">REGISTER A SIGN <span>Step 1</span></h2>

<%if $sid%>
<p>Please use the form below to enter the recipient's contact information for the sign you plan to leave after your physical death, or choose from the list of previously registered recipients.</p>
<%else%>
<p>Please enter your personal details and the details of the recipient of your sign</p>

<p class="small">Returning Visitors and Recipients, please login above. New users will be issued login information via email after first registration is completed.</p>
<p class="small">Before you begin, you will need to know the address and email of the person for whom you will be leaving a sign.</p>
<%/if%>




<blockquote>
<h2>THE COST OF REGISTERING A SIGN</h2>
<p>To help subsidize the cost of maintaining and administering this site (data storage, maintenance, administration, programming, communications, etc.) the cost of registering each sign is $<%$signPrice|money_format:"2":".":","%><span class="red">**</span>

, which includes <%$defaultValidations%> free visit<%if $defaultValidations ne '1'%>s<%/if%> to the <em>Validation Room</em> where your chosen recipient will be able to verify a sign that was received.</p>
</blockquote>


<%if $msg %><p class="red"><%$msg|nl2br%></p><%/if%>

<%if $sid%>
<!-- if there is a session already for the registrant then show exsisting recipients -->

<%if $recipientLoop %>
<!-- if there are previousl registered recipients then display them -->

<table class="return" id="recipients">
	<tr class="title">
		<th colspan="5" >Previously Registered Recipients</th>
	</tr>
	
	<tr>
		<th>Register a new sign</th>
		<th>Name</th>
		<th>Email</th>
		<th>Number of Signs</th>
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
		<td><%$recipientLoop[recipientList].count%></td>
		<td><%$recipientLoop[recipientList].date%></td>
		<form action="registrantsLoopindex.php" method="post">		
		<input type="hidden" name="mode" value="reg" />
		<input type="hidden" name="action" value="edit" />
		<input type="hidden" name="recID" value="<%$recipientLoop[recipientList].id%>" />
	</tr>
	</form>
	<%/section%>
</table>


<p>OR</p>
<p>Register a sign for a new person...</p>
<%/if%>
<%/if%>



<%if $sid%><form action="user.php?sid=<%$sid%>" method="post"><%else%><form action="index.php" method="post"><%/if%>
<input type="hidden" name="mode" value="reg" />
<input type="hidden" name="action" value="reg" />
<%if $regID %><input type="hidden" name="regID" value="<%$regID%>" /><%/if%>

<%if $recDoubleID %>
<!-- IF THERE WAS AN EMAIL FOUND DOUBLE THEN SHOW THE POSSIBE RECIPIENT NAME AND PROVIDE THEIR ID OIN A HIDDEN FIELD -->
<blockquote>
<p>Did you mean to leave a sign for...</p>
<p><strong><%$recDoubleName%> &lt;<%$recDoubleEmail%>&gt;</strong> from <strong><%$city%>, <%$state%></strong>?</p>
<p><input type="checkbox" name="recID" value="<%$recDoubleID%>" /> Yes!</p>
</blockquote>
<%/if%>


<%if !$sid%>
<div id="tc"><input name="tc" type="checkbox" value="yes" <%if $tc eq "yes" or $edit eq "true"%>checked<%/if%> /> <span class="red">*</span> By checking this box you are agreeing to the <a href="index.php?mode=tc" target="_blank" onClick="window.open('index.php?mode=tc','Terms&amp;Conditions','width=600,height=650,scrollbars=yes,resizable=yes');return false;">Terms &amp; Conditions</a> of <em>The Sign Registry</em>.</div>

<fieldset><legend>YOUR INFORMATION</legend>
<!-- if there is no session for the registrant then colect registratn details -->
<table class="form"> 
	<tr>
		<td colspan="2"><input type="radio" name="sal" value="Mr." <%if $sal eq "Mr."%>checked<%/if%>> Mr. <input type="radio" name="sal" value="Mrs." <%if $sal eq "Mrs."%>checked<%/if%> /> Mrs. <input type="radio" name="sal" value="Ms." <%if $sal eq "Ms."%>checked<%/if%> /> Ms.</td>
		<th><span class="red">*</span> Date of birth</th>
		<td><select name="dob_month" class="date">
		<%include file="inc/monthSelect.tpl" value="$dob_month"%>
		</select> / <select name="dob_day" class="date">
		<%include file="inc/daySelect.tpl" value="$dob_day"%>
		</select> / <select name="dob_year" class="date">
		<%include file="inc/yearSelect.tpl" value="$dob_year"%>
		</select></td>
	</tr>
	
	<tr>
		<th><span class="red">*</span> Email / Username</th>
		<td><input  type="text" class="text" name="email" value="<%$email%>" /></td>
		<th><span class="red">*</span> Street Address</th>
		<td><input  type="text" class="text" name="address" value="<%$address%>" /></td>
	</tr>
	
	<tr>
		<th><span class="red">*</span> First Name</th>
		<td><input  type="text" class="text" name="firstName" value="<%$firstName%>" /></td>
		<th>Address (additional)</th>
		<td><input  type="text" class="text" name="address2" value="<%$address2%>" /></td>
	</tr>
	
	<tr>	
		<th><span class="red">*</span> Last Name</th>
		<td><input  type="text" class="text" name="lastName" value="<%$lastName%>" /></td>
		<th><span class="red">*</span> City</th>
		<td><input  type="text" class="text" name="city" value="<%$city%>" /></td>
	</tr>
	
	<tr>
		<th><span class="red">*</span> Phone</th>
		<td><input  type="text" class="text" name="tel" value="<%$tel%>" /></td>
		<th><span class="red">*</span> State / Province</th>
		<td><select name="state" class="text">
		<%include file="inc/statesSelect.tpl" value="$state"%>
		</select></td>		
	</tr>
	
	<tr>
		<th>(Other Phone)</th>
		<td><input  type="text" class="text" name="tel2" value="<%$tel2%>" /></td>
		<th><span class="red">*</span> Zip</th>
		<td><input  type="text" class="dollar" name="zip" value="<%$zip%>" /></td>
	</tr>
	
	<tr>
		<td colspan="2"></td>
		<th><span class="red">*</span> Country</th>
		<td><select name="country" class="text">
		<%include file="inc/countrySelect.tpl" value="$country"%>
		</select></td>
	</tr>
</table>
</fieldset>

<!-- end if valid_user condition -->
<%/if%>



<fieldset><legend>I would like to leave a sign for: RECIPIENT INFORMATION</legend>
<table class="form"> 
		<tr>
			<td>
				
			</td>
		</tr>
		
		<tr>
		<td colspan="2"><input type="radio" name="sal_2" value="Mr." <%if $sal_2 eq "Mr."%>checked<%/if%> /> Mr. <input type="radio" name="sal_2" value="Mrs." <%if $sal_2 eq "Mrs."%>checked<%/if%> /> Mrs. <input type="radio" name="sal_2" value="Ms." <%if $sal_2 eq "Ms."%>checked<%/if%> /> Ms.</td>
		
	</tr>
	<tr>
		<th><span class="red">*</span> Email / Username</th>
		<td><input  type="text" class="text" name="email_2" value="<%$email_2%>" /></td>
		<th><span class="red">*</span> Street Address</th>
		<td><input  type="text" class="text" name="address_2" value="<%$address_2%>" /></td>
		
	
	</tr>
	
	<tr>	
		<th><span class="red">*</span> First Name</th>
		<td><input  type="text"  class="text" name="firstName_2" value="<%$firstName_2%>" /></td>
		<th>Address (additional)</th>
		<td><input  type="text" class="text" name="address2_2" value="<%$address2_2%>" /></td>
		
	</tr>
	
	<tr>
		<th><span class="red">*</span> Last Name</th>
		<td><input  type="text" class="text" name="lastName_2" value="<%$lastName_2%>" />
		<th><span class="red">*</span> City</th>
		<td><input  type="text" class="text" name="city_2" value="<%$city_2%>" /></td>	
	</tr>
	
	<tr>
		<th><span class="red">*</span> Phone</th>
		<td><input  type="text" class="text" name="tel_2" value="<%$tel_2%>" /></td>
		<th><span class="red">*</span> State</th>
		<td><select name="state_2" class="text">
		<%include file="inc/statesSelect.tpl" value="$state_2"%>
		</select></td>	
	</tr>
	
	<tr>
		<th>(Other Phone)</th>
		<td><input  type="text" class="text" name="tel2_2" value="<%$tel2_2%>" /></td>
		<th><span class="red">*</span> Zip</th>
		<td><input  type="text" class="dollar" name="zip_2" value="<%$zip_2%>" /></td>
	</tr>
	
	<tr>
		<td colspan="2"></td>
		<th><span class="red">*</span> Country</th>
		<td><select name="country_2" class="text">
		<%include file="inc/countrySelect.tpl" value="$country_2"%>
		</select></td>
	</tr>
</table>
</fieldset>
<p class="small footNote"><span class="red">*</span> Required fields<br /><span class="red">**</span> Price subject to Change</p>

<div class="lr"><span><%if $edit eq "true"%><input type="submit" name="save1" value="Save Changes" class="button" /><%else%><input type="submit" name="step1" value="Continue" class="button" /></span><%/if%></div>
</form>

</div>	
 
<%include file="footer.tpl"%>
