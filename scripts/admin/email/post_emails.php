<?php
$emailID = $_SESSION['emailID'];

//remove quotes from text field elemennts
$subject = str_replace('"','&quot;',$_POST['subject']);

//donn't knnow where these are coming from but the rte function can't handle them
$bodyContent = str_replace("\n","",$_POST['bodyContent']);
$bodyContent = str_replace("\r","",$bodyContent);

//take out the ' from the body text - MAKE SURE TO ONLY USE SINGLE QUOTE TO CONTAIN CONTENT
$bodyContent = str_replace("'","&prime;",$bodyContent);
	
if($_POST['preview']){

	if(!$_POST['subject'] || !$_POST['bodyContent']){
		
		$tpl->assign('error', "Please enter a Subject and a Body.");
		$tpl->assign('subject', $subject);
		$tpl->assign('bodyContent', $bodyContent);
		
		$tpl->display('admin/email/post_email.tpl');
	}else{
	
		if(!$_SESSION['emailID']){
			$sql = "insert into emails (subject, body, dateTime) values ('$subject', '$bodyContent', NOW())";
			$query = mysql_query($sql);
			$_SESSION['emailID'] = mysql_insert_id();
			$emailID = mysql_insert_id();
		}else{
			$emailID = $_SESSION['emailID'];
			$sql = "update emails set subject = '$subject', body = '$bodyContent' where id = '$emailID'";
			$query = mysql_query($sql);
		}
		
		$sql = "select * from emails where id = '$emailID'";
		$query = mysql_query($sql);
		$rows = mysql_fetch_array($query);
		$subject = $rows['subject'];
		$bodyContent = $rows['body'];
		$dateTime = $rows['dateime'];
		
		//returns $postFilter to decide who to post emails to
		include 'scripts/admin/email/post_filter.php';
		
		$tpl->assign('postFilter', $postFilter);
		$tpl->assign('subject', $subject);
		$tpl->assign('bodyContent', $bodyContent);
		
		$tpl->display('admin/email/preview_email.tpl');
	}
	
}elseif($_POST['edit']){
	$sql = "select * from emails where id = '$emailID'";
	$query = mysql_query($sql);
	$rows = mysql_fetch_array($query);
	$subject = $rows['subject'];
	$bodyContent = $rows['body'];
	$dateTime = $rows['dateime'];
	
	$tpl->assign('subject', $subject);
	$tpl->assign('bodyContent', $bodyContent);
	$tpl->display('admin/email/post_email.tpl');
	
}elseif($_POST['post']){
	$emailID = $_SESSION['emailID'];
	
	$sql = "select * from emails where id = '$emailID'";
	$query = mysql_query($sql);
	$rows = mysql_fetch_array($query);
	$num_rows = mysql_num_rows($query);
	
	$encodedChars =array('&nbsp;','&prime;','<br>','<br />');
	$decodeChars = array(" ","'","\n","\n");
	if ($num_rows == 1){
		$subject = $rows['subject'];
		$html = $rows['body'];
		$text = strip_tags(str_replace($encodedChars,$decodeChars,$html));
		$dateTime = $rows['dateime'];
		
		if($_POST['postFilter']) $postFilter = stripslashes($_POST['postFilter']);
		
		$sql = "SELECT email, id FROM users $postFilter";
		$result = mysql_query($sql);
		
		//recheck session for admin user_auth
		if($_SESSION['rrws_admin_user'] && $_SESSION['emailID']){
			
			$i=0;
			while($rows = mysql_fetch_array($result)){
				$email = $rows['email'];
				$id = $rows['id'];
				++$i;

				mail_multi_alt($email,__CFG_MPEmailBoundary,$subject,$text,$html,$id);
			}

		}else{
			$tpl->assign('msg','Authentication failed!');
			$tpl->display('admin/email/post_email.tpl');
			exit;
		}
		
		unset($_SESSION['emailID']);
		$tpl->assign('count',$i);
		$tpl->display('admin/email/confirm_post.tpl');	
	}else{
		echo $_SESSION['emailID'];
		$tpl->assign('error', "It seems that a repetative post has been atempted. Please start again.");
		$tpl->display('admin/email/post_email.tpl');
	}
}else{
	$tpl->display('admin/email/post_email.tpl');
}
?>