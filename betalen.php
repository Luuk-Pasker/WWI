<link rel="stylesheets" tupe="text/css" href="css/betalen.css">
<link rel="stylesheet" type="text/css" href="css/aboutus.css">
<link rel="stylesheet" type="text/css" href="css/productBekijken.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<?php
$active = "betalen";
include "includes/header.php";
include "includes/funtions.php";

$n = 10;
$discountCode = getName($n);
$discountPercent = "20";
$discountUsed = "1";

if (empty($_SESSION['user_session'])) {
    $userId = "";
} else if ($_SESSION['user_session'] == TRUE) {
    $userId = $_SESSION['user_session'];
}

$sql = "SELECT DeliveryMethodName FROM deliverymethods";
$result = mysqli_query($connection, $sql);

$costs = "SELECT RecommendedRetailPrice FROM stockitems";
$result1 = mysqli_query($connection, $costs);

$code = "SELECT discountcode FROM discount";
$result2 = mysqli_query($connection, $code);

$discount = "SELECT * FROM discount";
$result3 = mysqli_query($connection, $discount);

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
                        <div class="loginRow1">
                            <div class="loginColumn1">
                                <label for="first_name" class="form-label">First name:</label>
                            </div>
                            <div class="loginColumn2" style="width: 80%">
                                <input type="text" class="form-control" id="first_name" name="fname">
                            </div>
                        </div>
                        <div class="loginRow1">
                            <div class="loginColumn1">
                                <label for="last_name" class="form-label">Last name:</label>
                            </div>
                            <div class="loginColumn2" style="width: 80%">
                                <input type="text" id="last_name" name="lname" class="form-control"/>
                            </div>
                        </div>
                        <div class="loginRow1">
                            <!--email-->
                            <div class="form-group">
                                <div class="loginColumn1">
                                    <label for="email" class="form-label">Email:</label>
                                </div>
                                <div class="loginColumn2" style="width: 80%">
                                    <input type="email" id="email" name="email" class="form-control"
                                           placeholder="requires @">
                                </div>
                            </div>
                        </div>
                        <div class="loginRow1">
                            <!--phonenumber-->
                            <div class="form-group">
                                <div class="loginColumn1">
                                    <label for="phone_number" class="form-label">Phone number:</label>
                                </div>
                                <div class="loginColumn2" style="width: 80%">
                                    <input type="text" id="phone_number" name="phone" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="loginRow1">
                            <!--Adres-->
                            <div class="form-group">
                                <div class="loginColumn1">
                                    <label for="Street" class="form-label">Address:</label>
                                </div>
                                <div class="loginColumn2" style="width: 80%">
                                    <input type="text" id="Street" name="address" class="form-control"
                                           placeholder="Lane 12">
                                </div>
                            </div>
                        </div>
                        <div class="loginRow1">
                            <div class="form-group">
                                <div class="loginColumn1">
                                    <label for="Postal code" class="form-label">Postalcode:</label>
                                </div>
                                <div class="loginColumn2" style="width: 80%">
                                    <input type="text" id="Postal code" name="postal" class="form-control"
                                           placeholder="1111 AB">
                                </div>
                            </div>
                        </div>
                        <div class="loginRow1">
                            <div class="form-group">
                                <div class="loginColumn1">
                                    <label for="City" class="form-label">City:</label>
                                </div>
                                <div class="loginColumn2" style="width: 80%">
                                    <input type="text" id="City" name="city" class="form-control"
                                           placeholder="Rotterdam">
                                </div>
                            </div>
                        </div>
                        <div class="loginRow1">
                            <p style="margin-left: 30px">Do you want an account? Fill in a password to sign up.</p>
                            <div class="form-group">
                                <div class="loginColumn1">
                                    <label for="password" class="form-label">Password:</label>
                                </div>
                                <div class="loginColumn2" style="width: 80%">
                                    <input type="password" id="password" name="password"
                                           class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="loginRow1">
                            <div class="form-group">
                                <div class="loginColumn1">
                                    <label for="repeatPassword" class="form-label">Repeat
                                        password:</label>
                                </div>
                                <div class="loginColumn2" style="width: 80%">
                                    <input type="password" id="repeatPassword" name="repeatPassword"
                                           class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <?php
                    } elseif ($_SESSION["login"] == TRUE) {
                        $sql = "SELECT * FROM people WHERE PersonID = $userId";
                        /*printen van de resultaten op het scherm*/
                        $res_data = mysqli_query($connection, $sql);
                        while ($row = mysqli_fetch_array($res_data)) {
                            echo "You have been logged in as: " . $row['FullName'];
                            echo "<br>Proceed with the payment.<br>";
                            echo "<br>Your address: " . $row['address'];
                            echo "<br>Your postal code: " . $row['postalCode'];
                            echo "<br>Your city: " . $row['city'];
                        }
                    }
                    ?>

            </div>
        </div>

        <div class="column">
            <div class="sendmethode">
                <!--step 2 verzendmethode-->
                <div class="verzendmethode/css">
                    <h3><img src="images/(step 2).JPG" width="35" height="30" alt="step 1"> Send
                        method</h3>
                </div>

                <label for="sendMethod" class="contact-form-label">Home deliverd with:</label><br>
                <select name="sendMethod" id="sendMethod" class="contact-form-control">
                    <?php
                    while ($row = mysqli_fetch_array($result)):; ?>
                        <option> <?php print($row[0]); ?> </option>
                    <?php endwhile; ?>
                    }
                    ?>
                </select>
                <br>
                Your shipping price: <?php $_SESSION["TotalPrice"] ?>
                <?php
                if ($_SESSION["TotalPrice"] < 50) {
                    print("€6,95 <br> <br> Order above €50,00 and shipping will be FREE!   ");
                } else {
                    print("€0,00");
                }
                ?>

                <br><br><br><br><BR><br><br><br><BR><br><br><br><br>
                <br>
                <br>
                <!--                <a href="betalen 2.0.php">-->
                <!--                    <input type="submit" name="submit" value="Next step"/>-->
                <!--                </a>-->

            </div>

        </div>


        <div class="column">

            <h3 class="titlepayment"><img src="images/(step%203).JPG" width="35" height="30"
                                          alt="step 3"> Paymentmethod
            </h3>

            <div class="Payment">

                <input type="radio" name="paymentMethod" value="Check"> <i
                        class="fas fa-money-check-alt"
                        style="font-size:24px;"></i>
                Check
                <br>
                <br>
                <input type="radio" name="paymentMethod" value="Credit-Card"> <i
                        class="fas fa-credit-card"
                        style="font-size:24px;"></i>
                Credit-Card
                <br>
                <br>
                <input type="radio" name="paymentMethod" value="IDEAL"> <img class="IDEAL"
                                                                             src="images/IDEAL.png"
                                                                             style="font-size:24px;">


                <select>
                    <option value="choose your option"> Choose your bank...</option>
                    <option value="ABN AMRO"> ABN AMRO</option>
                    <option value="ASN Bank">ASN Bank</option>
                    <option value="bunq">bunq</option>
                    <option value="ING">ING</option>
                    <option value="Knab">Knab</option>
                    <option value="Moneyou">Moneyou</option>
                    <option value="Rabobank">Rabobank</option>
                    <option value="Regiobank">Regiobank</option>
                    <option value="SNS Bank">SNS Bank</option>
                    <option value="Triodos Bank">Triodos Bank</option>
                    <option value="Van Lanschot">Van Lanschot</option>
                </select>
                <br>
                <br>
                <input type="radio" name="paymentMethod" value="EFT"> <i class="fab fa-bitcoin"
                                                                         style="font-size:24px;"></i>
                EFT
                <br>
                <br>

                <input type="submit" name="submit" value="Finish payment">

            </div>
        </div>
        </form>


        <?php

        if (isset($_POST['submit']) && $_SESSION['login'] == TRUE) {
            if (empty($_POST['sendMethod'])) {
                $error = "Fill in a send method";
            } elseif (empty($_POST['paymentMethod'])) {
                $error = "Fill in a payment method";
            } else {
                $sql = "INSERT INTO invoice (PersonID, sendMethod, paymentMethod) VALUES (?, ?, ?)";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param('sss', $userId, $_POST['sendMethod'], $_POST['paymentMethod']);
                $stmt->execute();

                foreach ($_SESSION["IDs"] as $index => $val) {
                    $id = $_SESSION['IDs'][$index];
                    $Quantity = $_SESSION['Quantitys'][$index];
                    echo $id;
                    echo $Quantity;

                    $sql = "SELECT * FROM stockitemholdings WHERE StockItemID = '$id'";
                    /*printen van de resultaten op het scherm*/
                    $res_data = mysqli_query($connection, $sql);
                    foreach ($res_data as $row) {
                        $minQuantity = $row['QuantityOnHand'] - $Quantity;
                        echo $minQuantity;

                        $sql = "UPDATE stockitemholdings SET QuantityOnHand = ?, LastStocktakeQuantity = ? WHERE StockItemID = '$id'";

                        $stmt = $connection->prepare($sql);
                        $stmt->bind_param('ss', $minQuantity, $minQuantity);
                        $stmt->execute();

                    }

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
            }
        } elseif (isset($_POST['submit'])) {
            $_SESSION['email'] = $_POST['email'];
            $password = hash('sha256', $_POST['password']);
            $HPass = strtoupper($password);
            $permitted = "1";
            $notPermitted = "0";
            $username = $_POST['fname'] . " " . $_POST['lname'];
            $_SESSION['fullname'] = $username;

            $sql = "SELECT *, MAX(PersonID) AS HighestID FROM people";
            /*printen van de resultaten op het scherm*/
            $res_data = mysqli_query($connection, $sql);
            foreach ($res_data as $row) {
                $PersonID = $row['HighestID'] + 1;
                if ($_POST['email'] == $row['LogonName']) {
                    $error = "Email is already in use, try something else!";
                } elseif (empty($_POST['fname'])) {
                    $error = "Fill in name!";
                } elseif (empty($_POST['email'])) {
                    $error = "Fill in email!";
                } elseif (empty($_POST['phone'])) {
                    $error = "Fill in phonenumber!";
                } elseif (empty($_POST['address'])) {
                    $error = "Fill in address!";
                } elseif (empty($_POST['postal'])) {
                    $error = "Fill in postal!";
                } elseif (empty($_POST['city'])) {
                    $error = "Fill in city!";
                } elseif (empty($_POST['sendMethod'])) {
                    $error = "Fill in a send method";
                } elseif (empty($_POST['paymentMethod'])) {
                    $error = "Fill in a payment method";
                } elseif (empty($_POST['password'])) {
                    $sql = "INSERT INTO people (PersonID, Fullname, address, postalCode, city, IsPermittedToLogon, LogonName, PhoneNumber, EmailAddress) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param('sssssssss', $PersonID, $username, $_POST['address'], $_POST['postal'], $_POST['city'], $notPermitted, $_POST['email'], $_POST['phone'], $_POST['email']);
                    $stmt->execute();

                    $sql = "INSERT INTO invoice (PersonID, sendMethod, paymentMethod) VALUES (?, ?, ?)";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param('sss', $userId, $_POST['sendMethod'], $_POST['paymentMethod']);
                    $stmt->execute();

                    foreach ($_SESSION["IDs"] as $index => $val) {
                        $id = $_SESSION['IDs'][$index];
                        $Quantity = $_SESSION['Quantitys'][$index];
                        echo $id;
                        echo $Quantity;

                        $sql = "SELECT * FROM stockitemholdings WHERE StockItemID = '$id'";
                        /*printen van de resultaten op het scherm*/
                        $res_data = mysqli_query($connection, $sql);
                        foreach ($res_data as $row) {
                            $minQuantity = $row['QuantityOnHand'] - $Quantity;
                            echo $minQuantity;

                            $sql = "UPDATE stockitemholdings SET QuantityOnHand = ?, LastStocktakeQuantity = ? WHERE StockItemID = '$id'";

                            $stmt = $connection->prepare($sql);
                            $stmt->bind_param('ss', $minQuantity, $minQuantity);
                            $stmt->execute();

                        }

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
                    $error = "Email and password can't be the same!";
                } elseif ($_POST['password'] == $_POST['repeatPassword']) {
                    $sql = "INSERT INTO people (PersonID, Fullname, address, postalCode, city, IsPermittedToLogon, LogonName, HashedPassword, PhoneNumber, EmailAddress) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param('ssssssssss', $PersonID, $username, $_POST['address'], $_POST['postal'], $_POST['city'], $permitted, $_POST['email'], $HPass, $_POST['phone'], $_POST['email']);
                    $stmt->execute();


                    $sql1 = "INSERT INTO discount (discountCode, PersonID, discountUsed, discount) VALUES (?, ?, ?, ?)";

                    $stmt1 = $connection->prepare($sql1);
                    $stmt1->bind_param('ssss', $discountCode, $PersonID, $discountUsed, $discountPercent);
                    $stmt1->execute();


                    $sql = "INSERT INTO invoice (PersonID, sendMethod, paymentMethod) VALUES (?, ?, ?)";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param('sss', $userId, $_POST['sendMethod'], $_POST['paymentMethod']);
                    $stmt->execute();

                    foreach ($_SESSION["IDs"] as $index => $val) {
                        $id = $_SESSION['IDs'][$index];
                        $Quantity = $_SESSION['Quantitys'][$index];
                        echo $id;
                        echo $Quantity;

                        $sql = "SELECT * FROM stockitemholdings WHERE StockItemID = '$id'";
                        /*printen van de resultaten op het scherm*/
                        $res_data = mysqli_query($connection, $sql);
                        foreach ($res_data as $row) {
                            $minQuantity = $row['QuantityOnHand'] - $Quantity;
                            echo $minQuantity;

                            $sql = "UPDATE stockitemholdings SET QuantityOnHand = ?, LastStocktakeQuantity = ? WHERE StockItemID = '$id'";

                            $stmt = $connection->prepare($sql);
                            $stmt->bind_param('ss', $minQuantity, $minQuantity);
                            $stmt->execute();

                        }

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
                    $error = "wrong information";
                }
            }
        }

        print"<div class='column'>";

        if (empty($_SESSION['IDs'])) {
            print"<h3 style='font-weight: bold;'>Shopping cart is empty.</h3>";
        } else {

            print"<h3 style='font-weight: bold;'>Your order:</h3>";
            print"<br>";
            foreach ($_SESSION["IDs"] as $index => $val) {
                $Photo = $_SESSION['Images'][$index];
                $ItemPrice = $_SESSION["Prices"][$index] * $_SESSION["Quantitys"][$index];

                ?>
                <div class='Orderlist'>
                    <meta name="viewport" content="width=device-width, initial-scale=1">

                    <?php
                    print("<br>");
                    print("<img style='float: left; margin-right: 10px;' src='$Photo' height='100px'>");
                    print("<h5 style='font-weight: bold;'>" . $_SESSION["Names"][$index] . "</h5>");
                    print("<h5 style='font-weight: bold;'>" . "amount: " . $_SESSION["Quantitys"][$index] . "</h5>");
                    print("<h5 style='font-weight: bold;'>" . "price: " . "€" . number_format((float)$_SESSION["Prices"][$index], 2, '.', '') . "</h5>");
                    print"<br>";
                    ?>
                </div>
                <?php
            }
            print"<h5 style='font-weight: bold;'>" . "Shipping price €6,95" . "</h5><br>";
            print("<h5 style='font-weight: bold; font-size: 20px'>" . "Total: €    " . number_format($_SESSION["TotalPrice"], 2) . "</h5>");

        }
        ?>
    </div>

</div>

<?php
print"</div>";

if (empty($error)) {

} else {
    echo "<div class='errorBox' style='margin-top: -660px'>$error</div>";
}

include "includes/footer.php";