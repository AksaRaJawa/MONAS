<?php
include 'config.php';
$nama_jenis_kendaraan	 = $_POST['nama_jenis_kendaraan'];
$status = "1";
$sql = sqlsrv_query($kon, "insert into kendaraan_jeniskendaraan values('$nama_jenis_kendaraan','$status')");
if($sql)
{
	echo"<script>history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT DATA !!');history.go(-1)</script>";
}


 ?>
