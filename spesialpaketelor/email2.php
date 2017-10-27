	
<?php

date_default_timezone_set('Etc/UTC');
 
//include "../PHPMailer/class.phpmailer.php";
//include "../PHPMailer/class.smtp.php";
//include "../PHPMailer/class.pop3.php";
include "../PHPMailer/PHPMailerAutoload.php";
include "config.php";

$pop = POP3::popBeforeSmtp('mail.garudafood.co.id', 110, 30, 'ahmad.syakur', 'baksobakar', 1); 
$mail = new PHPMailer;
$mail->isSMTP();
//$mail->SMTPDebug = 2;
//$mail->Debugoutput = 'html';
$mail->Host = 'mail.garudafood.co.id';
$mail->Port = 25;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "ahmad.syakur";
$mail->Password = "baksobakar";
$mail->setFrom('ahmad.syakur@snsgroup.co.id', 'Ahmad Syakur');

$msa = sqlsrv_query($kon, "select a.no_imei,a.nama_merk,a.nama_tipe,a.nik_karyawan,a.masa_berlaku, b.nama_karyawan, b.nama_jabatan, c.nama_depo, c.email 
	from asset a 
	LEFT JOIN karyawan b ON a.nik_karyawan = b.nik_karyawan
	LEFT JOIN depo c ON a.id_depo = c.id_depo
	WHERE a.masa_berlaku != ''");
	$ulang=1;
    while($row = sqlsrv_fetch_array($msa))
	{
		$berlaku = $row['masa_berlaku'];
		$depox = strtolower($row['nama_depo']);
		$depo = ucfirst($depox);
		$buatx = explode(" ",$depo);
		$buat = 'Kordam '.$buatx[0].' TM '.$buatx[1].' '.$buatx[2]; 
		$today = date("d-m-Y");
		$kurang3 = date('d-m-Y',strtotime('-3 days',strtotime($berlaku)));
		$kurang2 = date('d-m-Y',strtotime('-2 days',strtotime($berlaku)));
		$kurang1 = date('d-m-Y',strtotime('-1 days',strtotime($berlaku)));
        if($kurang3==$today)
		{ 
			$mail->addAddress($row['email'], 'Helpdesk 03');
			$mail->Subject = 'Test Lagi';
			$mail->Body = "Dear Kordam ".$depo.",
			Cicilan HOP untuk Aset ".$row['nama_merk']." ".$row['nama_tipe']." dengan IMEI : ".$row['no_imei']." akan segera berahir 3 hari lagi sampai dengan tanggal : ".$berlaku.".
			Silahkan konfirmasi kepada Salesman dengan NIK : '".$row['nik_karyawan']."' atas nama : '".$row['nama_karyawan']."' untuk segera melunasinya.";  
			$mail->send();
			/*if (!$mail->send()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
				echo "Message sent!";
			}*/
		}
		 if($kurang2==$today)
		{ 
			$mail->addAddress($row['email'], 'Helpdesk 03');
			$mail->Subject = 'Test Lagi';
			$mail->Body = "Dear Kordam ".$depo.",
			Cicilan HOP untuk Aset ".$row['nama_merk']." ".$row['nama_tipe']." dengan IMEI : ".$row['no_imei']." akan segera berahir 2 hari lagi sampai dengan tanggal : ".$berlaku.".
			Silahkan konfirmasi kepada Salesman dengan NIK : '".$row['nik_karyawan']."' atas nama : '".$row['nama_karyawan']."' untuk segera melunasinya.";  
			$mail->send();
		}
		 if($kurang1==$today)
		{ 
			$mail->addAddress($row['email'], 'Helpdesk 03');
			$mail->Subject = 'Test Lagi';
			$mail->Body = "Dear Kordam ".$depo.",
			Cicilan HOP untuk Aset ".$row['nama_merk']." ".$row['nama_tipe']." dengan IMEI : ".$row['no_imei']." akan segera berahir 1 hari lagi sampai dengan besok, tanggal :".$berlaku.".
			Silahkan konfirmasi kepada Salesman dengan NIK : '".$row['nik_karyawan']."' atas nama : '".$row['nama_karyawan']."' untuk segera melunasinya.";  
			$mail->send();
		}
		$ulang++;	
	}


?>