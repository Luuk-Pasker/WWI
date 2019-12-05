<?php

error_reporting(E_ALL);

//mail ontvanger
$to = $_SESSION['email'];
$subject = "Confirmed payment WWI";
$txt = "Purchase has been succesfull";
$headers = "From: e.stienstra@live.nl" . "\r\n" .
    "CC:";

mail($to, $subject, $txt, $headers);


// body voor de email opmaken


$to = "somebody@example.com, somebodyelse@example.com";
$subject = "HTML email";

$message = "
<html>
<head>
<title>Confirmation of your payment</title>
</head>
<body>
<p> Hello The payment has been confired, you ordered:


</p>

</body>
</html>
";

// email verzenden

$formsent = mail($ontvanger, $hoofd, $body, "From: <$email>");
$replyemail = mail($onderwerp2, $bericht2, "From: <$email>:);
 
 
$body .= "<e.stienstra@live.nl>"; 
$body2 .= "X - Sender: <?????? ?> n";
    $headers2 .= "Return-Path: <?php ?????? ?>n";
$onderwerp2 = "Bedankt u voor uw reactie";
$bericht2 = "Beste <?php $naam ?>,

Bedankt voor uw reactie! Ik neem zo spoedig mogelijk contact met u op via uw e-mailadres, $replyemail .

Groeten,

rene );

}


