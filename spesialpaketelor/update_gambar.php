<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$lokasi_file = $_FILES['gambar']['tmp_name'];
$tipe_file = $_FILES['gambar']['type'];
$nama_file = $_FILES['gambar']['name'];
$direktori = "../spesialpaketelor/gambar_aset_it/$nama_file";
$no_aset=$_POST['no_aset'];

			move_uploaded_file($lokasi_file,$direktori);
			$sql = sqlsrv_query($kon, "update perangkat_it set foto = '".$nama_file."' where no_aset='".$no_aset."' ");

			if($sql)
			{
				echo"<script>alert('UPLOAD GAMBAR SUKSES. TERIMAKASIH');history.go(-1)</script>";
			}
			else{
				echo"<script>alert('GAGAL UPLOAD GAMBAR !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
			}



?>
