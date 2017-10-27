<?php
include 'header_aset.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Cost Center</h3>
<a class="btn" href="cost_center.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id_cc=$_GET['id'];
$det=sqlsrv_query($kon, "select * from cost_center where id_cc='$id_cc'");
while($d=sqlsrv_fetch_array($det)){
?>
	<form action="update_cost_center.php" method="post">
	<td><input type="hidden" name="id_cc" value="<?=$d['id_cc']?>"></td>
	<table class="table">
			<tr>
				<td>ID Cost Center</td>
				<td><input name="id" type="text" class="form-control"  value="<?=$d['id_cc']?>" disabled="disabled"></td>
			</tr>
			<tr>
				<td>Person Responsible</td>
				<td><input name="person_responsible" type="text" class="form-control"  value="<?=$d['person_responsible']?>" autocomplete="off"></td>
			</tr>
			<tr>
				<td>Desc Cost Center</td>
				<td><input name="desc_cc" type="text" class="form-control"  value="<?=$d['desc_cc']?>" autocomplete="off"></td>
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
				<td>Kepala Akun</td>
				<td><input name="kepala_akun" type="text" class="form-control"  value="<?=$d['kepala_akun']?>" autocomplete="off"></td>
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
