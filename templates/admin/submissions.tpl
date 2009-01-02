<!-- <%$smarty.template%> -->
<%include file="admin/admin_header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>


<h2>REVIEW SUBMISSIONS</h2>


<%if $submissionLoop%>
<!-- table to display signs registered to this person and pending validation attemplte -->
<table class="return" >
	
	<tr class="title">
		<th colspan="8" >Submissions</th>
	</tr>
	
	
	<tr>
		<th>ID #</th>
		<th>Registrant Name</th>
		<th>Recipient Name</th>
		<th>Description</th>
		<th>Status</th>
		<th>Reg date</th>
		<th>Action</th>
	</tr>
	
	
	<%section name=submissionList loop=$submissionLoop%>
	<form action="admin.php?sid=<%$sid%>" method="post">
	<input type="hidden" name="mode" value="submissions" />
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="id" value="<%$submissionLoop[submissionList].sub_id%>" />
	<tr class="<%if $smarty.section.index is odd %>grey<%/if%>">
		<td><%$submissionLoop[submissionList].sign_id%></td>
		<td><a href="admin.php?sid=<%$sid%>&mode=userDetails&id=<%$submissionLoop[submissionList].reg_id%>"><%$submissionLoop[submissionList].reg_name%></a></td>
		<td><a href="admin.php?sid=<%$sid%>&mode=userDetails&id=<%$submissionLoop[submissionList].rec_id%>"><%$submissionLoop[submissionList].rec_name%></a></td>
		<td><%$submissionLoop[submissionList].sub_id%></td>
		<td>
		<select name="status">
		<option value="0" <%if $submissionLoop[submissionList].status eq "0"%>selected<%/if%>>UN-PAID</option>
		<option value="1" <%if $submissionLoop[submissionList].status eq "1"%>selected<%/if%>>PAID</option>
		<option value="2" <%if $submissionLoop[submissionList].status eq "2"%>selected<%/if%>>CONFIRMED</option>
		</select></td>
		<td><nobr><%$submissionLoop[submissionList].sub_date%></nobr></td>
		<td><input type="submit" name="submit" value="UPDATE" /></td>
	</tr>
	</form>
	<%/section%>
	<form action="admin.php?sid=<%$sid%>" method="post">
	<input type="hidden" name="mode" value="submissions" />
	<input type="hidden" name="search" value="true" />
	<tr  class="title">
		<th>ID #</th>
		<th>Registrant Name</th>
		<th>Recipient Name</th>
		<th>Description</th>
		<th>Status</th>
		<th>Reg date</th>
		<th>Action</th>
	</tr>
	<tr class="title">
		<th><input type="text" name="s_subID" value="<%$s_subID%>" class="num" /></th>
		<th>First Name: <input type="text" name="s_reg_first_name" value="<%$s_reg_first_name%>" /></th>
		<th>First Name:<input type="text" name="s_rec_first_name" value="<%$s_rec_first_name%>" /></th>
		<th><input type="text" name="s_description" value="<%$s_description%>" /></th>
		<th><select name="s_status">
		<option value="0" >UN-PAID</option>
		<option value="1" >PAID</option>
		<option value="2" >CONFIRMED</option>
		</select></th>
		<th>From:<br /><select name="s_from_dob_day" class="date">
		<%include file="inc/daySelect.tpl" value="$dob_day"%>
		</select><select name="s_from_dob_month" class="date">
		<%include file="inc/monthSelect.tpl" value="$dob_month"%>
		</select><select name="s_from_dob_year" class="date">
		<%include file="inc/yearSelect.tpl" value="$dob_year"%>
		</select></th>
		<th><input type="submit" name="search" value="SEARCH" /></th>
	</tr>
	<tr class="title">
		<th></th>
		<th>Last Name: <input type="text" name="s_reg_last_name" value="<%$s_reg_last_name%>" /></th>
		<th>Last Name: <input type="text" name="s_rec_last_name" value="<%$s_rec_last_name%>" /></th>
		<th></th>
		<th></th>
		<th>To:<br /><select name="s_to_dob_day" class="date">
		<%include file="inc/daySelect.tpl" value="$dob_day"%>
		</select><select name="s_to_dob_month" class="date">
		<%include file="inc/monthSelect.tpl" value="$dob_month"%>
		</select><select name="s_to_dob_year" class="date">
		<%include file="inc/yearSelect.tpl" value="$dob_year"%>
		</select></th>
		<th></th>
	</tr>
	<tr>
		<th colspan="7"><p><%$fullCount%> signs in the database<%if $search %> match your search criteria<%/if%>.</p> 
<div id="pager"><%if $pages %>Page:  <a href="admin.php?sid=<%$sid%>&mode=submissions&start=<%$prev%><%if $search %>&action=search<%/if%><%if $email %>&email=<%$email%><%/if%><%if $username %>&username=<%$username%><%/if%><%if $status %>&status=<%$status%><%/if%><%if $emailList %>&emailList=<%$emailList%><%/if%>">&#8249;&#8249;&#8249;</a><%/if%><%section name=pageLoop loop=$pages%>
<%if $pages[pageLoop].start eq "$curr"%><span class="currPage"><%/if%><a href="admin.php?sid=<%$sid%>&mode=submissions&start=<%$pages[pageLoop].start%>">
<%$pages[pageLoop].pagenumber%></a><%if $curr eq $pages[pageLoop].start%></span><%/if%>
<%/section%> <%if $pages %><a href="admin.php?sid=<%$sid%>&mode=submissions&start=<%$next%><%if $search %>&action=search<%/if%><%if $email %>&email=<%$email%><%/if%><%if $username %>&username=<%$username%><%/if%><%if $status %>&status=<%$status%><%/if%><%if $emailList %>&emailList=<%$emailList%><%/if%>">&#8250;&#8250;&#8250;</a><%/if%>
</div></th>
	</tr>
</table>
<%else%>
No Submissions matched your serch criteria.
<%/if%>



<%include file="admin/admin_footer.tpl"%>
