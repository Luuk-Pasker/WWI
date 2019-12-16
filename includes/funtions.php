<?php

function sc_Print(){
    foreach($_SESSION["IDs"] as $index => $val) {
        //past de aantallen aan
        if (isset($_POST["Q$index"])) {
            $_SESSION["Quantitys"][$index] = $_POST["Q$index"];
        }
        //verwijdert items uit de lijst
        if (isset($_POST["D$index"])) {
            unset($_SESSION["IDs"][$index]);
            unset($_SESSION["Names"][$index]);
            unset($_SESSION["Prices"][$index]);
            unset($_SESSION["Images"][$index]);
            unset($_SESSION["Quantitys"][$index]);
            unset($_SESSION["DealPrices"][$index]);
            unset($_SESSION["Stocks"][$index]);
            header('Location: '.$_SERVER['REQUEST_URI']);
        }
    }

    //print de images
    print("<div class='scImage'>");
        print("<div class='scHeadRow'>");
            print("<br>");
        print("</div>");

    foreach($_SESSION["IDs"] as $index => $val){
        $Photo = $_SESSION['Images'][$index];
        print("<div class='scImageRow'>");
        print("<img src='$Photo' height='100px'>");
        print("</div>");
    }
    print("</div>");

    //print de namen
    print("<div class='scName'>");
        print("<div class='scHeadRow'>");
            print("<b>Item name</b>");
        print("</div>");

    foreach($_SESSION["IDs"] as $index => $val){
        print("<div class='scRow'>");
        $Name = $_SESSION['Names'][$index];
            print("<a class='scLink' href='productBekijken.php?id=" . $_SESSION["IDs"][$index] . "'>$Name</a>");
        print("</div>");
    }
        print("<div class='scHeadRow'>");
            print("<br><br><br>Shipping price is €6.95 for orders below €50.00");
        print("</div>");
    print("</div>");

    //print de aantallen
    print("<div class='scAmount'>");
        print("<div class='scHeadRow'>");
            print("<b>Amount</b>");
        print("</div>");
        print("<form name='form' method='post'>");
    foreach($_SESSION["IDs"] as $index => $val){
        //veranderd de hoeveelheid naar 3000 of de hoeveelheid op voorraad als de ingevorde waarde groter is dan die waardes
        if($_SESSION["Quantitys"][$index]>$_SESSION["Stocks"][$index]){
            $_SESSION["Quantitys"][$index] = $_SESSION["Stocks"][$index];
        }
        if($_SESSION["Quantitys"][$index]>3000){
            $_SESSION["Quantitys"][$index] = 3000;
        }
        //veranderd de hoeveelheid naar 1als de ingevorde waarde kleiner is dan 1
        if($_SESSION["Quantitys"][$index]<1){
            $_SESSION["Quantitys"][$index] = 1;
        }
        $quantity = $_SESSION["Quantitys"][$index];
            print("<div class='scRow'>");
                print("<input class='loginInput Inputborder' type='number' value='$quantity' name='Q$index'>");//onblur='this.form.submit()'
            print("</div>");
    }
            print("<button class='scUpdate'>Update amounts</button>");
        print("</form>");
    print("</div>");

    //print de prijzen per stuk
    print("<div class='scPrice'>");
        print("<div class='scHeadRow'>");
            print("<b>Price per Item</b>");
        print("</div>");

    foreach($_SESSION["IDs"] as $index => $val){
        if($_SESSION["DealPrices"][$index] == -1000){
            $UnitPrice = $_SESSION["Prices"][$index];
            $hasDeal = FALSE;
        }else{
            $UnitPrice = $_SESSION["DealPrices"][$index];
            $hasDeal = TRUE;
        }
        print("<div class='scRow'>");
            print("€" . number_format((float)$UnitPrice, 2, '.', ''));
            if($hasDeal){
                print("<br><div class='scOldPrice'><strike>€" . number_format((float)$_SESSION["Prices"][$index], 2, '.', '') . "</strike></div>");
            }
        print("</div>");
    }
        print("<div class='scHeadRow'>");
            print("<br><br><br><b>Shipping<br>price:</b><br><br><b>Total price:</b>");
        print("</div>");
    print("</div>");

    //print de totaal prijzen
    print("<div class='scTPrice'>");
        print("<div class='scHeadRow'>");
            print("<b>Total price</b>");
        print("</div>");

    foreach($_SESSION["IDs"] as $index => $val){
        if($_SESSION["DealPrices"][$index] == -1000){
            $UnitPrice = $_SESSION["Prices"][$index];
            $hasDeal = FALSE;
        }else{
            $UnitPrice = $_SESSION["DealPrices"][$index];
            $hasDeal = TRUE;
        }
        $TPrice = $UnitPrice * $_SESSION["Quantitys"][$index];
        $_SESSION["TotalPrice"] += $TPrice;
        print("<div class='scRow'>");
            print("€" . number_format((float)$TPrice, 2, '.', ''));
            if($hasDeal){
                print("<br><div class='scOldPrice'><strike>€" . number_format((float)$_SESSION["Prices"][$index] * $_SESSION["Quantitys"][$index], 2, '.', '') . "</strike></div>");
            }
        print("</div>");
    }
    //berekent de verzendkosten
    if($_SESSION["TotalPrice"]<50) {
        $shippingPrice = 6.95;
    }else{
        $shippingPrice = 0;
    }
    $_SESSION["TotalPrice"] += $shippingPrice;

        print("<div class='scHeadRow'>");
            print("<br><br><br><br><b>€" . number_format((float)$shippingPrice, 2, '.', '') . "</b>");
            print("<b><br><br>€" . number_format((float)$_SESSION["TotalPrice"], 2, '.', '') . "</b>");
            print("<br><br><form action='betalen.php' class='scButton'><input type='submit' value='Buy items'></form>");
        print("</div>");
    print("</div>");

    //print de verwijderknoppen
    print("<div class='scDelete'>");
        print("<div class='scHeadRow'>");
            print("<br>");
        print("</div>");

    foreach($_SESSION["IDs"] as $index => $val){
        print("<div class='scDeleteRow'>");
            print("<form method='post'><button class='scTrashcan' type='submit' name='D$index' value='true' ><img src='images/trashcan.JPG' width='28px' alt='X'></button></form>");
        print("</div>");
    }
    print("</div>");
}

/*zoek alle huidige producten met korting op*/
function GetDeals($connection){
    $sql = "SELECT * FROM stockitems sitem JOIN stockitemstockgroups sitemsgroup ON sitem.StockItemID = sitemsgroup.StockItemID WHERE sitemsgroup.StockGroupID IN (SELECT StockGroupID FROM specialdeals) limit 4";
    $results = mysqli_query($connection, $sql);
    return $results;
}
/*zoek alle huidige producten met korting op*/

/*zoek alle huidige producten met korting op voor browse pagina*/
function GetDealsBrowse($connection){
    $sql = "SELECT * FROM stockitems sitem JOIN stockitemstockgroups sitemsgroup ON sitem.StockItemID = sitemsgroup.StockItemID WHERE sitemsgroup.StockGroupID IN (SELECT StockGroupID FROM specialdeals)";
    $results = mysqli_query($connection, $sql);
    return $results;
}
/*zoek alle huidige producten met korting op voor browse pagina*/

/*zoek alle huidige producten die nieuw zijn voor op browse pagina*/
function GetLaatstToegevoegdBrowse($connection){
    $sql = "select * from stockitems order by StockItemID desc";
    $GetLatstToegevoed = mysqli_query($connection, $sql);
    return $GetLatstToegevoed;
}
/*zoek alle huidige producten die nieuw zijn voor op browse pagina*/

/*zoek de meest recent toegevoegde producten*/
function GetLaatstToegevoegd($connection){
    $sql = "select * from stockitems order by StockItemID desc limit 4";
    $GetLatstToegevoed = mysqli_query($connection, $sql);
    return $GetLatstToegevoed;
}
/*zoek de meest recent toegevoegde producten*/

function getName($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}