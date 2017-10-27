<?php
include 'config.php';
$no_aset=$_GET['id'];
$det=sqlsrv_query($kon, "select * from kendaraan_asetkendaraan where no_aset_kendaraan='$no_aset'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update kendaraan_asetkendaraan set status='0' where no_aset_kendaraan = '$no_aset'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update kendaraan_asetkendaraan set status='1' where no_aset_kendaraan = '$no_aset'");
	}
header("location:aset_kendaraan.php");
?>
