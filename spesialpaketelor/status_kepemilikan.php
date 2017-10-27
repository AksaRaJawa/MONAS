<?php
include 'config.php';
$id_kepemilikan=$_GET['id'];
$det=sqlsrv_query($kon, "select * from kepemilikan where id_kepemilikan='$id_kepemilikan'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update kepemilikan set status='0' where id_kepemilikan = '$id_kepemilikan'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update kepemilikan set status='1' where id_kepemilikan = '$id_kepemilikan'");
	}
header("location:kepemilikan.php");
?>					
	