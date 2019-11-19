<?php
$active = "login";
include "includes/header.php";
?>
<h1>U bent ingelogt!</h1>
<a href="index.php">Ga terug naar home!</a>

<form method="post">
    <input type="submit" name="submit" value="logout">
</form>

<?php
if (isset($_POST['submit'])){
    session_destroy();
    echo '<script> window.location.href = "login.php"; </script>';
}