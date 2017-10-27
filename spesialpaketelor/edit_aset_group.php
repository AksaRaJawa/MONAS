<?php
include 'header_aset.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Aset Group</h3>
<a class="btn" href="merk.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id_group=$_GET['id'];
$det=sqlsrv_query($kon, "select * from aset_group where id_group='$id_group'");
while($d=sqlsrv_fetch_array($det)){
?>
	<form action="update_aset_group.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id_group" value="<?php echo $d['id_group'] ?>"></td>
			</tr>
			<tr>
				<td>ID Group</td>
				<td><input type="text" class="form-control" name="id" value="<?php echo $d['id_group'] ?>" disabled="disabled"></td>
			</tr>
			<tr>
				<td>Nama Group</td>
				<td><input type="text" class="form-control" name="nama_group" value="<?php echo $d['nama_group'] ?>"></td>
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
