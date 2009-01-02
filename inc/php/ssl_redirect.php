<?php
if($_SERVER['SERVER_NAME'] == "thesignregistry.com" || $_SERVER['SERVER_NAME'] == "www.thesignregistry.com"){
	if(isset($_REQUEST['mode'])){
		if($_SERVER['HTTPS']!="on")
		{
			$redirect= "https://www.thesignregistry.com".$_SERVER['REQUEST_URI'];
			header("Location:$redirect");
		}
	}
}
?>