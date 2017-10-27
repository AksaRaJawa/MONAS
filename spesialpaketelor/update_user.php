<?php
include 'config.php';
$uname=$_POST['uname'];
$pass = base64_encode($_POST['pass']);
$nama_lengkap=$_POST['nama_lengkap'];
$akses = $_POST['akses'];

if($akses=='HO')
{
	$sql = sqlsrv_query($kon, "update [user] set pass  = '".$pass."', nama_lengkap = '".$nama_lengkap."', id_depo = '0001', nama_depo = 'HEAD OFFICE', nama_region = 'HEAD OFFICE', akses = 'HO' where uname='".$uname."'");
}
else if($akses=='GA')
{
	$sql = sqlsrv_query($kon, "update [user] set pass  = '".$pass."', nama_lengkap = '".$nama_lengkap."', id_depo = '0001', nama_depo = 'HEAD OFFICE', nama_region = 'HEAD OFFICE', akses = 'GA' where uname='".$uname."'");
}
else{
	$depo=$_POST['nama_depo'];
    $nama_depo = explode("---", $depo);
   $sql = sqlsrv_query($kon, "update [user] set pass  = '".$pass."', nama_lengkap = '".$nama_lengkap."', id_depo = '".$nama_depo[0]."', nama_depo = '".$nama_depo[1]."', nama_region = '".$nama_depo[2]."', akses = '".$akses."' where uname='".$uname."'");
}
   if($sql)
{
	echo"<script>alert('EDIT DATA SUKSES. TERIMAKASIH');history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>
