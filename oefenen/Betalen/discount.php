<?php
include "includes/header.php";

$sql = "SELECT FROM dicount";
$discountcode = $_POST['discountcode'];
$discountcodecorrect1 = "SALE";
$codemoney1 = "5";
$pricewithdiscount = ($_SESSION["TotalPrice"] - $codemoney1);
if (isset($_POST['Payment'])) {
    if ($discountcodecorrect1 == $discountcodecorrect1) {
        print("€ $codemoney1 discount with code: $discountcode.");
    } else {
        print("This is no discount code.");
    }
}
?>
I have a discount code: <input type="text" name="discountcode">