<?php
$active = "cart";
include "includes/header.php";
include "includes/funtions.php";

session_start();

//maakt de arrays als ze nog niet bestaan
if(!(isset($_SESSION["IDs"]) && isset($_SESSION["Names"]) && isset($_SESSION["Quantitys"]) && isset($_SESSION["Prices"]) && isset($_SESSION["Images"]) && isset($_SESSION["Stocks"]))) {
    $_SESSION["IDs"] = array();
    $_SESSION["Names"] = array();
    $_SESSION["Quantitys"] = array();
    $_SESSION["Prices"] = array();
    $_SESSION["Images"] = array();
    $_SESSION["Stocks"] = array();
}

//haalt de nodige waarden op van de productBekijken pagina en de database
if(isset($_GET["ItemID"]) && isset($_GET["quantity"]) && isset($_GET["ItemPrice"])) {
    $ItemID = $_GET["ItemID"];

    $sql = "SELECT * FROM stockitems S LEFT JOIN stockitemholdings H ON S.StockItemID = H.StockItemID WHERE S.StockItemID = $ItemID";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $image = "images/120_dino_slippers.jpg";
        //$row["Photo"]
        $ItemName = $row["StockItemName"];
        $stock = $row["QuantityOnHand"];
    }
    $quantity = $_GET["quantity"];
    $price = $_GET["ItemPrice"];
}

//zet de waarden in de arrays als dat ID er nog niet instaat
if(isset($_SESSION["IDs"]) && isset($_SESSION["Names"]) && isset($_SESSION["Quantitys"]) && isset($_SESSION["Prices"]) && isset($_SESSION["Images"]) && isset($_SESSION["Stocks"]) && isset($ItemID)) {
    if (!(in_array($ItemID, $_SESSION["IDs"]))) {
        $_SESSION["IDs"][] = $ItemID;
        $_SESSION["Names"][] = $ItemName;
        $_SESSION["Quantitys"][] = $quantity;
        $_SESSION["Prices"][] = $price;
        $_SESSION["Images"][] = $image;
        $_SESSION["Stocks"][] = $stock;
    }
}
?>

<a href="index.php">< Go back to shopping</a>
<h2 class="a.hoofdtext">Shoppingcart</h2>

<div class="scBox">
    <?php
    $_SESSION["TotalPrice"] = 0;
    print_sc_head();
    for ($i = 0; $i < count($_SESSION["IDs"]); $i++) {
        print_sc_item($i);
    }
    print_sc_foot();
    ?>
</div>

<?php
include "includes/footer.php";
?>