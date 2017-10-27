<?php include 'header.php'; ?>
<?php
error_reporting(0);
include "config.php";
require "excel_reader.php";

if(isset($_POST['submit'])){
    $target = basename($_FILES['file_aset']['name']) ;
    move_uploaded_file($_FILES['file_aset']['tmp_name'], $target);
    $data = new Spreadsheet_Excel_Reader($_FILES['file_aset']['name'],false);
    $baris = $data->rowcount($sheet_index=0);
    if(isset($_POST['drop']))
    {
	 $truncate ="TRUNCATE table asset";
      sqlsrv_query($kon, $truncate);
    }
    for ($i=2; $i<=$baris; $i++)
    {
		
		  $no_imei	        = $data->val($i, 1);
		  $nama_merk        = strtoupper($data->val($i, 2));
		  $nama_tipe        = strtoupper($data->val($i, 3));
		  $no_asset         = $data->val($i, 4);
		  $tanggal_beli     = $data->val($i, 5);
		  $serial_number    = $data->val($i, 6);
		  $nik_karyawan     = $data->val($i, 7);
		  $tanggal_terima   = $data->val($i, 8);
		  $nama_kepemilikan = strtoupper($data->val($i, 9));
		  $status_modis     = '1';
		  $status_device    = ucwords($data->val($i, 11));
		  $id_device        = $data->val($i, 12);
		  $masa_berlaku     = $data->val($i, 13);
		  $id_depo          = $data->val($i, 14);
		  $nama_region      = strtoupper($data->val($i, 15));
		  $keterangan       = ucwords($data->val($i, 16));
		  $provider         = ucwords($data->val($i, 17));
		  $nohp             = ucwords($data->val($i, 18));
		  $tggl_aktif       = ucwords($data->val($i, 19));
		  $status           = '1';
		  $uname            = 'Excel';
		  $status_validasi  = '0'; 
	   $cek = "select * from asset where no_imei = '".$no_imei."' AND no_imei != ' ' ";
	   $proses_cek = sqlsrv_query($kon, $cek, $param, $option);
	   $data_cek = sqlsrv_fetch_array($proses_cek);
		if(sqlsrv_num_rows($proses_cek)>0)
		{
			echo"<script>alert('DATA ADA YANG SAMA !!!! Asset dengan No.IMEI = ".$data_cek['no_imei']." ');history.go(-1)</script>";
		}
		else
		{	
		  $query = "INSERT into asset values ('$no_imei','$nama_merk','$nama_tipe','$no_asset','$tanggal_beli','$serial_number',
		  '$nik_karyawan','$tanggal_terima','$nama_kepemilikan','$status_modis','$status_device','$id_device','$masa_berlaku',
		  '$id_depo','$nama_region','$keterangan','$status','$uname','$status_validasi','$provider','$nohp','$tggl_aktif')";
		  $hasil = sqlsrv_query($kon, $query);
		  echo "<script>window.location='aset.php'</script>";
		}
    }

    if(!$hasil){
          echo "<script>alert('Import Gagal !!')</script>";
      }else{
          echo "<script>alert('Import Berhasil !!')</script>";
		  echo "<script>window.location='aset.php'</script>";
    }
    unlink($_FILES['file_aset']['name']);
}

?>

<h3><i class="glyphicon glyphicon-paperclip"></i>&nbsp;&nbsp;Import Data Asset Modis</h3>
<div class="row mt">
  <div class="col-lg-12">
    <div class="form-panel" style="padding-bottom:25px;">

<form name="myForm" id="myForm" onSubmit="return validateForm()" action="" method="post" enctype="multipart/form-data"  class="form-horizontal style-form">
<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label">Import File Dari Excel</label>
			<div class="col-sm-10"><input type="file" id="file_aset" name="file_aset" /></div>
			<p class="help-block">  &nbsp;&nbsp;   Hanya file Excel 2003 (.xls) yg diperbolehkan</p>
            </div>
	         <div class="form-group">
			<label class="col-sm-3 col-sm-2">Format Kolom : </label>
			<div class="col-sm-10">
            [ No.IMEI ] - [ Merk Device ] - [ Tipe Device ] - [ No.Asset ] - [ Tggl Beli ] - [ S/N ] - [ NIK Karyawan ] - [ Tggl Terima ] -  [ Kepemilikan ] - [ Status Aktif ] - [ Status Device ] - [ ID Device ] - [ Masa Berlaku ] - [ Kode Depo ] - [ Region ] - [ Ket. ]
            </div>
            </div>
     <div class="form-group">
     <div class="col-sm-10">
	 <input type="checkbox" value="Kosong" name="drop">  Kosongkan Data Sebelumnya<br/><br/>
	<input type="submit" class="btn btn-primary btn-blocks" value="Import" name="submit">
	 <button type="button" class="btn btn-warning btn-blocks" onclick="document.location='aset.php'">Kembali</button>
    </div>
    </div>
</form>
</div>
</div>
</div>
<script type="text/javascript">
//    validasi form (hanya file .xls yang diijinkan)
    function validateForm()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }

        if(!hasExtension('file_aset', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>
<?php 
include 'footer.php';

?>