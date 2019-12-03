<link rel="stylesheet" type="text/css" href="css/productBekijken.css">


<!--//header-->
<?php
include "includes/header.php";
include "includes/funtions.php";
?>
<!---->

<!-- go back knop-->
<div class="keerterug">
    <a class="KEERTERUGNU" href="browse.php" style="color: white;">
        <button class="btn" title="Go back"><i class="fas fa-long-arrow-alt-left"></i> Go back</button>
    </a>
</div>

<div class="container">
    <!-- go back knop-->


    <?php


    $productenmetkorting = array("USB rocket launcher (Gray)", "USB food flash drive - sushi roll", "USB food flash drive - hamburger", "USB food flash drive - hot dog", "USB food flash drive - pizza slice", "USB food flash drive - dim sum 10 drive variety pack", "USB food flash drive - banana", "USB food flash drive - chocolate bar", "USB food flash drive - cookie", "USB food flash drive - donut", "USB food flash drive - shrimp cocktail", "USB food flash drive - fortune cookie", "USB food flash drive - dessert 10 drive variety packdi");

    if (isset($_GET["id"])) {
        $ItemID = $_GET["id"];
    } else {
        $ItemID = 120;
    }

    //Queery voor het selecteren van het bepaalde item id
    $sql = "SELECT * FROM stockitems S LEFT JOIN stockitemholdings H ON S.StockItemID = H.StockItemID WHERE S.StockItemID = $ItemID";
    $result = mysqli_query($connection, $sql);
    //


    //print: afbeelding, voorraad, naam, prijs en beschrijving en bezorgtijd .
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        $ItemID = $row['StockItemID'];
        $Image = 'images/ProductImages/' . $ItemID . '.1.jpg';
        if(!(@getimagesize($Image))){
            $Image = "images/" . $row['Photo'];
        }
        print("<img class='foto' src='$Image'><br>");
        print("<div class='naambeschrijvingprijsnogopvoorraad'>");
        print("<div class='naam'>" . $row["StockItemName"] . "</div><br>");

        /*print tags*/
        print"<div class='Alltags'>";
        if ($row["Tags"] == '["32GB","USB Powered"]') {
            print("<a class='Techtags' href='http://localhost/WWI/browse.php?zoek=32gb&toevoegen=Search'>" . substr('["32GB","USB Powered"]', -20, 4) . "</a>");
            print("<a class='Techtags' href='http://localhost/WWI/browse.php?zoek=USB&toevoegen=Search'>" . substr('["32GB","USB Powered"]', -13, 11) . "</a>");

        } elseif ($row["Tags"] == '["16GB","USB Powered"]') {
            print("<a class='Techtags' href='http://localhost/WWI/browse.php?zoek=16gb&toevoegen=Search'>" . substr('["16GB","USB Powered"]', -20, 4) . "</a>");
            print("<a class='Techtags' href='http://localhost/WWI/browse.php?zoek=USB&toevoegen=Search'>" . substr('["16GB","USB Powered"]', -13, 11) . "</a>");

        } elseif ($row["Tags"] == '["Radio Control","Realistic Sound"]') {
            print("<a class='RCtags' href='http://localhost/WWI/browse.php?zoek=rc&toevoegen=Search'>" . substr('["Radio Control","Realistic Sound"]', -33, 13) . "</a>");
            print("<a class='Toytags' href='http://localhost/WWI/browse.php?zoek=realistic+sound&toevoegen=Search'>" . substr('["Radio Control","Realistic Sound"]', -17, 15) . "</a>");

        } elseif ($row["Tags"] == '["Vintage","So Realistic"]') {
            print("<a class='Lifestyletags' href='http://localhost/WWI/browse.php?zoek=vintage&toevoegen=Search'>" . substr('["Vintage","So Realistic"]', -24, 11) . "</a>");
            print("<a class='Lifestyletags' href='http://localhost/WWI/browse.php?zoek=realistic&toevoegen=Search'>" . substr('["Vintage","So Realistic"]', -14, 12) . "</a>");

        } elseif ($row["Tags"] == '["Comfortable","Long Battery Life"]') {
            print("<a class='Lifestyletags' href='http://localhost/WWI/browse.php?zoek=vintage&toevoegen=Search'>" . substr('["Comfortable","Long Battery Life"]', -33, 11) . "</a>");
            print("<a class='Techtags' href='http://localhost/WWI/browse.php?zoek=long&toevoegen=Search'>" . substr('["Comfortable","Long Battery Life"]', -19, 17) . "</a>");

        } elseif ($row["Tags"] == '[]') {
            print"";

        }elseif ($row["Tags"] == '["So Realistic"]'){
            print("<a class='Lifestyletags' href='http://localhost/WWI/browse.php?zoek=realistic&toevoegen=Search'>" . substr('["Vintage","So Realistic"]', -14, 12) . "</a>");
            print("<a class='Techtags' href='oefenen/test4.php'>" . "Easteregg" . "</a>");

        } else {
            $x = array('["', '"]');
            $y = ("http://localhost/WWI/browse.php?zoek=" . $row["Tags"] . "&toevoegen=Search");
            print("<a class='tags' href='$y'>" . str_replace($x, "", $row["Tags"]) . "</a>");
        }
        print"</div>";
        /*print tags*/

        /**/


        print("<div class='beschrijving2'>Description:</div><BR>" . "<div class='beschrijving'>" . $row["SearchDetails"] . "</div><br>");

        $price = $row["UnitPrice"];
        $kortingprijs = $price / 100 * 85;
        $nieuwekortingprijs = number_format($kortingprijs, 2);

/*producten met korting*/
        if (in_array($row['StockItemName'], $productenmetkorting)) {
            print("<div class='paynow'>" . "Pay now!" . "</div>");
            if ($row['StockItemName'] == 'USB rocket launcher (Gray)') {
                print("<A class='prijs'>" . "€21.25" . "</A>");
            } else {
                print("<A class='prijs'>" . "€" . $nieuwekortingprijs . "</A>");
            }
            print("<A class='oudeprijs'>" . "<strike>€$price </strike>" . "</A>");
            print("<div class='safeoff'>" . "15% off save " . ($price / 100 * 15) . "</div><br><br>");
            print("<H4 class='nogopvoorraad'>" . " In stock! </H4>");
            print("<H4 class='bezorgdatum'>" . $row['LeadTimeDays'] . " days to deliver</H4><br>");
            print("</div>");
            if ($row["QuantityOnHand"] > 1000) {
                $voorraad = 1000;
            } elseif ($row["QuantityOnHand"] > 100) {
                $voorraad = 100;
            } else {
                $voorraad = $row["QuantityOnHand"];
            }
            /*producten met korting*/

/*            producten zonder korting*/
        } else {
            print("<div class='prijs'>" . "€" . $price . "</div><br><br>");
            print("<h4 class='nogopvoorraad'>" . " In stock! </h4>");
            print("<h4 class='bezorgdatum'>" . $row['LeadTimeDays'] . " days to deliver</h4><br>");
            print("</div>");
/*            producten zonder korting*/

            if ($row["QuantityOnHand"] > 1000) {
                $voorraad = 1000;
            } elseif ($row["QuantityOnHand"] > 100) {
                $voorraad = 100;
            } else {
                $voorraad = $row["QuantityOnHand"];
            }
        }
    }
    ?>

   <!-- //aantallen selecteer formulee/toevoegen aan winkelmand knop-->
    <div class="aantallen">
        <form action="winkelmand.php" method="post">
            <input id="toevoegenaanwinkelmand" type="submit" value="Add to shopping cart">
            Amount: <input id="aantalx" type="number" value="1" name="quantity" min="1"
                           max="<?php print("$voorraad"); ?>">
            <input type="hidden" name="ItemID" value="<?php print("$ItemID"); ?>">
            <input type="hidden" name="ItemPrice" value="<?php print("$price"); ?>">
        </form>
    </div>
    <?php
    include "includes/footer.php";
    ?>

    <!--xx-->



