<?php include 'header.php'; ?>

<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-file"></span>  Master Jenis Biaya Asuransi</h3>


<button  data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span> Tambah</button>
<div class="col-md-10">
<button onclick="document.location='import_jenis.php'" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Import dari Excel</button>
</div>

<br/>
<br/>
<br/>
<div style="overflow-y:auto">
<div style="width:900px">
<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
<thead style="color:white;background:#00CED1;" >
	<tr>
		<th class="col-md-0 text-center">No</th>
		<th class="col-md-0">Jenis Biaya Asuransi</th>
		<th class="col-md-0">Opsi</th>
	</tr>
</thead>
<tbody>
	<?php

		$brg=sqlsrv_query($kon, "select * from asuransi_jenis ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){

		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['nama_jenis_biaya'] ?></td>

			<td>
				<a href="edit_jenis.php?id=<?php echo $b['id_jenis_biaya']; ?>" class="btn btn-warning">Edit</a>
				<a href="status_jenis.php?id=<?php echo $b['id_jenis_biaya']; ?>" name="status" class="btn btn-plus"><?php if($b['status']=='1'){ echo "Non-Aktifkan"; }else if($b['status']=='0'){ echo"Aktifkan";}?></a>
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
				<h4 class="modal-title">Tambah Jenis Biaya Asuransi Baru</h4>
			</div>
			<div class="modal-body">
				<form action="tambah_jenis.php" method="post">
					<div class="form-group">
						<label>Nama Biaya Asuransi</label>
						<input name="nama_jenis_biaya" type="text" class="form-control" placeholder="Nama Biaya Asuransi" required>
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
