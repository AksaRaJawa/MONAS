<?php 
include 'config.php';
$nik_karyawan = $_POST['nik_karyawan'];
$nama_karyawan= addslashes($_POST['nama_karyawan']);
$nama_jabatan = $_POST['nama_jabatan'];
$id_depo = $_POST['id_depo'];
$depo = explode("---",$id_depo);

$sql = sqlsrv_query($kon, "update karyawan set nama_karyawan='".$nama_karyawan."', nama_jabatan = '".$nama_jabatan."', id_depo = '".$depo[0]."', nama_region= '".$depo[1]."' where nik_karyawan= '".$nik_karyawan."'");
if($sql)
{
	echo"<script>alert('EDIT DATA SUKSES. TERIMAKASIH');history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>