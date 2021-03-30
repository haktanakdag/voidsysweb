<?php
	$mail = $_POST['mail'];
	$name = $_POST['name'];
	$subject = $_POST['subject'];
	$text = $_POST['text'];
	
 $to = "haktan.akdag@gmail.com";
 $message =" haktanakdag.com dan gelen mail ".$mail;
 $message .=" Mesaj : ".$text;

 if(mail($to, $subject,$message)){
	echo "Mesajiniz gönderilmiştir.";
} 
else{ 
	echo "Hata!!";
}
?>