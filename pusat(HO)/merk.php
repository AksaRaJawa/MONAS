<?php include 'header.php'; ?>

<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Merk & Type Device</h3>




<br/>

<div style="overflow-y:auto">
<div style="width:900px">
<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
<thead style="color:white;background:#00CED1;" >
	<tr>
		<th class="col-md-0 text-center">No</th>
		<th class="col-md-0">Nama Merk</th>
		<th class="col-md-0">Nama Tipe</th>
		<th class="col-md-0">Opsi</th>
	</tr>
</thead>
<tbody>
	<?php

		$brg=sqlsrv_query($kon, "select * from merk ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){

		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['nama_merk'] ?></td>
			<td><?php echo $b['nama_tipe'] ?></td>
			<td>
				<!--<a href="det_merk.php?id=<?php echo $b['id_merk']; ?>" class="btn btn-info">Detail</a>-->
				<a href="edit_merk.php?id=<?php echo $b['id_merk']; ?>" class="btn btn-warning">Edit</a>
				<a href="status_merk.php?id=<?php echo $b['id_merk']; ?>" name="status" class="btn btn-plus"><?php if($b['status']=='1'){ echo "Non-Aktifkan"; }else if($b['status']=='0'){ echo"Aktifkan";}?></a>
				<!--<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_merk.php?id=<?php echo $b['id_merk']; ?>' }" class="btn btn-danger">Hapus</a>-->
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
				<h4 class="modal-title">Tambah Merk Baru</h4>
			</div>
			<div class="modal-body">
				<form action="tambah_merk.php" method="post">
					<div class="form-group">
						<label>Nama Merk</label>
						<input name="nama_merk" type="text" class="form-control" placeholder="Nama Merk ..">
					</div>
                    <div class="form-group">
						<label>Nama Tipe</label>
						<input name="nama_tipe" type="text" class="form-control" placeholder="Nama Tipe ..">
					</div>
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
