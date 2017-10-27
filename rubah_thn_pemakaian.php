<?php
include "admin/config.php";
date_default_timezone_set('Asia/Jakarta');

    sqlsrv_query ($kon, "UPDATE perangkat_it SET thn_pemakaian = thn_pemakaian+1 ") ;

?>
