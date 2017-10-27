<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$thn_sekarang = date("y");
$uname = $_POST['uname'];
$lokasi_file = $_FILES['gambar_lama']['tmp_name'];
$tipe_file = $_FILES['gambar_lama']['type'];
$nama_file = $_FILES['gambar_lama']['name'];
$direktori = "gambar_aset_peripheral/$nama_file";
$no_aset_peripheral=$_POST['no_aset_peripheral'];
$jenis_peripheral = $_POST['jenis_peripheral'];
$desc_peripheral = $_POST['desc_peripheral'];
$no_aset_peripheral=$_POST['no_aset_peripheral'];
$no_aset_kendaraan=' ';
$cost_center_id = $_POST['cost_center_id'];
$nik_lama = ' ';
$nik_baru=$_POST['nik_baru'];
$profit_center_id = substr($cost_center_id,0,6);
$sqldepo = sqlsrv_query($kon,"select nama_depo, nama_ro from cost_center where id_cc = '".$cost_center_id."' ");
$depo = sqlsrv_fetch_array($sqldepo);
$nama_depo_peripheral = $depo['nama_depo'];
$nama_region_peripheral = $depo['nama_ro'];
$cap_date=$_POST['cap_date'];
$cap = substr($cap_date,7);
$thn_pemakaian = $thn_sekarang-$cap;
$acquis_val=$_POST['acquis_val'];
$status_perangkat=$_POST['status_perangkat'];
$status_jual=$_POST['status_jual'];
$harga_jual=$_POST['harga_jual'];
$gambar_baru = '';
$status = '1';
$status_validasi = '0';
$barcode = '';

     $cek = "select * from kendaraan_peripheral where no_aset_peripheral = '".$no_aset_peripheral."' ";
	   $proses_cek = sqlsrv_query($kon, $cek, $param, $option);
	   $data_cek = sqlsrv_fetch_array($proses_cek);
		if(sqlsrv_num_rows($proses_cek)>0)
		{
			echo"<script>alert('DATA ADA YANG SAMA !!!! Peripheral dengan No. Aset = ".$data_cek['no_aset_peripheral']." ');history.go(-1)</script>";
		}
		else
		{
      move_uploaded_file($lokasi_file,$direktori);
			$sql = sqlsrv_query($kon, "insert into kendaraan_peripheral values('".$no_aset_peripheral."','".$jenis_peripheral."','".$desc_peripheral."','".$no_aset_kendaraan."',
      '".$cost_center_id."','".$profit_center_id."','".$nama_depo_peripheral."','".$nama_region_peripheral."','".$nik_lama."','".$nik_baru."','".$cap_date."','".$acquis_val."',
			'".$thn_pemakaian."','".$status_perangkat."','".$status_jual."','".$harga_jual."','".$barcode."','".$nama_file."','".$gambar_baru."','".$status."','".$uname."','".$status_validasi."')");

			if($sql)
			{
				echo"<script>history.go(-1)</script>";
			}
			else{
				echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN !!');history.go(-1)</script>";
			}

		}
 ?>
