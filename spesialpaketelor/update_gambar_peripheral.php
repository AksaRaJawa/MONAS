<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$lokasi_file = $_FILES['gambar_lama']['tmp_name'];
$tipe_file = $_FILES['gambar_lama']['type'];
$nama_file = $_FILES['gambar_lama']['name'];
$direktori = "../spesialpaketelor/gambar_aset_peripheral/$nama_file";
$no_aset=$_POST['no_aset_peripheral'];

			move_uploaded_file($lokasi_file,$direktori);
			$sql = sqlsrv_query($kon, "update kendaraan_peripheral set gambar_lama = '".$nama_file."' where no_aset_peripheral='".$no_aset."' ");

			if($sql)
			{
				echo"<script>alert('UPLOAD GAMBAR SUKSES. TERIMAKASIH');history.go(-1)</script>";
			}
			else{
				echo"<script>alert('GAGAL UPLOAD GAMBAR !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
			}



?>
