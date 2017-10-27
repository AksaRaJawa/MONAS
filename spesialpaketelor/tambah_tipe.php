<?php 
include 'config.php';
$nama_tipe=$_POST['nama_tipe'];

$sql = sqlsrv_query($kon, "insert into tipe values('','$nama_tipe')");
if($sql)
{
	echo"<script>alert('INPUT DATA SUKSES. TERIMAKASIH');history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT !!');history.go(-1)</script>";
}

 ?>