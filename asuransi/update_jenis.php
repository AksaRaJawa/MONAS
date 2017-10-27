<?php
include 'config.php';
$id_jenis_biaya=$_POST['id_jenis_biaya'];
$nama_jenis_biaya= $_POST['nama_jenis_biaya'];


$sql = sqlsrv_query($kon, "update asuransi_jenis set nama_jenis_biaya='$nama_jenis_biaya' where id_jenis_biaya='$id_jenis_biaya'");
if($sql)
{
	echo"<script>history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>
