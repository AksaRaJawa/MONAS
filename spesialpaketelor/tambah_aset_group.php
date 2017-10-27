<?php
include 'config.php';
$id_group   = strtoupper($_POST['id_group']);
$nama_group = strtoupper($_POST['nama_group']);
$status = "1";
$sql = sqlsrv_query($kon, "insert into aset_group values('$id_group','$nama_group','$status')");
if($sql)
{
	echo"<script>alert('INPUT DATA SUKSES. TERIMAKASIH');history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT !!');history.go(-1)</script>";
}

 ?>
