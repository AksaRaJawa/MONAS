<?php
include 'config.php';
$no_aset=$_GET['id'];
$uname = $_GET['uname'];
$det=sqlsrv_query($kon, "select * from kendaraan_asetkendaraan where no_aset_kendaraan='$no_aset'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status_validasi'];
	$gambar = $d['gambar_baru'];
}
if($gambar==''||$gambar==NULL)
{
	echo"<script>alert('MAAF, Silahkan Masukan Gambar Aset Terlebih Dahulu.');history.go(-1)</script>";
}
else{
	if($x=='1')
		{
			sqlsrv_query($kon, "update kendaraan_asetkendaraan set status_validasi='0' where no_aset_kendaraan = '$no_aset'");
			echo"<script>history.go(-1)</script>";
		}
		else if($x=='0')
		{
			sqlsrv_query($kon, "update kendaraan_asetkendaraan set status_validasi='1' where no_aset_kendaraan = '$no_aset'");
			echo"<script>history.go(-1)</script>";
		}
}

//header("location:perangkat_it.php");
?>
