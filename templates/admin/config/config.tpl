<!-- <%$smarty.template%> -->
<%include file="admin/admin_header.tpl" pageTitle="Red Rock West Saloon - NYC"%>

<div id="centercontent">
<div id="adminTitle" class="title"><h1>Admin Area</h1></div>

<h1>Configuration Parameters</h1>

<table class="form">
	<tr>
		<th>Last modified</th>
		<th>Modified by</th>
		<th>Name</th>
		<th>Value</th>
		<th>Description</th>
		<th>ID#</th>
		<th>Action</th>
		<th>Submit</th>
	</tr>
<%section name=configList loop=$configLoop%>

<form action="admin.php?sid=<%$sid%>" method="post">
<input type="hidden" name="mode" value="config">
<input type="hidden" name="id" value="<%$configLoop[configList].id%>">	
	
	<tr>
		<td class="small"><%$configLoop[configList].lastChange|date_format:"%D %l:%M %p"%></td>
		<td><%$configLoop[configList].changeBy%></td>
		<td><%$configLoop[configList].config_name%></td>
		<td><%$configLoop[configList].value|strip_tags:false%></td>
		<td class="ctr"><%$configLoop[configList].description%></td>
		<td><%$configLoop[configList].id%></td>
		<td><select name="action">
			<option value="edit">Edit</option>
			<option value="delete">Delete</option>
			</select></td>
		<td><input type="submit" name="submit" value="Do it" class="button"></td>
	</tr>
</form>

<%/section%>
	<tr>
		<th colspan="8">Add / Edit</th>
	</tr>
	<%if $msg%>
		<tr>
			<td class="red ctr" colspan="8"><%$msg|nl2br%></td>
		</tr>
	<%/if%>
	<tr>
	<form action="admin.php?sid=<%$sid%>" method="post">
	<input type="hidden" name="mode" value="config">
	<input type="hidden" name="adminID" value="<%$adminID%>">
	<input type="hidden" name="id" value="<%$id%>">
	
		<td class="small"><%$smarty.now|date_format:"%D %l:%M %p"%></td>
		<td><%$adminName|capitalize:true%></td>
		<td><input type="text" name="config_name" value="<%$config_name%>"></td>
		<td><textarea name="config_value" ><%$config_value%></textarea></td>
		<td><input type="text" name="config_description" value="<%$config_description%>"></td>
		<td colspan="3"><input type="submit" name="add_edit" value="Add / Save" class="button"></td>
	</form>
	</tr>
</table>


</div>
<%include file="admin/admin_footer.tpl" currPage=$smarty.template%>