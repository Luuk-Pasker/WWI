<?php
include "includes/header.php";
$tekst = "";
$tekst =  "$tekst You have ordered:";
foreach ($_SESSION["IDs"] as $index => $val) {
    $ItemPrice = number_format($_SESSION["Prices"][$index] * $_SESSION["Quantitys"][$index], 2);
    $name = $_SESSION["Names"][$index];
    $amount = $_SESSION["Quantitys"][$index];
    $price = $_SESSION["Prices"][$index];
    $tekst = "$tekst<br>$amount $name €$ItemPrice";
}
$totalprice = number_format($_SESSION["TotalPrice"], 2);
$tekst = "$tekst<br>The totalprice is €$totalprice";
print($tekst);