<?php
if (!isset($active)) {
    $active = "user";
}
include "includes/header.php";

if ($_SESSION['login'] == FALSE) {
    echo '<script> window.location.href = "login.php"; </script>';
}
?>

<h1>You have been logged in!</h1>
<?php
$userId = $_SESSION['user_session'];

$sql = "SELECT * FROM people WHERE PersonID = $userId";
/*printen van de resultaten op het scherm*/
$res_data = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_array($res_data)) {
    echo "<h3>Welkom " . $row['FullName'] . "</h3>";
}
?>

<br><a href="index.php">Go back to home</a>
<form method="post">
    <input type="submit" name="submit" value="logout">
</form>

<?php
if (isset($_POST['submit'])) {
    $_SESSION['login'] = FALSE;
    echo '<script> window.location.href = "login.php"; </script>';
}