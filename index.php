<?php
$active = "home";
/*header en functions*/
include "includes/header.php";
include "includes/funtions.php";
/*header en functions*/


/*link naar css*/
print("<link rel='stylesheet' type='text/css' href = 'css/home.css'>");
print("<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>");
/*link naar css*/


/*navigatie bar*/

    /* sql query voor alle categorien*/
    $sql = "SELECT * FROM stockgroups ORDER BY StockGroupName";
    $result = mysqli_query($connection, $sql);
    /* sql query voor alle categorien   */


    /*print alle namen op de knoppen*/
    print("<form method='get' action=\"/WWI/browse.php\">");

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        /*navigationbar*/
        print("<button class='button' name='id' value='" . $row['StockGroupID'] . "'>" . $row['StockGroupName'] . "</button>");
    }
    print("</form></div>");

/*navigatie bar*/


/*maak een array met de random producten*/
$sql = "SELECT * FROM StockItems ORDER BY StockItemID";
$resultRandomProduct = mysqli_query($connection, $sql);
$randomProductArray = array();
$i = 0;
foreach ($resultRandomProduct as $row) {
    if (mysqli_num_rows($resultRandomProduct) != 0) {
        $randomProductArray[$i] = $row;
        $i++;
    }
}
/*maak een array met de random producten*/


/*maak een array met de verkregen deals*/
$results = GetDeals($connection);
$aantalpaginas = floor(mysqli_num_rows($results) / 3);
$fullarray = array();
$i = 0;
foreach ($results as $row) {
    if (mysqli_num_rows($results) != 0) {
        $fullarray[$i] = $row;
        $i++;
    }
}
/*maak een array met de verkregen deals*/


/*maak een array met de laatst toegevoegde items*/
$laatstToegevoegd = GetLaatstToegevoegd($connection);
$fullArrayLaatstToegevoegd = array();
$i = 0;
foreach ($laatstToegevoegd as $row) {
    if (mysqli_num_rows($results) != 0) {
        $fullArrayLaatstToegevoegd[$i] = $row;
        $i++;
    }
}
?>
<!--/*maak een array met de laatst toegevoegde items*/-->


<!--slider/banner-->
<div class="homebody">

    <link rel='stylesheet' type='text/css' href = 'banner css/slider.css'>

    <div id="slider">
        <figure>
            <a href="http://localhost/WWI/browse.php?deals=deals">
                <img src="banner css/banner%20christmas.gif">
            </a>

            <a href="http://localhost/WWI/register.php">
                <img src="banner%20css/banner%20login.gif">
            </a>

            <a href="http://localhost/WWI/browse.php?id=8">
                <img src="banner%20css/testbanner3.33.gif">
            </a>


                <img src="banner%20css/banner 4.gif">
            
            <a href="http://localhost/WWI/browse.php?deals=deals">
                <img src="banner css/banner%20christmas.gif">
            </a>



        </figure>

    </div>
<!--slider/banner-->


<!--producten geprint in tabel die in de aanbieding zijn-->
    <table width="100%" class="table table-bordered">
        <tr>
            <?php
            for($i=0; $i < mysqli_num_rows($results); $i++){
                $ItemID = $fullarray[$i]['StockItemID'];
                $image = 'images/ProductImages/' . $ItemID . '.1.jpg';
                if(!(@getimagesize($image))){
                    $image = "images/" . $fullarray[$i]['Photo'];
                }
                print("<th class='thhome'><a href='productBekijken.php?id=" . $fullarray[$i]['StockItemID'] . "'><img class='homefoto' src='$image' style='width: 100%!important;'><BR>");
                print($fullarray[$i]['StockItemName'] . "<br>");
                $price = number_format($fullarray[$i]['UnitPrice'] / 100 * 85, 2);
                print("<a class='standaardprijs'>" . "€" . $price . " " . "</a><a class='kortingprijs'>" . "<strike>€" . $fullarray[$i]['UnitPrice'] . "</strike>" . "</a></a></th>");
            }
            ?>
        </tr>
        <tr>
            <td colspan="4" style="border: none!important;">
                <!--<a href="browse.php">-->
                    <div style="text-align: center">
                        <form method="get" action="browse.php">
                        <button type="submit" name='deals' value="deals" class="btn btn-primary">See More Deals</button>
                        </form>
                    </div>
                <!--</a>-->
            </td>
        </tr>
    </table>
<!--producten geprint in tabel die in de aanbieding zijn-->


<!--producten geprint die nieuw zijn-->
    <table width="100%" class="table table-bordered">
        <tr>
            <?php
            for($i=0; $i < mysqli_num_rows($results); $i++){
                $ItemID = $fullArrayLaatstToegevoegd[$i]['StockItemID'];
                $image = 'images/ProductImages/' . $ItemID . '.1.jpg';
                if(!(@getimagesize($image))){
                    $image = "images/" . $fullArrayLaatstToegevoegd[$i]['Photo'];
                }
                print("<th class='thhome'><a href='productBekijken.php?id=" . $fullArrayLaatstToegevoegd[$i]['StockItemID'] . "'><img class='homefoto' src='$image' style='width: 100%!important;'><BR>");
                print($fullArrayLaatstToegevoegd[$i]['StockItemName'] . "<br>");
                print("<a class='prijsje'>" . "€" . $fullArrayLaatstToegevoegd[$i]['UnitPrice'] . "</a></a></th>");
            }
            ?>
        </tr>
        <tr>
            <td colspan="4" style="border: none!important;">
                <!--<a href="browse.php">-->
                <div style="text-align: center">
                    <form method="post" action="browse.php">
                        <button type="submit" name='NewItems' value="NewItems" class="btn btn-primary">See More New Items</button>
                    </form>
                </div>
                <!--</a>-->
            </td>
        </tr>
    </table>
</div>
<!--producten geprint die nieuw zijn-->


<?php
include "includes/footer.php";
?>
