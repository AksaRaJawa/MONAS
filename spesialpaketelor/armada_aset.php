<?php
include 'header_kendaraan.php';
include "config.php";
?>
<?php
$usern = sqlsrv_query($kon, "select * from admin where uname = '".$_SESSION['uname']."'");
$uu = sqlsrv_fetch_array($usern);

?>
    <script src="../assets/js/Chart.js"></script>
    <script src="../assets/js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../assets/js/highcharts.js" type="text/javascript"></script>
    <script src="../assets/js/highcharts-3d.js" type="text/javascript"></script>
    <script src="../assets/js/exporting.js" type="text/javascript"></script>
<div style="margin-top:10px;background-color:#DF7401;width:100%;display:block;float:left; color:#fff; font-family:Georgia; font-weight:bold; font-size:24px; text-align:center; margin-bottom:20px;">
SELAMAT DATANG : <?=$uu['uname']?> <br />
==================================<br />
TOOLS MONITORING ASET KENDARAAN -- SNS
</div>
<div style="font-family:Lucida Sans;  font-weight:bold; font-size:16px;">
    Hak Akses Anda : ADMINISTRATOR
</div>
<?php
include 'footer.php';

?>
