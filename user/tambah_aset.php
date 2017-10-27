<?php 
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$uname = $_POST['uname'];
$uu_depo = $_POST['uu_depo'];
$uu_region = $_POST['uu_region'];

$nik_karyawan=$_POST['nik_karyawan'];
$nama_karyawan = ucwords($_POST['nama_karyawan']);
$nama_jabatan=$_POST['nama_jabatan'];
$status_karyawan=$_POST['status_karyawan'];
$nama_kepemilikan=$_POST['nama_kepemilikan'];
$no_imei=$_POST['no_imei'];
$nama_merk=$_POST['nama_merk'];
$merk = explode("---", $nama_merk);
$no_asset=$_POST['no_asset'];
$serial_number=$_POST['serial_number'];
$id_device=$_POST['id_device'];
$status_modis=$_POST['status_modis'];
$status_device = $_POST['status_device'];
$tanggal_terima=$_POST['tanggal_terima'];
$id_depo=$_POST['id_depo'];
$nama_region = $_POST['nama_region'];
$keterangan=ucwords($_POST['keterangan']);
$status = '1';
$status_validasi = '1';
$tanggal_beli = '';
$masa_berlaku = '';
$provider = '';
$nohp = '';
$tggl_aktif = '';
//,'".$provider."','".$nohp."','".$tggl_aktif."'
$aktifitas = "Masukan Data Asset Modis";
$tanggal = date("d/m/Y"); 
$waktu = date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$tanggal_perubahan = date("d-M-Y");	                  
						
						
$cek = "select * from asset where no_imei = '".$no_imei."' ";
	   $proses_cek = sqlsrv_query($kon, $cek);
	   $data_cek = sqlsrv_fetch_array($proses_cek);
/*$cek2 = "select * from asset where nik_karyawan = '".$nik_karyawan."'";
	   $proses_cek2 = sqlsrv_query($kon, $cek2);
	   $data_cek2 = sqlsrv_fetch_array($proses_cek2);*/		   
						
if(sqlsrv_num_rows($proses_cek)>0)
{
	echo"<script>alert('Maaf !!!, Aset untuk IMEI = ".$no_imei." sudah terdaftar. Terimakasih ');history.go(-1)</script>";
}
	else
	{
$sql= sqlsrv_query($kon, "insert into asset values('".$no_imei."','".$merk[0]."','".$merk[1]."','".$no_asset."','".$tanggal_beli."',
'".$serial_number."','".$nik_karyawan."','".$tanggal_terima."','".$nama_kepemilikan."','".$status_modis."',
'".$status_device."','".$id_device."','".$masa_berlaku."','".$id_depo."','".$nama_region."','".$keterangan."','".$status."','".$uname."','".$status_validasi."','".$provider."','".$nohp."','".$tggl_aktif."')");
if($nik_karyawan != '')
{
sqlsrv_query($kon, "insert into karyawan values ('".$nik_karyawan."','".$nama_karyawan."','".$nama_jabatan."','".$id_depo."','".$nama_region."','".$status."')");
}
sqlsrv_query($kon, "insert into histori values ('".$tanggal_perubahan."','".$aktifitas."','".$no_imei."','".$merk[0]."','".$merk[1]."','".$no_asset."','".$serial_number."','".$nik_karyawan."','".$tanggal_terima."','".$nama_kepemilikan."','".$status_modis."','".$status_device."','".$uname."','".$uu_depo."','".$uu_region."','".$waktu."')");

if($sql)
{
	echo"<script>alert('INPUT DATA SUKSES. TERIMAKASIH');history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT !!');history.go(-1)</script>";
}
}


 ?>