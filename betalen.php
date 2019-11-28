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
                <input<h4>Home delivered with:</h4>
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
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                    <input type="submit" value="Send"/>
                </div>
        </div>

    </div>

    </div>
</div>


</body>
</html>

