<?php
$active = "home";
include "includes/header.php";
?>
<div class="balk"></div>
    <div class="row">
        <div class="column">
            <img src="images/img_nature_wide.jpg" style="width:100%;"><br>
            hallo wereld
        </div>
        <div class="column">
            <img src="images/img_nature_wide.jpg" style="width:100%;">
        </div>
        <div class="column">
            <img src="images/img_nature_wide.jpg" style="width:100%;">
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

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <br>

    <div class="paginaindex" style="text-align:center">
        <span class="dot" onclick="currentSlide(1)">pagina 1</span>
        <span class="dot" onclick="currentSlide(2)">pagina 2</span>
        <span class="dot" onclick="currentSlide(3)">pagina 3</span>
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