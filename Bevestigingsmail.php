<?php

error_reporting(E_ALL);
$fullname = $_SESSION['fullname'];

//mail ontvanger
$to = $_SESSION['email'];
$subject = "Confirmed payment WWI";
$txt = "Purchase has been succesfull";
$headers = "From: e.stienstra@live.nl" . "\r\n" .
    "CC:";

mail($to, $subject, $txt, $headers);


// body voor de email opmaken
$message = print("this");
?>
<html>
<head>
    <title> Confirmation of your payment </title>
</head>
<body>
<p> Hello <?php print($fullname); ?>
<br>
<br>
The payment has been confirmed, you ordered:

</p>

</body>
</html>

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



