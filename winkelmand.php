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
    print("€" . $_SESSION["Prices"][$index]);
    print("</div>");
    print("<div class='scTPrice'>");
    $TPrice = $_SESSION["Prices"][$index] * $_SESSION["Quantitys"][$index];
    print("€" . $TPrice);
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
    print("<b>€$shippingPrice</b><br><br>");
    $_SESSION["TotalPrice"] += $shippingPrice;
    print("<b>€" . $_SESSION['TotalPrice'] . "</b>");
    print("</div>");
    print("</div>");

    print("<form action='betalen.php' class='scButton'><input type='submit' value='Buy items'></form>");
}

if(isset($_GET["ItemID"]) && isset($_GET["ItemName"]) && isset($_GET["quantity"]) && isset($_GET["ItemPrice"]) && isset($_GET["image"])) {
    $ItemID = $_GET["ItemID"];
    $ItemName = $_GET["ItemName"];
    $quantity = $_GET["quantity"];
    $price = $_GET["ItemPrice"];
    $image = $_GET["image"];
}

if(!(isset($_SESSION["IDs"]) && isset($_SESSION["Names"]) && isset($_SESSION["Quantitys"]) && isset($_SESSION["Prices"]) && isset($_SESSION["Images"]))) {
    $_SESSION["IDs"] = array();
    $_SESSION["Names"] = array();
    $_SESSION["Quantitys"] = array();
    $_SESSION["Prices"] = array();
    $_SESSION["Images"] = array();
}

if(isset($_SESSION["IDs"]) && isset($_SESSION["Names"]) && isset($_SESSION["Quantitys"]) && isset($_SESSION["Prices"]) && isset($_SESSION["Images"]) && isset($ItemID)) {
    if (!(in_array($ItemID, $_SESSION["IDs"]))) {
        $_SESSION["IDs"][] = $ItemID;
        $_SESSION["Names"][] = $ItemName;
        $_SESSION["Quantitys"][] = $quantity;
        $_SESSION["Prices"][] = $price;
        $_SESSION["Images"][] = $image;
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