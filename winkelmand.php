<link rel="stylesheet" type="text/css" href="css/productBekijken.css">
<?php
$active = "cart";
include "includes/header.php";
include "includes/funtions.php";

//maakt de arrays als ze nog niet bestaan
if(!(isset($_SESSION["IDs"]) && isset($_SESSION["Names"]) && isset($_SESSION["Quantitys"]) && isset($_SESSION["Prices"]) && isset($_SESSION["Images"]) && isset($_SESSION["Stocks"]) && isset($_SESSION["DealPrices"]))) {
    $_SESSION["IDs"] = array();
    $_SESSION["Names"] = array();
    $_SESSION["Quantitys"] = array();
    $_SESSION["Prices"] = array();
    $_SESSION["Images"] = array();
    $_SESSION["Stocks"] = array();
    $_SESSION["DealPrices"] = array();
}

//haalt de nodige waarden op van de productBekijken pagina en de database
if(isset($_POST["ItemID"]) && isset($_POST["quantity"]) && isset($_POST["ItemPrice"])) {
    $ItemID = $_POST["ItemID"];

    $sql = "SELECT * FROM stockitems S LEFT JOIN stockitemholdings H ON S.StockItemID = H.StockItemID WHERE S.StockItemID = $ItemID";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $image = 'images/ProductImages/' . $ItemID . '.1.jpg';
        if(!(@getimagesize($image))){
            $image = "images/" . $row['Photo'];
        }
        $ItemName = $row["StockItemName"];
        $stock = $row["QuantityOnHand"];
    }
    $quantity = $_POST["quantity"];
    $price = $_POST["ItemPrice"];
    $DealPrice = $_POST["DealPrice"];
    $hasDeal = $_POST["hasDeal"];
}

//zet de waarden in de arrays als dat ID er nog niet instaat
if(isset($_SESSION["IDs"]) && isset($_SESSION["Names"]) && isset($_SESSION["Quantitys"]) && isset($_SESSION["Prices"]) && isset($_SESSION["Images"]) && isset($_SESSION["Stocks"]) && isset($_SESSION["DealPrices"]) && isset($ItemID)) {
    if (!(in_array($ItemID, $_SESSION["IDs"]))) {
        $_SESSION["IDs"][] = $ItemID;
        $_SESSION["Names"][] = $ItemName;
        $_SESSION["Quantitys"][] = $quantity;
        $_SESSION["Prices"][] = $price;
        $_SESSION["Images"][] = $image;
        $_SESSION["Stocks"][] = $stock;
        if($hasDeal) {
            $_SESSION["DealPrices"][] = $DealPrice;
        }else{
            $_SESSION["DealPrices"][] = -1000;
        }
    }
}
?>

<!-- go back knop-->
<div class="keerterug">
    <a class="KEERTERUGNU" href="browse.php" style="color: white;">
        <button class="btn" title="Go back"><i class="fas fa-long-arrow-alt-left"></i> Go back</button>
    </a>
</div>

        <!--<script>
            function goBack() {
                window.history.back();
            }
        </script>-->


<br>
<h1 class="a.hoofdtext">Shopping cart</h1>


<div class="scBox">
    <?php
    //dit print de hele winkelmand
    $_SESSION["TotalPrice"] = 0;
    if(count($_SESSION["IDs"])>0) {foreach ($_SESSION["IDs"] as $index => $val) {
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
            header('Location: ' . $_SERVER['REQUEST_URI']);
        }
    }

        //print de images
        print("<div class='scImage'>");
        print("<div class='scHeadRow'>");
        print("<br>");
        print("</div>");

        foreach ($_SESSION["IDs"] as $index => $val) {
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

        foreach ($_SESSION["IDs"] as $index => $val) {
            print("<div class='scRow'>");
            $Name = $_SESSION['Names'][$index];
            print("<a class='scLink' href='productBekijken.php?id=" . $_SESSION["IDs"][$index] . "'>$Name</a>");
            print("</div>");
        }
        print("</div>");

        //print de aantallen
        print("<div class='scAmount'>");
        print("<div class='scHeadRow'>");
        print("<b>Amount</b>");
        print("</div>");
        print("<form name='form' method='post'>");
        foreach ($_SESSION["IDs"] as $index => $val) {
            //veranderd de hoeveelheid naar 3000 of de hoeveelheid op voorraad als de ingevorde waarde groter is dan die waardes
            if ($_SESSION["Quantitys"][$index] > $_SESSION["Stocks"][$index]) {
                $_SESSION["Quantitys"][$index] = $_SESSION["Stocks"][$index];
            }
            if ($_SESSION["Quantitys"][$index] > 3000) {
                $_SESSION["Quantitys"][$index] = 3000;
            }
            //veranderd de hoeveelheid naar 1als de ingevorde waarde kleiner is dan 1
            if ($_SESSION["Quantitys"][$index] < 1) {
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

        foreach ($_SESSION["IDs"] as $index => $val) {
            if ($_SESSION["DealPrices"][$index] == -1000) {
                $UnitPrice = $_SESSION["Prices"][$index];
                $hasDeal = FALSE;
            } else {
                $UnitPrice = $_SESSION["DealPrices"][$index];
                $hasDeal = TRUE;
            }
            print("<div class='scRow'>");
            print("€" . number_format((float)$UnitPrice, 2, '.', ''));
            if ($hasDeal) {
                print("<br><div class='scOldPrice'><strike>€" . number_format((float)$_SESSION["Prices"][$index], 2, '.', '') . "</strike></div>");
            }
            print("</div>");
        }
        print("</div>");

        //print de totaal prijzen
        print("<div class='scTPrice'>");
        print("<div class='scHeadRow'>");
        print("<b>Total price</b>");
        print("</div>");

        foreach ($_SESSION["IDs"] as $index => $val) {
            if ($_SESSION["DealPrices"][$index] == -1000) {
                $UnitPrice = $_SESSION["Prices"][$index];
                $hasDeal = FALSE;
            } else {
                $UnitPrice = $_SESSION["DealPrices"][$index];
                $hasDeal = TRUE;
            }
            $TPrice = $UnitPrice * $_SESSION["Quantitys"][$index];
            $_SESSION["TotalPrice"] += $TPrice;
            print("<div class='scRow'>");
            print("€" . number_format((float)$TPrice, 2, '.', ''));
            if ($hasDeal) {
                print("<br><div class='scOldPrice'><strike>€" . number_format((float)$_SESSION["Prices"][$index] * $_SESSION["Quantitys"][$index], 2, '.', '') . "</strike></div>");
            }
            print("</div>");
        }


        print("</div>");

        //print de verwijderknoppen
        print("<div class='scDelete'>");
        print("<div class='scHeadRow'>");
        print("<br>");
        print("</div>");

        foreach ($_SESSION["IDs"] as $index => $val) {
            print("<div class='scDeleteRow'>");
            print("<form method='post'><button class='scTrashcan' type='submit' name='D$index' value='true' ><img src='images/trashcan.JPG' width='28px' alt='X'></button></form>");
            print("</div>");
        }
        print("</div>");


        print("<div class='scBoxFoot'>");
        print("<div  class='scHeadRow'  style=' position: absolute; overflow: hidden; margin-top: 20px'>");
        print("<form method='post'><p style='width: 700px; float: left; margin-top: 10px'>Discount code:</p><input type='text' name='discountcode' style='width: 134px; margin: 0 0 0 26px; float: left; margin-top: 10px'> <input type='submit' name='discountSubmit' value='Submit' style='width: 106px; margin: 0 0 0 24px; float: left'></form>");
        print("</div>");

        $host = "localhost";
        $databasename = "wideworldimporters";
        $user = "root";
        $pass = ""; //eigen password invullen
        $port = 3306;
        $connection = mysqli_connect($host, $user, $pass, $databasename, $port);

        if (isset($_POST['discountSubmit'])&&!empty($_POST["discountcode"])) {
            $discount = "SELECT * FROM discount";
            $result = mysqli_query($connection, $discount);
            $DiscUsed = false;
            foreach ($result as $row1) {
                $dcode = $_POST['discountcode'];
                $disountCode = $row1['discountCode'];
                if ($disountCode == $dcode) {
                    $DiscUsed = true;
                    $discount = "SELECT * FROM discount WHERE discountCode = '$dcode'";
                    $result = mysqli_query($connection, $discount);
                    foreach ($result as $row) {
                        if (($row['discountUsed']) == 0) {
                            $correct = $_SESSION["TotalPrice"] * (100 - $row['discount']) / 100;
                            print("<div class='scDiscountMessageGood'>" . $row['discount'] . "% discount has been applied.</div>");
                            /*door de code heen*//*
                    print("<b><br>€" . number_format((float)$shippingPrice, 2, '.', '') . "</b>");
                    print("<b><br><br>€" . number_format((float)$correct, 2, '.', '') . "</b>");*/
                            $_SESSION["TotalPrice"] = $correct;
                        } elseif ($row['discountUsed'] == 1) {
                            if (empty($_SESSION['login'])) {
                                print("<div class='scDiscountMessageBad2'>This discount code is wrong.</div>");
                            } else if ($row['PersonID'] == $userId) {
                                $correct = $_SESSION["TotalPrice"] * (100 - $row['discount']) / 100;
                                print("<div class='scDiscountMessageGood'>Your personal discount for " . $row['discount'] . "% code has been used!</div>");
                                $_SESSION["TotalPrice"] = $correct;

                                $sql = "UPDATE discount SET  discountUsed = ? WHERE PersonID = '$userId'";

                                $disused = 2;
                                $stmt = $connection->prepare($sql);
                                $stmt->bind_param('s', $disused);
                                $stmt->execute();
                            }
                        } else {
                            print("<div class='scDiscountMessageBad'>This discount code has already been used.</div>");
                        }
                    }
                }
            }
            if(!$DiscUsed) {
                print("<div class='scDiscountMessageBad2'>This discount code is wrong.</div>");
            }
        } else {
            print("<div style='margin: 80px 60px 0px 0px;'> </div>");
            /*
            print("<b><br>€" . number_format((float)$shippingPrice, 2, '.', '') . "</b>");
            print("<b><br><br>€" . number_format((float)$_SESSION["TotalPrice"], 2, '.', '') . "</b>");*/
        }

//    $discountArray = array();
//    $i = 0;
//    foreach ($result3 as $row) {
//        if (mysqli_num_rows($result3) != 0) {
//            $discountArray[$i] = $row;
//            $i++;
//        }
//    }
//    $_SESSION['TotalPrice'];
//    $discount = $discountArray[0]['discount'];
//    $code = $discountArray[0]['discountCode'];



        //berekent de verzendkosten
        if ($_SESSION["TotalPrice"] < 50) {
            $shippingPrice = 6.95;
        } else {
            $shippingPrice = 0;
        }
        $_SESSION["TotalPrice"] += $shippingPrice;
        print("<div class='scHeadRow' style=' position: absolute; overflow: hidden; margin-top: 30px'>");
        print("<div style='width: 700px; float: left'>Shipping price is €6.95 for orders below €50.00 </div><div style='width: 160px; float: left'>Shipping price:</div><div style='width: 130px; float: left'>€" . number_format((float)$shippingPrice, 2, '.', '') . "</div>");
        print("</div>");
        print("<div class='scHeadRow' style=' position: absolute; overflow: hidden; margin-top: 70px'>");
        print("<div style='width: 860px; float: left'><b>Total price:</div><div style='width: 110px; float: left; border-top: 1px solid black; margin-left: 20px'>€" . number_format((float)$_SESSION["TotalPrice"], 2, '.', '') . "</b></div>");
        print("</div>");
        print("<div class='scHeadRow' style=' position: absolute; overflow: hidden; margin-top: 110px; margin-left: 890px'>");
        print("<form action='betalen.php' class='scButton'><input type='submit' value='Buy items'></form>");
        print("</div>");
        print("</div>");


    }else{
        print("<div class='scEmpty'>Your shopping cart is empty, you can add <a href='browse.php'>these</a> products.</div>");
    }
    ?>
</div>

<?php
include "includes/footer.php";
/*
//laat de inhoud van de lijst zien
//alleen voor testen
print_r($_SESSION["IDs"]);
print_r($_SESSION["Quantitys"]);
print_r($_SESSION["Names"]);
//*/

//*
//zet false op true om de lijst te resetten
if(false) {
    foreach($_SESSION["IDs"] as $i => $j) {
        unset($_SESSION["IDs"][$i]);
    }
    foreach($_SESSION["Names"] as $i => $j) {
        unset($_SESSION["Names"][$i]);
    }
    foreach($_SESSION["Images"] as $i => $j) {
        unset($_SESSION["Images"][$i]);
    }
    foreach($_SESSION["Quantitys"] as $i => $j) {
        unset($_SESSION["Quantitys"][$i]);
    }
    foreach($_SESSION["Prices"] as $i => $j) {
        unset($_SESSION["Prices"][$i]);
    }
    foreach($_SESSION["DealPrices"] as $i => $j) {
        unset($_SESSION["DealPrices"][$i]);
    }
    foreach($_SESSION["Stocks"] as $i => $j) {
        unset($_SESSION["Stocks"][$i]);
    }
}
//*/
?>