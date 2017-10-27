<?php
include 'config.php';
$pc				     					 = $_POST['pc'];
$nama_depo     					 = strtoupper($_POST['nama_depo']);
$nama_ro      					 = strtoupper($_POST['nama_ro']);
$market_tipe	 					 = strtoupper($_POST['market_tipe']);
$plant_description		   = $_POST['plant_description'];
$plant 									 = substr($pc,2);
$pc_induk     					 = strtoupper($_POST['pc_induk']);
$status = "1";
$sql = sqlsrv_query($kon, "insert into profit_center values('$pc','$nama_depo', '$nama_ro','$market_tipe','$plant_description','$plant','$pc_induk','$status')");
if($sql)
{
	echo"<script>alert('INPUT DATA SUKSES. TERIMAKASIH');history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT DATA !!');history.go(-1)</script>";
}


 ?>
