<?php
include 'config.php';
$no_rangka=$_GET['id'];
$det=sqlsrv_query($kon, "select * from asuransi_kendaraan where no_rangka='$no_rangka'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update asuransi_kendaraan set status='0' where no_rangka = '$no_rangka'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update asuransi_kendaraan set status='1' where no_rangka = '$no_rangka'");
	}
header("location:asuransi.php");
?>
