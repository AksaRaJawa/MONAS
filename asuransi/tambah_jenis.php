<?php
include 'config.php';
$nama_jenis_biaya= $_POST['nama_jenis_biaya'];
$status = "1";
$sql = sqlsrv_query($kon, "insert into asuransi_jenis values('$nama_jenis_biaya','$status')");
if($sql)
{
	echo"<script>history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT !!');history.go(-1)</script>";
}

 ?>
