<!-- <%$smarty.template%> --><%include file="admin/admin_header.tpl" pageTitle="Red Rock West Saloon - NYC"%><div id="centercontent"><div id="adminTitle" class="title"><h1>Adminn Area</h1></div>	<h2>Thank you.</h2><h3>Your admin username and new password have been sent to <span class="error"><%$email%></span>.</h3><hr><p class='error'><%$errors%></p><form action="admin.php" method="post" name="adminLogin"><input type="hidden" name="mode" value="login"><p>Username: <input name="username" type="text" value="<%$username%>" size="10"></p><p>Password: <input name="password" type="password" size="10"></p><p><input name="submit" type="submit" value="Login"></p></form><h5>Forgot your username or password? <a href='admin.php?mode=forgot'>Click Here</a>.</h5><hr></div><%include file="admin/admin_footer.tpl" currPage=$smarty.template%>