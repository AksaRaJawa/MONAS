<?php include 'header_aset.php';	?>
<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Histori Perangkat IT</h3>

<div class="col-md-10">
<button onclick="document.location='lap_history_perangkat_it.php'" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Export ke Excel</button>
</div>

<br/>
<br/>
<br/>
    <div style="overflow:auto">
    <div style="width:2500px">
			<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
			<thead style="color:white;background:#00CED1;" >
	<tr>
		<th class="col-md-0 text-center">No.</th>
		<th class="col-md-1">Tanggal Perubahan</th>
		<th class="col-md-1">Aktifitas</th>
		<th class="col-md-1">No.Aset</th>
		<th class="col-md-1">Aset Group</th>
		<th class="col-md-1">Aset Desc</th>
		<th class="col-md-1">Merk & Type</th>
		<th class="col-md-1">Cost Center</th>
		<th class="col-md-1">NIK User Responsible</th>
		<th class="col-md-1">Status Perangkat</th>
		<th class="col-md-1">Username</th>
		<th class="col-md-1">Depo</th>
		<th class="col-md-1">Region</th>
		<th class="col-md-1">Waktu</th>
	</tr>
</thead>
	<tbody>
	<?php

		$brg=sqlsrv_query($kon, "select a.*, c.nama_karyawan from histori_perangkat_it a LEFT JOIN karyawan_perangkat_it c ON a.nik_karyawan = c.nik_karyawan");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
		$nama = $b['nama_karyawan'];
		?>
		<tr>
			<td class="text-center"><?php echo $b['no_dok'] ?></td>
			<td><?php echo $b['tanggal_perubahan'] ?></td>
			<td><?php echo $b['aktivitas'] ?></td>
			<td><?php echo $b['no_aset'] ?></td>
			<td><?php echo $b['aset_group'] ?></td>
			<td><?php echo $b['aset_desc'] ?></td>
      <td><?php echo $b['nama_merk'] ?></td>
      <td><?php echo $b['cost_center'] ?></td>
			<td>
				<a href=""  data-toggle="tooltip" title="<?php echo $nama;?>" data-placement="top"><?php echo $b['nik_karyawan'] ?></a>
			</td>
			<td><?php echo $b['status_perangkat'] ?></td>
			<td><?php echo $b['uname'] ?></td>
			<td><?php echo $b['nama_depo'] ?></td>
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

	<?php include 'footer.php'; ?>
