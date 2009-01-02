<!-- <%$smarty.template%> -->
<%include file="admin/admin_header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>


<h2>SIGN DETAILS</h2>

<table class="return" >
	
	<tr class="title">
		<th colspan="8" >Sign registered by <a href="admin.php?mode=userDetails&sid=<%$sid%>&id=<%$reg_id%>"><%$reg_name%></a> for <a href="admin.php?mode=userDetails&sid=<%$sid%>&id=<%$reg_id%>"><%$rec_name%></a></th>
	</tr>
	<tr>
		<td><%$description%></td>
	</tr>
	
	<tr class="title">
		<th>Submissions</th>
	</tr>
	<%section name=submissionList loop=$submissionLoop%>
		<tr>
			<td><%$submissionLoop[submissionList].text%></td>
		</tr>
	<%/section%>
</table>




<%include file="admin/admin_footer.tpl"%>
