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

print($fullarray[1]['StockItemName']);
print($fullarray[1]['UnitPrice'] . "\n");
print("\n" . $fullarray[1]['StockItemID']);

print($fullarray[2]['StockItemName']);
print($fullarray[2]['UnitPrice'] . "\n");
print("\n" . $fullarray[2]['StockItemID']);

print($fullarray[3]['StockItemName']);
print($fullarray[3]['UnitPrice'] . "\n");
print("\n" . $fullarray[3]['StockItemID']);

print($fullarray[4]['StockItemName']);
print($fullarray[4]['UnitPrice'] . "\n");
print("\n" . $fullarray[4]['StockItemID']);

print($fullarray[5]['StockItemName']);
print($fullarray[5]['UnitPrice'] . "\n");
print("\n" . $fullarray[5]['StockItemID']);

print($fullarray[6]['StockItemName']);
print($fullarray[6]['UnitPrice'] . "\n");
print("\n" . $fullarray[6]['StockItemID']);

print($fullarray[7]['StockItemName']);
print($fullarray[7]['UnitPrice'] . "\n");
print("\n" . $fullarray[7]['StockItemID']);

print($fullarray[8]['StockItemName']);
print($fullarray[8]['UnitPrice'] . "\n");
print("\n" . $fullarray[8]['StockItemID']);

print($fullarray[9]['StockItemName']);
print($fullarray[9]['UnitPrice'] . "\n");
print("\n" . $fullarray[9]['StockItemID']);

print($fullarray[10]['StockItemName']);
print($fullarray[10]['UnitPrice'] . "\n");
print("\n" . $fullarray[10]['StockItemID']);

print($fullarray[11]['StockItemName']);
print($fullarray[11]['UnitPrice'] . "\n");
print("\n" . $fullarray[11]['StockItemID']);

print($fullarray[12]['StockItemName']);
print($fullarray[12]['UnitPrice'] . "\n");
print("\n" . $fullarray[12]['StockItemID']);

print($fullarray[13]['StockItemName']);
print($fullarray[13]['UnitPrice'] . "\n");
print("\n" . $fullarray[13]['StockItemID']);





