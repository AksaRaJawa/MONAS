<?php
include 'config.php';
$pc=$_GET['id'];
$det=sqlsrv_query($kon, "select * from profit_center where pc='$pc'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update profit_center set status='0' where pc = '$pc'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update profit_center set status='1' where pc = '$pc'");
	}
header("location:profit_center.php");
?>
