	
<?php

date_default_timezone_set('Etc/UTC');
 
//include "PHPMailer/class.phpmailer.php";
//include "PHPMailer/class.smtp.php";
//include "PHPMailer/class.pop3.php";
include "PHPMailer/PHPMailerAutoload.php";
include "admin/config.php";

$pop = POP3::popBeforeSmtp('mail.garudafood.co.id', 110, 30, 'admin.support', 'B1nt@r010@', 0); 
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'mail.garudafood.co.id';
$mail->Port = 25;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "admin.support";
$mail->Password = "B1nt@r010@";
$mail->setFrom('admin.support@snsgroup.co.id', 'Admin Support');

$msa = sqlsrv_query($kon, "select a.no_imei,a.nama_merk,a.nama_tipe,a.nik_karyawan,a.masa_berlaku, b.nama_karyawan, b.nama_jabatan, c.nama_depo, c.nama_region
	from asset a 
	LEFT JOIN karyawan b ON a.nik_karyawan = b.nik_karyawan
	LEFT JOIN depo c ON a.id_depo = c.id_depo
	WHERE a.masa_berlaku != ''");
	$ulang=1;
    while($row = sqlsrv_fetch_array($msa))
	{
		$berlaku = $row['masa_berlaku'];
		$regionx = strtolower($row['nama_region']);
		$region = ucfirst($regionx);
		$today = date("d-m-Y");
		$kurang3 = date('d-m-Y',strtotime('-25 days',strtotime($berlaku)));
		//$kurang2 = date('d-m-Y',strtotime('-2 days',strtotime($berlaku)));
		$file = 'Form pengajuan perangkat modis.xlsx';
		//$kurang1 = date('d-m-Y',strtotime('-1 days',strtotime($berlaku)));
        if($kurang3==$today)
		{ 
			$mail->addAddress('ahmad.syakur@snsgroup.co.id', 'Ahmad Syakur');
			$mail->Subject = 'Cicilan HOP Aset Modis (Percobaan)';
			$mail->Body = "Dear Bapak/Ibu HC Region,
			
Dengan email ini kami ingin menginformasikan bahwa Cicilan HOP aset modis salesman dengan rincian
 
Nik  Salesman	: ".$row['nik_karyawan']."
Nama Salesman	: ".$row['nama_karyawan']."
Tipe Asset		: ".$row['nama_merk']." ".$row['nama_tipe']."
Imei Asset		: ".$row['no_imei']."
Depo			: ".$row['nama_depo']."
 
Akan segera berakhir '25 hari lagi' sampai tanggal ".$berlaku.". Dengan berakhirnya cicilan HOP tersebut, silahkan di ajukan aset modis baru ke team IT HO dengan format terlampir.
 
 
Terimakasih
 
 
Helpdesk Aplikasi Modis Tools";
$mail->addAttachment($file);  
		$mail->send();
		}
		$ulang++;	
	}


?>