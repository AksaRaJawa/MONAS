<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$thn_sekarang = date("y");
$uname = $_POST['uname'];
$lokasi_file = $_FILES['gambar_lama']['tmp_name'];
$tipe_file = $_FILES['gambar_lama']['type'];
$nama_file = $_FILES['gambar_lama']['name'];
$direktori = "gambar_aset_kendaraan/$nama_file";
$no_aset_kendaraan=$_POST['no_aset_kendaraan'];
$jenis_kendaraan = $_POST['jenis_kendaraan'];
$tipe_kendaraan = $_POST['tipe_kendaraan'];
$nama_merk = strtoupper($_POST['nama_merk']);
$nama_tipe= ucwords($_POST['nama_tipe']);
$tahun_kendaraan = $_POST['tahun_kendaraan'];
$no_aset_peripheral=$_POST['no_aset_peripheral'];
$cost_center_id = $_POST['cost_center_id'];
$nik_lama = ' ';
$nik_baru=$_POST['nik_baru'];
$profit_center_id = substr($cost_center_id,0,6);
$sqldepo = sqlsrv_query($kon,"select nama_depo, nama_ro from cost_center where id_cc = '".$cost_center_id."' ");
$depo = sqlsrv_fetch_array($sqldepo);
$nama_depo_kendaraan = $depo['nama_depo'];
$nama_region_kendaraan = $depo['nama_ro'];
$cap_date=$_POST['cap_date'];
$end_date=$_POST['end_date'];
$cap = substr($cap_date,7);
$thn_pemakaian = $thn_sekarang-$cap;
$acquis_val=$_POST['acquis_val'];
$gambar_baru = '';
$status = '1';
$status_validasi = '0';

     $cek = "select * from kendaraan_asetkendaraan where no_aset_kendaraan = '".$no_aset_kendaraan."' ";
	   $proses_cek = sqlsrv_query($kon, $cek, $param, $option);
	   $data_cek = sqlsrv_fetch_array($proses_cek);
		if(sqlsrv_num_rows($proses_cek)>0)
		{
			echo"<script>alert('DATA ADA YANG SAMA !!!! Kendaraan dengan No. Aset = ".$data_cek['no_aset_kendaraan']." ');history.go(-1)</script>";
		}
		else
		{
      move_uploaded_file($lokasi_file,$direktori);
			$sql = sqlsrv_query($kon, "insert into kendaraan_asetkendaraan values('".$no_aset_kendaraan."','".$jenis_kendaraan."','".$tipe_kendaraan."','".$nama_merk."','".$nama_tipe."','".$tahun_kendaraan."','".$no_aset_peripheral."',
      '".$cost_center_id."','".$profit_center_id."','".$nama_depo_kendaraan."','".$nama_region_kendaraan."','".$nik_lama."','".$nik_baru."','".$cap_date."','".$end_date."','".$acquis_val."',
			'".$thn_pemakaian."','".$nama_file."','".$gambar_baru."','".$status."','".$uname."','".$status_validasi."')");

			if($sql)
			{
				echo"<script>history.go(-1)</script>";
			}
			else{
				echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN !!');history.go(-1)</script>";
			}

		}
 ?>
