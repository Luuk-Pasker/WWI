<link rel="stylesheets" type="text/css" href="css/betalen.css">
<link rel="stylesheet" type="text/css" href="css/aboutus.css">
<link rel="stylesheet" type="text/css" href="css/productBekijken.css">

<?php
active:
"betalen";
include "includes/header.php";


$sql = "SELECT DeliveryMethodName FROM deliverymethods";
$result = mysqli_query($connection, $sql);

$costs = "SELECT RecommendedRetailPrice FROM stockitems";
$result1 = mysqli_query($connection, $costs);

?>

    <button class="btn" onclick="goBack()">Go back</button>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
<div class="container2">
<h1> Payment </h1> <br>

<?php
include "includes/footer.php";
?>


    <div class="row">

        <div class="column">

            <div class="contact">
                <!--step 1: information-->

                <h3><img src="images/(step 1).JPG" width="35" height="30" alt="step 1"> Information </h3>
                <?php
                if (empty($_SESSION['login'])) {
                    ?>
                    <form method="post">
                        <!--Name-->
                        <div class="contact-form-group">
                            <label for="first_name" class="contact-form-label">First name:</label>
                            <input type="text" id="first_name" name="fname" class="contact-form-control"/>
                        </div>
                        <br>
                        <br>
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
                        <p>Do you want an acount? Fill in a password to sign up.</p>
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
                    </form>
            </div>

                    <?PHP
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

                } elseif ($_SESSION["login"] == TRUE) {

                }

                ?>
        </div>

        <div class="column">
            <div class="sendmethode">
                <!--step 2 verzendmethode-->
                <div class="verzendmethode/css">
                    <h3><img src="images/(step 2).JPG" width="35" height="30" alt="step 1"> Send method</h3>
                </div>

                <h4>Home delivered with:</h4>
                <select>
                    <?php while ($row = mysqli_fetch_array($result)):; ?>
                        <option> <?php print ($row[0]); ?> </option>
                    <?php endwhile; ?>
                </select>
                <br>
                Your shipping price: <?php $costs ?>
                <?php
                if ($costs < 50) {
                    print("€6,95 <br> <br> Order above €50,00 and shipping will be FREE!   ");
                } else {
                    print("€0,00");
                }
                ?>
                <BR>
                <br>
                <br>
                <br>
                <BR>
                <br>
                <br>
                <br>
                <BR>
                <br>
                <br>
                <br>
                <br>
                <a href="betalen 2.0.php"><input type="submit" name="submit" value="Next step"/> </a>
            </div>

        </div>

    </div>

</div>

<?php
include "includes/footer.php";