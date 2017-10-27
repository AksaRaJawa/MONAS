<?php
include 'header_aset.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Profit Center</h3>
<a class="btn" href="profit_center.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$pc=$_GET['id'];
$det=sqlsrv_query($kon, "select * from profit_center where pc='$pc'");
while($d=sqlsrv_fetch_array($det)){
?>
	<form action="update_profit_center.php" method="post">
	<td><input type="hidden" name="pc" value="<?=$d['pc']?>"></td>
	<table class="table">
			<tr>
				<td>ID Profit Center</td>
				<td><input name="id" type="text" class="form-control"  value="<?=$d['pc']?>" disabled="disabled"></td>
			</tr>
			<tr>
				<td>Nama Depo</td>
				<td><input name="nama_depo" type="text" class="form-control"  value="<?=$d['nama_depo']?>" autocomplete="off"></td>
			</tr>
			<tr>
				<td>Nama RO</td>
				<td><input name="nama_ro" type="text" class="form-control"  value="<?=$d['nama_ro']?>" autocomplete="off"></td>
			</tr>
			<tr>
				<td>Market Tipe</td>
				<td><input name="market_tipe" type="text" class="form-control"  value="<?=$d['market_tipe']?>" autocomplete="off"></td>
			</tr>
			<tr>
				<td>Plant Description</td>
				<td><input name="plant_description" type="text" class="form-control"  value="<?=$d['plant_description']?>" autocomplete="off"></td>
			</tr>
			<tr>
				<td>PC Induk</td>
				<td><input name="pc_induk" type="text" class="form-control"  value="<?=$d['pc_induk']?>" autocomplete="off"></td>
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
