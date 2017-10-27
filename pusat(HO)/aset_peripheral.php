<?php include 'header_kendaraan.php';	?>
<?php
$usern = sqlsrv_query($kon, "select * from [user] where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);
?>

<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Aset Peripheral Kendararaan</h3>

<div class="col-md-10">
<button onclick="document.location='lap_aset_peripheral.php'" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Export ke Excel</button>
</div>
<br/>
<br/>
    <div style="overflow-y:auto">

	<div style="width:1600px">

<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
<thead style="color:white;background:#00CED1;" >
  <tr>
		<th class="col-md-0; text-center">No</th>
		<th class="col-md-0; text-center">No. Aset Peripheral</th>
    <th class="col-md-0">Jenis</th>
		<th class="col-md-0">Desc Peripheral</th>
    <th class="col-md-0">No. Aset peripheral</th>
		<th class="col-md-0">Nama Region</th>
		<th class="col-md-0">Nama Depo</th>
		<th class="col-md-0">Profit Center</th>
		<th class="col-md-0">Cost Center</th>
		<th class="col-md-0">User</th>

	</tr>
</thead>
<tbody >
	<?php

		$brg=sqlsrv_query($kon, "select a.*, b.nama_karyawan, b.nama_jabatan, b.nama_depo from kendaraan_peripheral a LEFT JOIN karyawan_perangkat_it b ON a.nik_baru = b.nik_karyawan ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
    $nama = $b['nama_karyawan'];
    $jabatan = $b['nama_jabatan'];
    $depoxx = $b['nama_depo'];
    $dp = $b['nama_depo_peripheral'];
    $depo = strstr($dp," ");
    $ro = $b['nama_region_peripheral'];
    $region = strstr($ro," ");
    $status = $b['status'];
		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
      <td class="text-center">
				<a class="DetailAsetPeripheral" data-toggle="modal" data-target="#detailasetperipheral" data-whatever="<?=$b['no_aset_peripheral']?>"><?php echo $b['no_aset_peripheral']?></a>
			</td>
			<td><?php echo $b['jenis_peripheral'] ?></td>
      <td><?php echo $b['desc_peripheral'] ?></td>
      <td><?php echo $b['no_aset_kendaraan']  ?></td>
      <td><?php echo $region ?></td>
      <td><?php echo $depo ?></td>
      <td><?php echo $b['profit_center_id'] ?></td>
      <td><?php echo $b['cost_center_id'] ?></td>
      <td>
        <a href=""  data-toggle="tooltip" title="<?php echo $nama; echo " == "; echo $jabatan; echo " == "; echo $depoxx;?>" data-placement="top"><?php echo $b['nik_baru'] ?></a>
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
				<h4 class="modal-title">Tambah Aset Peripheral
				</div>
				 <div class="modal-body">
					<form name="myForm" action="tambah_aset_peripheral.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
						<input name="uname" type="hidden" class="form-control" value= "<?=$uu['uname']?>">
						<div id="accordion" class="accordion-style1 panel-group">
						<div class="form-group">
							<label>Gambar (Ukuran Maks = 1 MB)</label>
								<input id="gambar_lama" name="gambar_lama" type="file" class="form-control focus">
						</div>
						<div class="panel panel-default">
						<div class="panel-heading">
								<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseZero">
								<i class="ace-icon fa fa-angle-right bigger-110"></i>
								&nbsp; Detail Aset Peripheral
							    </a>
								</h4>
						</div>
							<div class="panel-collapse collapse" id="collapseZero">
							<div class="panel-body">
								<div class="form-group">
								<label>No. Aset Peripheral</label>
									<input id="no_aset_peripheral" name="no_aset_peripheral" type="text" class="form-control" placeholder="No. Aset" onkeyup = "validAngka(this)" required>
								</div>
								<div class="form-group">
									<label>Jenis Aset</label>
									<select class="form-control autocomplete" id="jenis_peripheral" name="jenis_peripheral" >
									<option value="Box">Box</option>
									</select>
								</div>
                <div class="form-group">
									<label>Desc Peripheral</label>
									<input id="" name="desc_peripheral" type="text" class="form-control" placeholder="Description Peripheral">
								</div>

							</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									<i class="ace-icon fa fa-angle-right bigger-110"></i>
									&nbsp; Cos Center, User, Cap.Date & Acquis Val
									</a>
								</h4>
							</div>
							<div class="panel-collapse collapse" id="collapseOne">
								<div class="panel-body">
									<div class="form-group">
									<label>Cost Center</label>
										<input id="cost_center_id" name="cost_center_id" type="text" class="form-control" placeholder="Cost Center ID" maxlength="10">
									</div>
										<div class="form-group">
												<label>NIK User</label>
												<input name="nik_baru" type="text" class="form-control" placeholder="NIK User" onkeyup="validAngka(this)" maxlength="8">
										</div>
										<div class="form-group">
												<label>Cap. Date</label>
												<input id="cap_date" name="cap_date" type="text" class="form-control" placeholder="Cap. Date" >
										</div>
										<div class="form-group">
												<label>Acquis Val</label>
												<input id="acquis_val" name="acquis_val" type="text" class="form-control" placeholder="Acquis Value" onkeyup="validAngka(this)">
										</div>
								</div>
							</div>
						</div>
            <div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									<i class="ace-icon fa fa-angle-right bigger-110"></i>
									&nbsp; Status Perangkat Status Jual, & Harga Jual
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
									<select class="form-control" id="status_jual" name="status_jual" >
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
  <div id="detailasetperipheral" class="modal fade">
  <div class="modal-dialog">
  <div class="modal-content">

    </div>
  </div>
  </div>
  <?php include 'footer.php'; ?>
  <script language='javascript'>
    function validAngka(angka)
    {
      if(!/^[0-9.]+$/.test(angka.value))
      {
        angka.value = angka.value.substring(0,angka.value.length-1000);
      }
    }
    </script>
<script>
$('.DetailAsetperipheral').click(function(){
	var Detail=$(this).attr('data-whatever');
	$.ajax({url:"detailasetperipheral.php?Detail="+Detail, cache:false, success:function(result){
		$(".modal-content").html(result);
	}});
});
</script>
  <script type="text/javascript">
    $(document).ready(function(){
      //$("#tgl").datepicker($.datepicker.regional["id"]);
      $("#tahun_peripheral").datepicker({dateFormat : 'yy',viewMode: 'years',orientation: 'auto top'});
      $("#cap_date").datepicker({dateFormat : 'dd-M-y'});
      $("#end_date").datepicker({dateFormat : 'dd-M-y'});
    });
  </script>

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
