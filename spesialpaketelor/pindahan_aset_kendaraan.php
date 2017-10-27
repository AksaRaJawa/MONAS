<?php include 'header_kendaraan.php';	?>
<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Log Perpindahan Aset Kendaraan</h3>

<div class="col-md-10">
<button onclick="document.location='lap_pindahan_kendaraan.php'" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Export ke Excel</button>
</div>

<br/>
<br/>
<br/>
    <div style="overflow:auto">
    <div style="width:2100px">
			<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
			<thead style="color:white;background:#00CED1;" >
	<tr>
		<th class="col-md-0 text-center">No.</th>
		<th class="col-md-0">No. Aset</th>
		<th class="col-md-0">Nama Merk & Tipe</th>
		<th class="col-md-0">CC Sebelumnya</th>
		<th class="col-md-0">PC Sebelumnya</th>
		<th class="col-md-0">User Sebelumnya</th>
		<th class="col-md-0">CC Sekarang</th>
		<th class="col-md-0">PC Sekarang</th>
		<th class="col-md-0">User Sekarang</th>
		<th class="col-md-0">Depo Sekarang</th>
		<th class="col-md-0">Region Sekarang</th>
		<th class="col-md-0">USERNAME</th>
		<th class="col-md-0">Tanggal</th>
		<th class="col-md-0">Waktu</th>
	</tr>
	<?php

		$brg=sqlsrv_query($kon, "select  * from pindahan_kendaraan ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
		?>
		<tr>
		    <td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['no_aset_kendaraan'] ?></td>
			<td><?php echo $b['nama_merk'] ?> --- <?php echo $b['nama_tipe'] ?></td>
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
