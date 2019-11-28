<?php
if (!isset($active)) {
    $active = "user";
}
include "includes/header.php";

if ($_SESSION['login'] == FALSE) {
    echo '<script> window.location.href = "login.php"; </script>';
}

$userId = $_SESSION['user_session'];
$sql = "SELECT * FROM people WHERE PersonID = $userId";
/*printen van de resultaten op het scherm*/
$res_data = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_array($res_data)) {
    ?>


    <div class="loginBox" style="height: 65%">
        <form method="post">
            <div class="loginRow">
                <div class="loginHead">
                    <h1>You have been logged in!</h1>
                    <?php
                    echo "<h3>Welkom " . $row['FullName'] . "</h3>";
                    ?>
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputName" class="">Full name:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputName" name="username"
                           placeholder="<?= $row['FullName'] ?>">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputEmail" class="">Email address:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputEmail" name="email"
                           placeholder="<?= $row['EmailAddress'] ?>">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPhone" class="">Phone number:</label>
                </div>
                <div class="loginColumn2">
                    <input type="number" class="loginInput" id="inputPhone" name="phone"
                           placeholder="<?= $row['PhoneNumber'] ?>">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputAddress" class="">Address:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputAddress" name="address"
                           placeholder="<?= $row['address'] ?>">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPostal" class="">Postal code:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputPostal" name="postal"
                           placeholder="<?= $row['postalCode'] ?>">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputCity" class="">City:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputCity" name="city"
                           placeholder="<?= $row['city'] ?>">
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
                    <input type="submit" name="edit" value="Edit information">
                    <a class="loginLink" href="index.php" style="margin-left: 25%">Go back to home </a><input type="submit"
                                                                            name="logout"
                                                                            value="Logout">
                </div>
            </div>
        </form>
    </div>

    <?php
}
if (isset($_POST['logout'])) {
    $_SESSION['login'] = FALSE;
    echo '<script> window.location.href = "login.php"; </script>';
}