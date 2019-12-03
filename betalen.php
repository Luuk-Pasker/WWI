<link rel="stylesheets" type="text/css" href="css/betalen.css">
<link rel="stylesheet" type="text/css" href="css/aboutus.css">
<link rel="stylesheet" type="text/css" href="css/productBekijken.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<?php
$active = "betalen";
include "includes/header.php";
include "includes/funtions.php";

if (empty($_SESSION['user_session'])) {
    $userId = "";
} else if ($_SESSION['user_session'] == TRUE) {
    $userId = $_SESSION['user_session'];
}

$sql = "SELECT DeliveryMethodName FROM deliverymethods";
$result = mysqli_query($connection, $sql);

$costs = "SELECT RecommendedRetailPrice FROM stockitems";
$result1 = mysqli_query($connection, $costs);

?>

<div class="keerterug">
    <a class="KEERTERUGNU" href="winkelmand.php" style="color: white;">
        <button class="btn" title="Go back"><i class="fas fa-long-arrow-alt-left"></i> Shoppingcart</button>
    </a>
</div>

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
                <form method="post">
                    <?php
                    if (empty($_SESSION['login'])) {
                        ?>
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
                            <input type="text" id="phone_number" name="phone" class="contact-form-control"/>
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

                        <?PHP
                    } elseif ($_SESSION["login"] == TRUE) {
                        $sql = "SELECT * FROM people WHERE PersonID = $userId";
                        /*printen van de resultaten op het scherm*/
                        $res_data = mysqli_query($connection, $sql);
                        while ($row = mysqli_fetch_array($res_data)) {
                            echo "You have been logged in as " . $row['FullName'];
                            echo "<br>proceed with the payment.";
                        }
                    }

                    ?>
                    <br>
                    <br>

            </div>
        </div>

        <div class="column">
            <div class="sendmethode">
                <!--step 2 verzendmethode-->
                <div class="verzendmethode/css">
                    <h3><img src="images/(step 2).JPG" width="35" height="30" alt="step 1"> Send method</h3>
                </div>

                <label for="sendMethod" class="contact-form-label">Home deliverd with:</label><br>
                <select name="sendMethod" id="sendMethod" class="contact-form-control">
                    <?php
                    foreach ($result as $row) {
                        ?>
                        <option value="<?= $row['DeliveryMethodName']; ?>"> <?php print ($row["DeliveryMethodName"]); ?> </option>
                        <?php
                    }
                    ?>
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

                <BR><br><br><br><BR><br><br><br><BR><br><br><br><br>


                <br>
                <br>
                <!--                <a href="betalen 2.0.php">-->
                <!--                    <input type="submit" name="submit" value="Next step"/>-->
                <!--                </a>-->

            </div>

        </div>


        <div class="column">

            <h3 class="titlepayment"><img src="images/(step%203).JPG" width="35" height="30" alt="step 3"> Paymentmethod
            </h3>

                <div class="Payment">

                    <input type="radio" name="paymentMethod" value="Check"> <i class="fas fa-money-check-alt"
                                                                               style="font-size:24px;"></i>
                    Check
                    <br>
                    <br>
                    <input type="radio" name="paymentMethod" value="Credit-Card"> <i class="fas fa-credit-card"
                                                                                     style="font-size:24px;"></i>
                    Credit-Card
                    <br>
                    <br>
                    <input type="radio" name="paymentMethod" value="IDEAL"> <img class="IDEAL" src="images/IDEAL.png"
                                                                                 style="font-size:24px;"> IDEAL
                    <br>
                    <br>
                    <input type="radio" name="paymentMethod" value="EFT"> <i class="fab fa-bitcoin"
                                                                             style="font-size:24px;"></i> EFT
                    <br>
                    <br>
                    <!-- I have a discount code: <input type="text" name="discountcode">
                     </form>
                     -->
                    <?php
                    /*                        if(isset($_POST['Payment'])) {
                                                $discountcode = $_POST['discountcode'];
                                                $discountcodecorrect = "SALE";
                                                $codemoney = "5";
                                                if ($discountcode == $discountcodecorrect) {
                                                    print("€ $codemoney discount with code: $discountcode.");
                                                } else {
                                                    print("This is no discount code.");
                                                }
                                            }
                                            */
                    ?>
                    <input type="submit" name="submit" value="Finish payment">

                </div>
        </div>
        </form>


        <?php
        if (isset($_POST['submit']) && $_SESSION['login'] == TRUE) {

            $sql = "INSERT INTO invoice (PersonID, sendMethod, paymentMethod) VALUES (?, ?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param('sss', $userId, $_POST['sendMethod'], $_POST['paymentMethod']);
            $stmt->execute();

            foreach ($_SESSION["IDs"] as $index => $val) {
                $id = $_SESSION['IDs'][$index];
                $Quantity = $_SESSION['Quantitys'][$index];
                echo $id;
                echo $Quantity;

                $sql = "SELECT MAX(InvoicesID) AS HighestID FROM invoice";
                /*printen van de resultaten op het scherm*/
                $res_data = mysqli_query($connection, $sql);
                foreach ($res_data as $row) {
                    $invoiceID = $row['HighestID'];

                    $sql = "INSERT INTO transactions (StockItemID, Quantity, InvoicesID) VALUES (?, ?, ?)";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param('sss', $id, $Quantity, $invoiceID);
                    $stmt->execute();
                    echo '<script> window.location.href = "bevestiging.php"; </script>';
                }
            }

        } elseif (isset($_POST['submit'])) {
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

                    $sql = "INSERT INTO invoice (PersonID, sendMethod, paymentMethod) VALUES (?, ?, ?)";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param('sss', $userId, $_POST['sendMethod'], $_POST['paymentMethod']);
                    $stmt->execute();

                    foreach ($_SESSION["IDs"] as $index => $val) {
                        $id = $_SESSION['IDs'][$index];
                        $Quantity = $_SESSION['Quantitys'][$index];
                        echo $id;
                        echo $Quantity;

                        $sql = "SELECT MAX(InvoicesID) AS HighestID FROM invoice";
                        /*printen van de resultaten op het scherm*/
                        $res_data = mysqli_query($connection, $sql);
                        foreach ($res_data as $row) {
                            $invoiceID = $row['HighestID'];

                            $sql = "INSERT INTO transactions (StockItemID, Quantity, InvoicesID) VALUES (?, ?, ?)";
                            $stmt = $connection->prepare($sql);
                            $stmt->bind_param('sss', $id, $Quantity, $invoiceID);
                            $stmt->execute();
                            echo '<script> window.location.href = "bevestiging.php"; </script>';
                        }
                    }
                } elseif ($_POST['email'] == $_POST['password']) {
                    echo "Email and password can't be the same!";
                } elseif ($_POST['password'] == $_POST['repeatPassword']) {
                    $sql = "INSERT INTO people (PersonID, Fullname, address, postalCode, city, IsPermittedToLogon, LogonName, HashedPassword, PhoneNumber, EmailAddress) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param('ssssssssss', $PersonID, $username, $_POST['address'], $_POST['postal'], $_POST['city'], $permitted, $_POST['email'], $HPass, $_POST['phone'], $_POST['email']);
                    $stmt->execute();
                    echo "GELUKT!!!";


                    $sql = "INSERT INTO invoice (PersonID, sendMethod, paymentMethod) VALUES (?, ?, ?)";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param('sss', $userId, $_POST['sendMethod'], $_POST['paymentMethod']);
                    $stmt->execute();

                    foreach ($_SESSION["IDs"] as $index => $val) {
                        $id = $_SESSION['IDs'][$index];
                        $Quantity = $_SESSION['Quantitys'][$index];
                        echo $id;
                        echo $Quantity;

                        $sql = "SELECT MAX(InvoicesID) AS HighestID FROM invoice";
                        /*printen van de resultaten op het scherm*/
                        $res_data = mysqli_query($connection, $sql);
                        foreach ($res_data as $row) {
                            $invoiceID = $row['HighestID'];

                            $sql = "INSERT INTO transactions (StockItemID, Quantity, InvoicesID) VALUES (?, ?, ?)";
                            $stmt = $connection->prepare($sql);
                            $stmt->bind_param('sss', $id, $Quantity, $invoiceID);
                            $stmt->execute();
                            echo '<script> window.location.href = "bevestiging.php"; </script>';
                        }
                    }
                } else {
                    echo "wrong information";
                }
            }
        }

        print"<br>";
        foreach ($_SESSION["IDs"] as $index => $val) {
            $Photo = $_SESSION['Images'][$index];
            $ItemPrice = $_SESSION["Prices"][$index] * $_SESSION["Quantitys"][$index];

            print("<br>");
            print("<img style='float: left; margin-right: 10px;' src='$Photo' height='100px'>");
            print("<h5 style='font-weight: bold;'>" . $_SESSION["Names"][$index] . "</h5>");
            print("<h5 style='font-weight: bold;'>" . "amount: " . $_SESSION["Quantitys"][$index] . "</h5>");
            print("<h5 style='font-weight: bold;'>" . "price: " . "€" . number_format((float)$_SESSION["Prices"][$index], 2, '.', '') . "</h5>");
            print"<br>";
        }
        print"<h5 style='font-weight: bold;'>" . "Shipping price €6,95" . "</h5><br>";
        print"<h5 style='font-weight: bold; font-size: 20px'>" . "Total: " . "</h5>";
        print("<h5 style='font-weight: bold;'>" . "amount: €    " . number_format($_SESSION["TotalPrice"], 2) . "</h5>");

        ?>


    </div>

</div>

<?php
include "includes/footer.php";