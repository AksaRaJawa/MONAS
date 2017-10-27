<?php 
include 'config.php';
$nama_kepemilikan=strtoupper($_POST['nama_kepemilikan']);
$status = "1";
$sql = sqlsrv_query($kon, "insert into kepemilikan values('$nama_kepemilikan','$status')");
if($sql)
{
	echo"<script>alert('INPUT DATA SUKSES. TERIMAKASIH');history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT !!');history.go(-1)</script>";
}

 ?>