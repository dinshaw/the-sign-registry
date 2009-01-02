<?php
if (isset($_REQUEST['mode'])){

	if ($_REQUEST['mode'] == 'forgot'){

		if (!isset($_POST['email'])){

			if (isset($_POST['action'])){
				$tpl->assign('errors','Please enter your email address.');
			}

			$tpl->display('admin/login/forgot.tpl');

		}else{

			$email = $_POST['email'];
			$sql = "select * from adminlogin where email = '$email'";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			$rows = mysql_fetch_array($result);
			$username = $rows['username'];
			$email = $rows['email'];
			$id = $rows['id'];

			if ($num < 1){
				$tpl->assign('errors','That email does not exsist in the admin database.');
				$tpl->display('admin/login/forgot.tpl');

			}else{
				//create new password and update
				$password = random_string(6,13);
				$sql ="update adminlogin set passwd = password('$password') where id = '$id'";
				$query = mysql_query($sql);

				$html = 'Hello,<br>
					Your admin username is: <b>'.$username.'</b>.<br />
					Your admin new password is: <b>'.$password.'</b><br />
					<a href="'.__CFG_SiteUrl.'/admin.php">Click here to return to the Admin login area</a>.<br>
					Thanks,<br>
					-'.__CFG_EmailSig;
				$encodedChars =array('&nbsp;','&prime;','<br>','<br />');
				$decodeChars = array(" ","'","\n","\n");
				$text = strip_tags(str_replace($encodedChars,$decodeChars,$html));

				error_log($password);
				
				//mail($_POST['email'],'Your new admin password',$adminEmail,$adminHeaders);
				mail_multi_alt(__CFG_AdminEmail,__CFG_MPEmailBoundary,'TheSignRegistry.com',$text,$html,$id);

				//echo $adminEmail;
				$tpl->assign('email',$email);
				$tpl->display('admin/login/forgot_thankyou.tpl');
			}
		}
	}elseif ($_REQUEST['mode'] == 'login'){

		if (!$_POST['username'] || !$_POST['password']){
			$tpl->assign('errors','Please enter your login details.');
			$tpl->display('admin/login/login.tpl');
			exit;

		}else{	

			$password = $_POST['password'];
			$username = $_POST['username'];

			$sql = "select * from adminlogin where username = '$username' and passwd = password('$password')";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			$row = mysql_fetch_array($result);
			$id = $row['id'];

			if ($num < 1){
				$tpl->assign('errors','Login failed.');
				$tpl->display('admin/login/login.tpl');
				exit;

			}else{
				$_SESSION['admin_name'] = $username;
				$tpl->assign('sid',md5(session_id()));
				$tpl->display('admin/login/success.tpl');
			}	
		}
	}else{
		$tpl->display('admin/login/login.tpl');
	}

}else{
	$tpl->display('admin/login/login.tpl');
}	

?>
