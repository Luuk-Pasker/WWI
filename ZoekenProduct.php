<?php
//include "includes/header.php";
include "db_config.php";


function TelZoek($connection, $zoek){

    $statement = mysqli_prepare($connection, "select distinct * from stockitems sitem
join stockitemstockgroups sgroup on sgroup.StockItemID = sitem.StockItemID
join stockgroups sgroups on sgroup.StockGroupID = sgroups.StockGroupID
where StockItemName like CONCAT('%',?,'%')
or SearchDetails like CONCAT('%',?,'%')
or Tags like CONCAT('%',?,'%')
or StockGroupName = ?
or sitem.StockItemID = ?
order by StockItemName
");

    mysqli_stmt_bind_param($statement,'ssssi', $zoek, $zoek, $zoek, $zoek, $zoek);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $result = mysqli_num_rows($result);
    $pageszoekfunctie = ceil($result / 25);
    return $pageszoekfunctie;
}

function ZoekPoduct($connection, $zoek, $no_of_records_per_page, $offset) {
    $statement = mysqli_prepare($connection, "select distinct * from stockitems sitem
join stockitemstockgroups sgroup on sgroup.StockItemID = sitem.StockItemID
join stockgroups sgroups on sgroup.StockGroupID = sgroups.StockGroupID
where StockItemName like CONCAT('%',?,'%')
or SearchDetails like CONCAT('%',?,'%')
or Tags like CONCAT('%',?,'%')
or StockGroupName = ?
or sitem.StockItemID = ?
limit $no_of_records_per_page, $offset");

    mysqli_stmt_bind_param($statement,'ssssi', $zoek, $zoek, $zoek, $zoek, $zoek);
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
    <!--<form method="get" action="ZoekenProduct.php">
        <label for="0-5">0-5</label><input type="checkbox" id="0-5"><br>
        <label for="5-50">5-50</label><input type="checkbox" id="5-50"><br>
        <label for="50-100">50-100</label><input type="checkbox" id="50-100"><br>
    </form>-->


<?php

/*if(isset($_GET["toevoegen"])) {
    $zoek = $_GET["zoek"];
    $result = ZoekPoduct($connection, $zoek);
    if(mysqli_num_rows($result) > 0) {
        foreach ($result as $product) {
            print($product["StockItemName"] . " " . $product["RecommendedRetailPrice"] . "<br>");
        }
        header('location: browse.php');
        exit();
    } else {
        header('location: NiksGevonden.php');
        exit();
    }

}*/


function PrintSearchResults($search, $no_of_records_per_page, $offset) {
    GLOBAL $pageszoekfunctie;
    $zoek = $search;
    $host = "localhost";
    $databasename = "wideworldimporters";
    $user = "root";
    $pass = ""; //eigen password invullen
    $port = 3306;
    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
    $result = ZoekPoduct($connection, $zoek, $no_of_records_per_page, $offset);
    if(mysqli_num_rows($result) > 0) {
        foreach ($result as $product) {
            print("<div class='test'>");
            print("<img class='productfoto' src='images/" . $product['Photo'] . "'" . "<br>");
            print("<div class='productnaam'>");
            print("<a href='productBekijken.php?id=" . $product['StockItemID'] . "'>" . $product["StockItemName"] . " €" . $product["RecommendedRetailPrice"] . "</a><br>");
            print("</div>");
            print("</div>");
        }
    } else {
        header('location: NiksGevonden.php');
        exit();
    }
}

// aanroepen om resultaten te printen
/*if(isset($_GET["toevoegen"])) {
    PrintSearchResults($_GET["zoek"]);
}*/
//include "includes/footer.php";
?>