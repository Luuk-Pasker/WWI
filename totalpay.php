<div class="totalbetalen">

                <b><h3> Total </h3></b><!--rechterkant en border-->
                <?php
                $totalPrice = ($_SESSION["TotalPrice"]);
                ?>
                Total: €<?php print($totalPrice); ?>
                <br>
                *with sendingcosts included
                <br>

                <h3> Your Order </h3> <!-- border + border om elk product > plaatje Float; right overflow: scroll;-->
                <br>
                <br>
                <?php
                foreach ($_SESSION["IDs"] as $index => $val) {
                    $Photo = $_SESSION['Images'][$index];
                    $ItemPrice = $_SESSION["Prices"][$index] * $_SESSION["Quantitys"][$index];
                    print("<img src='$Photo' height='100px'>");
                    print("<br>");
                    print($_SESSION["Names"][$index]);
                    print("<br>");
                    print($_SESSION["Quantitys"][$index]);
                    print("<br>");
                    print("€" . number_format((float)$ItemPrice, 2, '.', ''));

                }
                /*while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    print($_SESSION["Names"]);
                print($_SESSION["Quantitys"]);
                print($_SESSION["Prices"]);
                print($_SESSION["Images"]);*/
                ?>
            </div>
