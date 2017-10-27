<?php
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Jenis Biaya Asuransi</h3>
<a class="btn" href="jenis.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id=$_GET['id'];
$det=sqlsrv_query($kon, "select * from asuransi_jenis where id_jenis_biaya='$id'");
while($d=sqlsrv_fetch_array($det)){
?>
	<form action="update_jenis.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id_jenis_biaya" value="<?php echo $d['id_jenis_biaya'] ?>"></td>
			</tr>
			<tr>
				<td>Nama Biaya Asuransi</td>
				<td><input type="text" class="form-control" name="nama_jenis_biaya" value="<?php echo $d['nama_jenis_biaya'] ?>"></td>
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
