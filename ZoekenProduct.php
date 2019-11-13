<?php
include "includes/header.php";
include "db_config.php";


function ZoekPoduct($connection, $zoek) {
    $statement = mysqli_prepare($connection, "select * from stockitems where StockItemName like CONCAT('%',?,'%') or SearchDetails like CONCAT('%',?,'%') or Tags like CONCAT('%',?,'%') order by StockItemName");
    mysqli_stmt_bind_param($statement,'sss', $zoek, $zoek, $zoek);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    return $result;
}

?>

<!--<form method="get" action="ZoekenProduct.php">
    <label>Zoek Product</label>
    <input type="text" name="zoek" value=""/><br>
    <input type="submit" name="toevoegen" value="Toevoegen"/>
</form>-->
<form method="get" action="ZoekenProduct.php">
    <label for="0-5">0-5</label><input type="checkbox" id="0-5"><br>
    <label for="5-50">5-50</label><input type="checkbox" id="5-50"><br>
    <label for="50-100">50-100</label><input type="checkbox" id="50-100"><br>
</form>


<?php

if(isset($_GET["toevoegen"])) {
    $zoek = $_GET["zoek"];
    $result = ZoekPoduct($connection, $zoek);
    foreach ($result as $product) {
        print($product["StockItemName"] . " " . $product["RecommendedRetailPrice"] . "<br>");
    }
    header('location: browse.php');
    exit();
}

include "includes/footer.php";
?>