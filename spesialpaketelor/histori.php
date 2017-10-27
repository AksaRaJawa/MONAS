<?php include 'header.php';	?>
<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Histori Modis</h3>

<div class="col-md-10">
<button onclick="document.location='lap_history.php'" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Export ke Excel</button>
</div>

<br/>
<br/>
<br/>
    <div style="overflow:auto">
    <div style="width:2600px">
			<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
			<thead style="color:white;background:#00CED1;" >
	<tr>
		<th class="col-md-0 text-center">No.</th>
		<th class="col-md-0">Tanggal Perubahan</th>
		<th class="col-md-0">Aktifitas</th>
		<th class="col-md-0">No.IMEI</th>
		<th class="col-md-0">Merk</th>
		<th class="col-md-0">Tipe</th>
		<th class="col-md-0">No.Asset</th>
		<th class="col-md-0">Serial Number</th>
		<th class="col-md-0">Nik Karyawan</th>
		<th class="col-md-0">Tanggal Terima</th>
		<th class="col-md-0">Kepemilikan</th>
		<th class="col-md-0">Status Modis</th>
		<th class="col-md-0">Status Device</th>
		<th class="col-md-0">Username/NIK</th>
		<th class="col-md-0">Depo</th>
		<th class="col-md-0">Region</th>
		<th class="col-md-0">Waktu</th>
	</tr>
</thead>
<tbody>
	<?php

		$brg=sqlsrv_query($kon, "select  * from histori ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
			$bt_modis = $b['status_modis'];
			if($bt_modis=='1')
			{
				$btuh_modis = 'AKTIF';
			}else if($bt_modis=='0')
			{
				$btuh_modis = 'NON-AKTIF';
			}
		?>
		<tr>
			<td class="text-center"><?php echo $b['no_dok'] ?></td>
			<td><?php echo $b['tanggal_perubahan'] ?></td>
			<td><?php echo $b['aktivitas'] ?></td>
			<td><?php echo $b['no_imei'] ?></td>
			<td><?php echo $b['nama_merk'] ?></td>
			<td><?php echo $b['nama_tipe'] ?></td>
            <td><?php echo $b['no_asset'] ?></td>
            <td><?php echo $b['serial_number'] ?></td>
			<td><?php echo $b['nik_karyawan'] ?></td>
			<td><?php echo $b['tanggal_terima'] ?></td>
			<td><?php echo $b['nama_kepemilikan'] ?></td>
			<td><?php echo $btuh_modis ?></td>
			<td><?php echo $b['status_device'] ?></td>
			<td><?php echo $b['uname'] ?></td>
			<td><?php echo $b['id_depo'] ?></td>
			<td><?php echo $b['nama_region'] ?></td>
            <td><?php echo $b['waktu'] ?></td>
		</tr>

		<?php
	}
	?>
</tbody>
</table>
</div>
</div>

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
