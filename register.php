<?php
include "includes/header.php";
include "includes/funtions.php";

$n = 10;
$discountCode = getName($n);
$discount = "20";
$discountUsed = "1";
?>

    <div class="loginBox" style="height: 70%; top: 55%;">
        <form method="post">
            <div class="loginRow">
                <div class="loginHead">
                    <h2>Wide World Importers Register</h2>
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputName" class="form-label">Full name:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="form-control form-border" id="inputName" name="username"
                           placeholder="Full name">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputEmail" class="form-label">Email adress:</label>
                </div>
                <div class="loginColumn2">
                    <input type="email" class="form-control form-border" id="inputEmail" name="email"
                           placeholder="Email adress">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPhone" class="form-label">Phone number:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="form-control form-border" id="inputPhone" name="phone"
                           placeholder="Phone number">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPhone" class="form-label">Address:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="form-control form-border" id="inputAddress" name="address"
                           placeholder="Address">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPhone" class="form-label">Postal code:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="form-control form-border" id="inputPostal" name="postal"
                           placeholder="Postal code">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPhone" class="form-label">City:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="form-control form-border" id="inputCity" name="city" placeholder="City">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPassword" class="form-label">Password:</label>
                </div>
                <div class="loginColumn2">
                    <input type="password" class="form-control form-border" id="inputPassword" name="password"
                           placeholder="Password">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPassword1" class="form-label">Repeat password:</label>
                </div>
                <div class="loginColumn2">
                    <input type="password" class="form-control form-border" id="inputPassword" name="repeatPassword"
                           placeholder="Repeat password">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn2">
                    <input type="submit" class="" name="submit" value="Sign up">
                </div>
            </div>
        </form>
    </div>

<?php

if (isset($_POST['submit'])) {
    $password = hash('sha256', $_POST['password']);
    $HPass = strtoupper($password);
    $permitted = "1";

    $sql = "SELECT LogonName, MAX(PersonID) AS HighestID FROM people";
    /*printen van de resultaten op het scherm*/
    $res_data = mysqli_query($connection, $sql);
    foreach ($res_data as $row) {
        if ($_POST['email'] == $row['LogonName']) {
            $error = "Email is already in use, try something else!";
        } elseif (empty($_POST['username'])) {
            $error = array("Fill in username!");
        } elseif (empty($_POST['email'])) {
            $error = array("Fill in email!");
        } elseif (empty($_POST['phone'])) {
            $error = "Fill in phonenumber!";
        } elseif (empty($_POST['password'])) {
            $error = "Fill in password!";
        } elseif ($_POST['email'] == $_POST['password']) {
            $error = "Username and password can't be the same!";
        } elseif ($_POST['password'] == $_POST['repeatPassword']) {
                $PersonID = $row['HighestID'] + 1;
                $sql = "INSERT INTO people (PersonID, Fullname, address, postalCode, city, IsPermittedToLogon, LogonName, HashedPassword, PhoneNumber, EmailAddress) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $connection->prepare($sql);
                $stmt->bind_param('ssssssssss', $PersonID, $_POST['username'], $_POST['address'], $_POST['postal'], $_POST['city'], $permitted, $_POST['email'], $HPass, $_POST['phone'], $_POST['email']);
                $stmt->execute();

                $sql1 = "INSERT INTO discount (discountCode, PersonID, discountUsed, discount) VALUES (?, ?, ?, ?)";

                $stmt1 = $connection->prepare($sql1);
                $stmt1->bind_param('ssss', $discountCode, $PersonID, $discountUsed, $discount);
                $stmt1->execute();
            echo '<script> window.location.href = "login.php"; </script>';
        } else {
            $error = "Passwords do not match";
        }
    }
}

if (empty($error)) {

} else {
    foreach ($error as $item => $message) {
        echo "<div class='errorBox' style='margin-top: 1%'>$message</div>";
    }
}

include "includes/footer.php";