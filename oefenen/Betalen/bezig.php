<?php
include "includes/header.php";
?>

<h3> Log in </h3>

<?php
$Password1=isset($_POST['password']);
$Passwordagain=isset($_POST['passwordagain']);
$Username=isset($_POST['username']);

if(!$Username) {
    print("No username/password");
} if($Password1 != $Passwordagain){
    print("The password is not the same");
} else {
    print("succesfully logged in");
}
?>
<form method = "$_POST" action="bezig.php">
Username = <input type="text" name="usenname"> <br>
Password = <input type="password" name="password"><br>
Password (again) = <input type="password" name="passwordagain"> <br> <br>
<input type="submit" name="inloggen" value="Log in">
</form>

<?php
$totalPrice = print($_SESSION["TotalPrice"]);
?>


<h3> Total </h3> <!--rechterkant en border-->

Total: €<?php $totalPrice ?>
* with sendingcosts included


<h3> Your Order </h3> <!-- border + border om elk product > plaatje Float; right overflow: scroll;-->
<?php
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    $_SESSION["Names"];
$_SESSION["Quantitys"];
$_SESSION["Prices"];
$image = "images/" . $row['Photo'];


?>