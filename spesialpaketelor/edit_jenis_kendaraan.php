<?php
include 'header_kendaraan.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Jenis Kendaraan</h3>
<a class="btn" href="jenis_kendaraan.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id=$_GET['id'];
$det=sqlsrv_query($kon, "select * from kendaraan_jeniskendaraan where id_jenis_kendaraan='$id'");
while($d=sqlsrv_fetch_array($det)){
?>
	<form action="update_jenis_kendaraan.php" method="post">
	<td><input type="hidden" name="id_jenis_kendaraan" value="<?=$d['id_jenis_kendaraan']?>"></td>
	<table class="table">
			<tr>
				<td>Nama Jenis Kendaraan</td>
				<td><input name="nama_jenis_kendaraan" type="text" class="form-control"  value="<?=$d['nama_jenis_kendaraan']?>" ></td>
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
