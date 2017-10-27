<?php 
include 'config.php';
$nama_jabatan=strtoupper($_POST['nama_jabatan']);
$butuh_modis=$_POST['butuh_modis'];
$tipe_aktif="1";
$status = "1";

$sql = sqlsrv_query($kon, "insert into jabatan values('$nama_jabatan','$butuh_modis','$tipe_aktif','$status')");
if($sql)
{
	echo"<script>alert('INPUT DATA SUKSES. TERIMAKASIH');history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT !!');history.go(-1)</script>";
}

 ?>