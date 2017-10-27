<?php
include 'config.php';
$nama_leasing= $_POST['nama_leasing'];
$nama_note = $_POST['nama_note'];
$nama_bank= $_POST['nama_bank'];
$no_rekening = $_POST['no_rekening'];
$status = "1";
$sql = sqlsrv_query($kon, "insert into asuransi_leasing values('$nama_leasing','$nama_note','$nama_bank','$no_rekening','$status')");
if($sql)
{
	echo"<script>history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT !!');history.go(-1)</script>";
}

 ?>
