<?php
if (isset($_POST['id'])) {
    unset($_GET["zoek"]);
    while ($row = mysqli_fetch_array($res_data)) {

        print($row["StockItemName"] . " €" . $row["UnitPrice"] . " Aantal:" . $row["QuantityOnHand"] . "<br>");

    }
} elseif(isset($_GET["toevoegen"])) {
    PrintSearchResults($_GET["zoek"]);
}