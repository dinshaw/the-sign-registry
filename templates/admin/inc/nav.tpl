<div id="nav">
	<ul>
		<li><a href="admin.php?mode=signs&amp;sid=<%$sid%>" <%if !$cur_page%>class="on"<%/if%>>HOME</a></li>
		<li><a href="admin.php?mode=signs&amp;sid=<%$sid%>" <%if !$cur_page%>class="on"<%/if%>>SIGNS</a></li>
		<li><a href="admin.php?mode=submissions&amp;sid=<%$sid%>" <%if !$cur_page%>class="on"<%/if%>>SUBMISSIONS</a></li>
		<li><a href="admin.php?mode=users&amp;sid=<%$sid%>" <%if !$cur_page%>class="on"<%/if%>>REGISTRANTS &amp; RECIPIENTS</a></li>	
		<li><a href="admin.php?mode=signTypes&amp;sid=<%$sid%>" <%if $cur_page eq "signTypes"%>class="on"<%/if%>>SIGN TYPES</a></li>
		<li><a href="admin.php?mode=accounts&amp;sid=<%$sid%>" <%if $cur_page eq "accounts"%>class="on"<%/if%>>ACCOUNTS</a></li>
		<li><a href="admin.php?mode=config&amp;sid=<%$sid%>" <%if $cur_page eq "config"%>class="on"<%/if%>>CONFIG</a></li>
		<li><a href="admin.php?mode=logout&amp;sid=<%$sid%>">LOGOUT</a></li>				
	</ul>
</div>