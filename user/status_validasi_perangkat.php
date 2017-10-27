<?php
include 'config.php';
$no_aset=$_GET['id'];
$uname = $_GET['uname'];
$det=sqlsrv_query($kon, "select * from perangkat_it where no_aset='$no_aset'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status_validasi'];
	$gambar = $d['foto'];
}
if($gambar==''||$gambar==NULL)
{
	echo"<script>alert('MAAF, Silahkan Masukan Gambar Aset Terlebih Dahulu.');history.go(-1)</script>";
}
else{
	if($x=='1')
		{
			sqlsrv_query($kon, "update perangkat_it set status_validasi='0', status_approve = '0', validater = ' ' where no_aset = '$no_aset'");
			echo"<script>history.go(-1)</script>";
		}
		else if($x=='0')
		{
			sqlsrv_query($kon, "update perangkat_it set status_validasi='1', validater = '$uname' where no_aset = '$no_aset'");
			echo"<script>history.go(-1)</script>";
		}
}

//header("location:perangkat_it.php");
?>
