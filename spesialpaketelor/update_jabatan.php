<?php 
include 'config.php';
$id_jabatan=$_POST['id_jabatan'];
$nama_jabatan=strtoupper($_POST['nama_jabatan']);
$butuh_modis=$_POST['butuh_modis'];

$sql = sqlsrv_query($kon, "update jabatan set nama_jabatan='$nama_jabatan', butuh_modis='$butuh_modis' where id_jabatan='$id_jabatan'");
if($sql)
{
	echo"<script>alert('EDIT DATA SUKSES. TERIMAKASIH');history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>