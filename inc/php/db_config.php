<?php
if($_SERVER['SERVER_NAME'] == "thesignregistry.com" || $_SERVER['SERVER_NAME'] == "www.thesignregistry.com"){
	//host
	define('__CFG_HOSTNAME','localhost');

	//MySQL DataBase Name
	define('__CFG_DATABASE','thesignr_main');

	//MySQL User Name
	define('__CFG_USERNAME','thesignr_dbuser');

	//MySQL Password
	define('__CFG_PASSWORD','reg_user');

}else{
	//host
	define('__CFG_HOSTNAME','localhost');

	//MySQL DataBase Name
	define('__CFG_DATABASE','thesignr_main');

	//MySQL User Name
	define('__CFG_USERNAME','root');

	//MySQL Password
	define('__CFG_PASSWORD','mysqlroot');
}
//database connect
function db_connect(){ 	
	$mysql_access = @mysql_pconnect(__CFG_HOSTNAME, __CFG_USERNAME, __CFG_PASSWORD); 
	mysql_select_db(__CFG_DATABASE, $mysql_access);
	return $mysql_access;
}
?>