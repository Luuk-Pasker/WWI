<?php
$active = "login";
include "includes/header.php";
?>

    <div class="loginBox" style="height: 40%;">
        <form method="post">
            <div class="loginRow">
                <div class="loginHead">
                    <h2>Wide World Importers User</h2>
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputEmail" class="form-label">Email:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="form-control form-border" id="inputEmail" name="username" placeholder="Email">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPassword" class="form-label">Password:</label>
                </div>
                <div class="loginColumn2">
                    <input type="password" class="form-control form-border" id="inputPassword" name="password" placeholder="Password">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn2">
                    <input type="submit" class="" name="submit" value="Login">
                    <a href="register.php"><input type="submit" name="register" value="Sign up"></a>
                    
                    <!-- sign in en forgot password doen nog niks -->
                </div>
            </div>
        </form>
    </div>

<?php
$username = "";

if (isset($_POST['register'])) {
    echo '<script> window.location.href = "register.php"; </script>';
}

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) && empty($_POST['password'])) {
        $error = "Fill in data";
    } else {
        $username = $_POST['username'];
        $HPass = hash('sha256', $_POST['password']);
        $HPass = strtoupper($HPass);

        $sql = "SELECT * FROM people";
        $res_data = mysqli_query($connection, $sql);
        /*printen van de resultaten op het scherm*/
        foreach ($res_data as $row1) {
            if ($row1['LogonName'] == $username && $row1['HashedPassword'] == $HPass) {

                $sql = "SELECT * FROM people WHERE LogonName = '$username' AND HashedPassword = '$HPass'";
                $res_data = mysqli_query($connection, $sql);
                /*printen van de resultaten op het scherm*/
                foreach ($res_data as $row) {
                    $_SESSION['login'] = TRUE;
                    $_SESSION['user_session'] = $row['PersonID'];
                    $_SESSION['email'] = $row['EmailAddress'];
                    $_SESSION['name'] = $row['FullName'];
                }

            } else {
                $error = "Wrong information!";
            }
        }
    }
}


if (empty($error)) {

} else {
    echo "<div class='errorBox'>$error</div>";
}

if (empty($_SESSION['login'])) {

} else if ($_SESSION['login'] == TRUE) {
    echo '<script> window.location.href = "dashboard.php"; </script>';
}


include "includes/footer.php";
?>