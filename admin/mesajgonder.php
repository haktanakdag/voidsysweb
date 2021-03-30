<?php
$mail = $_POST['eposta'];
$name = $_POST['adsoyad'];
$telefon = $_POST['telefon'];
$subject=" Web Sitesinden gelen mail";
$text = $_POST['mesaj'];

 $to = "haktan.akdag@gmail.com";
 $message =" web sitesinden ".$name." kişisinden gelen mail ".$mail;
 $message .=" Mesaj : ".$text;
 $message .= " Mesajı ileten kişinin telefon numarası =".$telefon;

 if(mail($to, $subject,$message)){
	echo "Mesajiniz gönderilmiştir.";
} 
else{ 
	echo "Hata!!";
}
?>