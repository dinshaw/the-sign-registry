<!-- <%$smarty.template%> -->
<%include file="admin/admin_header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>


<h2>SIGN TYPES</h2>

<p class="red"?><%$msg|nl2br%></p>
<table class="return" >
	
	<tr class="title">
		<th colspan="2" >Sign Types</th>
	</tr>
	
	
	<tr>
		<th>Name</th>
		<th>Action</th>
	</tr>
	
	
	<%section name=typeList loop=$typeLoop%>
	<form action="admin.php?sid=<%$sid%>" method="post">
	<input type="hidden" name="mode" value="signTypes" />
	<input type="hidden" name="action" value="edit" />
	<input type="hidden" name="typeID" value="<%$typeLoop[typeList].id%>" />
	<tr>
		<td><%$typeLoop[typeList].name%></td>
		<td><a href="admin.php?mode=signTypes&action=delete&id=<%$typeLoop[typeList].id%>&sid=<%$sid%>" onClick="return confirm('Are yo sure you want to delete?')">DELETE</a> <a href="admin.php?mode=signTypes&action=edit&id=<%$typeLoop[typeList].id%>&sid=<%$sid%>">EDIT</a>
	</tr>
	</form>
	<%/section%>
	
	<tr class="title">
		<th colspan="2">Add Sign</td>
	</tr>
	<tr>
	<form action="admin.php?sid=<%$sid%>" method="post">
	<input type="hidden" name="mode" value="signTypes" />
	<%if $edit eq "true"%>
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="id" value="<%$id%>" />
	<%else%>
	<input type="hidden" name="action" value="add" />
	<%/if%>
		<td colspan="2"><input type="text" name="name" value="<%$name%>" /> 
		<%if $edit eq "true"%>
		<input type="submit" value="UPDATE" />
		<%else%>
		<input type="submit" value="ADD TYPE" />
		<%/if%>
		</td>
	</form>
	</tr> 
</table>




<%include file="admin/admin_footer.tpl"%>
