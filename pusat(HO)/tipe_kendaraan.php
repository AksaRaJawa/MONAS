<?php include 'header_kendaraan.php';	?>


<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Data Tipe Aset Kendaraan</h3>


<button  data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span> Tambah</button>
<br/>
<br/>
<br/>
    <div style="overflow-y:auto">

	<div style="width:1000px">

<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
<thead style="color:white;background:#00CED1;" >
	<tr>
		<th class="col-md-0 text-center">No</th>
		<th class="col-md-0">Tipe Aset Kendaraan</th>
    <th class="col-md-0">Detail Tipe Aset Kendaraan</th>
		<th class="col-md-0">Opsi</th>
	</tr>
</thead>
<tbody style="overflow-x:auto">
	<?php

		$brg=sqlsrv_query($kon, "select * from kendaraan_tipekendaraan ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
    $status = $b['status'];
		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['nama_tipe_kendaraan'] ?></td>
      <td><?php echo $b['detail_tipe_kendaraan'] ?></td>
            <td>
				<a href="edit_tipe_kendaraan.php?id=<?php echo $b['id_tipe_kendaraan']; ?>" class="btn btn-warning">Edit</a>
				<a href="status_tipe_kendaraan.php?id=<?php echo $b['id_tipe_kendaraan']; ?>" name="status" class="btn btn-plus"><?php if($status=='1'){ echo "Non-Aktifkan"; }else if($status=='0'){ echo "Aktifkan";}?></a>
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
				<h4 class="modal-title">Tambah Tipe Aset Kendaraan
				</div>
				<div class="modal-body">
					<form action="tambah_tipe_kendaraan.php" method="post">
						<div class="form-group">
						<label>Nama Tipe Aset Kendaraan</label>
							<input name="nama_tipe_kendaraan" type="text" class="form-control" placeholder = "Nama Tipe Aset Kendaran"  required>
						</div>
            <div class="form-group">
						<label>Detail Tipe Aset Kendaraan</label>
							<input name="detail_tipe_kendaraan" type="text" class="form-control" placeholder = "Detail Tipe Aset Kendaran"  required>
						</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan">
					</div>
				</form>
			</div>
		</div>
	</div>

	<script language='javascript'>
		function validAngka(angka)
		{
			if(!/^[0-9.]+$/.test(angka.value))
			{
				angka.value = angka.value.substring(0,angka.value.length-1000);
			}
		}
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
