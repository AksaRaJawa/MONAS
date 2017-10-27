<?php include 'header_aset.php'; ?>
<?php
error_reporting(0);
include "config.php";
require "excel_reader.php";

if(isset($_POST['submit'])){
    $target = basename($_FILES['file_profit_center']['name']) ;
    move_uploaded_file($_FILES['file_profit_center']['tmp_name'], $target);
    $data = new Spreadsheet_Excel_Reader($_FILES['file_profit_center']['name'],false);
    $baris = $data->rowcount($sheet_index=0);
    if(isset($_POST['drop']))
    {
	 $truncate ="TRUNCATE table profit_center";
      sqlsrv_query($kon, $truncate);
    }
    for ($i=2; $i<=$baris; $i++)
    {

		  $pc	               = $data->val($i, 1);
      $nama_depo	       = strtoupper($data->val($i, 2));
		  $nama_ro	         = strtoupper($data->val($i, 3));
		  $market_tipe       = strtoupper($data->val($i, 4));
		  $plant_description = $data->val($i, 5);
      $plant             = $data->val($i, 6);
      $pc_induk   	     = $data->val($i, 7);
		  $status            = '1';
		   $cek = "select * from profit_center where pc = '".$pc."' ";
		   $proses_cek = sqlsrv_query($kon, $cek, $param, $option);
		   $data_cek = sqlsrv_fetch_array($proses_cek);
		if(sqlsrv_num_rows($proses_cek)>0)
		{
			echo"<script>alert('DATA ADA YANG SAMA !!!! Profit Center = ".$data_cek['pc']." ');history.go(-1)</script>";
		}
		else
		{
		  $query = "INSERT into profit_center values ('$pc','$nama_depo','$nama_ro','$market_tipe','$plant_description','$plant','$pc_induk','$status')";
		  $hasil = sqlsrv_query($kon, $query);
		  echo "<script>window.location='profit_center.php'</script>";
		}
    }

    if(!$hasil){
          echo "<script>alert('Import Gagal !!')</script>";
      }else{
          echo "<script>alert('Import Berhasil !!')</script>";
		  echo "<script>window.location='profit_center.php'</script>";
    }
    unlink($_FILES['file_profit_center']['name']);
}

?>

<h3><i class="glyphicon glyphicon-paperclip"></i>&nbsp;&nbsp;Import Data Profit Center</h3>
<div class="row mt">
  <div class="col-lg-12">
    <div class="form-panel" style="padding-bottom:25px;">

<form name="myForm" id="myForm" onSubmit="return validateForm()" action="" method="post" enctype="multipart/form-data"  class="form-horizontal style-form">
<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label">Import File Dari Excel</label>
			<div class="col-sm-10"><input type="file" id="file_profit_center" name="file_profit_center" /></div>
			<p class="help-block">  &nbsp;&nbsp;   Hanya file Excel 2003 (.xls) yg diperbolehkan</p>
            </div>
	         <div class="form-group">
			<label class="col-sm-3 col-sm-2">Format Kolom : </label>
			<div class="col-sm-10">
            [ ID PC ] - [ Nama Depo ] - [ Nama RO ] - [ Market Tipe ] - [ Plant Description ] - [ Plant ] - [ PC Induk ]
            </div>
            </div>
     <div class="form-group">
     <div class="col-sm-10">
	 <input type="checkbox" value="Kosong" name="drop">  Kosongkan Data Sebelumnya<br/><br/>
	<input type="submit" class="btn btn-primary btn-blocks" value="Import" name="submit">
	 <button type="button" class="btn btn-warning btn-blocks" onclick="document.location='profit_center.php'">Kembali</button>
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

        if(!hasExtension('file_profit_center', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>
<?php
include 'footer.php';

?>
