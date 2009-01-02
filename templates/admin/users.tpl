<!-- <%$smarty.template%> -->
<%include file="admin/admin_header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>


<h2>REVIEW USERS</h2>


<%if $userLoop%>
<!-- table to display signs registered to this person and pending validation attemplte -->
<table class="return" >
	
	<tr class="title">
		<th colspan="4" >Users</th>
	</tr>
	
	
	<tr>
		<th>ID #</th>
		<th>Name<p class="small">(click to email)</p></th>
		<th>Type<p class="small">(click for details)</p></th>
		<th>Reg date</th>
	</tr>
	
	
	<%section name=userList loop=$userLoop%>
	<form action="admin.php?sid=<%$sid%>" method="post">
	<input type="hidden" name="mode" value="users" />
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="id" value="<%$userLoop[userList].sub_id%>" />
	<tr class="<%if $smarty.section.index is odd %>grey<%/if%>">
		<td><%$userLoop[userList].id%></td>
		<td><a href="mailTo:<%$userLoop[userList].email%>"><%$userLoop[userList].name%></a></td>
		<td><a href="admin.php?sid=<%$sid%>&mode=userDetails&id=<%$userLoop[userList].id%>"><%$userLoop[userList].type%></a></td>
		<td><nobr><%$userLoop[userList].reg_date|date_format%></nobr></td>
	</tr>
	</form>
	<%/section%>
	<form action="admin.php?sid=<%$sid%>" method="post">
	<input type="hidden" name="mode" value="users" />
	<input type="hidden" name="search" value="true" />
	<tr class="title">
		<th>ID #</th>
		<th>Name</th>
		<th>Type</p></th>
		<th>Reg date</th>
		<th>Action</th>
	</tr>
	<tr class="title">
		<th><input type="text" name="s_id" value="<%$s_id%>" class="num" /></th>
		<th>First Name: <input type="text" name="s_first_name" value="<%$s_first_name%>" /></th>
		<th><select name="s_type">
		<option value="" >All</option>
		<option value="1" >Registrant</option>
		<option value="2" >Recipient</option>
		<option value="3" >Registrant / Recipient</option>
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
		<th>Last Name: <input type="text" name="s_last_name" value="<%$s_last_name%>" /></th>
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
		<p><%$fullCount%> users in the database<%if $search %> match your search criteria<%/if%>.</p> 
<div id="pager"><%if $pages %>Page:  <a href="admin.php?sid=<%$sid%>&mode=users&start=<%$prev%><%if $search %>&action=search<%/if%><%if $email %>&email=<%$email%><%/if%><%if $username %>&username=<%$username%><%/if%><%if $status %>&status=<%$status%><%/if%><%if $emailList %>&emailList=<%$emailList%><%/if%>">&#8249;&#8249;&#8249;</a><%/if%><%section name=pageLoop loop=$pages%>
<%if $pages[pageLoop].start eq "$curr"%><span class="currPage"><%/if%><a href="admin.php?sid=<%$sid%>&mode=users&start=<%$pages[pageLoop].start%>">
<%$pages[pageLoop].pagenumber%></a><%if $curr eq $pages[pageLoop].start%></span><%/if%>
<%/section%> <%if $pages %><a href="admin.php?sid=<%$sid%>&mode=users&start=<%$next%><%if $search %>&action=search<%/if%><%if $email %>&email=<%$email%><%/if%><%if $username %>&username=<%$username%><%/if%><%if $status %>&status=<%$status%><%/if%><%if $emailList %>&emailList=<%$emailList%><%/if%>">&#8250;&#8250;&#8250;</a><%/if%>
</div>
		</td>
	</tr>
</table>
<%else%>
There are no users
<%/if%>



<%include file="admin/admin_footer.tpl"%>
