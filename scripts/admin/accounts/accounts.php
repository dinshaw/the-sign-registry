<?php
if(isset($_POST['action'])){
	if($_POST['action'] == "addAccount")
	{
		include "scripts/admin/accounts/add_account.php";
		include "scripts/admin/accounts/get_accounts.php";
		$tpl->display('admin/accounts/accounts.tpl');
	}elseif($_POST['action'] == "delete"){
			$id = $_POST['id'];
			$sql = "delete from adminlogin where id = '$id'";
			$query = mysql_query($sql);
			include "scripts/admin/accounts/get_accounts.php";
			$tpl->display('admin/accounts/accounts.tpl');
			}elseif($_POST['action'] == "changepass"){
				include "scripts/admin/accounts/change_password.php";
			}else{
				include "scripts/admin/accounts/get_accounts.php";
				$tpl->display('admin/accounts/accounts.tpl');
			}
		}else{
			include "scripts/admin/accounts/get_accounts.php";
			$tpl->display('admin/accounts/accounts.tpl');
		}
		?>