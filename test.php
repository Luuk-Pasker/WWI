<?php
$active = "home";
include "includes/header.php";
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

<?php
include "includes/footer.php";
?>