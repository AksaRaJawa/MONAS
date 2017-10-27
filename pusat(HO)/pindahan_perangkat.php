<?php include 'header_aset.php';	?>
<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Log Perpindahan Perangkat IT</h3>

<div class="col-md-10">
<button onclick="document.location='lap_pindahan_perangkat_it.php'" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Export ke Excel</button>
</div>

<br/>
<br/>
<br/>
    <div style="overflow:auto">
    <div style="width:2000px">
			<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
			<thead style="color:white;background:#00CED1;" >
	<tr>
		<th class="col-md-0 text-center">No.</th>
		<th class="col-md-0">No.Aset</th>
		<th class="col-md-0">No.Aset Sekarang</th>
		<th class="col-md-0">Aset Group</th>
		<th class="col-md-0">Aset Desc</th>
		<th class="col-md-0">CC Sebelumnya</th>
		<th class="col-md-0">PC Sebelumnya</th>
		<th class="col-md-0">User Resp. Sebelumnya</th>
		<th class="col-md-0">CC Sekarang</th>
		<th class="col-md-0">PC Sekarang</th>
		<th class="col-md-0">User Resp. Sekarang</th>
		<th class="col-md-0">Depo Sekarang</th>
		<th class="col-md-0">Region Sekarang</th>
		<th class="col-md-0">USER</th>
		<th class="col-md-0">Tanggal</th>
		<th class="col-md-0">Waktu</th>
	</tr>
	<?php

		$brg=sqlsrv_query($kon, "select  * from pindahan_perangkat ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
		?>
		<tr>
		    <td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['no_aset'] ?></td>
			<td><?php echo $b['no_aset_baru'] ?></td>
			<td><?php echo $b['aset_group'] ?></td>
			<td><?php echo $b['aset_desc'] ?></td>
			<td><?php echo $b['cost_center_dulu'] ?></td>
			<td><?php echo $b['profit_center_dulu'] ?></td>
			<td><?php echo $b['nik_karyawan_dulu'] ?></td>
			<td><?php echo $b['cost_center_sekarang'] ?></td>
      <td><?php echo $b['profit_center_sekarang'] ?></td>
			<td><?php echo $b['nik_karyawan_sekarang'] ?></td>
			<td><?php echo $b['depo_sekarang'] ?></td>
			<td><?php echo $b['region_sekarang'] ?></td>
			<td><?php echo $b['uname'] ?></td>
			<td><?php echo $b['tanggal'] ?></td>
      <td><?php echo $b['waktu'] ?></td>
		</tr>

		<?php
	}
	?>
</table>
</div>
</div>

<!-- modal input -->

	<script type="text/javascript">
		$(document).ready(function(){
			//$("#tgl").datepicker($.datepicker.regional["id"]);
			//$("#tgl").datepicker({dateFormat : 'dd/MM/yy'});

		});
	</script>
	<?php include 'footer.php'; ?>
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
