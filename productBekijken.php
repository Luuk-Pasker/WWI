
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
                            print("<a class='Techtags' href='http://localhost/WWI/browse.php?zoek=32gb&toevoegen=Search'>" . substr('["32GB","USB Powered"]', -20,4 ) . "</a>");
                            print("<a class='Techtags' href='http://localhost/WWI/browse.php?zoek=USB&toevoegen=Search'>" . substr('["32GB","USB Powered"]', -13,11 ) . "</a>");
                        }elseif($row["Tags"] == '["16GB","USB Powered"]') {
                            print("<a class='Techtags' href='http://localhost/WWI/browse.php?zoek=16gb&toevoegen=Search'>" . substr('["16GB","USB Powered"]', -20,4 ) . "</a>");
                            print("<a class='Techtags' href='http://localhost/WWI/browse.php?zoek=USB&toevoegen=Search'>" . substr('["16GB","USB Powered"]', -13,11 ) . "</a>");

                        }elseif($row["Tags"] == '["Radio Control","Realistic Sound"]'){
                            print("<a class='RCtags' href='http://localhost/WWI/browse.php?zoek=rc&toevoegen=Search'>" . substr('["Radio Control","Realistic Sound"]', -33,13 ) . "</a>");
                            print("<a class='Toytags' href='http://localhost/WWI/browse.php?zoek=realistic+sound&toevoegen=Search'>" . substr('["Radio Control","Realistic Sound"]', -17,15 ) . "</a>");

                        }elseif($row["Tags"] == '["Vintage","So Realistic"]'){
                            print("<a class='Lifestyletags' href='http://localhost/WWI/browse.php?zoek=vintage&toevoegen=Search'>" . substr('["Vintage","So Realistic"]', -24,11 ) . "</a>");
                            print("<a class='Lifestyletags' href='http://localhost/WWI/browse.php?zoek=realistic&toevoegen=Search'>" . substr('["Vintage","So Realistic"]', -14,12 ) . "</a>");

                        }elseif($row["Tags"] == '["Comfortable","Long Battery Life"]'){
                            print("<a class='Lifestyletags' href='http://localhost/WWI/browse.php?zoek=vintage&toevoegen=Search'>" . substr('["Comfortable","Long Battery Life"]', -33,11 ) . "</a>");
                            print("<a class='Techtags' href='http://localhost/WWI/browse.php?zoek=long&toevoegen=Search'>" . substr('["Comfortable","Long Battery Life"]', -19,17 ) . "</a>");

                        }elseif ($row["Tags"] == '[]'){
                            print"";

                        }else{
                            $x = array('["', '"]');
                            $y= ("http://localhost/WWI/browse.php?zoek=" . $row["Tags"] . "&toevoegen=Search");
                            print("<a class='tags' href='$y'>" . str_replace($x, "", $row["Tags"]) . "</a>");
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


