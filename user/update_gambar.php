<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$lokasi_file = $_FILES['gambar']['tmp_name'];
$tipe_file = $_FILES['gambar']['type'];
$nama_file = $_FILES['gambar']['name'];
$direktori = "../spesialpaketelor/gambar_aset_it/$nama_file";
$no_aset=$_POST['no_aset'];


			move_uploaded_file($lokasi_file,$direktori);
			//identitas file asli
			$im_src = imagecreatefromjpeg($direktori);
			$src_width = imageSX($im_src);
			$src_height = imageSY($im_src);
			//Simpan dalam versi small 110 pixel
			//set ukuran gambar hasil perubahan
			$dst_width = 150;
			$dst_height = ($dst_width/$src_width)*$src_height;

			//proses perubahan ukuran
			$im = imagecreatetruecolor($dst_width,$dst_height);
			imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

			//Simpan gambar
			imagejpeg($im,$direktori);
			imagedestroy($im_src);
            imagedestroy($im);

						if($tipe_file=="image/jpeg" || $tipe_file=="image/jpg" || $tipe_file=="image/gif" || $tipe_file=="image/x-png")
					  {
													
						$sql = sqlsrv_query($kon, "update perangkat_it set foto = '".$nama_file."' where no_aset='".$no_aset."' ");

						if($sql)
						{
							echo"<script>alert('UPLOAD GAMBAR SUKSES. TERIMAKASIH');history.go(-1)</script>";
						}
						else{
							echo"<script>alert('GAGAL UPLOAD GAMBAR !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
						}
					} else {
				  		        echo "<script>alert('GAGAL UPLOAD GAMBAR !!!. Gambar Harus berformat .jpg, .jpeg, .gif atau  .png');history.go(-1)</script>";
				  		  }



?>
