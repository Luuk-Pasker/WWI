<!DOCTYPE html>
<html>
<head>
    <?php
    include "db_config.php";
    $active="";
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
        <a <?php if($active == "home"){echo 'class="active"';} ?> href="index.php">Homepage</a>
        <a <?php if($active == "browse"){echo 'class="active"';} ?> href="browse.php">Browse</a>
        <a <?php if($active == "about"){echo 'class="active"';} ?> href="#about">About us</a>
        <a <?php if($active == "cart"){echo 'class="active"';} ?>href="winkelmand.php">Shopping cart <img class='mand' src='images/winkelmand.jpg'></a>
        <a <?php if($active == "login"){echo 'class="active"';} ?>href="login.php">Login</a>

    </div>
</div>
<div class="balk"></div>