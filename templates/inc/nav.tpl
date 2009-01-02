<div id="nav">
	<ul>
		<li><a href="<%if $sid%>user.php?mode=reg&sid=<%$sid%><%else%>index.php?mode=reg<%/if%>">Registration Room</a></li>
		<li><a href="user.php?mode=val<%if $sid%>&sid=<%$sid%><%/if%>">Validation Room</a></li>
		<li><a href="user.php?mode=editProfile<%if $sid%>&sid=<%$sid%><%/if%>">Edit My Profile</a></li>
		<li><a href="http://www.foreverfamilyfoundation.org/" target="_blank">Forever Family Foundation</a></li>
		<li><a href="index.php?mode=contact">Contact</a></li>
		<%if $sid%><li><a href="user.php?sid=<%$sid%>&mode=add_vals">Add Validations</a></li><%/if%>
		<%if $sid%><li><a href="index.php?mode=logout">Logout</a></li><%/if%>
		<li><%if $sid%><a href="user.php?sid=<%$sid%>"><%else%><a href="index.php"><%/if%>Home</a></li>
		<%if $sid%><li><a href="user.php?sid=<%$sid%>&mode=pay&editCart=true">Checkout</a></li><%/if%>

	</ul>
</div>