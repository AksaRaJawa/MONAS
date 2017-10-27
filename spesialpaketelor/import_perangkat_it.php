<?php include 'header_aset.php'; ?>
<?php
error_reporting(0);
include "config.php";
require "excel_reader.php";
$uname = $_GET['uname'];
if(isset($_POST['submit'])){
    $target = basename($_FILES['file_perangkat']['name']) ;
    move_uploaded_file($_FILES['file_perangkat']['tmp_name'], $target);
    $data = new Spreadsheet_Excel_Reader($_FILES['file_perangkat']['name'],false);
    $baris = $data->rowcount($sheet_index=0);
    if(isset($_POST['drop']))
    {
	 $truncate ="TRUNCATE table perangkat_it";
      sqlsrv_query($kon, $truncate);
    }
    for ($i=2; $i<=$baris; $i++)
    {

		  $no_aset	        = $data->val($i, 1);
      $no_aset_baru = ' ';
      $aset_group	      = strtoupper($data->val($i, 2));
		  $aset_desc        = $data->val($i, 3);
		  $nama_merk        = strtoupper($data->val($i, 4));
		  $cost_center      = $data->val($i, 5);
		  $nik_karyawan     = $data->val($i, 6);
		  $profit_center    = $data->val($i, 7);
		  $nama_depo        = strtoupper($data->val($i, 8));
		  $nama_region      = strtoupper($data->val($i, 9));
		  $cap_date         = $data->val($i, 10);
		  $acquis_val       = $data->val($i, 11);
		  $thn_pemakaian    = $data->val($i, 12);
      $status_aset = '1';
      $status_perangkat = $data->val($i, 13);
		  $status_jual      = $data->val($i, 14);
		  $harga_jual       = $data->val($i, 15);
      $barcode          = $data->val($i, 16);
		  $status           = '1';
      $status_validasi  = '0';
      $status_approve = '0';
      $validater  = ' ';
		  //$uname            = '00100';

      $cek = "select * from perangkat_it where no_aset = '".$no_aset."' ";
 	   $proses_cek = sqlsrv_query($kon, $cek, $param, $option);
 	   $data_cek = sqlsrv_fetch_array($proses_cek);
 		if(sqlsrv_num_rows($proses_cek)>0)
 		{
 			echo"<script>alert('DATA ADA YANG SAMA !!!! Perangkat IT dengan No.Aset = ".$data_cek['no_aset']." ');history.go(-1)</script>";
 		}
 		else
 		{
      $query = "insert into perangkat_it values ('$no_aset','$no_aset_baru','$aset_group','$aset_desc','$nama_merk','$cost_center','$nik_karyawan','$profit_center','$nama_depo','$nama_region','$cap_date','$acquis_val','$thn_pemakaian','$status_aset','$status_perangkat','$status_jual','$harga_jual','$foto','$barcode','$status','$uname','$status_validasi','$validater','$status_approve')";
 			$hasil = sqlsrv_query($kon, $query);
		  //echo "<script>window.location='perangkat_it.php'</script>";
		}
    }

    if(!$hasil){
          echo "<script>alert('Import Gagal !!')</script>";
      }else{
          echo "<script>alert('Import Berhasil !!')</script>";
		  echo "<script>window.location='perangkat_it.php'</script>";
    }
    unlink($_FILES['file_perangkat']['name']);
}

?>

<h3><i class="glyphicon glyphicon-paperclip"></i>&nbsp;&nbsp;Import Data Perangkat IT</h3>
<div class="row mt">
  <div class="col-lg-12">
    <div class="form-panel" style="padding-bottom:25px;">

<form name="myForm" id="myForm" onSubmit="return validateForm()" action="" method="post" enctype="multipart/form-data"  class="form-horizontal style-form">
<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label">Import File Dari Excel</label>
			<div class="col-sm-10"><input type="file" id="file_perangkat" name="file_perangkat" /></div>
			<p class="help-block">  &nbsp;&nbsp;   Hanya file Excel 2003 (.xls) yg diperbolehkan</p>
            </div>
	         <div class="form-group">
			<label class="col-sm-3 col-sm-2">Format Kolom : </label>
			<div class="col-sm-10">
            [ No.Aset ] - [ Aset Group ] - [ Aset Desc ] - [ Merk & Tipe ] - [ Cost Center ] - [ NIK User Responsible ] - [ Profit Center ] - [ Nama Depo ] -  [ Nama Region ] - [ Cap. Date ] - [ Acquis Val ] - [ Tahun Pemakaian ] - [ Status Perangkat ] - [ Status Jual ] - [ Harga Jual ]
            </div>
            </div>
     <div class="form-group">
     <div class="col-sm-10">
	 <input type="checkbox" value="Kosong" name="drop">  Kosongkan Data Sebelumnya<br/><br/>
	<input type="submit" class="btn btn-primary btn-blocks" value="Import" name="submit">
	 <button type="button" class="btn btn-warning btn-blocks" onclick="document.location='perangkat_it.php'">Kembali</button>
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

        if(!hasExtension('file_perangkat', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>
<?php
include 'footer.php';

?>
