<?php include 'header_kendaraan.php';	?>
<?php
$usern = sqlsrv_query($kon, "select * from [user] where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);
$re_gion = $uu['nama_region'];
$uu_region = strstr($re_gion," ");
?>

<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Data Asuransi Kendaraan</h3>


<div class="col-md-10">
<!--<button onclick="location.href='import_asuransi.php?uname=<?php echo $_SESSION['uname'];?>'" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Import dari Excel</button>

<!--<button onclick="document.location='lap_asuransi.php'" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Export ke Excel</button>-->
</div>
<br/>
<br/>
    <div style="overflow-y:auto">

	<div style="width:1000px">

<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
<thead style="color:white;background:#00CED1;" >
  <tr>
		<th class="col-md-0; text-center">No</th>
		<th class="col-md-0; text-center">No. Polis Asuransi</th>
    <th class="col-md-0">No. Polisi</th>
		<th class="col-md-0">Note Leasing</th>
		<th class="col-md-0">Status</th>
		<th class="col-md-0">NIK & Nama User</th>
		<th class="col-md-0">Depo</th>
		<th class="col-md-0">Awal Asuransi</th>
    <th class="col-md-0">Akhir Asuransi</th>
    <th class="col-md-0">Biaya Asuransi</th>

	</tr>
</thead>
<tbody >
	<?php

		$brg=sqlsrv_query($kon, "select a.*, b.nama_karyawan, b.nama_jabatan, b.nama_depo AS depox from asuransi_kendaraan a LEFT JOIN karyawan_perangkat_it b ON a.nik_user = b.nik_karyawan WHERE a.nama_region = '$uu_region' ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
    $depo = $b['nama_depo'];
    //$depo = strstr($dp," ");
    $region = $b['nama_region'];
    //$region = strstr($ro," ");
    $status = $b['status'];
		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
      <td><?php echo $b['no_asuransi'] ?></td>
      <td class="text-center">
				<a class="DetailKendaraan" data-toggle="modal" data-target="#detailkendaraan" data-whatever="<?=$b['no_polisi']?>"><?php echo $b['no_polisi']?></a>
			</td>
			<td><?php echo $b['note_leasing'] ?></td>
      <td><?php echo $b['status_kendaraan'] ?></td>
      <td>
        <a  data-toggle="tooltip" title="<?php echo $b['nama_jabatan']; echo " == "; echo $b['depox'];?>" data-placement="top"><?php echo $b['nik_user'] ?> : <?php echo $b['nama_karyawan'] ?></a>
      </td>
      <td><?php echo $depo ?></td>
      <td><?php echo $b['awal_asuransi'] ?></td>
      <td><?php echo $b['akhir_asuransi'] ?></td>
      <td class="text-center">
				<a class="DetailBiaya" data-toggle="modal" data-target="#detailbiaya" data-whatever="<?=$b['no_rangka']?>">Cek Biaya</a>
			</td>

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
  <div id="detailbiaya" class="modal fade">
  <div class="modal-dialog">
  <div class="modal-content">

    </div>
  </div>
  </div>
  <?php include 'footer.php'; ?>

<script>
$('.DetailKendaraan').click(function(){
	var Detail=$(this).attr('data-whatever');
	$.ajax({url:"detailkendaraan.php?Detail="+Detail, cache:false, success:function(result){
		$(".modal-content").html(result);
	}});
});
</script>

<script>
$('.DetailBiaya').click(function(){
	var Detail=$(this).attr('data-whatever');
	$.ajax({url:"detailbiaya.php?Detail="+Detail, cache:false, success:function(result){
		$(".modal-content").html(result);
	}});
});
</script>


  <script type="text/javascript">
    $(document).ready(function(){
      //$("#tgl").datepicker($.datepicker.regional["id"]);
      //$("#tahun_kendaraan").datepicker({dateFormat : 'yy',viewMode: 'years',orientation: 'auto top'});
      $("#tanggal_stnk").datepicker({dateFormat : 'dd-M-y'});
      $("#awal_asuransi").datepicker({dateFormat : 'dd-M-y'});
      $("#akhir_asuransi").datepicker({dateFormat : 'dd-M-y'});
    });
  </script>
  <script type="text/javascript">
      function ChangesBiaya(){
      var fr = document.getElementById('id_biaya').value;
      var xr = String(fr);
      if(xr=='1')
      {
        document.getElementById('jumlah_biaya_comprehensive').show();
      }

      };
      </script>
  <script language='javascript'>
    function validAngka(angka)
    {
      if(!/^[0-9.]+$/.test(angka.value))
      {
        angka.value = angka.value.substring(0,angka.value.length-1000);
      }
    }
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
