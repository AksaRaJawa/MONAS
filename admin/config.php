<?php
$db_server = "10.50.1.78";
$db_user = "adminmodis";
$db_pass = "Zaq!2wsxcvbnm";

//$db_server = "JKTJAMUL";
//$db_user = "sa";
//$db_pass = "0010";

$db_name = "dbmodis";

$connectioninfo = array("Database"=>$db_name,
"UID"=>$db_user,
"PWD"=>$db_pass);

$kon = sqlsrv_connect($db_server,$connectioninfo);

$param = array();
$option = array("Scrollable"=>'static');
?>
