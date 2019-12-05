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
group by StockItemName
");

    mysqli_stmt_bind_param($statement,'ssssi', $zoek, $zoek, $zoek, $zoek, $zoek);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $result = mysqli_num_rows($result);
    return $result;
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
group by StockItemName
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
        $browsearray = array();
        $p=0;
        foreach ($result as $row) {
            if (mysqli_num_rows($result) != 0) {
                $browsearray[$p] = $row;
                $p++;
            }
        }
        $x = 0;
        if(!empty($browsearray[$x])) {
            echo '<table width="100%" class="table table-bordered">';

            for ($i = 0; $i < 5; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 5; $j++) {
                    echo "<td class='browsecell'>";
                    /*/informatie voor elke cel invullen/*/
                    if(!empty($browsearray[$x])) {
                        $Stocktitemname = ($browsearray[$x]['StockItemName']);
                        $price =$browsearray[$x]['UnitPrice'];
                        $kortingprijs = number_format($price / 100 * 85, 2);
                        $productenmetkorting = array("USB rocket launcher (Gray)", "USB food flash drive - sushi roll", "USB food flash drive - hamburger", "USB food flash drive - hot dog", "USB food flash drive - pizza slice", "USB food flash drive - dim sum 10 drive variety pack", "USB food flash drive - banana", "USB food flash drive - chocolate bar", "USB food flash drive - cookie", "USB food flash drive - donut", "USB food flash drive - shrimp cocktail", "USB food flash drive - fortune cookie", "USB food flash drive - dessert 10 drive variety packdi");
                        $image = 'images/ProductImages/' . $browsearray[$x]['StockItemID'] . '.1.jpg';
                        if(!(@getimagesize($image))){
                            $image = "images/" . $row['Photo'];
                        }

                        if(in_array($Stocktitemname, $productenmetkorting)==true){
                            print("<a class= 'tekstVooronderProduct' href='productBekijken.php?id=" . $browsearray[$x]['StockItemID'] . "'><img class='productfoto' src='$image' width='100%' <br>");
                            print($Stocktitemname . "<br>");
                            print("<a class='specialdeal'>SpecialDeal<a/><br>");
                            print("<a class='standaardprijs'>" . "€" . $kortingprijs . " " . "</a>");
                            print("<a class='kortingprijs'>" . "<strike>€$price</strike>" . "</a><br>");
                            print("<a>Available Now<a/>");
                        }else{
                            print("<a class= 'tekstVooronderProduct' href='productBekijken.php?id=" . $browsearray[$x]['StockItemID'] . "'><img class='productfoto' src='$image' width='100%' <br>");
                            print($Stocktitemname . "<br>");
                            print("<h4 class='prijsje'>" . "€" . $price . "</h4>");
                            print("<a class='availablenow'> Available Now</a>");
                        }
                        /*/informatie voor elke cel invullen/*/
                        echo "</td>";
                        $x++;
                    }
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    } else {
        header("location: NiksGevonden.php");
        exit();
    }
}

// aanroepen om resultaten te printen
/*if(isset($_GET["toevoegen"])) {
    PrintSearchResults($_GET["zoek"]);
}*/
//include "includes/footer.php";
?>