<html>
<head>
<title>PHPMailer - SMTP basic test with authentication</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('America/Toronto');

require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();
$mail->SMTPDebug = 2;
$body             = "ASDASDASDASDASDASDASDSADASDASDASDASD";
//$body             = preg_replace('/[\]/','',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.bkmpazarlama.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = false;                  // enable SMTP authentication
$mail->Host       = "mail.bkmpazarlama.com"; // sets the SMTP server
$mail->Port       = 26;                    // set the SMTP port for the GMAIL server
$mail->Username   = "bkmgrup@bkmpazarlama.com"; // SMTP account username
$mail->Password   = "Wb6X_,[o!psC";        // SMTP account password

$mail->SetFrom('bkmgrup@bkmpazarlama.com');

$mail->AddReplyTo("bkmgrup@bkmpazarlama.com");

$mail->Subject    = "PHPMailer Test Subject via smtp, basic with authentication";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "haktan.akdag@gmail.com";
$mail->AddAddress($address, "HA");

$mail->AddAttachment("images/phpmailer.gif");      // attachment
$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>

</body>
</html>
