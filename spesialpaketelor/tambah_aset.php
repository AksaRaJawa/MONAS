<?php 
include 'config.php';
$uname = $_POST['uname'];
$no_imei=$_POST['no_imei'];
$nama_merk = $_POST['nama_merk'];
$merk = explode("---", $nama_merk);
$no_asset = $_POST['no_asset'];
$tanggal_beli=$_POST['tanggal_beli'];
$serial_number=$_POST['serial_number'];
$nik_karyawan=$_POST['nik_karyawan'];
$tanggal_terima='';
$nama_kepemilikan=$_POST['nama_kepemilikan'];
$status_modis=$_POST['status_modis'];
$status_device = $_POST['status_device'];
$id_device=$_POST['id_device'];
$masa_berlaku=$_POST['masa_berlaku'];
$id_depo=$_POST['id_depo'];
$depo = explode("---", $id_depo);
$keterangan=ucwords($_POST['keterangan']);
$provider = $_POST['provider'];
$nohp = $_POST['nohp'];
$tgglaktif = $_POST['tgglaktif'];
$status = '1';

       $cek = "select * from asset where no_imei = '".$no_imei."' AND no_imei != ' ' ";
	   $proses_cek = sqlsrv_query($kon, $cek, $param, $option);
	   $data_cek = sqlsrv_fetch_array($proses_cek);
		if(sqlsrv_num_rows($proses_cek)>0)
		{
			echo"<script>alert('DATA ADA YANG SAMA !!!! Asset dengan No.IMEI = ".$data_cek['no_imei']." ');history.go(-1)</script>";
		}
		else 
		{	
			$sql = sqlsrv_query($kon, "insert into asset values('".$no_imei."','".$merk[0]."','".$merk[1]."','".$no_asset."',
			'".$tanggal_beli."','".$serial_number."','".$nik_karyawan."','".$tanggal_terima."','".$nama_kepemilikan."','".$status_modis."',
			'".$status_device."','".$id_device."','".$masa_berlaku."','".$depo[0]."','".$depo[1]."','".$keterangan."','".$status."','".$uname."','".$status."','".$provider."','".$nohp."','".$tgglaktif."')");

			if($sql)
			{
				echo"<script>alert('INPUT DATA SUKSES. TERIMAKASIH');history.go(-1)</script>";
			}
			else{
				echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN !!');history.go(-1)</script>";
			}

		}
 ?>