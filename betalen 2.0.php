
<?php
active:"betalen2";
include "includes/header.php";
?>

<?php

?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<!--<link  rel = "icon"  type = "image / png"  sizes = "32x32"  href = "/favicon-32x32.png" >-->

<a href="betalen.php"> back to step 1 and 2 </a>

<h3 class="titlepayment"> Paymentmethod</h3>
<form method="POST" action="betalen%202.0.php">
    <div class="Payment">
    <input type="radio" name="select"> <i class="fas fa-money-check-alt" style="font-size:24px;"></i> Check
        <br>
        <br>
        <input type="radio" name="select"> <i class="fas fa-credit-card" style="font-size:24px;"></i> Credit-Card
        <br>
        <br>
        <input type="radio" name="select"> <img class="IDEAL" src="images/IDEAL.png" style="font-size:24px;"> IDEAL
        <br>
        <br>
    <input type="radio" name="select"> <i class="fab fa-bitcoin" style="font-size:24px;"></i> EFT
        <br>
        <br>
    I have a discount code: <input type="text" name="discountcode">
</form>
<?php
if(isset($_POST['Payment'])) {
    $discountcode = $_POST['discountcode'];
    $discountcodecorrect = "SALE";
    $codemoney = "5";
    if ($discountcode == $discountcodecorrect) {
        print("€ $codemoney discount with code: $discountcode.");
    } else {
        print("This is no discount code.");
    }
}
?>
<br> <br>
<input type="submit" name="Payment" value="Payment">
</div>


<!--/*foreach ($_SESSION["IDs"] as $i => $value) {
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

*/
?>-->