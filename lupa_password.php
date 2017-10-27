<?php
date_default_timezone_set('Asia/Jakarta');
include "PHPMailer/PHPMailerAutoload.php";
include "admin/config.php";
$nik = $_POST['nik'];
$username = $_POST['username'];
$email = $_POST['email'];
$subjek = "PASSWORD MODIS TOOLS";

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

$sql = sqlsrv_query($kon, "select pass, nama_lengkap where uname = $nik ", $param, $option);
$isi = sqlsrv_num_rows($sql);
$sqlx = sqlsrv_fetch_array($sql);
$namalengkap = $qlx['nama_lengkap'];
$pass = base64_decode($sqlx['pass']);

if($isi==0)
{
    echo"<script>alert('MAAF, NIK Anda tidak terdaftar di Modis Tools. Silahkan hubungi IT HO untuk penambahan akun. Terimakasih');history.go(-1)</script>";
}
else {
  $mail->addAddress($email, $username);
  $mail->Subject = $subjek;
  $mail->Body = "Dear Bapak/Ibu ".$username.",

  Dengan email ini kami ingin menginformasikan bahwa password untuk
  NIK	: ".$nik."
  Nama Lengkap : ".$namalengkap.", adalah : ".$pass.".

  Tolong disimpan dan diingat dengan sebaik-baiknya.

  

  Terimakasih


  Helpdesk Aplikasi Modis Tools";
  $mail->send();

}


?>
