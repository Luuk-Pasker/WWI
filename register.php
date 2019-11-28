<?php
include "includes/header.php";
?>

    <div class="loginBox" style="height: 60%">
        <form method="post">
            <div class="loginRow">
                <div class="loginHead">
                    <h2>Wide World Importers Register</h2>
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputName" class="">Full name:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputName" name="username" placeholder="Full name">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputEmail" class="">Email adress:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputEmail" name="email" placeholder="Email adress">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPhone" class="">Phone number:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputPhone" name="phone" placeholder="Phone number">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPhone" class="">Address:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputAddress" name="address" placeholder="Address">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPhone" class="">Postal code:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputPostal" name="postal" placeholder="Postal code">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPhone" class="">City:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputCity" name="city" placeholder="City">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPassword">Password:</label>
                </div>
                <div class="loginColumn2">
                    <input type="password" class="loginInput" id="inputPassword" name="password" placeholder="Password">
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
    if ($_POST['email'] == $_POST['password']) {
        echo "Username and password can't be the same!";
    } elseif (empty($_POST['username'])) {
        echo "Fill in username!";
    } elseif (empty($_POST['email'])) {
        echo "Fill in email!";
    } elseif (empty($_POST['phone'])) {
        echo "Fill in phonenumber!";
    } elseif (empty($_POST['password'])) {
        echo "Fill in password!";
    } else {
        $sql = "SELECT MAX(PersonID) AS HighestID FROM people";
        /*printen van de resultaten op het scherm*/
        $res_data = mysqli_query($connection, $sql);
        foreach ($res_data as $row) {
            $PersonID = $row['HighestID'] + 1;
            $sql = "INSERT INTO people (PersonID, Fullname, address, postalCode, city, IsPermittedToLogon, LogonName, HashedPassword, PhoneNumber, EmailAddress) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $connection->prepare($sql);
            $stmt->bind_param('ssssssssss', $PersonID, $_POST['username'], $_POST['address'], $_POST['postal'], $_POST['city'], $permitted, $_POST['email'], $HPass, $_POST['phone'], $_POST['email']);
            $stmt->execute();
            echo "GELUKT!!!";
        }
        echo '<script> window.location.href = "login.php"; </script>';
    }
}

include "includes/footer.php";