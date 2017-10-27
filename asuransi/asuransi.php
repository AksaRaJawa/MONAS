<?php include 'header.php';	?>
<?php
$usern = sqlsrv_query($kon, "select * from [user] where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);
?>

<link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
<h3><span class="glyphicon glyphicon-book"></span>  Data Asuransi Kendaraan</h3>


<button  data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span> Tambah</button>
<div class="col-md-10">
<button onclick="location.href='import_asuransi.php?uname=<?php echo $_SESSION['uname'];?>'" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Import dari Excel</button>

<!--<button onclick="document.location='lap_asuransi.php'" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Export ke Excel</button>-->
</div>
<br/>
<br/>
    <div style="overflow-y:auto">

	<div style="width:1800px">

<table id="lookup1" class="table table-nomargin table-bordered" width="100%">
<thead style="color:white;background:#00CED1;" >
  <tr>
		<th class="col-md-0; text-center">No</th>
		<th class="col-md-0; text-center">No. Polis Asuransi</th>
    <th class="col-md-0">No. Polisi</th>
		<th class="col-md-0">Note Leasing</th>
		<th class="col-md-0">Status</th>
		<th class="col-md-0">NIK & Nama User</th>
		<th class="col-md-0">Depo</th>
		<th class="col-md-0">Region</th>
		<th class="col-md-0">Awal Asuransi</th>
    <th class="col-md-0">Akhir Asuransi</th>
    <!--<th class="col-md-0">No. Rangka</th>
    <th class="col-md-0">No. Mesin</th>
    <th class="col-md-0">Merk & Type</th>
    <th class="col-md-0">Warna</th>
    <th class="col-md-0">Tahun</th>-->
    <th class="col-md-0">Biaya Asuransi</th>
    <th class="col-md-0 text-center">Opsi</th>

	</tr>
</thead>
<tbody >
	<?php

		$brg=sqlsrv_query($kon, "select a.*, b.nama_karyawan from asuransi_kendaraan a LEFT JOIN karyawan_perangkat_it b ON a.nik_user = b.nik_karyawan ");

	$no=1;
	while($b=sqlsrv_fetch_array($brg)){
    $depo = $b['nama_depo'];
    //$depo = strstr($dp," ");
    $region = $b['nama_region'];
    //$region = strstr($ro," ");
    $status = $b['status'];
		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
      <td><?php echo $b['no_asuransi'] ?></td>
      <td class="text-center">
				<a class="DetailKendaraan" data-toggle="modal" data-target="#detailkendaraan" data-whatever="<?=$b['no_polisi']?>"><?php echo $b['no_polisi']?></a>
			</td>
			<td><?php echo $b['note_leasing'] ?></td>
      <td><?php echo $b['status_kendaraan'] ?></td>
      <td><?php echo $b['nik_user']  ?> : <?php echo $b['nama_karyawan']  ?></td>
      <td><?php echo $depo ?></td>
      <td><?php echo $region ?></td>
      <td><?php echo $b['awal_asuransi'] ?></td>
      <td><?php echo $b['akhir_asuransi'] ?></td>
      <td class="text-center">
				<a class="DetailBiaya" data-toggle="modal" data-target="#detailbiaya" data-whatever="<?=$b['no_rangka']?>">Cek Biaya</a>
			</td>
      <td>
				<a href="edit_asuransi.php?id=<?php echo $b['no_rangka']; ?>" class="btn btn-warning">Edit</a>
				<a href="status_asuransi.php?id=<?php echo $b['no_rangka']; ?>" name="status" class="btn btn-plus"><?php if($status=='1'){ echo "Non-Aktifkan"; }else if($status=='0'){ echo "Aktifkan";}?></a>
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
				<h4 class="modal-title">Tambah Asuransi Kendaraan
				</div>
				 <div class="modal-body">
					<form name="myForm" action="tambah_asuransi.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
						<input name="uname" type="hidden" class="form-control" value= "<?=$uu['uname']?>">
						<div id="accordion" class="accordion-style1 panel-group">
						<div class="panel panel-default">
						<div class="panel-heading">
								<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseZero">
								<i class="ace-icon fa fa-angle-right bigger-110"></i>
								&nbsp; Detail Kendaraan
							    </a>
								</h4>
						</div>
							<div class="panel-collapse collapse" id="collapseZero">
							<div class="panel-body">
								<div class="form-group">
								<label>No. Polisi</label>
									<input id="no_polisi" name="no_polisi" type="text" class="form-control" placeholder="No. Polisi"  required>
								</div>
                <div class="form-group">
                <label>No. Rangka</label>
									<input id="no_rangka" name="no_rangka" type="text" class="form-control" placeholder="No. Rangka"  required>
								</div>
                <div class="form-group">
                <label>No. Mesin</label>
									<input id="no_mesin" name="no_mesin" type="text" class="form-control" placeholder="No. Mesin"  required>
								</div>
                <div class="form-group">
                <label>Nama Merk</label>
									<input id="nama_merk" name="nama_merk" type="text" class="form-control" placeholder="Merk Kendaraan"  >
								</div>
                <div class="form-group">
                <label>Nama Type</label>
									<input id="nama_tipe" name="nama_tipe" type="text" class="form-control" placeholder="Tipe Kendaraan"  >
								</div>
                <div class="form-group">
                <label>Warna Kendaraan</label>
									<input id="warna_kendaraan" name="warna_kendaraan" type="text" class="form-control" placeholder="Warna Kendaraan"  >
								</div>
                <div class="form-group">
                <label>Tahun</label>
									<input id="tahun_kendaraan" name="tahun_kendaraan" type="text" class="form-control" value=""  placeholder="Tahun Kendaraan">
								</div>
                <div class="form-group">
                <label>No. STNK</label>
									<input id="no_stnk" name="no_stnk" type="text" class="form-control" placeholder="No. STNK"  >
								</div>
                <div class="form-group">
                <label>Tanggal STNK</label>
									<input id="tanggal_stnk" name="tanggal_stnk" type="text" class="form-control" placeholder="Tanggal STNK"   >
								</div>
								<div class="form-group">
									<label>Status</label>
									<select class="form-control autocomplete" id="status_kendaraan" name="status_kendaraan" >
									<option value="OPR">- Pilih Status -</option>
                  <option value="OPR"> OPR </option>
                  <option value="MOP"> MOP </option>
                  <option value="COP"> COP </option>
									</select>
								</div>
                <div class="form-group">
								<label>NIK User</label>
									<input id="" name="nik_user" type="text" class="form-control"  placeholder="NIK User" maxlength="8" onkeyup="validAngka(this)">
								</div>
							</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									<i class="ace-icon fa fa-angle-right bigger-110"></i>
									&nbsp; Detail Biaya Asuransi
									</a>
								</h4>
							</div>
							<div class="panel-collapse collapse" id="collapseOne">
								<div class="panel-body">
									<div class="form-group">
									<label>No. Polis Asuransi</label>
										<input id="no_asuransi" name="no_asuransi" type="text" class="form-control" placeholder="No. Polis Asuransi" onkeyup="validAngka(this)">
									</div>
                  <div class="form-group">
                    <label>Note Leasing</label>
                    <select class="form-control autocomplete" id="note_leasing" name="note_leasing" >
                    <option value="">- Pilih Note Leasing -</option>
                      <?php
                      $dp=sqlsrv_query($kon, "select * from asuransi_leasing where status = '1'");
                      while($rw=sqlsrv_fetch_array($dp)){
                        echo'<option value="'.$rw['nama_note'].'">'.$rw['nama_note'].'</option> ';
                      }
                      ?>
                    </select>
                  </div>
										<div class="form-group">
												<label>Awal Asuransi</label>
												<input id="awal_asuransi" name="awal_asuransi" type="text" class="form-control" placeholder="Tanggal Awal Asuransi" >
										</div>
                    <div class="form-group">
                        <label>Akhir Asuransi</label>
                        <input id="akhir_asuransi" name="akhir_asuransi" type="text" class="form-control" placeholder="Tanggal Akhir Asuransi" >
                    </div>
										<div class="form-group">
												<label>Biaya Admin</label>
												<input id="biaya_admin" name="biaya_admin" type="text" class="form-control" placeholder="Biaya Admin" onkeyup="validAngka(this)">
										</div>
                    <div class="form-group">
												<label>Biaya Comprehensive</label>&nbsp;&nbsp;
												<input id="jumlah_biaya_comprehensive" name="jumlah_biaya_comprehensive" type="text" class="form-control-static" placeholder="Biaya " onkeyup="validAngka(this)" >
                        <input id="persen_biaya_comprehensive" name="persen_biaya_comprehensive" type="text" class="form-control-static" placeholder="Persen "  >&nbsp;&nbsp;<label>%</label>
										</div>
                    <div class="form-group">
                        <label>Biaya Gempa Bumi</label>&nbsp;&nbsp;
                        <input id="jumlah_biaya_gempa_bumi" name="jumlah_biaya_gempa_bumi" type="text" class="form-control-static" placeholder="Biaya " onkeyup="validAngka(this)" >
                        <input id="persen_biaya_gempa_bumi" name="persen_biaya_gempa_bumi" type="text" class="form-control-static" placeholder="Persen "  >&nbsp;&nbsp;<label>%</label>
                    </div>
                    <div class="form-group">
                        <label>Biaya Banjir & Angin Topan</label>&nbsp;&nbsp;
                        <input id="jumlah_biaya_banjir_angin_topan" name="jumlah_biaya_banjir_angin_topan" type="text" class="form-control-static" placeholder="Biaya " onkeyup="validAngka(this)" >
                        <input id="persen_biaya_banjir_angin_topan" name="persen_biaya_banjir_angin_topan" type="text" class="form-control-static" placeholder="Persen "  >&nbsp;&nbsp;<label>%</label>
                    </div>
                    <div class="form-group">
                        <label>Biaya Huru Hara</label>&nbsp;&nbsp;
                        <input id="jumlah_biaya_huru_hara" name="jumlah_biaya_huru_hara" type="text" class="form-control-static" placeholder="Biaya " onkeyup="validAngka(this)" >
                        <input id="persen_biaya_huru_hara" name="persen_biaya_huru_hara" type="text" class="form-control-static" placeholder="Persen "  >&nbsp;&nbsp;<label>%</label>
                    </div>
                    <div class="form-group">
                        <label>Biaya Pihak Ke-3</label>&nbsp;&nbsp;
                        <input id="jumlah_pihak_ke_3" name="jumlah_pihak_ke_3" type="text" class="form-control-static" placeholder="Biaya " onkeyup="validAngka(this)" >
                        <input id="persen_pihak_ke_3" name="persen_pihak_ke_3" type="text" class="form-control-static" placeholder="Persen "  >&nbsp;&nbsp;<label>%</label>
                    </div>
                    <div class="form-group">
                        <label>Biaya Terorisme & Sabotase</label>&nbsp;&nbsp;
                        <input id="jumlah_terorisme_sabotase" name="jumlah_terorisme_sabotase" type="text" class="form-control-static" placeholder="Biaya " onkeyup="validAngka(this)" >
                        <input id="persen_terorisme_sabotase" name="persen_terorisme_sabotase" type="text" class="form-control-static" placeholder="Persen "  >&nbsp;&nbsp;<label>%</label>
                    </div>
                    <div class="form-group">
												<label>Keterangan</label>
												<input id="keterangan" name="keterangan" type="text" class="form-control" placeholder="Keterangan Tambahan" >
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
					</div>

				</form>
			</div>
		</div>
	</div>
  <div id="detailkendaraan" class="modal fade">
  <div class="modal-dialog">
  <div class="modal-content">

    </div>
  </div>
  </div>
  <div id="detailbiaya" class="modal fade">
  <div class="modal-dialog">
  <div class="modal-content">

    </div>
  </div>
  </div>
  <?php include 'footer.php'; ?>

<script>
$('.DetailKendaraan').click(function(){
	var Detail=$(this).attr('data-whatever');
	$.ajax({url:"detailkendaraan.php?Detail="+Detail, cache:false, success:function(result){
		$(".modal-content").html(result);
	}});
});
</script>

<script>
$('.DetailBiaya').click(function(){
	var Detail=$(this).attr('data-whatever');
	$.ajax({url:"detailbiaya.php?Detail="+Detail, cache:false, success:function(result){
		$(".modal-content").html(result);
	}});
});
</script>


  <script type="text/javascript">
    $(document).ready(function(){
      //$("#tgl").datepicker($.datepicker.regional["id"]);
      //$("#tahun_kendaraan").datepicker({dateFormat : 'yy',viewMode: 'years',orientation: 'auto top'});
      $("#tanggal_stnk").datepicker({dateFormat : 'dd-M-y'});
      $("#awal_asuransi").datepicker({dateFormat : 'dd-M-y'});
      $("#akhir_asuransi").datepicker({dateFormat : 'dd-M-y'});
    });
  </script>
  <script type="text/javascript">
      function ChangesBiaya(){
      var fr = document.getElementById('id_biaya').value;
      var xr = String(fr);
      if(xr=='1')
      {
        document.getElementById('jumlah_biaya_comprehensive').show();
      }

      };
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
