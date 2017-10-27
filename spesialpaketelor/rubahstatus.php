
<?php
sqlsrv_query($kon, "UPDATE perangkat_it set status_jual = 'Siap dijual' WHERE thn_pemakaian >4");
?>
