<!-- <%$smarty.template%> -->
<%include file="header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>

<div id="reg">

<h2 class="lr">VALIDATION ROOM</h2>

<%if $sid%>
<!-- if there is a session already for the user then show exsisting registrants -->

<%if $registrantsLoop or $registrantID%>
<form action="user.php?sid=<%$sid%>" method="post">
<input type="hidden" name="mode" value="val" />
<input type="hidden" name="prepaids" value="<%$prepaids%>" />

<%if $registrantsLoop%>
<!-- if there are signns registerred to this user display the registrants -->
<p>There are multiple signs reigistered to you in our database. If you belive that you know who the person is that is maybe trying to contact you please indicate it by  checking the box next to their name in the table below.</p>

<table class="return" id="registrants">
	<tr class="title">
		<th colspan="5" >Our database indicates the following number of signs have been registered to you</th>
	</tr>
	
	
	<tr>
		<th></th>
		<th>Registrant Name</th>
		<th>Number of Signs Registered</th>
		<!-- <th>Reg date</th> -->
	</tr>

	<%section name=registrantList loop=$registrantsLoop%>
	<tr>
		<td><input type="radio" name="registrantID" value="<%$registrantsLoop[registrantList].id%>"/></td>
		<td><%$registrantsLoop[registrantList].name%></td>
		<td><%$registrantsLoop[registrantList].count%></td>
		<!-- <td><%$registrantsLoop[registrantList].date%></td> -->
	</tr>
	<%/section%>
	<tr class="title">
		<th colspan="3">We will check your current after death communication entered below with all signs registered to you.<br />This will count as only one validation attempt.<br />If you know, or you believe you know, who has sent you the sign you are entering for validation,<br />please click on that person's button above before hitting the submit button.</th>
	</tr>
	
</table>

<%elseif $registrantID%>
<p>Our database indicates that <strong><%$registrantName%></strong>, has registered at least one sign to you.</p>
<input type="hidden" name="registrantID" value="<%$registrantID%>" />
<%/if%>

<h3 class="mb20"></h3>
<h3 class="mb20">
<%if $prepaids %>You have <%$prepaids%> prepaid validation attempts remaining.</p>
<%else%>
<span class="red">You have no prepaid validation attempts left.  In order to recieve confirmation of this sign you will need to purchase a validation atempt.  Please click the <a href="user.php?sid=<%$sid%>&mode=add_vals">Add Validations</a> link in the left hand menu.</span><%/if%>
</h3>

<%if $msg %><p class="red"><%$msg|nl2br%></p><%/if%>

<textarea name="validation"><%$description%></textarea>



<div class="lr">Each validation attempt is $5.00. You currently have <%$prepaids%> paid validation attempts available. Click <a href="user.php?sid=<%$sid%>&mode=add_vals">here</a> to buy more validation attempts<span><input type="submit" name="validate" value="Submit for validation" class="button" /></span></div>
</form>




<%else%>
<!-- if there are no signs registered then say so -->
<p>You have no signs registered to you at this time.</p>
<%/if%>
<%/if%>



</div>
 
<%include file="footer.tpl"%>
