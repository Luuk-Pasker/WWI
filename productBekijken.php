<!DOCTYPE html>
    <html>
        <head>
            <title>ProductBekijken</title>
            <link rel="stylesheet" type="text/css" href="style.css">

        </head>

        <body>
        <!--//header-->
        <?php
        include "includes/header.php";
        ?>
        //

            <div class="container">

                <?php
                $ItemID = 120;

                //Queery voor het selecteren van het bepaalde item i    d
                $sql = "SELECT * FROM stockitems S LEFT JOIN stockitemholdings H ON S.StockItemID = H.StockItemID WHERE S.StockItemID = $ItemID";
                $result = mysqli_query($connection, $sql);
                //


                //print: afbeelding, voorraad, naam, prijs en beschrijving.
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                    print("<img class='foto' src='images/120_dino_slippers.jpg'" . $row["Photo"] . "<br>");

                    print("<div class='test'>");
                    print("<div class='naam'>" . $row["StockItemName"] . "</div><br>");
                    print("<div class='beschrijving2'>Beschrijving:</div><BR>" ."<div class='beschrijving'>" . $row["SearchDetails"] . "</div><br>");
                    print("<div class='prijs'>" . "€" . $row["UnitPrice"] . "</div><br>");
                    $voorraad = $row["QuantityOnHand"];
                    print("<div class='nogopvoorraad'>" . "Nog " . $voorraad . " op voorraad.</div><br>");
                    print("</div>");



                }
                //
                ?>

               <!aantallen selecteer formulee/toevoegen aan winkelmand knop>
                <div class="aantallen">
                    <form>
                        <input id="toevoegenaanwinkelmand" type="submit" value="Toevoegen aan winkelmand">
                        Aantal: <input id="aantalx" type="number" name="quantity" min="1" max="<?php print("$voorraad"); ?>">
                    </form>

                </div>
                <!>

                <?php
/*                print("Nog " . $voorraad . " op voorraad.<br>");
                */?>


                <!footer>
                <?php
                include "includes/footer.php";
                ?>
                <!>



            </div>
        </body>

    </html>


