<?php

ini_set('SMTP','smtp.zoho.com');
ini_set('smtp_port',465);
ini_set('sendmail_from', 'admin@moderactif.com');

//define the receiver of the email
$to = 'kaushlendra@gmail.com';
//define the subject of the email
$subject = 'Test for title'; 
//define the message to be sent. Each line should be separated with \n
$message = 'Message to send'; 

//define the headers we want passed. Note that they are separated with \r\n
$headers = 'From: info@wranga.in\r\nReply-To: admin@moderactif.com';

//send the email
$mail_sent = mail($to, $subject, $message, $headers);
mail($to, $subject, $message, $headers);

//if the message is sent successfully print "Mail sent correctly". Otherwise print "Mail failed" 
echo $mail_sent ? "Mail sent" : "Mail failed";
?>