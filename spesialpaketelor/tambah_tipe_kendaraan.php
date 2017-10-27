<?php
include 'config.php';
$nama_tipe_kendaraan	 = $_POST['nama_tipe_kendaraan'];
$detail_tipe_kendaraan	 = $_POST['detail_tipe_kendaraan'];
$status = "1";
$sql = sqlsrv_query($kon, "insert into kendaraan_tipekendaraan values('$nama_tipe_kendaraan','$detail_tipe_kendaraan','$status')");
if($sql)
{
	echo"<script>history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT DATA !!');history.go(-1)</script>";
}


 ?>
