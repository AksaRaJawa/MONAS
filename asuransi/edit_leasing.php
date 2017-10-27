<?php
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Vendor Leasing</h3>
<a class="btn" href="leasing.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id=$_GET['id'];
$det=sqlsrv_query($kon, "select * from asuransi_leasing where id_leasing='$id'");
while($d=sqlsrv_fetch_array($det)){
?>
	<form action="update_leasing.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id_leasing" value="<?php echo $d['id_leasing'] ?>"></td>
			</tr>
			<tr>
				<td>Nama Vendor Leasing</td>
				<td><input type="text" class="form-control" name="nama_leasing" value="<?php echo $d['nama_leasing'] ?>"></td>
			</tr>
			<tr>
				<td>Note Leasing</td>
				<td><input type="text" class="form-control" name="nama_note" value="<?php echo $d['nama_note'] ?>"></td>
				
			</tr>
			<tr>
				<td>Nama Bank Leasing</td>
				<td><input type="text" class="form-control" name="nama_bank" value="<?php echo $d['nama_bank'] ?>"></td>
			</tr>
			<tr>
				<td>Rekening Leasing</td>
				<td><input type="text" class="form-control" name="no_rekening" value="<?php echo $d['no_rekening'] ?>"></td>
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
