<?php include 'header.php'; ?>

<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Data Jabatan Salesman</h3>



<br/>
<div style="overflow-y:auto">
<div style="width:1000px">
<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
<thead style="color:white;background:#00CED1;" >
	<tr>
		<th class="col-md-0 text-center">No</th>
		<th class="col-md-0">Nama Jabatan</th>
		<th class="col-md-0">Butuh Modis?</th>
		<th class="col-md-0">Status Aktif?</th>
		<th class="col-md-0">Opsi</th>
	</tr>
</thead>
<tbody>
	<?php

		$brg=sqlsrv_query($kon, "select  * from jabatan ");
	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
			if($b['butuh_modis']=='1')
			{
				$bt_modis = 'YA';
			}else
			{
				$bt_modis = 'TIDAK';
			}
			if($b['tipe_aktif']=='1')
			{
				$t_aktif = 'YA';
			}else
			{
				$t_aktif = 'TIDAK';
			}
		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['nama_jabatan'] ?></td>
			<td><?php echo $bt_modis ?></td>
			<td><?php echo $t_aktif ?></td>
			<td>
				<!--<a href="det_jabatan.php?id=<?php echo $b['id_jabatan']; ?>" class="btn btn-info">Detail</a>-->
				<a href="edit_jabatan.php?id=<?php echo $b['id_jabatan']; ?>" class="btn btn-warning">Edit</a>
				<a href="status_jabatan.php?id=<?php echo $b['id_jabatan']; ?>" name="status" class="btn btn-plus"><?php if($b['status']=='1'){ echo "Non-Aktifkan"; }else if($b['status']=='0'){ echo"Aktifkan";}?></a>
				<!--<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_jabatan.php?id=<?php echo $b['id_jabatan']; ?>' }" class="btn btn-danger">Hapus</a>-->
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
				<h4 class="modal-title">Tambah Jabatan Baru</h4>
			</div>
			<div class="modal-body">
				<form action="tambah_jabatan.php" method="post">
					<div class="form-group">
						<label>Nama Jabatan</label>
						<input name="nama_jabatan" type="text" class="form-control" placeholder="Nama Jabatan ..">
					</div>
                    <div class="form-group">
							<label>Butuh Modis?</label>
							 <div class="radio">
						                            <label>
													<input type="radio" name="butuh_modis" id="status_device" value="1">
													YA
													</label>
													<label>
													<input type="radio" name="butuh_modis" id="status_device" value="0">
													TIDAK
						                           </label>
						  </div>
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
