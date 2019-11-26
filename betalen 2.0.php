
<?php
active:"betalen2";
include "includes/header.php";
?>



<a href="betalen.php"> back to step 1 and 2 </a>

<h3 class="titlepayment"> Paymentmethod</h3>
<form method="POST" action="afgeronde_bestelling.php">
    <div class="Payment">
    <input type="radio" name="select"> Cash <br> <br>
    <input type="radio" name="select"> Check <br><br>
    <input type="radio" name="select"> Credit-Card <br><br>
    <input type="radio" name="select"> EFT  <br>
    I have a discount code: <input type="textarea" name="discount"><br>
        <input type="submit" value="Payment">
</form>
    <input type="submit" value="Enter">


</div>


<?php
/*foreach ($_SESSION["IDs"] as $i => $value) {
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
?>