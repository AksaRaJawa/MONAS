<?php 
include 'config.php';
$nik_karyawan = $_POST['nik_karyawan'];
$nama_karyawan= addslashes($_POST['nama_karyawan']);
$nama_jabatan = $_POST['nama_jabatan'];
$id_depo = $_POST['id_depo'];
$depo = explode("---",$id_depo);
$status = "1";
$sql = sqlsrv_query($kon, "insert into karyawan values('$nik_karyawan','$nama_karyawan','$nama_jabatan', '".$depo[0]."', '".$depo[1]."','$status')");
if($sql)
{
	echo"<script>alert('INPUT DATA SUKSES. TERIMAKASIH');history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT DATA !!');history.go(-1)</script>";
}


 ?>