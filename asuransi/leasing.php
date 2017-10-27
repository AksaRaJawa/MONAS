<?php include 'header.php'; ?>

<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-file"></span>  Master Vendor Leasing</h3>


<button  data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span> Tambah</button>
<div class="col-md-10">
<button onclick="document.location='import_leasing.php'" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Import dari Excel</button>
</div>

<br/>
<br/>
<br/>
<div style="overflow-y:auto">
<div style="width:1000px">
<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
<thead style="color:white;background:#00CED1;" >
	<tr>
		<th class="col-md-0 text-center">No</th>
		<th class="col-md-0">Nama Vendor Leasing</th>
		<th class="col-md-0">Note Leasing</th>
		<th class="col-md-0">Nama Bank</th>
		<th class="col-md-0">No. Rekening</th>
		<th class="col-md-0">Opsi</th>
	</tr>
</thead>
<tbody>
	<?php

		$brg=sqlsrv_query($kon, "select * from asuransi_leasing ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){

		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['nama_leasing'] ?></td>
			<td><?php echo $b['nama_note'] ?></td>
			<td><?php echo $b['nama_bank'] ?></td>
			<td><?php echo $b['no_rekening'] ?></td>
			<td>
				<a href="edit_leasing.php?id=<?php echo $b['id_leasing']; ?>" class="btn btn-warning">Edit</a>
				<a href="status_leasing.php?id=<?php echo $b['id_leasing']; ?>" name="status" class="btn btn-plus"><?php if($b['status']=='1'){ echo "Non-Aktifkan"; }else if($b['status']=='0'){ echo"Aktifkan";}?></a>
			</td>
		</tr>
		<?php
	}
	?>

</tbody>
</table>
</div>
</div>
<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Vendor Leasing Baru</h4>
			</div>
			<div class="modal-body">
				<form action="tambah_leasing.php" method="post">
					<div class="form-group">
						<label>Nama Vendor Leasing</label>
						<input name="nama_leasing" type="text" class="form-control" placeholder="Nama Vendor Leasing" required>
					</div>
          <div class="form-group">
						<label>Note Leasing</label>
						<input name="nama_note" type="text" class="form-control" placeholder="Note Leasing" required>
					</div>
					<div class="form-group">
						<label>Nama Bank</label>
						<input name="nama_bank" type="text" class="form-control" placeholder="Nama Bank Leasing" >
					</div>
					<div class="form-group">
						<label>No Rekening</label>
						<input name="no_rekening" type="text" class="form-control" placeholder="Rekening Bank Leasing" >
					</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>



<?php
include 'footer.php';?>
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
