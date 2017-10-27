<?php include 'header_aset.php';	?>


<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Data Profit Center</h3>

<button onclick="document.location='lap_profit_center.php'" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Export ke Excel</button>



<br/>
<br/>
    <div style="overflow-y:auto">
	<div style="width:1300px">
		<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
		<thead style="color:white;background:#00CED1;" >
	<tr>
		<th class="col-md-0 text-center">No</th>
		<th class="col-md-0">ID Profit Center</th>
		<th class="col-md-0">Nama Depo</th>
		<th class="col-md-0">Nama RO</th>
		<th class="col-md-0">Market Tipe</th>
		<th class="col-md-0">Plant Description</th>
		<th class="col-md-0">Plant</th>
		<th class="col-md-0">PC Induk</th>
		<th class="col-md-0">Opsi</th>
	</tr>
</thead>
<tbody style="overflow-x:auto">
	<?php

		$brg=sqlsrv_query($kon, "select * from profit_center ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
			$status = $b['status'];
		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['pc'] ?></td>
			<td><?php echo $b['nama_depo'] ?></td>
			<td><?php echo $b['nama_ro'] ?></td>
			<td><?php echo $b['market_tipe'] ?></td>
			<td><?php echo $b['plant_description'] ?></td>
			<td><?php echo $b['plant'] ?></td>
			<td><?php echo $b['pc_induk'] ?></td>
            <td>
				<a href="edit_profit_center.php?id=<?php echo $b['pc']; ?>" class="btn btn-warning">Edit</a>
				<a href="status_profit_center.php?id=<?php echo $b['pc']; ?>" name="status" class="btn btn-plus"><?php if($status=='1'){ echo "Non-Aktifkan"; }else if($status=='0'){ echo "Aktifkan";}?></a>
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
				<h4 class="modal-title">Tambah Profit Center
				</div>
				<div class="modal-body">
					<form action="tambah_profit_center.php" method="post">
						<div class="form-group">
						    <label>ID Profit Center</label>
							<input id="pc" name="pc" type="text" class="form-control" placeholder = "Profit Center" >
						</div>
						<script type="text/javascript">
								  function ChangesPlant(){
									var fr = document.getElementById('pc').value;
									var xr = String(fr);
									var pl = substring(xr,2);
									ddocument.getElementById('plant').innerHTML=pl;
									};
									</script>
						<div class="form-group">
							<label>Nama Depo</label>
							<input name="nama_depo" type="text" class="form-control" placeholder="Nama Depo">
						</div>
						<div class="form-group">
							<label>Nama RO</label>
							<input name="nama_ro" type="text" class="form-control" placeholder="Nama RO">
						</div>
            <div class="form-group">
							<label>Market Tipe</label>
							<input name="market_tipe" type="text" class="form-control" placeholder = "Market Tipe" >
						</div>
						<div class="form-group">
							<label>Plant Description</label>
							<input name="plant_description" type="text" class="form-control" placeholder="Plant Description">
						</div>
						<div class="form-group">
							<label>PC Induk</label>
							<input name="pc_induk" type="text" class="form-control" placeholder="PC Induk">
						</div>
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
