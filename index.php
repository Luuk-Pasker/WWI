<?php
$active = "home";
include "includes/header.php";

/*zoek alle huidige producten met korting op*/
function GetDeals(){
    $host = "localhost";
    $databasename = "wideworldimporters";
    $user = "root";
    $pass = ""; //eigen password invullen
    $port = 3306;
    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
    $sql = "SELECT * FROM stockitems sitem JOIN stockitemstockgroups sitemsgroup ON sitem.StockItemID = sitemsgroup.StockItemID WHERE sitemsgroup.StockGroupID IN (SELECT StockGroupID FROM specialdeals) limit 3";
    $results = mysqli_query($connection, $sql);
    return $results;
}
/*zoek alle huidige producten met korting op*/


/*laat alle producten met korting zien*/
$results = GetDeals();
$aantalpaginas = floor(mysqli_num_rows($results) / 3);
$fullarray = array();
$i = 0;
foreach ($results as $row){
    if(mysqli_num_rows($results) != 0) {
        $fullarray[$i] = $row;
        $i++;
    }
}
/*for($i=0; $i < 3; $i++) {
    print('
    <div class="aanbiedingen">
        <div class="row">
            <div class="column">
                <img src="images/img_nature_wide.jpg" style="width:100%">
                product 1<?php print($fullarray[$i]['StockItemName']); ?>
            </div>
        </div>
    </div>';
}*/
/*$q=0;
for($j=0; $j < $aantalpaginas; $j++) {
    for ($i = 0; $i < 3; $i++) {
        if($q == 3){
            $q = 4;
        }
        print_r($fullarray[15]['StockItemName']);
        print($q);
        $q++;
        print("<br><br>");
    }
    $q++;
}*/
/*while ($row = mysqli_fetch_assoc($results)) {
    print_r($row);
    print("<br><br>");
}*/
/*foreach ($results as $index => $row) {
    print_r($index);
    print($row[$index]['StockItemName']);
}*/
/*$aantalpaginas = ceil(mysqli_num_rows($results) / 3);
print($aantalpaginas);*/

/*for($i=1; $i < 3; $i++){
    foreach ($results as $row){
        print($row["StockItemName"]);
        print("<br>");
    }
}*/
/*laat alle producten met korting zien*/
?>
    <div class="aanbiedingen">
        <a href="browse.php" class="extraaanbiedingen"> bekijk meer</a>
        <div class="row">
            <div class="column">
                <img src="images/img_nature_wide.jpg" style="width:100%;">
                <?php print($fullarray[0]['StockItemName'] . "<br>prijs: " . $fullarray[0]['RecommendedRetailPrice'] . "<br>") ?>
                <a class="bekijkkorting" href="productBekijken.php">bekijk product</a>
            </div>
            <div class="column">
                <img src="images/img_nature_wide.jpg" style="width:100%;">
                <?php print($fullarray[1]['StockItemName'] . "<br>prijs: " . $fullarray[1]['RecommendedRetailPrice'] . "<br>") ?>
                <a class="bekijkkorting" href="productBekijken.php">bekijk product</a>
            </div>
            <div class="column">
                <img src="images/img_nature_wide.jpg" style="width:100%;">
                <?php print($fullarray[2]['StockItemName'] . "<br>prijs: " . $fullarray[2]['RecommendedRetailPrice'] . "<br>") ?>
                <a class="bekijkkorting" href="productBekijken.php">bekijk product</a>
            </div>
        </div>
    </div>


    <!--slideshow-->
<!--
    <div class="aanbiedingen">
        <div class="row">
            <div class="column">
                <img src="images/img_nature_wide.jpg" style="width:100%;">
                product 1
            </div>
            <div class="column">
                <img src="images/img_nature_wide.jpg" style="width:100%;">
                product 2
            </div>
            <div class="column">
                <img src="images/img_nature_wide.jpg" style="width:100%;">
                product 3
            </div>
        </div>
        <div class="row">
            <div class="column">
                <img src="images/img_snow_wide.jpg" style="width:100%">
            </div>
            <div class="column">
                <img src="images/img_snow_wide.jpg" style="width:100%">
            </div>
            <div class="column">
                <img src="images/img_snow_wide.jpg" style="width:100%">
            </div>


        </div>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
        <br>

        <div class="paginaindex" style="text-align:center">
            <span class="dot" onclick="currentSlide(1)">pagina 1</span>
            <span class="dot" onclick="currentSlide(2)">pagina 2</span>
            <span class="dot" onclick="currentSlide(3)">pagina 3</span>
        </div>
    </div>
        <!--slideshow-->



    <!--javascript voor de slideshow-->
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("row");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
        }
    </script>
    <!--javascript voor de slideshow-->
<?php
include "includes/footer.php";
?>