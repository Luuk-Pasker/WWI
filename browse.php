<!-- header-->
<?php
$active = "browse";
include "includes/header.php";
include "ZoekenProduct.php";
include "includes/funtions.php"
/*session_start();*/
/*header*/
?>



<?php

/* sql query voor alle categorien*/
$sql = "SELECT * FROM stockgroups ORDER BY StockGroupName";
$result = mysqli_query($connection, $sql);
/* sql query voor alle categorien   */


/*alle producten weergeven KNOP*/
?>
<div class="allProducts">
    <?php
    print("<div class='everything'>");
    print("<form method=\"post\" action=\"/WWI/browse.php\"><button class='button' type=\"submit\">All products</button></form>");
    print("</div>");
    ?>
</div>
<div class="Deals">
    <?php
    print("<div class='Deals'>");
    print("<form method=\"post\" action=\"/WWI/browse.php\"><button name='deals' value='deals' class='button' type=\"submit\">Deals</button></form>");
    print("</div>");
    ?>
</div>
<div class="NewItems">
    <?php
    print("<div class='Deals'>");
    print("<form method=\"post\" action=\"/WWI/browse.php\"><button name='NewItems' value='NewItems' class='button' type=\"submit\">New Items</button></form>");
    print("</div>");
    ?>
</div>
<!--/*alle producten weergeven KNOP*/-->

<?php
/*print alle namen op de knoppen*/
print("<form method='get' style='width: 250px; float: left'>");

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    /*navigationbar*/
    print("<div class = 'navigationbar'><button class= 'button' type='submit' name='id' value='" . $row['StockGroupID'] . "'>" . $row['StockGroupName'] . "</button><br></div>");
}
/*navigationbar*/
print("</form>");
/*print alle namen op de knoppen*/

/*bepaalen van het id van de geselecteerde category*/
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $_SESSION['id'] = $_GET['id'];
    $sID = $_SESSION['id'];
} else {
    $sID = 0;
}
/*bepaalen van het id van de geselecteerde category*/


/*opvragen van het pagina nummer*/
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
/*opvragen van het pagina nummer*/


/*bepalen aantal producten per pagina*/
$no_of_records_per_page = 25;
$offset = ($page - 1) * $no_of_records_per_page;
/*bepalen aantal producten per pagina*/


/*ophalen van hoeveelheid producten binnen een geselecteerde category*/
if (isset($_GET['id'])) {
    $total_pages_sql = "SELECT COUNT(DISTINCT StockItemID) FROM stockitemstockgroups WHERE StockGroupID = $id";
} else {
    $total_pages_sql = "SELECT COUNT(DISTINCT StockItemID) FROM stockitemstockgroups";
}
/*ophalen van hoeveelheid producten binnen een geselecteerde category*/


/*resultaten van voorgaande query ophalen*/
$result = mysqli_query($connection, $total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
/*resultaten van voorgaande query ophalen*/

/*ophalen van alle producten binnen een geselecteerde category*/
if (isset($_GET['id'])) {
    $sql = "SELECT * FROM stockitemstockgroups sisg JOIN stockitems si ON sisg.StockItemID = si.StockItemID JOIN stockitemholdings sih ON si.StockItemId = sih.StockItemId WHERE sisg.StockGroupID = $id ORDER BY si.StockItemName LIMIT $offset, $no_of_records_per_page";
} else {
    $sql = "SELECT * FROM stockitemstockgroups sisg JOIN stockitems si ON sisg.StockItemID = si.StockItemID JOIN stockitemholdings sih ON si.StockItemId = sih.StockItemId ORDER BY si.StockItemName LIMIT $offset, $no_of_records_per_page";
}
/*ophalen van alle producten binnen een geselecteerde category*/
?>

<div class="test6">
    <div  class='results'>
        <div  class='resultskayleigh' style="margin-top: -170px!important;">
            <?php

            /*printen van de resultaten op het scherm*/
            if(isset($_GET["toevoegen"])) {
                $aantalproducten = TelZoek($connection, $_GET["zoek"]);
                print("<h4>$aantalproducten " . "results</h4>");
            } elseif(isset($_GET["deals"])){
                $aantalproducten = 14;
                print("<h4>$aantalproducten " . "results</h4>");
            } elseif ($total_rows >= 1) {
                print("<h4>$total_rows " . "results</h4>");
            } else ("");
            ?>
        </div>
        <?php

        $res_data = mysqli_query($connection, $sql);
        $zoekopdracht = "";
        if (isset($_GET['id'])) {
            $browsearray = array();
            $p=0;
            foreach ($res_data as $row) {
                if (mysqli_num_rows($res_data) != 0) {
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
                            $productenmetkorting = array("USB missile launcher (Green)", "USB rocket launcher (Gray)", "USB food flash drive - sushi roll", "USB food flash drive - hamburger", "USB food flash drive - hot dog", "USB food flash drive - pizza slice", "USB food flash drive - dim sum 10 drive variety pack", "USB food flash drive - banana", "USB food flash drive - chocolate bar", "USB food flash drive - cookie", "USB food flash drive - donut", "USB food flash drive - shrimp cocktail", "USB food flash drive - fortune cookie", "USB food flash drive - dessert 10 drive variety packdi");

                            if(in_array($Stocktitemname, $productenmetkorting)==true){
                                print("<a class= 'tekstVooronderProduct' href='productBekijken.php?id=" . $browsearray[$x]['StockItemID'] . "'><img class='productfoto' src='images/" . $row["Photo"] . "' width='100%' <br>");
                                print($Stocktitemname . "<br>");
                                print("<a class='specialdeal'>SpecialDeal<a/><br>");
                                print("<a class='standaardprijs'>" . "€" . $kortingprijs . " " . "</a>");
                                print("<a class='kortingprijs'>" . "<strike>€$price</strike>" . "</a><br>");
                                print("<a>Available Now<a/>");
                            }else{
                                print("<a class= 'tekstVooronderProduct' href='productBekijken.php?id=" . $browsearray[$x]['StockItemID'] . "'><img class='productfoto' src='images/" . $row["Photo"] . "' width='100%' <br>");
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
            } else {
                print("");
            }
            unset($_GET["zoek"]);
        } elseif (isset($_GET["toevoegen"])) {
            $sID = $_GET["zoek"];
            $_GET["page"] = 1;
            $_GET["id"] = $_GET["zoek"];
            $zoekopdracht = $_GET["zoek"];
            $zoekopdracht = "zoek=" . $zoekopdracht . "&toevoegen=Search&";
            $total_pages = TelZoek($connection, $_GET["zoek"]);
            PrintSearchResults($_GET["zoek"], $offset, $no_of_records_per_page);
        } elseif (isset($_POST['deals'])){
            $deals = GetDealsBrowse($connection);
            $dealsArray = array();
            $i = 0;
            foreach ($deals as $row) {
                if (mysqli_num_rows($deals) != 0) {
                    $dealsArray[$i] = $row;
                    $i++;
                }
            }
            $x = 0;
            if(!empty($dealsArray[$x])) {
                echo '<table width="100%" class="table table-bordered">';
                for ($i = 0; $i < 5; $i++) {
                    echo "<tr>";
                    for ($j = 0; $j < 5; $j++) {
                        echo "<td class='browsecell'>";
                        /*/informatie voor elke cel invullen/*/
                        if(!empty($dealsArray[$x])) {
                            $Stocktitemname = ($dealsArray[$x]['StockItemName']);
                            $price =$dealsArray[$x]['UnitPrice'];
                            $kortingprijs = number_format($price / 100 * 85, 2);
                            $productenmetkorting = array("USB missile launcher (Green)", "USB rocket launcher (Gray)", "USB food flash drive - sushi roll", "USB food flash drive - hamburger", "USB food flash drive - hot dog", "USB food flash drive - pizza slice", "USB food flash drive - dim sum 10 drive variety pack", "USB food flash drive - banana", "USB food flash drive - chocolate bar", "USB food flash drive - cookie", "USB food flash drive - donut", "USB food flash drive - shrimp cocktail", "USB food flash drive - fortune cookie", "USB food flash drive - dessert 10 drive variety packdi");

                            if(in_array($Stocktitemname, $productenmetkorting)==true){
                                print("<a class= 'tekstVooronderProduct' href='productBekijken.php?id=" . $dealsArray[$x]['StockItemID'] . "'><img class='productfoto' src='images/" . $row["Photo"] . "' width='100%' <br>");
                                print($Stocktitemname . "<br>");
                                print("<a class='specialdeal'>SpecialDeal<a/><br>");
                                print("<a class='standaardprijs'>" . "€" . $kortingprijs . " " . "</a>");
                                print("<a class='kortingprijs'>" . "<strike>€$price</strike>" . "</a><br>");
                                print("<a>Available Now<a/>");
                            }else{
                                print("<a class= 'tekstVooronderProduct' href='productBekijken.php?id=" . $dealsArray[$x]['StockItemID'] . "'><img class='productfoto' src='images/" . $row["Photo"] . "' width='100%' <br>");
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
            } else {
                print("");
            }
        } elseif(isset($_POST['NewItems'])) {
            $deals = GetLaatstToegevoegdBrowse($connection);
            $browsearray = array();
            $i = 0;
            foreach ($deals as $row) {
                if (mysqli_num_rows($deals) != 0) {
                    $browsearray[$i] = $row;
                    $i++;
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
                            $productenmetkorting = array("USB missile launcher (Green)", "USB rocket launcher (Gray)", "USB food flash drive - sushi roll", "USB food flash drive - hamburger", "USB food flash drive - hot dog", "USB food flash drive - pizza slice", "USB food flash drive - dim sum 10 drive variety pack", "USB food flash drive - banana", "USB food flash drive - chocolate bar", "USB food flash drive - cookie", "USB food flash drive - donut", "USB food flash drive - shrimp cocktail", "USB food flash drive - fortune cookie", "USB food flash drive - dessert 10 drive variety packdi");

                            if(in_array($Stocktitemname, $productenmetkorting)==true){
                                print("<a class= 'tekstVooronderProduct' href='productBekijken.php?id=" . $browsearray[$x]['StockItemID'] . "'><img class='productfoto' src='images/" . $row["Photo"] . "' width='100%' <br>");
                                print($Stocktitemname . "<br>");
                                print("<a class='specialdeal'>SpecialDeal<a/><br>");
                                print("<a class='standaardprijs'>" . "€" . $kortingprijs . " " . "</a>");
                                print("<a class='kortingprijs'>" . "<strike>€$price</strike>" . "</a><br>");
                                print("<a>Available Now<a/>");
                            }else{
                                print("<a class= 'tekstVooronderProduct' href='productBekijken.php?id=" . $browsearray[$x]['StockItemID'] . "'><img class='productfoto' src='images/" . $row["Photo"] . "' width='100%' <br>");
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
            } else {
                print("");
            }
        } else {
            $browsearray = array();
            $p=0;
            foreach ($res_data as $row) {
                if (mysqli_num_rows($res_data) != 0) {
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
                            $productenmetkorting = array("USB missile launcher (Green)", "USB rocket launcher (Gray)", "USB food flash drive - sushi roll", "USB food flash drive - hamburger", "USB food flash drive - hot dog", "USB food flash drive - pizza slice", "USB food flash drive - dim sum 10 drive variety pack", "USB food flash drive - banana", "USB food flash drive - chocolate bar", "USB food flash drive - cookie", "USB food flash drive - donut", "USB food flash drive - shrimp cocktail", "USB food flash drive - fortune cookie", "USB food flash drive - dessert 10 drive variety packdi");

                            if(in_array($Stocktitemname, $productenmetkorting)==true){
                                print("<a class= 'tekstVooronderProduct' href='productBekijken.php?id=" . $browsearray[$x]['StockItemID'] . "'><img class='productfoto' src='images/" . $row["Photo"] . "' width='100%' <br>");
                                print($Stocktitemname . "<br>");
                                print("<a class='specialdeal'>SpecialDeal<a/><br>");
                                print("<a class='standaardprijs'>" . "€" . $kortingprijs . " " . "</a>");
                                print("<a class='kortingprijs'>" . "<strike>€$price</strike>" . "</a><br>");
                                print("<a>Available Now<a/>");
                            }else{
                                print("<a class= 'tekstVooronderProduct' href='productBekijken.php?id=" . $browsearray[$x]['StockItemID'] . "'><img class='productfoto' src='images/" . $row["Photo"] . "' width='100%' <br>");
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
        }
        /* producten niet getoond worden, geen resultaat tonen */
        if (mysqli_num_rows($res_data) == 0) {
            print("<p class='text2'> No results in this category </p>");
        }
        mysqli_close($connection);
        ?>
    </div>
</div>





<!--/*knoppenstructuur van de paginaindeling*/-->
<?php
if (!mysqli_num_rows($res_data) == 0) {
    ?>


    <div class="paginatie">
        <ul class="pagination">
            <li><a href="<?php
                if ($sID == 0) {
                    echo '?page=1';
                } else {
                    echo '?page=1&id=' . $sID;
                }
                ?>">First</a></li>
            <li class="<?php
            if ($page <= 1) {
                echo 'disabled';
            }
            ?>">
                <a href="<?php
                if ($page <= 1) {
                    echo '#';
                } elseif ($sID == 0) {
                    echo "?" . $zoekopdracht . "page=" . ($page - 1);
                } else {
                    echo "?page=" . ($page - 1) . "&id=" . $sID;
                }
                ?>">Prev</a>
            </li>
            <li>
                <a>
                    <?php
                    print($page);
                    ?>
                </a>
            </li>
            <li class="<?php
            if ($page >= $total_pages) {
                echo 'disabled';
            }
            ?>">
                <a href="<?php
                if ($page >= $total_pages) {
                    echo '#';
                } elseif ($sID == 0) {
                    echo "?" . $zoekopdracht . "page=" . ($page + 1);
                } else {
                    echo "?page=" . ($page + 1) . "&id=" . $sID;
                }
                ?>">Next</a>
            </li>
            <li><a href="<?php
                if ($sID == 0) {
                    echo '?page=' . $total_pages;
                } else {
                    echo '?page=' . $total_pages . "&id=" . $sID;
                }


                ?>">Last</a></li>
        </ul>
    </div>
    <?php
}
?>
<!--/*knoppenstructuur van de paginaindeling*/-->

<?php
include "includes/footer.php";
?>