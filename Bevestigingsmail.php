<?php

error_reporting(E_ALL);
$fullname = $_SESSION['fullname'];

//mail ontvanger
$to = $_SESSION['email'];
$from = 'From: Eva Stienstra<e.stienstra@live.nl>';
$subject = "Confirmed payment WWI";
$message = ?> <b> Confirmation of your payment </b>
<br>
<br>
Purchase has been succesfull!<?php


mail($to, $subject, $message, $headers);

<?php
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@example.com>' . "\r\n";
$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);
?>
// email verzenden



