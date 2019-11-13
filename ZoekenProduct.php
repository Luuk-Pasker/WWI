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

<form method="get" action="ZoekenProduct.php">
    <label>Zoek Product</label>
    <input type="text" name="zoek" value=""/><br>
    <input type="submit" name="toevoegen" value="Toevoegen"/>
</form>


<?php

if(isset($_GET["toevoegen"])) {
    $zoek = $_GET["zoek"];
    $result = ZoekPoduct($connection, $zoek);
    foreach ($result as $product) {
        print($product["StockItemName"] . " " . $product["RecommendedRetailPrice"] . "<br>");
    }
}

include "includes/footer.php";
?>