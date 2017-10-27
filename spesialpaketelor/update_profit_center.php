<?php
include 'config.php';
$pc				     					 = $_POST['pc'];
$nama_depo     					 = strtoupper($_POST['nama_depo']);
$nama_ro      					 = strtoupper($_POST['nama_ro']);
$market_tipe	 					 = strtoupper($_POST['market_tipe']);
$plant_description		   = $_POST['plant_description'];
$pc_induk     					 = strtoupper($_POST['pc_induk']);

$sql = sqlsrv_query($kon, "update profit_center set market_tipe='".$market_tipe."', plant_description = '".$plant_description."', nama_depo = '".$nama_depo."', nama_ro= '".$nama_ro."', pc_induk = '".$pc_induk."' where pc= '".$pc."'");
if($sql)
{
	echo"<script>alert('EDIT DATA SUKSES. TERIMAKASIH');history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>
