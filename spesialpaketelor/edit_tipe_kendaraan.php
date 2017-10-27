<?php
include 'header_kendaraan.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Tipe Kendaraan</h3>
<a class="btn" href="tipe_kendaraan.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id=$_GET['id'];
$det=sqlsrv_query($kon, "select * from kendaraan_tipekendaraan where id_tipe_kendaraan='$id'");
while($d=sqlsrv_fetch_array($det)){
?>
	<form action="update_tipe_kendaraan.php" method="post">
	<td><input type="hidden" name="id_tipe_kendaraan" value="<?=$d['id_tipe_kendaraan']?>"></td>
	<table class="table">
			<tr>
				<td>Nama Tipe Kendaraan</td>
				<td><input name="nama_tipe_kendaraan" type="text" class="form-control"  value="<?=$d['nama_tipe_kendaraan']?>" ></td>
			</tr>
			<tr>
				<td>Detail Tipe Kendaraan</td>
				<td><input name="detail_tipe_kendaraan" type="text" class="form-control"  value="<?=$d['detail_tipe_kendaraan']?>" ></td>
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
