<?php
$okMail=

"Dear customer,

Thank you for your purchase. We will send the product as soon as possible. 
If the order is incomplete or not functioning properly, feel free to contact us. See the website for the info.
The invoice is enclosed in this e-mail. The invoice may be used for your warranty.

Kind regards,
             
WWI.



";


$tekst ="
You have ordered:
";

foreach ($_SESSION["IDs"] as $index => $val) {
    $ItemPrice = number_format($_SESSION["Prices"][$index] * $_SESSION["Quantitys"][$index], 2);
    $name = $_SESSION["Names"][$index];
    $amount = $_SESSION["Quantitys"][$index];
    $price = $_SESSION["Prices"][$index];
    $tekst = "$tekst
Amount: $amount                    Name of product: $name                                Itemprice: €$ItemPrice";
}
$totalprice = number_format($_SESSION["TotalPrice"], 2);
$tekst = "$tekst 

The totalprice is €$totalprice";


$okMail= "$okMail $tekst";
?>