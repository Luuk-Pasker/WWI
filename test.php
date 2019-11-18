<?php
include "includes/header.php";
include "ZoekenProduct.php";
session_start();
?>

    <form method="post">
        <input type="text" name="username">
        <input type="password" name="password">
        <input type="submit" name="submit">
    </form>

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
        echo "Goed!";
        $_SESSION['login'] = TRUE;
    } else {
        echo "FOUT!";
        $_SESSION['login'] = false;
    }
}

if ($_SESSION['login'] == TRUE){
    echo '<script> window.location.href = "dashboard.php"; </script>';
} else {
    echo "Verkeerde gegevens!";
}

include "includes/footer.php";