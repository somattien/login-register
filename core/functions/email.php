<?php


require 'phpmailer/PHPMailerAutoload.php';

function email($to, $body){
//tu them1
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                                     // Enable verbose debug output

$mail->isSMTP();                                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                                     // Enable SMTP authentication
$mail->Username = 'somattien@gmail.com';                    // SMTP username
$mail->Password = '824301datty';                            // SMTP password
$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                          // TCP port to connect to

$mail->setFrom('somattien.dl@gmail.com', 'Mailer');         //$mail->setFrom('from@example.com', 'Mailer');
$mail->addAddress($to, 'Somattien');    // Add a recipient
$mail->addAddress('ellen@example.com');                     // Name is optional
$mail->addReplyTo('info@example.com', 'Information');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');

$mail->addAttachment('/var/tmp/file.tar.gz');               // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');          // Optional name
$mail->isHTML(true);                                        // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = $body;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//if(!$mail->send()) {
//    echo 'Message could not be sent. <br>';
//    echo 'Mailer Error: ' . $mail->ErrorInfo;
//} else {
//    echo 'Message has been sent';
//}
//tu them2
}

?>