<?php
include 'config.php';
$id_leasing=$_POST['id_leasing'];
$nama_leasing= $_POST['nama_leasing'];
$nama_note = $_POST['nama_note'];
$nama_bank= $_POST['nama_bank'];
$no_rekening = $_POST['no_rekening'];

$sql = sqlsrv_query($kon, "update asuransi_leasing set nama_leasing='$nama_leasing', nama_note='$nama_note', nama_bank='$nama_bank', no_rekening='$no_rekening' where id_leasing='$id_leasing'");
if($sql)
{
	echo"<script>history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>
