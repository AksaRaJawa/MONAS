<?php
session_start();
include 'admin/config.php';
$uname=$_POST['uname'];
$pass=$_POST['pass'];
$pas=base64_encode($pass);
//$cont = sqlsrv_query($kon, "select count(uname) as jumlah from admin where uname='$uname' and pass='$pas'");
$query=sqlsrv_query($kon, "select * from admin where uname='$uname' and pass='$pas'", $param, $option);
$query1=sqlsrv_query($kon, "select * from [user] where uname='$uname' and pass='$pas' and status = '1'", $param, $option);
if(sqlsrv_num_rows($query)==1){
	$_SESSION['uname']=$uname;
	header("location:spesialpaketelor/index.php");
}
else if(sqlsrv_num_rows($query1)==1){
	$_SESSION['uname']=$uname;
	$dd = sqlsrv_fetch_array($query1);
	if($dd['akses'] == 'DEPO')
	{
		header("location:user/index.php");
	}else if($dd['akses']  == 'REGION')
	{
		header("location:region/index.php");
	}
	else if($dd['akses']  == 'HO')
	{
		header("location:pusat(HO)/index.php");
	}
	else if($dd['akses']  == 'GA')
	{
		header("location:asuransi/index.php");
	}
}else{
	header("location:index.php?pesan=gagal")or die(sqlsrv_errors());
	// sqlsrv_error();
}
// echo $pas;
 ?>
