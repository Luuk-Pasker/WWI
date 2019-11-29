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
        <form method="post">
            <!--Name-->
            <div class="contact-form-group">
                <label for="first_name" class="contact-form-label">First name:</label>
                <input type="text" id="first_name" name="fname" class="contact-form-control"/>
            </div>
            <div class="contact-form-group">
                <label for="last_name" class="contact-form-label">Last name:</label>
                <input type="text" id="last_name" name="lname" class="contact-form-control"/>
            </div>
            <br>
            <br>
            <!--email-->
            <div class="contact-form-group">
                <label for="email" class="contact-form-label">Email:</label>
                <input type="email" id="email" name="email" class="contact-form-control"/>
            </div>
            <br>
            <br>
            <!--phonenumber-->
            <div class="contact-form-group">
                <label for="phone_number" class="contact-form-label">Phone number:</label>
                <input type="number" id="phone_number" name="phone" class="contact-form-control"/>
            </div>
            <!--            <br>-->
            <!--            <br>-->
            <!--            mr or ms-->
            <!--            <div class="contact-form-group">-->
            <!--                <label for="salutation" class="contact-form-label">Salutation:</label>-->
            <!--                <select id="salutation" class="contact-form-control">-->
            <!--                    <option value="Mr">Mr.</option>-->
            <!--                    <option value="Ms">Ms.</option>-->
            <!--                </select>-->
            <!--            </div>-->
            <br>
            <br>
            <!--Adres-->
            <div class="contact-form-group">
                <label for="Street" class="contact-form-label">Address:</label>
                <input type="text" id="Street" name="address" class="contact-form-control">
            </div>
            <br>
            <br>
            <div class="contact-form-group">
                <label for="Postal code" class="contact-form-label">Postalcode:</label>
                <input type="text" id="Postal code" name="postal" class="contact-form-control">
            </div>
            <br>
            <br>
            <div class="contact-form-group">
                <label for="City" class="contact-form-label">City:</label>
                <input type="text" id="City" name="city" class="contact-form-control">
            </div>
            <br><br><br>
            <p>Want to make an account? fill in your password here!</p>
            <div class="contact-form-group">
                <label for="password" class="contact-form-label">Password:</label>
                <input type="password" id="password" name="password" class="contact-form-control"/>
            </div>
            <br><br>
            <div class="contact-form-group">
                <label for="repeatPassword" class="contact-form-label">Repeat password:</label>
                <input type="password" id="repeatPassword" name="repeatPassword"
                       class="contact-form-control"/>
            </div>
            <br>
            <br>

            <input type="submit" name="submit" value="Send"/>
        </form>
    </div>

    <div class="make account">
        <h3> Make account </h3>
    <?php
    if (isset($_POST['submit'])) {
        $password = hash('sha256', $_POST['password']);
        $HPass = strtoupper($password);
        $permitted = "1";
        $notPermitted = "0";
        $username = $_POST['fname'] . " " . $_POST['lname'];

        $sql = "SELECT MAX(PersonID) AS HighestID FROM people";
        /*printen van de resultaten op het scherm*/
        $res_data = mysqli_query($connection, $sql);
        foreach ($res_data as $row) {
            $PersonID = $row['HighestID'] + 1;

            if (empty($_POST['fname'])) {
                echo "Fill in name!";
            } elseif (empty($_POST['email'])) {
                echo "Fill in email!";
            } elseif (empty($_POST['phone'])) {
                echo "Fill in phonenumber!";
            } elseif (empty($_POST['address'])) {
                echo "Fill in address!";
            } elseif (empty($_POST['postal'])) {
                echo "Fill in postal!";
            } elseif (empty($_POST['city'])) {
                echo "Fill in city!";
            } elseif (empty($_POST['password'])) {
                $sql = "INSERT INTO people (PersonID, Fullname, address, postalCode, city, IsPermittedToLogon, LogonName, PhoneNumber, EmailAddress) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $connection->prepare($sql);
                $stmt->bind_param('sssssssss', $PersonID, $username, $_POST['address'], $_POST['postal'], $_POST['city'], $notPermitted, $_POST['email'], $_POST['phone'], $_POST['email']);
                $stmt->execute();
                echo "GELUKT!!!";
            } elseif ($_POST['email'] == $_POST['password']) {
                echo "Email and password can't be the same!";
            } elseif ($_POST['password'] == $_POST['repeatPassword']) {
                $sql = "INSERT INTO people (PersonID, Fullname, address, postalCode, city, IsPermittedToLogon, LogonName, HashedPassword, PhoneNumber, EmailAddress) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $connection->prepare($sql);
                $stmt->bind_param('ssssssssss', $PersonID, $username, $_POST['address'], $_POST['postal'], $_POST['city'], $permitted, $_POST['email'], $HPass, $_POST['phone'], $_POST['email']);
                $stmt->execute();
                echo "GELUKT!!!";
            } else {
                echo "wrong information";
            }
        }
    }
    ?>
<br>
            <!--step 2 verzendmethode-->
            <div class="verzendmethode/css">
                <img src="images/(step 2).JPG" width="35" height="30" alt="step 1"> <h3>Send method</h3>

                <h4>Home delivered with:</h4>
                <select>
                    <?php while ($row = mysqli_fetch_array($result)):; ?>
                        <option> <?php print ($row[0]); ?> </option>
                    <?php endwhile; ?>
                </select>
                <br>
                 Shipping price: <?php $costs ?>
                <?php
                if ($costs < 50) {
                    print("€6,95 <br> <br> Shipping price is €6.95 for orders below €50.00!");
                } else {
                    print("€0,00");
                }
                ?>


                    <div class="totalbetalen">
                        <b><h3> Total </h3></b><!--rechterkant en border-->
                                <?php
                                $totalPrice = ($_SESSION["TotalPrice"]);
                                ?>
                                Total: €<?php print($totalPrice); ?>
                                <br>
                                *with sendingcosts included
                                <br>

                                <h3> Your Order </h3> <!-- border + border om elk product > plaatje Float; right overflow: scroll;-->
                                <br>
                                <br>
                                <?php
                                foreach ($_SESSION["IDs"] as $index => $val) {
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
                                </div>
                </div>
            </div>
</div>
<?php
include "includes/footer.php";