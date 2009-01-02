<!-- <%$smarty.template%> -->
<%include file="admin/admin_header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>


<h2>REVIEW SIGNS</h2>


<%if $signLoop%>
<!-- table to display signs registered to this person and pending validation attemplte -->
<table class="return" >
	
	<tr class="title">
		<th colspan="9" >Signs registered</th>
	</tr>
	
	
	<tr>
		<th>ID #</th>
		<th>Registrant Name</th>
		<th>Recipient Name</th>
		<th>Description</th>
		<th>Confirmed Validation</th>
		<th>Type</th>
		<th>Status</th>
		<th>Reg date</th>
		<th>Action</th>
	</tr>
	
	
	<%section name=signList loop=$signLoop%>
	<form action="admin.php?sid=<%$sid%>" method="post">
	<input type="hidden" name="mode" value="signs" />
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="signID" value="<%$signLoop[signList].sign_id%>" />
	<tr class="<%if $smarty.section.index is odd %>grey<%/if%>">
		<td><%$signLoop[signList].sign_id%></td>
		<td><a href="admin.php?sid=<%$sid%>&mode=userDetails&id=<%$signLoop[signList].reg_id%>"><%$signLoop[signList].reg_name%></a></td>
		<td><a href="admin.php?sid=<%$sid%>&mode=userDetails&id=<%$signLoop[signList].rec_id%>"><%$signLoop[signList].rec_name%></td>
		<td><a href="admin.php?sid=<%$sid%>&mode=signDetails&signID=<%$signLoop[signList].sign_id%>"><%$signLoop[signList].description%></td>
		<td><%$signLoop[signList].sub_id%></td>
		<td>
		<select name="type">
		<option value="">N/A</option>
		<%section name=typeList loop=$typeLoop%>
		<option value="<%$typeLoop[typeList].id%>" <%if $typeLoop[typeList].id eq $signLoop[signList].type%>selected<%/if%>><%$typeLoop[typeList].name%></option>
		<%/section%>
		</select></td>
		<td><select name="status">
		<option value="0" <% if $signLoop[signList].status eq "0"%>selected<%/if%> >Unpaid</option>
		<option value="1" <% if $signLoop[signList].status eq "1"%>selected<%/if%>>Paid</option>
		<option value="2" <% if $signLoop[signList].status eq "2"%>selected<%/if%>>Confirmed</option>
		</select></td>
		<td><nobr><%$signLoop[signList].reg_date|date_format%></nobr></td>
		<td><input type="submit" name="submit" value="UPDATE" /></td>
	</tr>
	</form>
	<%/section%>
	
	<tr class="title">
		<th colspan="9">SEARCH</th>
	</tr>
	<tr class="title">
		<th>ID #</th>
		<th>Registrant Name</th>
		<th>Recipient Name</th>
		<th colspan="2">Description</th>
		<th>Type</th>
		<th>Status</th>
		<th>Reg date</th>
		<th>Action</th>
	</tr>
	<form action="admin.php?sid=<%$sid%>" method="post">
	<input type="hidden" name="mode" value="signs" />
	<input type="hidden" name="search" value="true" />
	<tr class="title">
		<th><input type="text" name="s_signID" value="<%$s_signID%>" class="num" /></th>
		<th>First Name: <input type="text" name="s_reg_first_name" value="<%$s_reg_first_name%>" /></th>
		<th>First Name:<input type="text" name="s_rec_first_name" value="<%$s_rec_first_name%>" /></th>
		<th colspan="2"><input type="text" name="s_description" value="<%$s_description%>" /></th>
		<th><select name="s_type">
		<option value="">N/A</option>
		<%section name=typeList loop=$typeLoop%>
		<option value="<%$typeLoop[typeList].id%>" <%if $typeLoop[typeList].id eq $s_type%>selected<%/if%>><%$typeLoop[typeList].name%></option>
		<%/section%>
		</select></th>
		<th><select name="s_status">
		<option value="0" >Unpaid</option>
		<option value="1" >Paid</option>
		<option value="2" >Confirmed</option>
		</select></th>
		<th>From:<br /><select name="s_from_reg_day" class="date">
		<%include file="inc/daySelect.tpl" value="$reg_day"%>
		</select><select name="s_from_reg_month" class="date">
		<%include file="inc/monthSelect.tpl" value="$reg_month"%>
		</select><select name="s_from_reg_year" class="date">
		<%include file="inc/yearSelect.tpl" value="$reg_year"%>
		</select></th>
		<th><input type="submit" name="search" value="SEARCH" /></th>
	</tr>
	<tr class="title">
		<th></th>
		<th>Last Name: <input type="text" name="s_reg_last_name" value="<%$s_reg_last_name%>" /></th>
		<th>Last Name: <input type="text" name="s_rec_last_name" value="<%$s_rec_last_name%>" /></th>
		<th colspan="2"></th>
		<th></th>
		<th></th>
		<th>To:<br /><select name="s_to_reg_day" class="date">
		<%include file="inc/daySelect.tpl" value="$reg_day"%>
		</select><select name="s_to_reg_month" class="date">
		<%include file="inc/monthSelect.tpl" value="$reg_month"%>
		</select><select name="s_to_reg_year" class="date">
		<%include file="inc/yearSelect.tpl" value="$reg_year"%>
		</select></th>
		<th></th>
	</tr>
	</form>
	<tr>
		<td colspan="9">
		<p><%$fullCount%> signs in the database<%if $search %> match your search criteria<%/if%>.</p> 
<div id="pager"><%if $pages %>Page:  <a href="admin.php?sid=<%$sid%>&mode=signs&start=<%$prev%><%if $search %>&action=search<%/if%><%if $email %>&email=<%$email%><%/if%><%if $username %>&username=<%$username%><%/if%><%if $status %>&status=<%$status%><%/if%><%if $emailList %>&emailList=<%$emailList%><%/if%>">&#8249;&#8249;&#8249;</a><%/if%><%section name=pageLoop loop=$pages%>
<%if $pages[pageLoop].start eq "$curr"%><span class="currPage"><%/if%><a href="admin.php?sid=<%$sid%>&mode=signs&start=<%$pages[pageLoop].start%>">
<%$pages[pageLoop].pagenumber%></a><%if $curr eq $pages[pageLoop].start%></span><%/if%>
<%/section%> <%if $pages %><a href="admin.php?sid=<%$sid%>&mode=signs&start=<%$next%><%if $search %>&action=search<%/if%><%if $email %>&email=<%$email%><%/if%><%if $username %>&username=<%$username%><%/if%><%if $status %>&status=<%$status%><%/if%><%if $emailList %>&emailList=<%$emailList%><%/if%>">&#8250;&#8250;&#8250;</a><%/if%>
</div>
		</td>
	</tr>

</table>
<%else%>
There are no signs
<%/if%>



<%include file="admin/admin_footer.tpl"%>
