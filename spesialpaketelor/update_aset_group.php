<?php
include 'config.php';
$id_group=$_POST['id_group'];
$nama_group= strtoupper($_POST['nama_group']);

$sql = sqlsrv_query($kon, "update aset_group set nama_group='$nama_group' where id_group='$id_group'");
if($sql)
{
	echo"<script>alert('EDIT DATA SUKSES. TERIMAKASIH');history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>
