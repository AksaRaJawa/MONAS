<?php
include 'config.php';
$id_jenis_kendaraan				        = $_POST['id_jenis_kendaraan'];
$nama_jenis_kendaraan				   = $_POST['nama_jenis_kendaraan'];


$sql = sqlsrv_query($kon, "update kendaraan_jeniskendaraan set nama_jenis_kendaraan='".$nama_jenis_kendaraan."' where id_jenis_kendaraan= '".$id_jenis_kendaraan."'");
if($sql)
{
	echo"<script>history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>
