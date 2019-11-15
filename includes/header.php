<!DOCTYPE html>
<html>
<head>
    <?php
    include "db_config.php";
    ?>
    <title>
        World Wide Importers
    </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/slider.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="header">
    <a href="index.php" class="logo"><img src= "images/logo.png"></a>
    <div class="header-right">
        <div class="zoekbalk">
        <form method="get" action="browse.php">
            <input type="text" name="zoek" placeholder="Search.." value=""/>
            <input type="submit" name="toevoegen" value="Search"/>
        </form>
        </div>
        <a class="active" href="index.php">Homepage</a>
        <a href="browse.php">Browse</a>
        <a href="#about">About us</a>
        <a href="winkelmand.php">Shopping cart <img class='mand' src='images/winkelmand.jpg'></a>
        <a href="login.php">Login</a>

    </div>
</div>