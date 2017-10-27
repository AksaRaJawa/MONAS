<?php include 'header_kendaraan.php'; ?>
<?php
date_default_timezone_set('Asia/Jakarta');
$thn_sekarang = date("y");
error_reporting(0);
include "config.php";
require "excel_reader.php";
$uname = $_GET['uname'];
if(isset($_POST['submit'])){
    $target = basename($_FILES['file_peripheral']['name']) ;
    move_uploaded_file($_FILES['file_peripheral']['tmp_name'], $target);
    $data = new Spreadsheet_Excel_Reader($_FILES['file_peripheral']['name'],false);
    $baris = $data->rowcount($sheet_index=0);
    if(isset($_POST['drop']))
    {
	 $truncate ="TRUNCATE table kendaraan_peripheral";
      sqlsrv_query($kon, $truncate);
    }
    for ($i=2; $i<=$baris; $i++)
    {

		  $no_aset_peripheral           = $data->val($i, 1);
      $jenis_peripheral               = ucwords($data->val($i, 2));
		  $desc_peripheral                   = $data->val($i, 3);
		  $no_aset_kendaraan                   = ' ';

		  $cost_center_id            = $data->val($i, 4);
      $profit_center_id           = substr($cost_center_id,0,6);
      $nama_depo_peripheral            = $data->val($i, 5);
      $nama_region_peripheral            = $data->val($i, 6);
      $nik_lama           = ' ';
      $nik_baru            = $data->val($i, 7);
		  $cap_date         = $data->val($i, 8);
		  $acquis_value       = $data->val($i, 9);
      $cap = substr($cap_date,7);
      $thn_pemakaian = $thn_sekarang-$cap;
      $status_perangkat       = $data->val($i, 10);
      $status_jual       = $data->val($i, 11);
      $harga_jual       = $data->val($i, 12);
      $barcode = '';
      $gambar_lama = '';
      $gambar_baru = '';
		  $status           = '1';
      $status_validasi  = '0';
      $status_approve = '0';
      $validater  = ' ';
		  //$uname            = '00100';

      $cek = "select * from kendaraan_peripheral where no_aset_peripheral = '".$no_aset_peripheral."' ";
 	   $proses_cek = sqlsrv_query($kon, $cek, $param, $option);
 	   $data_cek = sqlsrv_fetch_array($proses_cek);
 		if(sqlsrv_num_rows($proses_cek)>0)
 		{
 			echo"<script>alert('DATA ADA YANG SAMA !!!! Peripheral dengan No. Aset = ".$data_cek['no_aset_peripheral']." ');history.go(-1)</script>";
 		}
 		else
 		{
      $hasil = sqlsrv_query($kon, "insert into kendaraan_peripheral values('".$no_aset_peripheral."','".$jenis_peripheral."','".$desc_peripheral."','".$no_aset_kendaraan."',
      '".$cost_center_id."','".$profit_center_id."','".$nama_depo_peripheral."','".$nama_region_peripheral."','".$nik_lama."','".$nik_baru."','".$cap_date."','".$acquis_val."',
			'".$thn_pemakaian."','".$status_perangkat."','".$status_jual."','".$harga_jual."','".$barcode."','".$gambar_lama."','".$gambar_baru."','".$status."','".$uname."','".$status_validasi."')");
		}
    }

    if(!$hasil){
          echo "<script>alert('Import Gagal !!')</script>";
      }else{
          echo "<script>alert('Import Berhasil !!')</script>";
		  echo "<script>window.location='aset_peripheral.php'</script>";
    }
    unlink($_FILES['file_peripheral']['name']);
}

?>

<h3><i class="glyphicon glyphicon-paperclip"></i>&nbsp;&nbsp;Import Data Aset Peripheral</h3>
<div class="row mt">
  <div class="col-lg-12">
    <div class="form-panel" style="padding-bottom:25px;">

<form name="myForm" id="myForm" onSubmit="return validateForm()" action="" method="post" enctype="multipart/form-data"  class="form-horizontal style-form">
<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label">Import File Dari Excel</label>
			<div class="col-sm-10"><input type="file" id="file_peripheral" name="file_peripheral" /></div>
			<p class="help-block">  &nbsp;&nbsp;   Hanya file Excel 2003 (.xls) yg diperbolehkan</p>
            </div>
     <div class="form-group">
     <div class="col-sm-10">
	 <input type="checkbox" value="Kosong" name="drop">  Kosongkan Data Sebelumnya<br/><br/>
	<input type="submit" class="btn btn-primary btn-blocks" value="Import" name="submit">
	 <button type="button" class="btn btn-warning btn-blocks" onclick="document.location='aset_peripheral.php'">Kembali</button>
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

        if(!hasExtension('file_peripheral', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>
<?php
include 'footer.php';

?>
