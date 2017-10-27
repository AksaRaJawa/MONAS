<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Kepemilikan Device</h3>
<a class="btn" href="kepemilikan.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id_kepemilikan=$_GET['id'];
$det=sqlsrv_query($kon, "select * from kepemilikan where id_kepemilikan='$id_kepemilikan'");
while($d=sqlsrv_fetch_array($det)){
?>					
	<form action="update_kepemilikan.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id_kepemilikan" value="<?php echo $d['id_kepemilikan'] ?>"></td>
			</tr>
			<tr>
				<td>Kepemilikan</td>
				<td><input type="text" class="form-control" name="nama_kepemilikan" value="<?php echo $d['nama_kepemilikan'] ?>"></td>
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