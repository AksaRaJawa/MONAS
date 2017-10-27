<?php
include 'config.php';
$id_cc				 = $_POST['id_cc'];
$pr					   = $_POST['person_responsible'];
$desc_cc		   = strtoupper($_POST['desc_cc']);
$nama_depo     = strtoupper($_POST['nama_depo']);
$nama_ro       = strtoupper($_POST['nama_ro']);
$kepala_akun   = $_POST['kepala_akun'];

$sql = sqlsrv_query($kon, "update cost_center set person_responsible='".$pr."', desc_cc = '".$desc_cc."', nama_depo = '".$nama_depo."', nama_ro= '".$nama_ro."', kepala_akun = '".$kepala_akun."' where id_cc= '".$id_cc."'");
if($sql)
{
	echo"<script>alert('EDIT DATA SUKSES. TERIMAKASIH');history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>
