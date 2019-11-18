<?php
$active = "login";
include "includes/header.php";
//session_start();
?>

<div class="loginBox">
    <form method="post">
        <div class="loginRow">
            <div class="loginHead">
                <h2>World Wide Importers Login</h2>
            </div>
        </div>
        <div class="loginRow">
            <div class="loginColumn1">
                <label for="inputEmail" class=""><div class ='email'>Email: </div></label>
            </div>
            <div class="loginColumn2">
                <input type="text" class="loginInput" id="inputEmail" name="username" placeholder="Email">
            </div>
        </div>
        <div class="loginRow">
            <div class="loginColumn1">
                <label for="inputPassword" class="">Password:</label>
            </div>
            <div class="loginColumn2">
                <input type="password" class="loginInput" id="inputPassword" name="password" placeholder="Password">
            </div>
        </div>
        <div class="loginRow">
            <div class="loginColumn2">
                <input type="submit" class="" name="submit" value="Sign in"> <a class="loginLink" href="">Forgot password?</a> <!-- sign in en forgot password doen nog niks -->
            </div>
        </div>
    </form>
</div>

<?php

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $HPass = hash('sha256', $_POST['password']);
    $HPass = strtoupper($HPass);
} else {
    $username = "";
}

$sql = "SELECT * FROM people LIMIT 1";
/*printen van de resultaten op het scherm*/
$res_data = mysqli_query($connection,$sql);
while ($row = mysqli_fetch_array($res_data)) {
    if ($row['LogonName'] == $username && $row['HashedPassword'] == $HPass){
        $_SESSION['login'] = TRUE;
    } elseif (!($row['LogonName'] == $username && $row['HashedPassword'] == $HPass)) {
        echo "verkeerd ingevuld";
    } else {
        $_SESSION['login'] = FALSE;
    }
}

if ($_SESSION['login'] == TRUE){
//    echo '<script> window.location.href = "dashboard.php"; </script>';
    echo "ingelogt!";
} elseif ($_SESSION['login'] == FALSE) {
    echo "Verkeerde gegevens!";
}

include "includes/footer.php";
?>