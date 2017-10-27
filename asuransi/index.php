<?php
include 'header.php';
?>
<?php
$usern = sqlsrv_query($kon, "select * from [user] where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);
?>
    <link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
    <script src="../assets/js/Chart.js"></script>
    <script src="../assets/js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../assets/js/highcharts.js" type="text/javascript"></script>
    <script src="../assets/js/highcharts-3d.js" type="text/javascript"></script>
    <script src="../assets/js/exporting.js" type="text/javascript"></script>
<div style="margin-top:10px;background-color:#9370DB;width:100%;display:block;float:left; color:#FFF; font-family:Lucida Sans; font-weight:bold; font-size:24px; text-align:center; margin-bottom:20px;">
SELAMAT DATANG : <?=$uu['nama_lengkap']?> <br />
==================================<br />
ASURANSI KENDARAAN TOOLS -- SNS
</div>
<br/>
<h4>SISA MASA ASURANSI & SISA MASA AKTIF STNK </h4>
<div style="overflow-y:auto">
<div style="width:1000px">
<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
<thead style="color:white;background:#00CED1;" >
<tr>
<th class="col-md-0; text-center">No</th>
<th class="col-md-0; text-center">No. Polis Asuransi</th>
<th class="col-md-0">No. Polisi</th>
<th class="col-md-0">NIK & Nama User</th>
<!--<th class="col-md-0">Depo</th>
<th class="col-md-0">Region</th>-->
<th class="col-md-0">Akhir Asuransi</th>
<th class="col-md-0">Sisa Asuransi</th>
<th class="col-md-0">Tanggal STNK</th>
<th class="col-md-0">Sisa Masa Aktif STNK</th>

</tr>
</thead>
<tbody >
<?php
date_default_timezone_set('Asia/Jakarta');
$skrg = new DateTime("now");
$brg=sqlsrv_query($kon, "select a.*, b.nama_karyawan from asuransi_kendaraan a LEFT JOIN karyawan_perangkat_it b ON a.nik_user = b.nik_karyawan order by akhir_asuransi ASC");

$no=1;
while($b=sqlsrv_fetch_array($brg)){
$depo = $b['nama_depo'];
//$depo = strstr($dp," ");
$region = $b['nama_region'];
//$region = strstr($ro," ");
$akhiras = $b['akhir_asuransi'];
$tgglstnk = $b['tanggal_stnk'];
$akhir =  new DateTime($akhiras);
$tgglstn =  new DateTime($tgglstnk);
$akhir_asuransi = $skrg->diff($akhir);
$akhir_stnk = $skrg->diff($tgglstn);
?>
<tr>
  <td class="text-center"><?php echo $no++ ?></td>
  <td><?php echo $b['no_asuransi'] ?></td>
  <td class="text-center">
    <a class="DetailKendaraan" data-toggle="modal" data-target="#detailkendaraan" data-whatever="<?=$b['no_polisi']?>"><?php echo $b['no_polisi']?></a>
  </td>
  <td><?php echo $b['nik_user']  ?> : <?php echo $b['nama_karyawan']  ?></td>
  <!--<td><?php echo $depo ?></td>
  <td><?php echo $region ?></td>-->
  <td><?php echo $b['akhir_asuransi'] ?></td>
  <td><?php echo $akhir_asuransi->format('%m Bln & %d Hari')?></td>
  <td><?php echo $b['tanggal_stnk'] ?></td>
  <td><?php if($b['tanggal_stnk']==''){ echo "";} else { echo $akhir_stnk->format('%y Thn, %m Bln & %d Hari'); }?></td>
</tr>

<?php
}
?>
</tbody>
</table>
</div>
</div>
<div id="detailkendaraan" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">

  </div>
</div>
</div>
<?php
include 'footer.php';?>
<script>
$('.DetailKendaraan').click(function(){
	var Detail=$(this).attr('data-whatever');
	$.ajax({url:"detailkendaraan.php?Detail="+Detail, cache:false, success:function(result){
		$(".modal-content").html(result);
	}});
});
</script>
<script src="../datatables/jquery.dataTables.js"></script>
<script src=../"datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript">
$(function () {
        $("#lookup1").dataTable({
  });
$("#lookup2").dataTable({

  });
    });
</script>
