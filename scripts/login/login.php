<?php
if ($_REQUEST['mode'] == 'login') {

	if (!$_POST['email'] || !$_POST['password']){
		$tpl->assign('loginMsg','Please enter your login details.');
		$tpl->display('login.tpl');
	}else{
		$password = $_POST['password'];
		$email = $_POST['email'];
		
		//check for registrant login
		$sql = "SELECT id, email, sal, last_name, type
				FROM users
				WHERE email = '$email' AND passwd = password('$password')";
				
		$query = mysql_query($sql) or die(mysql_error());
		$num = mysql_num_rows($query);
		$result = mysql_fetch_array($query);
		
		//USER LOGIN SUCCESS
		if ($num == '1'){
		
			extract($result);
			
			$_SESSION['welcome_name'] = $welcome_name = $sal . " " . ucfirst(strtolower($last_name));
			$_SESSION['userID'] = $id;
			$_SESSION['regID'] = $id;
			
			switch($type) {
				case 1:
					$_SESSION['valid_user'] = 'reg';
					break;
				case 2:
					$_SESSION['valid_user'] = 'rec';
					break;
				case 3:
					$_SESSION['valid_user'] = 'reg_rec';
					break;
			}
			
			include 'scripts/users/get_info.php';
			
			$tpl->assign('sid',md5(session_id()));
			$tpl->assign('welcome_name',$_SESSION['welcome_name']);
			$tpl->display('welcome.tpl');

		}else{
			//login has failed
			$tpl->assign('loginMsg','Login failed.');
			$tpl->display('login.tpl');
		}
		
		
	}

	
}elseif ($_REQUEST['mode'] == 'forgot'){
}else{
}
?> 