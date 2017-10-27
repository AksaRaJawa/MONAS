<?php
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Depo & Region</h3>
<a class="btn" href="depo.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id_depo=$_GET['id'];
$det=sqlsrv_query($kon, "select * from depo where id_depo='$id_depo'");
while($d=sqlsrv_fetch_array($det)){
?>
	<form action="update_depo.php" method="post">
		<table class="table">
			<input type="hidden" name="id_depo" value="<?php echo $d['id_depo'] ?>">
			<tr>
				<td>Kode Depo</td>
				<td><input type="text" class="form-control" name="depo" value="<?php echo $d['id_depo'] ?>" disabled = "disabled"></td>
			</tr>
			<tr>
				<td>Nama Depo</td>
				<td><input type="text" class="form-control" name="nama_depo" value="<?php echo $d['nama_depo'] ?>"></td>
			</tr>
			<tr>
				<td>Nama Region</td>
				<td><input type="text" class="form-control" name="nama_region" value="<?php echo $d['nama_region'] ?>"></td>
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
