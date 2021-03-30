<html>
<head>
<title>PHPMailer - Mail() basic test</title>
</head>
<body>

<?php

require_once('../class.phpmailer.php');

$mail             = new PHPMailer(); // defaults to using php "mail()"

$body             = "ASDASDASDASDASDAS";
$body             = preg_replace('/[\]/','',$body);

$mail->SetFrom('haktan@haktanakdag.com.com', 'H A');

$mail->AddReplyTo("haktan@haktanakdag.com.com","H A");

$address = "haktan.akdag@gmail.com";
$mail->AddAddress($address, "HA");

$mail->Subject    = "PHPMailer Test Subject via mail(), basic";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>

</body>
</html>
