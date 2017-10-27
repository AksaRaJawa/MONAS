<?php
include 'config.php';
$nik_karyawan=$_GET['id'];
$det=sqlsrv_query($kon, "select * from karyawan_perangkat_it where nik_karyawan='$nik_karyawan'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update karyawan_perangkat_it set status='0' where nik_karyawan = '$nik_karyawan'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update karyawan_perangkat_it set status='1' where nik_karyawan = '$nik_karyawan'");
	}
header("location:karyawan_perangkat_it.php");
?>
