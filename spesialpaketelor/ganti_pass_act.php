<?php 
include 'config.php';
$user=$_POST['user'];
$lama=base64_encode($_POST['lama']);
$baru=$_POST['baru'];
$ulang=$_POST['ulang'];

$cek=sqlsrv_query($kon, "select * from admin where pass='$lama' and uname='$user'", $param, $option);
if(sqlsrv_num_rows($cek)==1){
	if($baru==$ulang){
		$b = base64_encode($baru);
		sqlsrv_query("update admin set pass='$b' where uname='$user'");
		header("location:ganti_pass.php?pesan=oke");
	}else{
		header("location:ganti_pass.php?pesan=tdksama");
	}
}else{
	header("location:ganti_pass.php?pesan=gagal");
}

 ?>