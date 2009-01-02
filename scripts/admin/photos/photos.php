<?php
if($_REQUEST['mode'] == "albums"){

	if($_POST['action'] == "add"){
		include 'scripts/admin/photos/add_update_albums.php';
	}else{
		include 'scripts/get_albums.php';
	}
	
	$tpl->display('admin/photos/albums.tpl');

}elseif($_POST['mode'] == "photos"){
	
	if($_POST['action'] == "add"){
		include 'scripts/admin/photos/add_update.php';
	}else{
		include 'scripts/get_photos.php';
	}
}
?>