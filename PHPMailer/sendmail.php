<?php
header('Content-Type: text/html; charset=utf-8');
require 'class.phpmailer.php';
$phpmailer = new PHPMailer;
$phpmailer->isSMTP();
$phpmailer->Host = 'mail.bkmpazarlama.com'; // duzenlenecek
$phpmailer->SMTPAuth = true;
$phpmailer->Username = 'bkmgrup@bkmpazarlama.com'; // duzenlenecek
$phpmailer->Password = 'Wb6X_,[o!psC'; // duzenlenecek
$phpmailer->SMTPSecure = 'tls'; // duzenlenecek
$phpmailer->Port = '587'; // duzenlenecek
$phpmailer->From = 'bkmgrup@bkmpazarlama.com'; // duzenlenecek
$phpmailer->FromName = 'İletişim Formu'; // duzenlenecek
$phpmailer->AddReplyTo($_POST['mail'], $_POST['name']);
$phpmailer->addAddress('haktan.akdag@gmail.com', 'İletişim Formu'); // duzenlenecek
$phpmailer->isHTML(true);
$phpmailer->Subject = "subject deneme";
$phpmailer->Body    = "mesaj deneme";
$phpmailer->CharSet = 'UTF-8';

//$phpmailer->SMTPDebug = 2;
if(!$phpmailer->send()) {
   echo 'Mail gonderilemedi. Hata: ' . $phpmailer->ErrorInfo; 
   exit; 
} 

echo 'Mail gonderildi.'; 
?>