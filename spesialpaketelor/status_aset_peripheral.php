<?php
include 'config.php';
$no_aset=$_GET['id'];
$det=sqlsrv_query($kon, "select * from kendaraan_peripheral where no_aset_peripheral='$no_aset'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update kendaraan_peripheral set status='0' where no_aset_peripheral = '$no_aset'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update kendaraan_peripheral set status='1' where no_aset_peripheral = '$no_aset'");
	}
header("location:aset_peripheral.php");
?>
