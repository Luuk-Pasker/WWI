<link rel="stylesheet" type="text/css" href="css/Bevestiging.css">

<?php
include "includes/header.php"
?>

<div class="confirm">
<h2> <img src="images/Check.png" width="35" height="35" alt="check"> Your order has been succesfull! </h2>
    <br>
<p class="textconfirm">
    We are happy that you have made a payment on our website.
    <br>
    If you want to check out more products, go back to the home page!
    <br>
    <br>
    Check your mail to confirm your payment, if you have any questions contact us.
</p>
</div>

<?php
unset($_SESSION["IDs"]);
unset($_SESSION["Names"]);
unset($_SESSION["Quantitys"]);
unset($_SESSION["Prices"]);
unset($_SESSION["Images"]);
unset($_SESSION["Stocks"]);
unset($_SESSION["DealPrices"]);


/*error_reporting(E_ALL);
$ontvanger = "mijn emailu";
$hoofd = "Contactformulier";
$naam = $_POST['naam'];
$telefoon = $_POST['telefoon'];
$email = $_POST['email'];
$onderwerp = $_POST['onderwerp'];
$bericht = $_POST['bericht'];
// body voor de email opmaken
$body = "";
$body .= "Naam: ".$naam. "\n";
$body .= "Telefoon: ".$telefoon. "\n";
$body .= "Email: ".$email. "\n";
$body .= "Onderwerp: ".$onderwerp. "\n";
$body .= "Bericht: ". $bericht. "\n";
// email verzenden
$formsent = mail($ontvanger, $hoofd, $body, "From: <$email>");
$replyemail = mail($onderwerp2,$bericht2,"From: <$email>:");//" vergeten en body zit hier niet in
$body .= "<mijn email>\n";
$body2 .= "X-Sender: <null>\n";
$headers2 .= "Return-Path: <null>\n";
$onderwerp2 .= "Bedankt u voor uw reactie";
$bericht2 .= "Beste $naam,
Bedankt voor uw reactie! Ik neem zo spoedig mogelijk contact met u op via uw e-mailadres, $replyemail .
Groeten,
rene ); //hier zit nog niet alles snor
}";
*/?>

