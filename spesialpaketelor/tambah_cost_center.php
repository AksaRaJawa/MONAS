<?php
include 'config.php';
$id_cc				 = $_POST['id_cc'];
$pr					   = $_POST['person_responsible'];
$desc_cc		   = strtoupper($_POST['desc_cc']);
$nama_depo     = strtoupper($_POST['nama_depo']);
$nama_ro       = strtoupper($_POST['nama_ro']);
$kepala_akun   = $_POST['kepala_akun'];
$status = "1";
$sql = sqlsrv_query($kon, "insert into cost_center values('$id_cc','$pr','$desc_cc', '$nama_depo', '$nama_ro','$kepala_akun','$status')");
if($sql)
{
	echo"<script>alert('INPUT DATA SUKSES. TERIMAKASIH');history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT DATA !!');history.go(-1)</script>";
}


 ?>
