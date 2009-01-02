<?php
// allow 10 things per page
if( !isset($_GET['start'] )) { $start = 0; $curr = 0;}else{ $start = $_GET['start']; $curr = $_GET['start']; }
$limit = __CFG_UserListLimit;
$next = $curr + $limit;
$prev = $curr - $limit;
//get count for number of pages

//decide which table to count
include'inc/php/paging_sqls.php';
$result = mysql_query( $sql ) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());

//run count query
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$count = $row["count(*)"];
$fullCount = $count;
//echo "count $count <br>";
$pages = array();
$pagenumber = 0;
$continue = 1;
$pageamount = $limit;
if( $count > $pageamount ){
	while ( $continue ){
		$page = array();
		$page["start"] = $pagenumber * $pageamount;
		++$pagenumber;
		$page["pagenumber"] = $pagenumber;
		$pages[] = $page;
		if( $count - $pageamount <= 0 ){
			$continue = 0;
	
		} else{
			$count = $count - $pageamount;
		}
	}

}
$tpl->assign('next',$next);
$tpl->assign('prev',$prev);
$tpl->assign('curr',$curr);
$tpl->assign('pages',$pages);
$tpl->assign('fullCount',$fullCount);
/*
sectopn loop
<%if $pages %>Page:  <%/if%>
<%section name=pageLoop loop=$pages%>
<a href="admin.php?mode=users&start=<%$pages[pageLoop].start%>">
<%$pages[pageLoop].pagenumber%></a>
<%/section%>
<%if $pages %><a href="#">&#8250;</a><a href="#">&#8249;</a>  <%/if%>

section loop with serch, back & forward, and full count
<p><%$fullCount%> users in database<%if $search %> match your search criteria<%/if%>.</p> 
<div id="pager"><%if $pages %>Page:  <a href="admin.php?mode=users&start=<%$prev%><%if $search %>&action=search<%/if%><%if $email %>&email=<%$email%><%/if%><%if $username %>&username=<%$username%><%/if%><%if $status %>&status=<%$status%><%/if%><%if $emailList %>&emailList=<%$emailList%><%/if%>">&#8249;</a><%/if%><%section name=pageLoop loop=$pages%>
<%if $pages[pageLoop].start eq "$curr"%><span class="currPage"><%/if%><a href="admin.php?mode=users&start=<%$pages[pageLoop].start%>">
<%$pages[pageLoop].pagenumber%></a><%if $curr eq $pages[pageLoop].start%></span><%/if%>
<%/section%> <%if $pages %><a href="admin.php?mode=users&start=<%$next%><%if $search %>&action=search<%/if%><%if $email %>&email=<%$email%><%/if%><%if $username %>&username=<%$username%><%/if%><%if $status %>&status=<%$status%><%/if%><%if $emailList %>&emailList=<%$emailList%><%/if%>">&#8250;</a><%/if%>
</div>
<p><%$emailCount%> users are on the email list.</p>
*/
?>
