<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$thn_sekarang = date("y");
$uname = $_POST['uname'];
$lokasi_file = $_FILES['gambar']['tmp_name'];
$tipe_file = $_FILES['gambar']['type'];
$nama_file = $_FILES['gambar']['name'];
$direktori = "gambar_aset_it/$nama_file";
$no_aset=$_POST['no_aset'];
$aset_desc = $_POST['aset_desc'];
$aset_group = $_POST['aset_group'];
$nama_merk = strtoupper($_POST['nama_merk']);
$cost_center = $_POST['cost_center'];
$nik_karyawan=$_POST['nik_karyawan'];
$profit_center = substr($cost_center,0,6);
$sqldepo = sqlsrv_query($kon,"select nama_depo, nama_ro from cost_center where id_cc = '".$cost_center."' ");
$depo = sqlsrv_fetch_array($sqldepo);
$nama_depo = $depo['nama_depo'];
$nama_region = $depo['nama_ro'];
$cap_date=$_POST['cap_date'];
$cap = substr($cap_date,7);
$thn_pemakaian = $thn_sekarang-$cap;
$acquis_val=$_POST['acquis_val'];
$status_perangkat =$_POST['status_perangkat'];
$status_jual =$_POST['status'];
$harga_jual=$_POST['harga_jual'];
$foto="";
$barcode="";
$status = '1';
$status_validasi = '0';

     $cek = "select * from perangkat_it where no_aset = '".$no_aset."' ";
	   $proses_cek = sqlsrv_query($kon, $cek, $param, $option);
	   $data_cek = sqlsrv_fetch_array($proses_cek);
		if(sqlsrv_num_rows($proses_cek)>0)
		{
			echo"<script>alert('DATA ADA YANG SAMA !!!! Perangkat IT dengan No.Aset = ".$data_cek['no_aset']." ');history.go(-1)</script>";
		}
		else
		{
      move_uploaded_file($lokasi_file,$direktori);
			$sql = sqlsrv_query($kon, "insert into perangkat_it values('".$no_aset."',' ','".$aset_group."','".$aset_desc."','".$nama_merk."','".$cost_center."',
			'".$nik_karyawan."','".$profit_center."','".$nama_depo."','".$nama_region."','".$cap_date."','".$acquis_val."',
			'".$thn_pemakaian."','".$status_perangkat."','".$status_jual."','".$harga_jual."','".$nama_file."','".$barcode."','".$status."','".$uname."','".$status_validasi."',' ',' ')");

			if($sql)
			{
				echo"<script>alert('INPUT DATA SUKSES. TERIMAKASIH');history.go(-1)</script>";
			}
			else{
				echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN !!');history.go(-1)</script>";
			}

		}
 ?>
