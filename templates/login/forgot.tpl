<!-- <%$smarty.template%> -->
<%include file="header.tpl" page_title="The Sign Registry" currPage=$smarty.template%>

<h2 class="lr">HELP!  I Forgot my password...</h2>
<h3>Enter your email address here and we will send a new password.</h3>

<blockquote><p><strong>Your password has been encryped in out database</strong> so we cannot read it back to you but we will generate a new, random password and send it to the email address that you used to register your account.  When you succesfully login with the password that we send you, you can change it to whatever you like in the  &#8220;Edit my Account&#8221; section.</p></blockquote>

<p class='red'><%$msg|nl2br%></p>

<form action="index.php" method="post">
<input type="hidden" name="mode" value="forgotPw" />
<p>Email address: <input name="email" type="text" value="<%$email%>" /></p>
<p><input name="getNewPass" type="submit" value="Get new password" /></p>
</form>

</div>
<%include file="footer.tpl"%>
