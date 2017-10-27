<?php
include 'config.php';

$uname=$_POST['uname'];
$pass=base64_encode($_POST['pass']);
$nama_lengkap=$_POST['nama_lengkap'];
$akses = $_POST['akses'];
$status = '1';

if($akses=='HO')
{
	$sql = sqlsrv_query($kon, "insert into [user] values('".$uname."','".$pass."','".$nama_lengkap."','0001','HEAD OFFICE','HEAD OFFICE','HO','".$status."')");
}
else if($akses=='GA')
{
	$sql = sqlsrv_query($kon, "insert into [user] values('".$uname."','".$pass."','".$nama_lengkap."','0001','HEAD OFFICE','HEAD OFFICE','GA','".$status."')");
}
else{
	$depo=$_POST['nama_depo'];
	$nama_depo = explode("---", $depo);
	$sql = sqlsrv_query($kon, "insert into [user] values('".$uname."','".$pass."','".$nama_lengkap."','".$nama_depo[0]."','".$nama_depo[1]."','".$nama_depo[2]."','".$akses."','".$status."')");
}
if($sql)
{
	echo"<script>alert('INPUT DATA SUKSES. TERIMAKASIH');history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT !!');history.go(-1)</script>";
}

 ?>
