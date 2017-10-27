<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$tampil = sqlsrv_query($kon, "select id_cc, desc_cc, nama_depo, nama_ro from cost_center where id_pc = '$_POST[id_pc]' ", $param, $option);
$jml = sqlsrv_num_rows($tampil);
if($jml>0)
{
	echo "<option selected>- Pilih Cost Center -</option>";
	while($r=sqlsrv_fetch_array($tampil))
	{
		echo"<option value=$r[id_cc]>$r[id_cc] --- $r[desc_cc]</option>";
	}
}else {
	echo "<option selected>- Data Tidak Ada, Pilih Profit Center yang Lain. -</option>";
}
?>
