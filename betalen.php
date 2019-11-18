<?php
include "includes/header.php";
session_start();
?>

<a href="index.php">back</a>

<?php
foreach ($_SESSION["IDs"] as $i => $value) {
    unset($_SESSION["IDs"][$i]);
}
foreach ($_SESSION["Names"] as $i => $value) {
    unset($_SESSION["Names"][$i]);
}
foreach ($_SESSION["Prices"] as $i => $value) {
    unset($_SESSION["Prices"][$i]);
}
foreach ($_SESSION["Images"] as $i => $value) {
    unset($_SESSION["Images"][$i]);
}
foreach ($_SESSION["Quantitys"] as $i => $value) {
    unset($_SESSION["Quantitys"][$i]);
}
$_SESSION["TotalPrice"] = 0;
session_destroy();
include "includes/footer.php";
?>
