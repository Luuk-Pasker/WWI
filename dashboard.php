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
                    echo "<h3>Welcome " . $row['FullName'] . "</h3>";
                    ?>
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputName" class="">Full name:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputName" name="username"
                           value="<?= $row['FullName'] ?>">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputEmail" class="">Email address:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputEmail" name="email"
                           value="<?= $row['EmailAddress'] ?>">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPhone" class="">Phone number:</label>
                </div>
                <div class="loginColumn2">
                    <input type="number" class="loginInput" id="inputPhone" name="phone"
                           value="<?= $row['PhoneNumber'] ?>">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputAddress" class="">Address:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputAddress" name="address"
                           value="<?= $row['address'] ?>">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPostal" class="">Postal code:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputPostal" name="postal"
                           value="<?= $row['postalCode'] ?>">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputCity" class="">City:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputCity" name="city"
                           value="<?= $row['city'] ?>">
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
                    <a class="loginLink" href="index.php" style="margin-left: 25%">Go back to home </a><input
                            type="submit"
                            name="logout"
                            value="Logout">
                </div>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['edit'])) {
        $password = hash('sha256', $_POST['password']);
        $HPass = strtoupper($password);

        if (empty($_POST['password'])) {
            $HPass = $row['HashedPassword'];
        }

        if ($_POST['email'] == $_POST['password']) {
            echo "Username and password can't be the same!";
        } elseif (empty($_POST['username'])) {
            echo "Fill in username!";
        } elseif (empty($_POST['email'])) {
            echo "Fill in email!";
        } elseif (empty($_POST['phone'])) {
            echo "Fill in phonenumber!";
        } else {
            $sql = "UPDATE people SET FullName = ?, address = ?, postalCode = ?, city = ?, LogonName = ?, HashedPassword = ?, PhoneNumber = ?, EmailAddress = ? WHERE PersonID = '$userId'";

            $stmt = $connection->prepare($sql);
            $stmt->bind_param('ssssssss', $_POST['username'], $_POST['address'], $_POST['postal'], $_POST['city'], $_POST['email'], $HPass, $_POST['phone'], $_POST['email']);
            $stmt->execute();

            echo '<script> window.location.href = "dashboard.php"; </script>';
        }
    }
}


if (isset($_POST['logout'])) {
    $_SESSION['login'] = FALSE;
    echo '<script> window.location.href = "login.php"; </script>';
}