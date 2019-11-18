<?php
$active = "home";
include "includes/header.php";


function GetDeals(){
    $host = "localhost";
    $databasename = "wideworldimporters";
    $user = "root";
    $pass = ""; //eigen password invullen
    $port = 3306;
    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
    $sql = "SELECT * FROM stockitems sitem JOIN stockitemstockgroups sitemsgroup ON sitem.StockItemID = sitemsgroup.StockItemID WHERE sitemsgroup.StockGroupID IN (SELECT StockGroupID FROM specialdeals)";
    $results = mysqli_query($connection, $sql);
    return $results;
}
$results = GetDeals();
foreach ($results as $row){
    print($row["StockItemName"] . "<br>");
}
?>

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

<?php
include "includes/footer.php";
?>