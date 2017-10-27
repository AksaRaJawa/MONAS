<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Merk Device</h3>
<a class="btn" href="merk.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id_merk=$_GET['id'];
$det=sqlsrv_query($kon, "select * from merk where id_merk='$id_merk'");
while($d=sqlsrv_fetch_array($det)){
?>					
	<form action="update_merk.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id_merk" value="<?php echo $d['id_merk'] ?>"></td>
			</tr>
			<tr>
				<td>Nama Merk</td>
				<td><input type="text" class="form-control" name="nama_merk" value="<?php echo $d['nama_merk'] ?>"></td>
			</tr>
			<tr>
				<td>Nama Tipe</td>
				<td><input type="text" class="form-control" name="nama_tipe" value="<?php echo $d['nama_tipe'] ?>"></td>
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