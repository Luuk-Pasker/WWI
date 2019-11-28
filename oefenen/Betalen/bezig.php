<?php
include "includes/header.php";
?>

<h3> Log in </h3>

<?php
$Password1=isset($_POST['password']);
$Passwordagain=isset($_POST['passwordagain']);
$Username1=isset($_POST['username']);

if(!$Username1) {
    print("No username/password");
} if($Password1 != $Passwordagain){
    print("The password is not the same");
} else {
    print("succesfully logged in");
}
?>
<form method = "$_POST" action="bezig.php">
    <label for="user" class="usernamebetalen"> Username = </label>
    <input type="text" id="user" name="usenname">
    <br>
    <label for="pass" class="passwordbetalen"> Password = </label>
    <input type="password" id="pass" name="password">
    <br>
    <label for="pass1" class="passfirst"> Password (again) = </label>l
    <input type="password" name="passwordagain">
    <br>
    <br>
<input type="submit" name="inloggen" value="Log in">
</form>

<?php
$totalPrice = print($_SESSION["TotalPrice"]);
?>


<h3> Total </h3> <!--rechterkant en border-->

Total: €<?php $totalPrice ?>
<br>
* with sendingcosts included


<h3> Your Order </h3> <!-- border + border om elk product > plaatje Float; right overflow: scroll;-->

<label for="aantal" class="aantalproducten"> Aantal: </label>
<input type="text" id="aantal" name="aantalproductenbetalen">
}

<?php
foreach($_SESSION["IDs"] as $index => $val) {
$Photo = $_SESSION['Images'][$index];
$ItemPrice = $_SESSION["Prices"][$index] * $_SESSION["Quantitys"][$index];
print("<img src='$Photo' height='100px'>");
print("<br>");
print($_SESSION["Names"][$index]);
print("<br>");
print($_SESSION["Quantitys"][$index]);
print("<br>");
print("€" . number_format((float)$ItemPrice, 2, '.', ''));


/*while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    print($_SESSION["Names"]);
print($_SESSION["Quantitys"]);
print($_SESSION["Prices"]);
print($_SESSION["Images"]);*/
?>

