<!DOCTYPE html>
<html>
<head>
    <script src="https://kit.fontawesome.com/bf0a4498c5.js" crossorigin="anonymous"></script>
    <?php
    include "../db_config.php";
    if(!isset($active)) {
        $active = "";
    }
    session_start();

    if ($_SESSION['login'] == FALSE){
        echo '<script> window.location.href = "../login.php"; </script>';
    }
    ?>
    <title>
        World Wide Importers
    </title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/slider.css">
    <link rel="stylesheet" type="text/css" href = "../css/browse.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="header">
    <a href="../index.php" class="logo"><img src= "../images/logo.png"></a>
    <div class="header-right">
        <div class="zoekbalk">
            <form method="get" action="../browse.php">
                <input type="text" name="zoek" placeholder="Search.." value=""/>
                <input type="submit" name="toevoegen" value="Search"/>
            </form>
        </div>
        <a <?php if($active == "home"){echo 'class="active"';} ?> href="../index.php"> <i class="fas fa-home"></i> Home</a>
        <a <?php if($active == "browse"){echo 'class="active"';} ?> href="../browse.php"><i class="fas fa-globe"></i> Browse</a>
        <a <?php if($active == "about"){echo 'class="active"';} ?> href="../aboutus.php"> About us</a>
        <a <?php if($active == "cart"){echo 'class="active"';} ?>href="../winkelmand.php"><i class="fas fa-shopping-cart"></i> Shopping cart</a>
        <a <?php if($active == "login"){echo 'class="active"';} ?>href="../login.php"> <i class="fas fa-sign-in-alt"></i> Login</a>

    </div>
</div>
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

<br><a href="../index.php">Go back to home</a>
<form method="post">
    <input type="submit" name="submit" value="logout">
</form>

<?php
if (isset($_POST['submit'])){
    $_SESSION['login'] = FALSE;
    echo '<script> window.location.href = "../login.php"; </script>';
}