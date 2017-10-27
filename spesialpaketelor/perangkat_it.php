<?php include 'header_aset.php';	?>
<?php
//======= RUBAH STATUS JUAL =======
sqlsrv_query($kon, "UPDATE perangkat_it set status_jual = 'Siap dijual' WHERE thn_pemakaian > 4");
?>
<?php
$usern = sqlsrv_query($kon, "select * from admin where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);
?>

<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Data Aset Perangkat IT</h3>


<button  data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span> Tambah</button>
<div class="col-md-10">
<button onclick="document.location='import_perangkat_it.php'" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Import dari Excel</button>

<button onclick="document.location='lap_perangkat_it.php'" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Export ke Excel</button>
</div>


<br/>
<br/>
<br/>
    <div style="overflow-y:auto;">
    <div style="width:1700px">
			<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
			<thead style="color:white;background:#00CED1;" >
	<tr>
		<th class="col-md-0; text-center">No</th>
		<th class="col-md-0; text-center">No.Aset</th>
		<th class="col-md-0">Nama Region</th>
		<th class="col-md-0">Nama Depo</th>
		<th class="col-md-0">Profit Center</th>
		<th class="col-md-0">Cost Center</th>
		<th class="col-md-0">Desc CC</th>
		<th class="col-md-0">Aset Description</th>
		<th class="col-md-0">User Responsible</th>
    <th class="col-md-0 text-center">Opsi</th>
		<th class="col-md-0 text-center">Status</th>
	</tr>
	</thead>
	<tbody style="overflow-x:auto">
	<?php

		$brg=sqlsrv_query($kon, "select a.*, b.nama_karyawan, b.nama_jabatan, b.nama_depo AS dp, c.desc_cc from perangkat_it a left join karyawan_perangkat_it b ON a.nik_karyawan = b.nik_karyawan LEFT JOIN cost_center c ON a.cost_center = c.id_cc  ORDER BY a.no_aset ASC");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
			$nama = $b['nama_karyawan'];
			$jabatan = $b['nama_jabatan'];
			$depoxx = $b['dp'];
			$dp = $b['nama_depo'];
			$depo = strstr($dp," ");
			$ro = $b['nama_region'];
			$region = strstr($ro," ");
		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
			<td class="text-center">
				<a class="DetailGambar" data-toggle="modal" data-target="#detailgambar" data-whatever="<?=$b['no_aset']?>"><?php echo $b['no_aset']?></a>
			</td>
			<td><?php echo $region ?></td>
			<td><?php echo $depo ?></td>
			<td><?php echo $b['profit_center'] ?></td>
			<td><?php echo $b['cost_center'] ?></td>
			<td><?php echo $b['desc_cc'] ?></td>
			<td><?php echo $b['aset_desc'] ?></td>
			<td>
				<a href=""  data-toggle="tooltip" title="<?php echo $nama; echo " == "; echo $jabatan; echo " == "; echo $depoxx;?>" data-placement="top"><?php echo $b['nik_karyawan'] ?></a>
			</td>
      <td>
				<a href="edit_perangkat_it.php?id=<?php echo $b['no_aset']; ?>" class="btn btn-warning">Edit</a>
				<a href="pindah_perangkat_it.php?id=<?php echo $b['no_aset']; ?>" class="btn btn-info">Pindah Profit Center</a>
				<a onclick="if(confirm('Apakah anda yakin ingin melepaskan User Responsible perangkat ini ??')){ location.href='lepas_perangkat_it.php?id=<?php echo $b['no_aset']; ?>' }" class="btn btn-danger">Lepas User Responsible</a>
			</td>
			<td>
				<a href="" name="status" class="btn btn-plus"><?php if($b['status']=='1'){ echo " "; }else if($b['status']=='0'){ echo "Scrapped";}?></a>
			</td>
		</tr>

		<?php
	}
	?>
	</tbody>
</table>
</div>
</div>

		<!--<form action="rubah_thn_pemakaian.php" method="post">
			<div></div>
		    <div><input type="submit" value="Rubah Tahun Pemakaian" class="btn btn-warning pull-right"></div>
		</form>
		<br/>-->

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Perangkat
				</div>
				 <div class="modal-body">
					<form name="myForm" action="tambah_perangkat_it.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
						<input name="uname" type="hidden" class="form-control" value= "<?=$uu['uname']?>">
						<div id="accordion" class="accordion-style1 panel-group">
						<div class="form-group">
							<label>Gambar (Ukuran Maks = 1 MB)</label>
								<input id="gambar" name="gambar" type="file" class="form-control focus">
						</div>
						<div class="panel panel-default">
						<div class="panel-heading">
								<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseZero">
								<i class="ace-icon fa fa-angle-right bigger-110"></i>
								&nbsp; Detail Perangkat
							    </a>
								</h4>
						</div>
							<div class="panel-collapse collapse" id="collapseZero">
							<div class="panel-body">
								<div class="form-group">
								<label>No.Aset</label>
									<input id="no_aset" name="no_aset" type="text" class="form-control" placeholder="No.Aset" onkeyup = "validAngka(this)" >
								</div>
								<div class="form-group">
									<label>Aset Group</label>
									<select class="form-control autocomplete" id="aset_group" name="aset_group" >
									<option value=" ">- Pilih Group -</option>
										<?php
										$dp=sqlsrv_query($kon, "select nama_group from aset_group where status = '1'");
										while($rw=sqlsrv_fetch_array($dp)){
											echo'<option value="'.$rw['nama_group'].'">'.$rw['nama_group'].'</option> ';
										}
										?>
									</select>
								</div>
								<div class="form-group">
								<label>Aset Description</label>
									<input id="" name="aset_desc" type="text" class="form-control" placeholder="Description">
								</div>
								<div class="form-group">
								<label>Merk & Tipe</label>
									<input id="" name="nama_merk" type="text" class="form-control" placeholder="Merk & Tipe" >
								</div>
							</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									<i class="ace-icon fa fa-angle-right bigger-110"></i>
									&nbsp; Cos Center, NIK Karyawan, Cap.Date & Acquis Val
									</a>
								</h4>
							</div>
							<div class="panel-collapse collapse" id="collapseOne">
								<div class="panel-body">
									<div class="form-group">
									<label>Cost Center</label>
										<input id="cost_center" name="cost_center" type="text" class="form-control" placeholder="Cost Center ID" >
									</div>
										<div class="form-group">
												<label>NIK User Responsible</label>
												<input name="nik_karyawan" type="text" class="form-control" placeholder="NIK User Responsible" onkeyup="validAngka(this)">
										</div>
										<div class="form-group">
												<label>Cap. Date</label>
												<input id="cap_date" name="cap_date" type="text" class="form-control" placeholder="Cap. Date" >
										</div>
										<div class="form-group">
												<label>Acquis Val</label>
												<input id="acquis_val" name="acquis_val" type="text" class="form-control" placeholder="Acquis Val" onkeyup="validAngka(this)">
										</div>

								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									<i class="ace-icon fa fa-angle-right bigger-110"></i>
									&nbsp; Status Perangkat & Status Jual
									</a>
								</h4>
							</div>
							<div class="panel-collapse collapse" id="collapseTwo">
								<div class="panel-body">
									<div class="form-group">
									<label>Status Perangkat</label>
									<select class="form-control" id="status_perangkat" name="status_perangkat">
									<option value="Operasional">- Pilih Status -</option>
									<option value="Operasional">Operasional</option>
									<option value="Rusak">Rusak</option>
									<option value="Servis">Servis</option>
									</select>
									</div>
									<div class="form-group">
									<label>Status Jual</label>
									<select class="form-control" id="status" name="status" >
									<option value="Masih Asset">- Pilih Status -</option>
									<option value="Masih Asset">Masih Asset</option>
									<option value="Siap dijual">Siap dijual</option>
									</select>
									</div>
									<script type="text/javascript">
											function ChangesStatus(){
											var fr = document.getElementById('status').value;
											var xr = String(fr);
											if(xr=='Siap dijual')
											{
												document.getElementById('harga_jual').disabled=false;
											}
											if(xr=='Masih Asset')
											{
												document.getElementById('harga_jual').disabled=false;
											}
											};
											</script>
										<div class="form-group">
												<label>Harga Jual</label>
												<input id="harga_jual" name="harga_jual" type="text" class="form-control" placeholder="Harga Jual" onkeyup="validAngka(this)">
										</div>
								</div>
							</div>
						</div>
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
	<div id="detailgambar" class="modal fade">
<div class="modal-dialog">
	<div class="modal-content">

		</div>
	</div>
</div>
<script>
$('.DetailGambar').click(function(){
	var DetailGambar=$(this).attr('data-whatever');
	$.ajax({url:"detailgambar.php?DetailGambar="+DetailGambar, cache:false, success:function(result){
		$(".modal-content").html(result);
	}});
});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			//$("#tgl").datepicker($.datepicker.regional["id"]);
			$("#cap_date").datepicker({dateFormat : 'dd-M-y'});
		});
	</script>
	<script type="text/javascript">
		function validateForm() {
		    var x = document.forms["myForm"]["no_aset"].value;
		    if (x == "") {
		        alert("No. Aset Tidak Boleh Kosong !!!");
		        return false;
		    }
		}
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
