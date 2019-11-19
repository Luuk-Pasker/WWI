<!DOCTYPE html>
    <html>
        <head>
            <title>ProductBekijken</title>
            <link rel="stylesheet" type="text/css" href="css/productBekijken.css">

        </head>

        <body>
        <!--//header-->
        <?php
        include "includes/header.php";
        ?>

        <!---->

            <div class="container">

                <?php

                if(isset($_GET["id"])){
                    $ItemID = $_GET["id"];
                }else{
                    $ItemID = 120;
                }

                //Queery voor het selecteren van het bepaalde item id
                $sql = "SELECT * FROM stockitems S LEFT JOIN stockitemholdings H ON S.StockItemID = H.StockItemID WHERE S.StockItemID = $ItemID";
                $result = mysqli_query($connection, $sql);
                //


                //print: afbeelding, voorraad, naam, prijs en beschrijving.
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                    $Image = "images/120_dino_slippers.jpg";
                    //$row["Photo"]
                    print("<img class='foto' src='$Image'><br>");
                    print("<div class='naambeschrijvingprijsnogopvoorraad'>");
                    print("<div class='naam'>" . $row["StockItemName"] . "</div><br>");
                    print("<div class='beschrijving2'>Description:</div><BR>" ."<div class='beschrijving'>" . $row["SearchDetails"] . "</div><br>");
                    $price = $row["UnitPrice"];
                    print("<div class='prijs'>" . "€" . $price . "</div><br>");
                    $voorraad = $row["QuantityOnHand"];
                    print("<div class='nogopvoorraad'>" . $voorraad . " in stock.</div><br>");
                    print("</div>");
                }
                //

                //aantallen selecteer formulee/toevoegen aan winkelmand knop
                if ($voorraad>0) {
                ?>

                <div class="aantallen">
                    <form action="winkelmand.php" method="get">
                        <input id="toevoegenaanwinkelmand" type="submit" value="Add to shopping cart">
                        Amount: <input id="aantalx" type="number" name="quantity" min="1" max="<?php print("$voorraad"); ?>">
                        <input type="hidden" name="ItemID" value="<?php print("$ItemID"); ?>">
                        <input type="hidden" name="ItemPrice" value="<?php print("$price"); ?>">
                    </form>
                </div>

                    <?php
                    }else {
                        print("<div class= 'noitem'>" . "No items in stock</div>");
                    }
                    ?>


                <!>

                <!footer>
                <?php
                include "includes/footer.php";
                ?>
                <!>



            </div>
        </body>

    </html>


