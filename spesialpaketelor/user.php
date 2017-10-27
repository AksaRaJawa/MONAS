<?php include 'header.php';	?>

<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Data User (Non-Administrator)</h3>


<button  data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span> Tambah</button>

<br/>
<br/>
<br/>
<div style="overflow-y:auto">
<div style="width:1200px">
<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
<thead style="color:white;background:#00CED1;" >	<tr>
		<th class="col-md-0 text-center">No</th>
		<th class="col-md-0">NIK</th>
		<th class="col-md-0">Password</th>
		<th class="col-md-0">Nama User</th>
		<th class="col-md-0">Depo</th>
		<th class="col-md-0">Region</th>
        <th class="col-md-0">Hak Akses</th>
		<th class="col-md-0">Opsi</th>
	</tr>
</thead>
<tbody>
	<?php

		$brg=sqlsrv_query($kon, "select  * from [user] ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){

		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
			<td><?php echo $b['uname'] ?></td>
			<td><?php echo base64_decode($b['pass'])?></td>
			<td><?php echo $b['nama_lengkap'] ?></td>
			<td><?php echo $b['nama_depo'] ?></td>
			<td><?php echo $b['nama_region'] ?></td>
            <td><?php echo $b['akses'] ?></td>
			<td>
				<a href="edit_user.php?id=<?php echo $b['uname']; ?>" class="btn btn-warning">Edit</a>
				<a href="status_user.php?id=<?php echo $b['uname']; ?>" name="status" class="btn btn-plus"><?php if($b['status']=='1'){ echo "Non-Aktifkan"; }else if($b['status']=='0'){ echo"Aktifkan";}?></a>
				<!--<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_user.php?id=<?php echo $b['uname']; ?>' }" class="btn btn-danger">Hapus</a>-->
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
				<h4 class="modal-title">Tambah User Baru
				</div>
				<div class="modal-body">
					<form action="tambah_user.php" method="post">
					  <div class="form-group">
							<label>NIK</label>
							<input name="uname" type="text" class="form-control" placeholder="NIK" autocomplete="off" onkeyup = "validAngka(this)">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input name="pass" type="password" class="form-control" placeholder="Password" autocomplete="off">
						</div>
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input name="nama_lengkap" type="text" class="form-control" placeholder="Nama Lengkap" autocomplete="off">
						</div>
						<div class="form-group">
							<label>Hak Akses</label>
							<select class="form-control" id="akses" name="akses" onchange="ChangesAkses()">
							<option value="DEPO"> DEPO </option>
							<option value="REGION"> REGION </option>
							<option value="HO"> HO </option>
							<option value="GA"> ASURANSI - GA </option>
							</select>
						</div>
						<script type="text/javascript">
								    function ChangesAkses(){
									var fr = document.getElementById('akses').value;
									var xr = String(fr);
									if(xr=='DEPO')
									{
								    document.getElementById('nama_depo').disabled = false;
									}else if(xr=='REGION')
									{
									document.getElementById('nama_depo').disabled = false;
									}
									else if(xr=='HO')
									{
									document.getElementById('nama_depo').disabled = true;
									}
									else if(xr=='GA')
									{
									document.getElementById('nama_depo').disabled = true;
									}
									};
									</script>
						<div class="form-group">
							<label>Depo</label>
							<select class="form-control" id="nama_depo" name="nama_depo" onchange="ChangesValue()">
							<option value=" --- ">- Pilih Depo -</option>
								<?php
								$dp=sqlsrv_query($kon, "select * from depo");
								while($rw=sqlsrv_fetch_array($dp)){
									echo'<option value="'.$rw['id_depo'].'---'.$rw['nama_depo'].'---'.$rw['nama_region'].'">'.$rw['nama_depo'].'</option> ';
								}
								?>
							</select>
						</div>
                        <div class="form-group">
							<label>Region</label>
							<span id="nama_region" name="nama_region" class="form-control" disabled="disabled"></span>
							<script type="text/javascript">
								    function ChangesValue(){
									var fr = document.getElementById('nama_depo').value;
									var xr = String(fr);
									var rr = xr.split("---");
									document.getElementById('nama_region').innerHTML = rr[2];
									};
									</script>
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

	<script type="text/javascript">
		$(document).ready(function(){
			//$("#tgl").datepicker($.datepicker.regional["id"]);
			//$("#tgl").datepicker({dateFormat : 'dd/MM/yy'});

		});
	</script>
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
