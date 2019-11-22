
<link rel="stylesheet" type="text/css" href="css/productBekijken.css">


        <!--//header-->
        <?php
        include "includes/header.php";
        ?>

        <!---->

        <!-- go back knop-->
           <div class="keerterug">
                <a class="KEERTERUGNU" href="browse.php" style="color: white;"><button class="btn" title="Go back"><i class="fas fa-long-arrow-alt-left"></i>  Go back</button></a>
            </div>

            <div class="container">
        <!-- go back knop-->



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


                //print: afbeelding, voorraad, naam, prijs en beschrijving en bezorgtijd .
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $Image = "images/" . $row['Photo'];
                    //$row["Photo"]
                    print("<img class='foto' src='$Image'><br>");
                    print("<div class='naambeschrijvingprijsnogopvoorraad'>");
                    print("<div class='naam'>" . $row["StockItemName"] . "</div><br>");

                    /*print tags*/
                    print"<div class='Alltags'>";
                        if($row["Tags"] == '["32GB","USB Powered"]') {
                            print("<div class='Techtags'>" . substr('["32GB","USB Powered"]', -20,4 ) . "</div>");
                            print("<div class='Techtags'>" . substr('["32GB","USB Powered"]', -13,11 ) . "</div>");
                        }elseif($row["Tags"] == '["16GB","USB Powered"]') {
                            print("<div class='Techtags'>" . substr('["16GB","USB Powered"]', -20,4 ) . "</div>");
                            print("<div class='Techtags'>" . substr('["16GB","USB Powered"]', -13,11 ) . "</div>");

                        }elseif($row["Tags"] == '["Radio Control","Realistic Sound"]'){
                            print("<div class='RCtags' >" . substr('["Radio Control","Realistic Sound"]', -33,13 ) . "</div>");
                            print("<div class='Toytags'>" . substr('["Radio Control","Realistic Sound"]', -17,15 ) . "</div>");

                        }elseif($row["Tags"] == '["Vintage","So Realistic"]'){
                            print("<div class='Lifestyletags'>" . substr('["Vintage","So Realistic"]', -24,11 ) . "</div>");
                            print("<div class='Lifestyletags'>" . substr('["Vintage","So Realistic"]', -14,12 ) . "</div>");

                        }elseif($row["Tags"] == '["Comfortable","Long Battery Life"]'){
                            print("<div class='Lifestyletags'>" . substr('["Comfortable","Long Battery Life"]', -33,11 ) . "</div>");
                            print("<div class='Techtags'>" . substr('["Comfortable","Long Battery Life"]', -19,17 ) . "</div>");

                        }elseif ($row["Tags"] == '[]'){
                            print"";

                        }else{
                            $x = array('["', '"]');
                            print("<div class='tags'>" . str_replace($x, "", $row["Tags"]) . "</div>");
                        }
                    print"</div>";
                    /*print tags*/

                    /**/
                    print("<div class='beschrijving2'>Description:</div><BR>" ."<div class='beschrijving'>" . $row["SearchDetails"] . "</div><br>");
                    $price = $row["UnitPrice"];
                    print("<div class='prijs'>" . "€" . $price . "</div><br>");
                    $voorraad = $row["QuantityOnHand"];
                    print("<div class='nogopvoorraad'>" . " In stock! </div><br><br>");
                    print("<div class='bezorgdatum'>" . $row['LeadTimeDays'] . " days to deliver</div><br>");
                    print("</div>");
                }


                //aantallen selecteer formulee/toevoegen aan winkelmand knop
                if ($voorraad>0) {
                ?>

                <div class="aantallen">
                    <form action="winkelmand.php" method="get">
                        <input id="toevoegenaanwinkelmand" type="submit" value="Add to shopping cart">
                        Amount: <input id="aantalx" type="number" value="1" name="quantity" min="1" max="<?php print("$voorraad"); ?>">
                        <input type="hidden" name="ItemID" value="<?php print("$ItemID"); ?>">
                        <input type="hidden" name="ItemPrice" value="<?php print("$price"); ?>">
                    </form>
                </div>

                <div class="hentai">
                <a href="oefenen/test4.php"><i class="fas fa-paw"></i></a>
                </div>

                    <?php
                    }else {
                        print("<div class= 'noitem'>" . "No items in stock</div>");
                    }
                    ?>


                <!x>

                <!footer>
                <?php
                include "includes/footer.php";
                ?>
                <!>



            </div>
        </body>

    </html>


