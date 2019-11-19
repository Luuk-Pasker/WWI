<?php
$active = "cart";
include "includes/header.php";

session_start();

function print_head(){
    print("<div class='scRow'>");
    print("<div class='scImage'>");
    print("</div>");
    print("<div class='scName'>");
    print("<b>Item name</b>");
    print("</div>");
    print("<div class='scAmount'>");
    print("<b>Amount</b>");
    print("</div>");
    print("<div class='scPrice'>");
    print("<b>Price per item</b>");
    print("</div>");
    print("<div class='scTPrice'>");
    print("<b>Total price</b>");
    print("</div>");
    print("</div>");
}

function print_item($index){
    print("<div class='scRow'>");
    print("<div class='scImage'>");
    $Photo = $_SESSION['Images'][$index];
    print("<img src='$Photo' width='100px'>");
    print("</div>");
    print("<div class='scName'>");
    print($_SESSION["Names"][$index]);
    print("</div>");
    print("<div class='scAmount'>");
    print($_SESSION["Quantitys"][$index]);
    print("</div>");
    print("<div class='scPrice'>");
    print("€" . number_format((float)$_SESSION["Prices"][$index], 2, '.', ''));
    print("</div>");
    print("<div class='scTPrice'>");
    $TPrice = $_SESSION["Prices"][$index] * $_SESSION["Quantitys"][$index];
    print("€" . number_format((float)$TPrice, 2, '.', ''));
    $_SESSION["TotalPrice"] += $TPrice;
    print("</div>");
    print("</div>");
}

function print_foot(){
    if($_SESSION["TotalPrice"]<50) {
        $shippingPrice = 6.95;
    }else{
        $shippingPrice = 0;
    }
    print("<div class='scRow'>");
    print("<div class='scImage'>");
    print("</div>");
    print("<div class='scName'>");
    print("</div>");
    print("<div class='scAmount'>");
    print("</div>");
    print("<div class='scPrice'>");
    print("<b>Shipping price:<br><br> Total price:</b>");
    print("</div>");
    print("<div class='scTPrice'>");
    print("<b>€" . number_format((float)$shippingPrice, 2, '.', '') . "</b><br><br>");
    $_SESSION["TotalPrice"] += $shippingPrice;
    print("<b>€" . number_format((float)$_SESSION["TotalPrice"], 2, '.', '') . "</b>");
    print("</div>");
    print("</div>");

    print("<form action='betalen.php' class='scButton'><input type='submit' value='Buy items'></form>");
}


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
    print_head();
    for ($i = 0; $i < count($_SESSION["IDs"]); $i++) {
        print_item($i);
    }
    print_foot();
    ?>
</div>

<?php
include "includes/footer.php";
?>