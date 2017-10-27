<?php 
include 'config.php';
$id_kepemilikan=$_POST['id_kepemilikan'];
$nama_kepemilikan=strtoupper($_POST['nama_kepemilikan']);

$sql = sqlsrv_query($kon, "update kepemilikan set nama_kepemilikan='$nama_kepemilikan' where id_kepemilikan='$id_kepemilikan'");
if($sql)
{
	echo"<script>alert('EDIT DATA SUKSES. TERIMAKASIH');history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>