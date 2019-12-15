<?php
include "includes/header.php";
include "includes/funtions.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Traffic racer</title>
    <link href="css/easteregg.css" rel="stylesheet" /> </head>

<body>

<div id="score_div">
    Score: <span id="score">0</span>
    High Score: <span id="high_score">0</span>
</div>

<div id="beschrijving">
    Oh no!!! Its christmas evening<br>
    and there is a huge problem at<br>
    the delivery department. Can <br>
    you drive the how well can you<br>
    maneuver over the road to<br>
    deliver the packages to the<br>
    right location?<br>
</div>

<div id="korting">
    Get a 10% discount if you score<br>
    more than a 100 points!!!
</div>

<div id="container">
    <div id="line_1" class="line"></div>
    <div id="line_2" class="line"></div>
    <div id="line_3" class="line"></div>
    <div id="car" class="car">
        <div class="f_glass"></div>
        <div class="b_glass"></div>
        <div class="f_light_l"></div>
        <div class="f_light_r"></div>
        <div class="f_tyre_l"></div>
        <div class="f_tyre_r"></div>
        <div class="b_tyre_l"></div>
        <div class="b_tyre_r"></div>
    </div>
    <div id="car_1" class="car">
        <div class="f_glass"></div>
        <div class="b_glass"></div>
        <div class="f_light_l"></div>
        <div class="f_light_r"></div>
        <div class="f_tyre_l"></div>
        <div class="f_tyre_r"></div>
        <div class="b_tyre_l"></div>
        <div class="b_tyre_r"></div>
    </div>
    <div id="car_2" class="car">
        <div class="f_glass"></div>
        <div class="b_glass"></div>
        <div class="f_light_l"></div>
        <div class="f_light_r"></div>
        <div class="f_tyre_l"></div>
        <div class="f_tyre_r"></div>
        <div class="b_tyre_l"></div>
        <div class="b_tyre_r"></div>
    </div>
    <div id="car_3" class="car">
        <div class="f_glass"></div>
        <div class="b_glass"></div>
        <div class="f_light_l"></div>
        <div class="f_light_r"></div>
        <div class="f_tyre_l"></div>
        <div class="f_tyre_r"></div>
        <div class="b_tyre_l"></div>
        <div class="b_tyre_r"></div>
    </div>



    <?php
    print"<div id=\"restart_div\">";

    print"<button id=\"restart\">
               Restart<br>
               <small class=\"small_text\">(press Enter)</small>
               </button>";
    print"</div>"

    ?>

</div>


<script src="jquery.min.js"></script>
<script src="script.js"></script>
</body>

</html>
