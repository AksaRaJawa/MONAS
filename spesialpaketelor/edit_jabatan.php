<?php
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Jabatan Salesman</h3>
<a class="btn" href="jabatan.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id_jabatan=$_GET['id'];
$det=sqlsrv_query($kon, "select * from jabatan where id_jabatan='$id_jabatan'");
while($d=sqlsrv_fetch_array($det)){
?>
	<form action="update_jabatan.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id_jabatan" value="<?php echo $d['id_jabatan'] ?>"></td>
			</tr>
			<tr>
				<td>Nama Jabatan</td>
				<td><input type="text" class="form-control" name="nama_jabatan" value="<?php echo $d['nama_jabatan'] ?>"></td>
			</tr>
			<tr>
				<td>Butuh Modis?</td>
				<td>
					<?php
					  if($d['butuh_modis'] == "1"){ ?>
						<label>
					    <input type="radio" class="butuh_modis" name="butuh_modis" value="1" checked="checked">
						YA
						</label>
						<label>
						<input type="radio" class="butuh_modis" name="butuh_modis" value="0">
						TIDAK
						</label>
						<?php }
					  else if($d['butuh_modis'] == "0"){ ?>
						<label>
						<input type="radio" class="butuh_modis" name="butuh_modis" value="1" >
						YA
						</label>
						<label>
						<input type="radio" class="butuh_modis" name="butuh_modis" value="0" checked="checked">
						TIDAK
						</label>
					<?php } ?>
				</td>
			</tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>
	</form>
	<?php
}
?>
<?php include 'footer.php'; ?>
