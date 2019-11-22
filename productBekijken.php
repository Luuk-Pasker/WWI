
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
                        if($row["Tags"] == '["32GB","USB Powered"]') {
                            print(substr('["32GB","USB Powered"]', -20,4 ) . "\n");
                            print(substr('["32GB","USB Powered"]', -13,11 ));
                        }elseif($row["Tags"] == '["16GB","USB Powered"]') {
                            print(substr('["16GB","USB Powered"]', -20,4 ) . "\n");
                            print(substr('["16GB","USB Powered"]', -13,11 ));

                        }elseif($row["Tags"] == '["Radio Control","Realistic Sound"]'){
                            print(substr('["Radio Control","Realistic Sound"]', -33,13 ) . "\n");
                            print(substr('["Radio Control","Realistic Sound"]', -17,15 ));

                        }elseif($row["Tags"] == '["Vintage","So Realistic"]'){
                            print(substr('["Vintage","So Realistic"]', -24,11 ) . "\n");
                            print(substr('["Vintage","So Realistic"]', -14,12 ));

                        }elseif($row["Tags"] == '["Comfortable","Long Battery Life"]'){
                            print(substr('["Comfortable","Long Battery Life"]', -33,11 ) . "\n");
                            print(substr('["Comfortable","Long Battery Life"]', -19,17 ));

                        }elseif ($row["Tags"] == '[]'){
                            print"";
                            
                        }else{
                            print("<div class='tags'>" . $row["Tags"] . "</div><br>");
                        }
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


