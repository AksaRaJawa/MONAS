<?php include 'header.php';	?>
<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Log Perpindahan Aset Modis</h3>


<br/>
    <div style="overflow:auto">
    <div style="width:2600px">
			<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
			<thead style="color:white;background:#00CED1;" >
				<tr>
		<th class="col-md-0 text-center">No.</th>
		<th class="col-md-0">No.IMEI</th>
		<th class="col-md-0">Merk</th>
		<th class="col-md-0">Tipe</th>
		<th class="col-md-0">No.Asset</th>
		<th class="col-md-0">NIK Sebelumnya</th>
		<th class="col-md-0">Nama Sebelumnya</th>
		<th class="col-md-0">Depo Sebelumnya</th>
		<th class="col-md-0">NIK Sekarang</th>
		<th class="col-md-0">Nama Sekarang</th>
		<th class="col-md-0">Depo Sekarang</th>
		<th class="col-md-0">USER</th>
		<th class="col-md-0">Tanggal</th>
		<th class="col-md-0">Waktu</th>
	</tr>
</thead>
<tbody>
	<?php

		$brg=sqlsrv_query($kon, "select * from pindahan ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
		?>
		<tr>
		    <td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['no_imei'] ?></td>
			<td><?php echo $b['nama_merk'] ?></td>
			<td><?php echo $b['nama_tipe'] ?></td>
			<td><?php echo $b['no_asset'] ?></td>
			<td><?php echo $b['nik_dulu'] ?></td>
			<td><?php echo $b['nama_dulu'] ?></td>
            <td><?php echo $b['depo_dulu'] ?></td>
			<td><?php echo $b['nik_sekarang'] ?></td>
			<td><?php echo $b['nama_sekarang'] ?></td>
			<td><?php echo $b['depo_sekarang'] ?></td>
			<td><?php echo $b['uname'] ?></td>
			<td><?php echo $b['tanggal'] ?></td>
            <td><?php echo $b['waktu'] ?></td>
		</tr>

		<?php
	}
	?>
</tbody>
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
