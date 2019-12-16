<?php
$okMail=
'Dear Costumer,
   
Thank you for your order. We will send it as soon as possible. If there is something wrong with your order, feel free to contact us. 
All information you need is on our website. Here you have the invoice, witch is also your warranty.

Greetings WWI

';


$tekst ="You have ordered:
";

foreach ($_SESSION["IDs"] as $index => $val) {
    $ItemPrice = number_format($_SESSION["Prices"][$index] * $_SESSION["Quantitys"][$index], 2);
    $name = $_SESSION["Names"][$index];
    $amount = $_SESSION["Quantitys"][$index];
    $price = $_SESSION["Prices"][$index];
    $tekst = "$tekst
$amount. $name €$ItemPrice";
}
$totalprice = number_format($_SESSION["TotalPrice"], 2);
$tekst = "$tekst 
The totalprice is €$totalprice";


$okMail= "$okMail $tekst";
?>