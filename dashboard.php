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
    $_SESSION['fullname'] = $row['FullName'];
    $_SESSION['email'] = $row['EmailAddress'];
    $userId = $_SESSION['user_session'];
    $sql = "SELECT * FROM discount WHERE PersonID = $userId";
    /*printen van de resultaten op het scherm*/
    $res_data = mysqli_query($connection, $sql);
    while ($row1 = mysqli_fetch_array($res_data)) {
        if ($row1['discountUsed'] == 1) {
            ?>

            <div class="loginBox1">
                <h3 class="discount" style="margin-top: 70%">You discountcode is:<br>
                    <?= $row1['discountCode'] ?></h3>
                <p class="discount">Usable for one time only!<br>For 20% discount!</p>
            </div>
            <?php
        }
    }
    ?>
    <div class="loginBox" style="height: 85%; top: 70%; margin-bottom: 5%;">
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
                    <label for="inputName" class="form-label">Full name:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="form-control form-border" id="inputName" name="username"
                           value="<?= $row['FullName'] ?>">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputEmail" class="form-label">Email address:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="form-control form-border" id="inputEmail" name="email"
                           value="<?= $row['EmailAddress'] ?>">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPhone" class="form-label">Phone number:</label>
                </div>
                <div class="loginColumn2">
                    <input type="number" class="form-control form-border" id="inputPhone" name="phone"
                           value="<?= $row['PhoneNumber'] ?>">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputAddress" class="form-label">Address:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="form-control form-border" id="inputAddress" name="address"
                           value="<?= $row['address'] ?>">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPostal" class="form-label">Postal code:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="form-control form-border" id="inputPostal" name="postal"
                           value="<?= $row['postalCode'] ?>">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputCity" class="form-label">City:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="form-control form-border" id="inputCity" name="city"
                           value="<?= $row['city'] ?>">
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
                <div class="loginColumn2">
                    <input type="submit" name="edit" value="Edit information">
                    <a class="loginLink" href="index.php" style="margin-left: 22%; margin-right: 5%">Home </a>
                    <input type="submit" name="logout" value="Logout">
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
            $error = "Username and password can't be the same!";
        } elseif (empty($_POST['username'])) {
            $error = "Fill in name!";
        } elseif (empty($_POST['email'])) {
            $error = "Fill in email!";
        } elseif (empty($_POST['phone'])) {
            $error = "Fill in phonenumber!";
        } elseif (empty($_POST['address'])) {
            $error = "Fill in address!";
        } elseif (empty($_POST['postal'])) {
            $error = "Fill in postal code!";
        } elseif (empty($_POST['city'])) {
            $error = "Fill in city!";
        } else {
            $sql = "UPDATE people SET FullName = ?, address = ?, postalCode = ?, city = ?, LogonName = ?, HashedPassword = ?, PhoneNumber = ?, EmailAddress = ? WHERE PersonID = '$userId'";

            $stmt = $connection->prepare($sql);
            $stmt->bind_param('ssssssss', $_POST['username'], $_POST['address'], $_POST['postal'], $_POST['city'], $_POST['email'], $HPass, $_POST['phone'], $_POST['email']);
            $stmt->execute();

            echo '<script> window.location.href = "dashboard.php"; </script>';
        }
    }
}

if (empty($error)) {

} else {
    echo "<div class='errorBox' style='margin-top: 0.2%'>$error</div>";
}

if (isset($_POST['logout'])) {
    $_SESSION['login'] = FALSE;
    echo '<script> window.location.href = "login.php"; </script>';
}