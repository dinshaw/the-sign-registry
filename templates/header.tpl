<!-- <%$smarty.template%> -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="description" content="Accessibility produces SEO, good design produces conversions" />
<meta name="keywords" content="design, usability, sales, conversion rates, accessibility, search engine optimization, seo, white hat" />
<title><%$page_title%></title>
<link rel="stylesheet" href="inc/css/layout.css" type="text/css" media="all" />
<link rel="stylesheet" href="inc/css/basic.css" type="text/css" media="all" />

</head>
<body id="the-sign-registry">

<div id="header">
	<img src="templates/img/header/logo.gif" />
</div>

<%if $currPage ne "login.tpl"%>
<div id="login">
	<%if $sid%>
	<p>Welcome <%$welcome_name%>,</p>
	<%else%><form action="user.php" name="login" method="post"><input type="hidden" name="mode" value="login" /><input type="hidden" name="currPage" value="<%$currPage%>" />email<input type="text" class="text" name="email" id="email" />password<input type="password" name="password" class="text" id="password" /><input type="submit" name="login" value="login" class="button"/><a href="index.php?mode=forgotPw">forgot your password?</a></form>
<%/if%><%/if%>
	</div>
	<%include file="inc/nav.tpl"%>
		<div id="content">