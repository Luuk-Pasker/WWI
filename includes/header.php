<!DOCTYPE html>
<html>
<head>
    <script src="https://kit.fontawesome.com/bf0a4498c5.js" crossorigin="anonymous"></script>
    <?php
    include "db_config.php";
    if (!isset($active)) {
        $active = "";
    }
    session_start();
    ?>
    <title>
        Wide World Importers
    </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/slider.css">
    <link rel="stylesheet" type="text/css" href="css/browse.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="header">
    <a href="index.php" class="logo"><img src="images/logo.png"></a>
    <div class="header-right">
        <div class="zoekbalk">
            <form method="get" action="browse.php">
                <input type="text" name="zoek" placeholder="Search.." value=""/>
                <input type="submit" name="toevoegen" value="Search"/>
            </form>
        </div>
        <a <?php if ($active == "home") {
            echo 'class="active"';
        } ?> href="index.php"> <i class="fas fa-home"></i> Home</a>
        <a <?php if ($active == "browse") {
            echo 'class="active"';
        } ?> href="browse.php"><i class="fas fa-globe"></i> Browse</a>
        <a <?php if ($active == "about") {
            echo 'class="active"';
        } ?> href="aboutus.php"> About us</a>
        <a <?php if ($active == "cart") {
            echo 'class="active"';
        } ?>href="winkelmand.php"><i class="fas fa-shopping-cart"></i> Shopping cart</a>
        <?php
        $userId = $_SESSION['user_session'];
        $sql = "SELECT * FROM people WHERE PersonID = $userId";
        /*printen van de resultaten op het scherm*/
        $res_data = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_array($res_data)) {

            if (empty($_SESSION['login'])) {
                echo "<a href = 'login.php' ";
                if ($active == 'login') {
                    echo "class='active'";
                }
                echo "><i class='fas fa-sign-in-alt'></i> Login</a>";
            } else if ($_SESSION['login'] == TRUE) {
                echo "<a href='dashboard.php' ";
                if ($active == 'user') {
                    echo "class='active'";
                }
                echo "> <i class='fas fa-user'></i> " . $row['FullName'] . "</a>";
            }
        }
        ?>
    </div>
</div>