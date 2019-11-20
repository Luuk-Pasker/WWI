<?php

$active = "home";
include "includes/header.php";
include "includes/funtions.php";




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
/*maak een array met de laatst toegevoegde items*/
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="w3-content w3-section" style="max-width:100%; height:20%!important">
    <img class="mySlides" src="images/img_mountains_wide.jpg" style="width:100%">
    <img class="mySlides" src="images/img_nature_wide.jpg" style="width:100%">
    <img class="mySlides" src="images/img_snow_wide.jpg" style="width:100%">
</div>
<br>

<script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}
        x[myIndex-1].style.display = "block";
        setTimeout(carousel, 2000); // Change image every 2 seconds
    }
</script>


<a href="productBekijken.php?id=">
    <table width="100%" class="table table-bordered">
        <tr>
            <?php
            for($i=0; $i < mysqli_num_rows($results); $i++){
                print("<th>" . "<img class='foto' src='images/120_dino_slippers.jpg' width='300px'><BR>");
                print($fullarray[$i]['StockItemName'] . "</th>");
            }
            ?>
        </tr>
        <tr>
            <td colspan="4" style="border: none!important;">
                <a href="browse.php">
                    <div style="text-align: center">
                        <button type="button" class="btn btn-primary">See More Deals</button>
                    </div>
                </a>
            </td>
        </tr>
    </table>
</a>

<a href="productBekijken.php?id=">
    <table width="100%" class="table table-bordered">
        <tr>
            <?php
            for($i=0; $i < mysqli_num_rows($results); $i++){
                print("<th>" . "<img class='foto' src='images/120_dino_slippers.jpg' width='300px'><BR>");
                print($fullArrayLaatstToegevoegd[$i]['StockItemName'] . "</th>");
            }
            ?>
        </tr>
        <tr>
            <td colspan="4" style="border: none!important;">
                <a href="browse.php">
                    <div style="text-align: center">
                        <button type="button" class="btn btn-primary">See More New Products</button>
                    </div>
                </a>
            </td>
        </tr>
    </table>
</a>


<?php
include "includes/footer.php";
?>
