<?php
include "includes/funtions.php";

$host = "localhost";
$databasename = "wideworldimporters";
$user = "root";
$pass = ""; //eigen password invullen
$port = 3306;
$connection = mysqli_connect($host, $user, $pass, $databasename, $port);

GetDeals($connection);

$results = GetDeals($connection);
$aantalpaginas = floor(mysqli_num_rows($results) / 3);
$fullarray = array();
$i = 0;
foreach ($results as $row) {
    if (mysqli_num_rows($results) != 0) {
        $fullarray[$i] = $row;
        $i++;

    }
}

print($fullarray[1]['ProductID']);





