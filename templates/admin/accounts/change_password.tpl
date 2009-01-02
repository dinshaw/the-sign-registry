<!-- <%$smarty.template%> -->
<%include file="admin/admin_header.tpl" pageTitle="Red Rock West Saloon - NYC"%>

<div id="centercontent">
<div id="adminTitle" class="title"><h1>Adminn Area</h1></div>

<h1>Change password for admin account <span class="error"><%$username%></span></h1>
<p class="error"><%$error|nl2br%></p>
<form action="admin.php?sid=<%$sid%>" method="post">
<input type="hidden" name="mode" value="accounts">
<input type="hidden" name="errorCheck" value="on">
<input type="hidden" name="action" value="changepass">
<input type="hidden" name="id" value="<%$id%>">
<table class="form">
  <tr>
    <td class="lbl">Old password:</td>
    <td class="fld"><input type="text" name="oldpassword" value=""></td>
  </tr>
  <tr>
    <td class="lbl">New Password:</td>
    <td class="fld"><input type="password" name="passwd"></td>
  </tr>
  <tr>
    <td class="lbl">Confirm New Password:</td>
	<td class="fld"><input type="password" name="passwd2"></td>
  </tr>
  <tr>
    <td colspan="2" id="btn"><input type="submit" name="add" value="Change Password"></td>
  </tr>
</table>
</div>

<%include file="admin/admin_footer.tpl" currPage=$smarty.template%>