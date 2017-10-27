<?php include 'header.php';	?>
<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-refresh"></span>  Histori Asuransi Kendaraan</h3>

<div class="col-md-10">
<!--<button onclick="document.location='lap_histori.php'" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Export ke Excel</button>-->
</div>
<br/>
    <div style="overflow:auto">
    <div style="width:1400px">
			<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
			<thead style="color:white;background:#00CED1;">
	<tr>
		<th class="col-md-0 text-center">No.</th>
		<th class="col-md-0">Tanggal</th>
		<th class="col-md-0">Waktu</th>
		<th class="col-md-0">No. Mesin</th>
		<th class="col-md-0">No. Rangka</th>
		<th class="col-md-0">Merk & Tipe</th>
		<th class="col-md-0">NoPol Lama</th>
		<th class="col-md-0">NoPol Baru</th>
		<th class="col-md-0">User Lama</th>
		<th class="col-md-0">User Baru</th>
	</tr>
</thead>
<tbody>
	<?php

	$brg=sqlsrv_query($kon, "select  a.*, b.nama_karyawan, b.nama_depo, b.nama_region from histori_asuransi a LEFT JOIN karyawan_perangkat_it b ON a.nik_lama = b.nik_karyawan OR a.nik_baru = b.nik_karyawan ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
	$nama = $b['nama_karyawan'];
	$dp = $b['nama_depo'];
	$depo = strstr($dp," ");
	$ro = $b['nama_region'];
	$region = strstr($ro," ");
		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['tanggal_perubahan'] ?></td>
			<td><?php echo $b['waktu'] ?></td>
			<td class="text-center">
				<a class="DetailHistori" data-toggle="modal" data-target="#detailhistori" data-whatever="<?=$b['no_mesin']?>"><?php echo $b['no_mesin']?></a>
			</td>
			<td><?php echo $b['no_rangka'] ?></td>
			<td><?php echo $b['nama_merk'] ?> --- <?php echo $b['nama_tipe'] ?></td>
      <td><?php echo $b['nopol_lama'] ?></td>
      <td><?php echo $b['nopol_baru'] ?></td>
			<td>
				<a href=""  data-toggle="tooltip" title="<?php echo $depo; echo " == "; echo $region;?>" data-placement="top"><?php echo $b['nik_lama'] ?>  <?php if($b['nik_lama']!=''){ echo " : "; echo $b['nama_karyawan']; } else {} ?></a>
			</td>
			<td>
				<a href=""  data-toggle="tooltip" title="<?php echo $depo; echo " == "; echo $region;?>" data-placement="top"><?php echo $b['nik_baru'] ?> : <?php echo $b['nama_karyawan'] ?></a>
			</td>
		</tr>

		<?php
	}
	?>
</tbody>
</table>
</div>
</div>
<div id="detailhistori" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">

	</div>
</div>
</div>
	<?php include 'footer.php'; ?>
	<script>
	$('.DetailHistori').click(function(){
		var Detail=$(this).attr('data-whatever');
		$.ajax({url:"detailhistori.php?Detail="+Detail, cache:false, success:function(result){
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
