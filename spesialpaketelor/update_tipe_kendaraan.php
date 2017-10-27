<?php
include 'config.php';
$id_tipe_kendaraan				        = $_POST['id_tipe_kendaraan'];
$nama_tipe_kendaraan				   = $_POST['nama_tipe_kendaraan'];
$detail_tipe_kendaraan				   = $_POST['detail_tipe_kendaraan'];

$sql = sqlsrv_query($kon, "update kendaraan_tipekendaraan set nama_tipe_kendaraan='".$nama_tipe_kendaraan."', detail_tipe_kendaraan='".$detail_tipe_kendaraan."'where id_tipe_kendaraan= '".$id_tipe_kendaraan."'");
if($sql)
{
	echo"<script>history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>
