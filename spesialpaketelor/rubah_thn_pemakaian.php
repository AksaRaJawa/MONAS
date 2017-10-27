<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$thn_sekarang = date("y");
$cap = sqlsrv_query($kon, "select cap_date from perangkat_it ");
$ulang = 1;
while($cp = sqlsrv_fetch_array($cap))
{
	$capdate = $cp['cap_date'];
	$capd = substr($capdate,7);
	$thn_pemakaian = $thn_sekarang-$capd;
	sqlsrv_query($kon, "UPDATE perangkat_it set thn_pemakaian = '".$thn_pemakaian."'");
	$ulang++;
}
?>
