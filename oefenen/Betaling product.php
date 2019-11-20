<!DOCTYPE html>
<html>

<head>
    <title>Betaling product</title>
    <link rel="stylesheet" type="text/css" href = "css/betaling.css">

</head>
<body>

<h2> Payment </h2> <br> <br>

<h4> Information </h4>
<form method="$_GET">
    E-mail adres: <input type="email" name="email">
    Sign up for the newspaper:<input type ="checkbox" name="Sign up">
</form>

</body>
</html>
<?php
include "includes/header.php";
session_start();
?>

<a href="index.php">back</a>
<h1> Payment </h1> <br>

<h3> Step 1: Information </h3>
<form method="POST"  action="Betaling product.php">
    E-mail adres: <input type="email" name="email"> <br>
    Sign up for the newspaper:<input type ="checkbox" name="Sign up"> <br> <br>
    Name: <input type="textarea" name="voornaam" placeholder="First name">  <input type="textarea" name="last name" placeholder="Last name"> <br>
    <input type="radio"> Mevr. <input type="radio"> Mnr. <br> <br>
    Adres: <input type="textarea" placeholder="Street">  <input type="textarea" placeholder="Number"> <br> <br>
    Postcode: <input type="textarea" name="cijfers postcode" placeholder="4 cijfers">  <input type="textarea" name="letters postcode" placeholder="2 letters"> <br> <br>
    Woonplaats: <input type="textarea" name="woonplaats"> <br> <br> <br>
    <input type="submit" value="Next step">
</form>

<?php
foreach ($_SESSION["IDs"] as $i => $value) {
    unset($_SESSION["IDs"][$i]);
}
foreach ($_SESSION["Names"] as $i => $value) {
    unset($_SESSION["Names"][$i]);
}
foreach ($_SESSION["Prices"] as $i => $value) {
    unset($_SESSION["Prices"][$i]);
}
foreach ($_SESSION["Images"] as $i => $value) {
    unset($_SESSION["Images"][$i]);
}
foreach ($_SESSION["Quantitys"] as $i => $value) {
    unset($_SESSION["Quantitys"][$i]);
}
$_SESSION["TotalPrice"] = 0;
session_destroy();
include "includes/footer.php";
?>



<?php
