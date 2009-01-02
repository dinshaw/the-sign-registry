<!-- <%$smarty.template%> -->
<%include file="admin/admin_header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>


<h2><%$first_name%> <%$last_name%> </h2>

<br /><br />
<ul id="reg_info">
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
		<th colspan="6" >Signs Registered By <%$first_name%> <%$last_name%> </th>
	</tr>
	
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Description</th>
		<th>Status</th>
		<th>Reg date</th>
	</tr>

	<%section name=recipientList loop=$recipientLoop%>

	<tr class="<%if $smarty.section.index is odd %>grey<%/if%>">
		<td><a href="admin.php?sid=<%$sid%>&mode=userDetails&id=<%$recipientLoop[recipientList].id%>"><%$recipientLoop[recipientList].name%></a></td>
		<td><a href="mailTo:<%$recipientLoop[recipientList].email%>"><%$recipientLoop[recipientList].email%></a></td>
		<td><a href="admin.php?sid=<%$sid%>&mode=signDetails&signID=<%$recipientLoop[recipientList].sign_id%>"><%$recipientLoop[recipientList].description%></a></td>
		<td><select name="status">
		<option value="0" <%if $recipientLoop[recipientList].status eq "0"%>selected<%/if%> >Un-paid</option>
		<option value="1" <%if $recipientLoop[recipientList].status eq "1"%>selected<%/if%> >Paid</option>
		<option value="2" <%if $recipientLoop[recipientList].status eq "2"%>selected<%/if%> >Verified</option>
		</select></td>
		<td><%$recipientLoop[recipientList].date%></td>
		
	<%/section%>
</table>
<%/if%>

<%if $signLoop%>
<!-- table to display signs registered to this person and pending validation attemplte -->
<table class="return" >
	
	<tr class="title">
		<th colspan="6" >Signs registered To <%$first_name%> <%$last_name%></th>
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
		<td><a href="admin.php?mode=userDetails&sid=<%$sid%>&id=<%$signLoop[signList].userID%>"><%$signLoop[signList].name%></a></td>
		<!-- <td><%$signLoop[signList].description%></td>-->
		<td><nobr><%$signLoop[signList].date%></nobr></td>
	</tr>
	</form>
	<%/section%>
</table>
<%/if%>


<%if $pendingVals %>
<table class="return">
	<tr class="title">
		<th colspan="6" ><%$first_name%> <%$last_name%> has <%$pendingVals%> pending validation submission<%if $pendingVals > 1%>s<%/if%> and <%$prepaids%> prepaid attempts left</th>
	</tr>
</table>
	<%/if%>
<%include file="admin/admin_footer.tpl"%>
