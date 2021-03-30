<?php
extract($_POST);
extract($_GET);
header('Content-Type: text/html; charset=utf-8');
require '../PHPMailer/class.phpmailer.php';
$phpmailer = new PHPMailer;
$phpmailer->isSMTP();
$phpmailer->Host = 'smtp.yandex.com.tr'; // duzenlenecek
$phpmailer->SMTPAuth = true;
$phpmailer->Username = 'info@haktanakdag.com'; // duzenlenecek
$phpmailer->Password = '1234567'; // duzenlenecek
$phpmailer->SMTPSecure = 'ssl'; // duzenlenecek
$phpmailer->Port = '465'; // duzenlenecek
$phpmailer->CharSet = "utf-8";
$phpmailer->From = 'info@haktanakdag.com'; // duzenlenecek
$phpmailer->FromName = 'Voidev İletişim Formu'; // duzenlenecek
$phpmailer->AddReplyTo($eposta, $adsoyad);
$phpmailer->addAddress('haktan.akdag@gmail.com', 'İletişim Formu'); // duzenlenecek
$phpmailer->isHTML(true);
$phpmailer->Subject = "Voidev iletisim formundan mesaj".date();
$mesaj = $mesaj." Bu mesajı gönderen kişinin telefon numarası : ".$telefon ." Eposta adresi : ". $eposta;

$phpmailer->Body    = $mesaj;
$phpmailer->CharSet = 'UTF-8';

//$phpmailer->SMTPDebug = 2;
if(!$phpmailer->send()) {
   echo 'Mail gonderilemedi. Hata: ' . $phpmailer->ErrorInfo; 
   exit; 
} 

echo 'Mail gonderildi.'; 
?>