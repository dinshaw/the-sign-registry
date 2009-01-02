<!-- <%$smarty.template%> -->
<%include file="admin/admin_header.tpl" pageTitle="Red Rock West Saloon - NYC"%>

<div id="centercontent">
<div id="adminTitle" class="title"><h1>Adminn Area</h1></div>
<table class="form">
<tr>
		<th>Email adderss</th><th>Username</th><th>ID#</th><th>Action</th><th>Edit</th>
	</tr>
<%section name=accountList loop=$accountLoop%>
<form action="admin.php?sid=<%$sid%>" method="post">
<input type="hidden" name="mode" value="accounts">
<input type="hidden" name="action" value="delete">
<input type="hidden" name="id" value="<%$accountLoop[accountList].id%>">
	
	<tr id="adminContent">
		<td><%$accountLoop[accountList].email%></td><td><%$accountLoop[accountList].username%></td>
		<td><%$accountLoop[accountList].id%></td>
		<td><select name="action">
			<option value="changepass">Change Password</option>
			<option value="delete">Delete</option>
			</select>
		</td>
		<td><input type="submit" name="Submit" value="Do it"></td>
	</tr>
</form>
<%/section%>
</table>
<p id="adminContent"><%$fullCount%> Admin accounts in database. <%if $pages %>Page:  <%/if%><%section name=pageLoop loop=$pages%>
<a href="admin.php?mode=accounts&start=<%$pages[pageLoop].start%>">
<%$pages[pageLoop].pagenumber%></a>
<%/section%></p>

<h1>Add an Account</h1>
<p class="error"><%$error|nl2br%></p>
<form action="admin.php?sid=<%$sid%>" method="post">
<input type="hidden" name="mode" value="accounts">
<input type="hidden" name="errorCheck" value="on">
<input type="hidden" name="action" value="addAccount">
<table class="form">
  <tr>
    <td class="lbl">Username:</td>
    <td class="fld"><input type="text" name="username" value="<%$username%>"></td>
  </tr>
  <tr>
    <td class="lbl">Password:</td>
    <td class="fld"><input type="password" name="passwd"></td>
  </tr>
  <tr>
    <td class="lbl">Confirm Password:</td>
	<td class="fld"><input type="password" name="passwd2"></td>
  </tr>
  <tr>
    <td class="lbl">Email Address:</td>
    <td class="fld"><input type="text" name="email" value="<%$email%>"></td>
  </tr>
  <tr>
    <td colspan="2" id="btn"><input type="submit" name="add" value="Add Account"></td>
  </tr>
</table>
</form>
</div>

<%include file="admin/admin_footer.tpl" currPage=$smarty.template%>