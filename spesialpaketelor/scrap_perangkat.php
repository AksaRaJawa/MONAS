<?php
include 'config.php';
$no_aset=$_GET['no_aset'];
$det=sqlsrv_query($kon, "select * from perangkat_it where no_aset='$no_aset'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update perangkat_it set status='0' where no_aset = '$no_aset'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update perangkat_it set status='1' where no_aset = '$no_aset'");
	}
header("location:perangkat_it.php");
?>
