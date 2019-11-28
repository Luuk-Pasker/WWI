<link rel="stylesheet" type="text/css" href="css/productBekijken.css">
<?php
$active = "cart";
include "includes/header.php";
include "includes/funtions.php";

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
if(isset($_POST["ItemID"]) && isset($_POST["quantity"]) && isset($_POST["ItemPrice"])) {
    $ItemID = $_POST["ItemID"];

    $sql = "SELECT * FROM stockitems S LEFT JOIN stockitemholdings H ON S.StockItemID = H.StockItemID WHERE S.StockItemID = $ItemID";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $image = "images/" . $row['Photo'];
        //$row["Photo"]
        $ItemName = $row["StockItemName"];
        $stock = $row["QuantityOnHand"];
    }
    $quantity = $_POST["quantity"];
    $price = $_POST["ItemPrice"];
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

<div class="keerterug">
    <!--
    <a class="KEERTERUGNU" href="browse.php" style="color: white;"><button class="btn" title="Go back"><i class="fas fa-long-arrow-alt-left"></i>  Go back to shopping</button></a>
    -->
    <button class="btn" onclick="goBack()">Go back</button>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</div>
<h1 class="a.hoofdtext">Shoppingcart</h1>
<div class="scBox">
    <?php
    //dit print de hele winkelmand
    $_SESSION["TotalPrice"] = 0;
    if(count($_SESSION["IDs"])>0) {
        sc_Print();
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

/*
//uncomment dit en zet false op true om de lijst te resetten
if(false) {
    foreach($_SESSION["IDs"] as $i => $j) {
        unset($_SESSION["IDs"][$i]);
        unset($_SESSION["Names"][$i]);
        unset($_SESSION["Images"][$i]);
        unset($_SESSION["Quantitys"][$i]);
        unset($_SESSION["Prices"][$i]);
    }
}
//*/
?>