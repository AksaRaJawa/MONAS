<?php 
include 'config.php';
$nama_merk= strtoupper($_POST['nama_merk']);
$nama_tipe = strtoupper($_POST['nama_tipe']);
$status = "1";
$sql = sqlsrv_query($kon, "insert into merk values('$nama_merk','$nama_tipe','$status')");
if($sql)
{
	echo"<script>alert('INPUT DATA SUKSES. TERIMAKASIH');history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT !!');history.go(-1)</script>";
}

 ?>