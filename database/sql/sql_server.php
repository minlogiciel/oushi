<?php
$server_name = $_SERVER['SERVER_NAME'];
$SQL_BASE	= "oushi";
if (strstr($server_name, "culture-oushi")) {
	$SQL_BASE	= "db501123401";
	$SQL_SERVER = "db501123401.db.1and1.com";
	$SQL_USER	= "dbo501123401";
	$SQL_PASSWD	= "oushi110";
}
else {
	$SQL_SERVER = "127.0.0.1";
	$SQL_USER	= "root";
	$SQL_PASSWD	= "";
}

?>