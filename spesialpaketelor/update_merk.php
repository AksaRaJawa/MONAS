<?php 
include 'config.php';
$id_merk=$_POST['id_merk'];
$nama_merk= strtoupper($_POST['nama_merk']);
$nama_tipe = strtoupper($_POST['nama_tipe']);

$sql = sqlsrv_query($kon, "update merk set nama_merk='$nama_merk', nama_tipe='$nama_tipe' where id_merk='$id_merk'");
if($sql)
{
	echo"<script>alert('EDIT DATA SUKSES. TERIMAKASIH');history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>