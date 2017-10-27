<?php include 'header_aset.php';	?>
<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-check"></span>  Log Validasi Perangkat IT </h3>
<br/>

    <div style="overflow:auto">
    <div style="width:1100px">
			<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
			<thead style="color:white;background:#00CED1;" >
	<tr>
		<th class="col-md-0 text-center">No.</th>
		<th class="col-md-0">No.Aset</th>
		<th class="col-md-0">Aset Group</th>
		<th class="col-md-0">Aset Desc</th>
		<th class="col-md-0">Nama Depo</th>
		<th class="col-md-0">Nama Region</th>
		<th class="col-md-0">Status Validasi</th>
		<th class="col-md-0">Validater</th>
	</tr>
</thead>
<tbody>
	<?php

		$brg=sqlsrv_query($kon, "select * from perangkat_it where status_validasi = '1' ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
		?>
		<tr>
		  <td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['no_aset'] ?></td>
			<td><?php echo $b['aset_group'] ?></td>
			<td><?php echo $b['aset_desc'] ?></td>
			<td><?php echo $b['nama_depo'] ?></td>
			<td><?php echo $b['nama_region'] ?></td>
			<td>
				<a href='' name="status_validasi" class="btn btn-plus"><?php if($b['status_validasi']=='1'){ ?> <span class="glyphicon glyphicon-ok"></span> <?php }else if($b['status_validasi']=='0'){ echo "";}?></a>
			</td>
      <td><?php echo $b['validater'] ?></td>
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
