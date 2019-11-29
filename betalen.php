<link rel="stylesheets" type="text/css" href="css/betalen.css">
<link rel="stylesheet" type="text/css" href="css/aboutus.css">

<?php
active:
"betalen";
include "includes/header.php";


$sql = "SELECT DeliveryMethodName FROM deliverymethods";
$result = mysqli_query($connection, $sql);

$costs = "SELECT RecommendedRetailPrice FROM stockitems";
$result1 = mysqli_query($connection, $costs);

?>

<a href="winkelmand.php"> < Back to shoppingcart </a>
<h1> Payment </h1> <br>

<?php
include "includes/footer.php";
?>
<div class="double-column2">

<div class="contact">
        <!--step 1: information-->

            <h3><img src="images/(step 1).JPG" width="35" height="30" alt="step 1"> Information </h3>
            <form method="$_GET" action="betalen 2.0.php">

                <!--email-->
                Sign up for the newspaper: <input type="checkbox" name="Sign up"> <br> <br>
                <div class="contact-form-group">
                    <label for="email" class="contact-form-label">Email:</label>
                    <input type="email" id="email" class="contact-form-control"/>
                </div>
                <br>
                <br>
                <!--phonenumber-->
                <div class="contact-form-group">
                    <label for="phone_number" class="contact-form-label">Phone number:</label>
                    <input type="text" id="phone_number" class="contact-form-control"/>
                </div>
                <br>
                <br>
                <!--mr or ms-->
                <div class="contact-form-group">
                    <label for="salutation" class="contact-form-label">Salutation:</label>
                    <select id="salutation" class="contact-form-control">
                        <option value="Mr">Mr.</option>
                        <option value="Ms">Ms.</option>
                    </select>
                </div>
                <br>
                <br>
                <!--Name-->
                <div class="contact-form-group">
                    <label for="first_name" class="contact-form-label">First name:</label>
                    <input type="text" id="first_name" class="contact-form-control"/>
                </div>
                <br>
                <br>
                <div class="contact-form-group">
                    <label for="last_name" class="contact-form-label">Last name:</label>
                    <input type="text" id="last_name" class="contact-form-control"/>
                </div>
                <br>
                <br>
                <!--Adres-->
                <div class="contact-form-group">
                    <label for="Street" class="contact-form-label">Street:</label>
                    <input type="text" id="Street" class="contact-form-control">
                </div>
                <br>
                <br>
                <div class="contact-form-group">
                    <label for="House number" class="contact-form-label">House number:</label>
                    <input type="number" id="House number" class="contact-form-control">
                </div>
                <br>
                <br>
                <div class="contact-form-group">
                    <label for="Postal code" class="contact-form-label">Postalcode:</label>
                    <input type="text" id="Postal code" class="contact-form-control">
                </div>
                <br>
                <br>
                <div class="contact-form-group">
                    <label for="City" class="contact-form-label">City:</label>
                    <input type="text" id="City" class="contact-form-control">
                </div>

            </div>

        <!--step 2 verzendmethode-->
                <div class="verzendmethode/css">
                <br>
                <h3><img src="images/(step 2).JPG" width="35" height="30" alt="step 1"> Send method </h3>
                    <h4>Home delivered with:</h4>
                <select>
                    <?php while ($row = mysqli_fetch_array($result)):; ?>
                        <option> <?php print ($row[0]); ?> </option>
                    <?php endwhile; ?>
                </select>
                <br> Shipping price: <?php $costs ?>
                <?php
                if ($costs < 50) {
                    print("€6,95 <br> <br> Shipping price is €6.95 for orders below €50.00!");
                } else {
                    print("€0,00");
                }
                ?>
                    <br>
                    <br>
                    <br>


                    <div class="Sign up">
                    <h3> Sign up </h3>
                        <br>

                    <form method = "$_POST" action="">
                        <label for="user" class="usernamebetalen"> Username = </label>
                        <input type="text" id="user" name="usenname">
                        <br>
                        <label for="pass" class="passwordbetalen"> Password = </label>
                        <input type="password" id="pass" name="password">
                        <br>
                        <label for="pass1" class="passfirst"> Password (again) = </label>
                        <input type="password" name="passwordagain">
                        <br>
                        <input type="submit" name="inloggen" value="Sign in">
                    </form>
                    <br>

                    <?php
                    $Password1=isset($_POST['password']);
                    $Passwordagain=isset($_POST['passwordagain']);
                    $Username1=isset($_POST['username']);

                    if(!$Username1 || !$Password1 || !$Passwordagain) {
                        print("No username/password");
                    } elseif($Password1 != $Passwordagain){
                        print("The password is not the same");
                    } else {
                        print("succesfully logged in");
                    }
                    ?>
                        <br>
                        <br>
                        <br>

                        <h3> Your Order </h3> <!-- border + border om elk product > plaatje Float; right overflow: scroll;-->

                        <br>
                        <br>

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

                        }
                        /*while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                            print($_SESSION["Names"]);
                        print($_SESSION["Quantitys"]);
                        print($_SESSION["Prices"]);
                        print($_SESSION["Images"]);*/
                        ?>
                    <br>
                    <br>
                        <div class="totalbetalen">
                            <b> <h3> Total </h3> <b><!--rechterkant en border-->
                                    <?php
                                    $totalPrice = ($_SESSION["TotalPrice"]);
                                    ?>
                                    Total: €<?php print($totalPrice); ?>
                                    <br>
                                    *with sendingcosts included
                                    <br>
                                    <br>
                                    <br>
                                    <div class="Your order">

                    <input type="submit" value="Send"/>
                        </div>
                        </div>
                    </div>
                </div>
</div>
</body>
</html>
