<?php
/* start format variables */
//don't knnow where these are coming from but the rte function can't handle them
$bodyContent = str_replace("\n","",$_POST['bodyContent']);
$bodyContent = str_replace("\r","",$bodyContent);

//take out the ' from the body text - MAKE SURE TO ONLY USE SINGLE QUOTE TO CONTAIN CONTENT
$bodyContent = str_replace("'","&#39;",$body);
/* end format variables */

/* start assign variables */
//$body already assigned above
$title = $_POST['title'];
$imageID = $_POST['imageID'];
$editID = $_POST['editID'];
$display = $_POST['display'];
/* end assign variables */

/* start error check */
//standard errors

//image test
if($_FILES['image'][name]) $error .= imageCheck('image');
//make sure the entry is still in the database (gaurd againnst BACK button abuse)
if($_POST['update']){
	$sqlDouble = "select * from albums where id = '$editID'";
	$queryDouble = mysql_query($sqlDouble);
	$numDouble = mysql_num_rows($queryDouble);
	if($numDouble == 0){
		$error .= "That album no longer exists.  You must have deleted it.\n";
	}
}
/* end error check */

if(!$error){
	/* start handle image */
	if($_FILES['image'][name]){
		//if we are updteing, check for the new image and erase the old one if it is there
		if($_POST['update'] && $_POST['imageID'] ){
			//delete image frrom the db and remove it from the server
			$image = get_value('name','images','id',$imageID);
			$imagePath = "userimages/".$image;
			unlink($imagePath);
			//clear image from db
			$sql = "delete from images where id = '$imageID'";
			$query = mysql_query($sql);
		}
		
		//put new image in db and folder
		$dest = __CFG_Image_Path;
		$imageID = imageUpload('image',$dest,NULL,NULL,NULL,NULL,NULL);
		$imgName = $imageID . "-" . $_FILES['image'][name];
		
		$imageInsertSQL = ", img1 = '$imageID'";
	
	//remove the image if it is checked
	}elseif($_POST['removeImage'] == "true"){
		$image = get_value('name','images','id',$imageID);
		$imagePath = "userimages/".$image;
		unlink($imagePath);
		//clear image from db
		$sql = "delete from photos where id = '$imageID'";
		$query = mysql_query($sql);
		
		//clear imageID from items
		$imageInsertSQL = ", img1 = NULL";
	}
	/* end handle image */
	
	
	//creat the SQL depending on if we are in edit or add mode
	if($_POST['add']){
		$sql = "insert into photos (title, description, img1, display, dateTime) values ('$title', '$bodyContent', '$imageID', '$display',NOW())";
			
	}elseif($_POST['update']){
		$sql = "update items set title = '$title', body = '$body', price = '$price'$imageInsertSQL where id = '$editID'";
	}
	
	//do query
	$query = mysql_query($sql)or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
	
	
	if(!$_POST['editID']){
		$editID = mysql_insert_id();
	}
	
	//on sucsessfull insert set up preview with database values
	include "scripts/store/get_item.php";
	
	$tpl->assign('edit','true');
	$tpl->assign('editID',$editID);
}else{
	//on error set up preview pane with last field values
	$tpl->assign('title',stripslashes($title));
	$tpl->assign('body',stripslashes($body));
	$tpl->assign('price',$price);
	
	$tpl->assign('editID',$editID);
	$tpl->assign('imageID',$imageID);
	$tpl->assign('imgName',$imgName);
	$tpl->assign('display',$display);
	
	$tpl->assign('msg',$error);
}






?>