<?php

function print_sc_head(){
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

function print_sc_item($index){
    if (isset($_GET["Q$index"])) {
        $_SESSION["Quantitys"][$index] = $_GET["Q$index"];
        if ($_GET["Q$index"] == 0) {
            $_SESSION["skip"][] = $index;
        }
    }

    if(isset($_SESSION["IDs"][$index])) {
        $quantity = $_SESSION["Quantitys"][$index];

        if ($quantity > 0) {
            $stock = $_SESSION['Stocks'][$index];
            print("<div class='scRow'>");
            print("<div class='scImage'>");
            $Photo = $_SESSION['Images'][$index];
            print("<img src='$Photo' width='100px'>");
            print("</div>");
            print("<div class='scName'>");
            print($_SESSION["Names"][$index]);
            print("</div>");
            print("<div class='scAmount'>");
            print("<form><input class='loginInput' type='number' value='$quantity' name='Q$index' min=\"0\" max=\"$stock\"></form>");
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
    }
}

function print_sc_foot(){
    if($_SESSION["TotalPrice"]<50) {
        $shippingPrice = 6.95;
    }else{
        $shippingPrice = 0;
    }
    print("<div class='scRow'>");
    print("<div class='scImage'>");
    print("</div>");
    print("<div class='scName'>");
    print("shipping price is €6.95 for orders below €50.00");
    print("</div>");
    print("<div class='scAmount'>");
    print("</div>");
    print("<div class='scPrice'>");
    print("<b>Shipping price:</b><br><br><b>Total price:</b>");
    print("</div>");
    print("<div class='scTPrice'>");
    print("<b>€" . number_format((float)$shippingPrice, 2, '.', '') . "</b><br><br>");
    $_SESSION["TotalPrice"] += $shippingPrice;
    print("<b>€" . number_format((float)$_SESSION["TotalPrice"], 2, '.', '') . "</b>");
    print("</div>");
    print("</div>");

    print("<form action='betalen.php' class='scButton'><input type='submit' value='Buy items'></form>");
}

/*zoek alle huidige producten met korting op*/
function GetDeals($connection){
    $sql = "SELECT * FROM stockitems sitem JOIN stockitemstockgroups sitemsgroup ON sitem.StockItemID = sitemsgroup.StockItemID WHERE sitemsgroup.StockGroupID IN (SELECT StockGroupID FROM specialdeals) limit 4";
    $results = mysqli_query($connection, $sql);
    return $results;
}
/*zoek alle huidige producten met korting op*/

/*zoek de meest recent toegevoegde producten*/
function GetLaatstToegevoegd($connection){
    $sql = "select * from stockitems order by StockItemID desc limit 4";
    $GetLatstToegevoed = mysqli_query($connection, $sql);
    return $GetLatstToegevoed;
}
/*zoek de meest recent toegevoegde producten*/