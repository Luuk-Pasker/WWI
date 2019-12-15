<!--//header-->
<?php
include "includes/header.php";
include "includes/funtions.php";
?>
<link rel="stylesheet" type="text/css" href="css/productBekijken.css">
<link rel="stylesheet" type="text/css" href="css/browse.css">
<!---->

<!-- go back knop-->
<div class="keerterug">
    <a class="KEERTERUGNU" href="browse.php" style="color: white;">
        <button class="btn" title="Go back"><i class="fas fa-long-arrow-alt-left"></i> Go back</button>
    </a>
</div>

<div class="container">
    <!-- go back knop-->


    <?php


    $productenmetkorting = array("USB missile launcher (Green)", "USB rocket launcher (Gray)", "USB food flash drive - sushi roll", "USB food flash drive - hamburger", "USB food flash drive - hot dog", "USB food flash drive - pizza slice", "USB food flash drive - dim sum 10 drive variety pack", "USB food flash drive - banana", "USB food flash drive - chocolate bar", "USB food flash drive - cookie", "USB food flash drive - donut", "USB food flash drive - shrimp cocktail", "USB food flash drive - fortune cookie", "USB food flash drive - dessert 10 drive variety packdi", "USB food flash drive - dessert 10 drive variety pack");

    if (isset($_GET["id"])) {
        $ItemID = $_GET["id"];
    } else {
        $ItemID = 120;
    }

    //Queery voor het selecteren van het bepaalde item id
    $sql = "SELECT * FROM stockitems S LEFT JOIN stockitemholdings H ON S.StockItemID = H.StockItemID WHERE S.StockItemID = $ItemID";
    $result = mysqli_query($connection, $sql);
    //


    //print: afbeelding, voorraad, naam, prijs en beschrijving en bezorgtijd .
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        //print de afbeeldingen
        $ItemID = $row['StockItemID'];
        $Image1 = 'images/ProductImages/' . $ItemID . '.1.jpg';
        $Image2 = 'images/ProductImages/' . $ItemID . '.2.jpg';
        $Image3 = 'images/ProductImages/' . $ItemID . '.3.jpg';
        $Image4 = 'images/ProductImages/' . $ItemID . '.4.jpg';
        $Image5 = 'images/ProductImages/' . $ItemID . '.5.jpg';
        $ImageFill = 'images/filler.jfif';
        //$ImageFill = 'images/Check.png';

        $Videos = array();
        $Videos["1"] = 'https://www.youtube.com/embed/8yDkraOEgmM';
        $Videos["2"] = 'https://www.youtube.com/embed/8yDkraOEgmM';
        $Videos["66"] = 'https://www.youtube.com/embed/d6B8aVZA4sM';
        $Videos["174"] = 'https://www.youtube.com/embed/bnqKxYbwWKU';
        $Videos["175"] = 'https://www.youtube.com/embed/bnqKxYbwWKU';
        $Videos["176"] = 'https://www.youtube.com/embed/bnqKxYbwWKU';
        $Videos["203"] = 'https://www.youtube.com/embed/LEmqJ_eQnR0';
        $Videos["204"] = 'https://www.youtube.com/embed/LEmqJ_eQnR0';
        $Videos["205"] = 'https://www.youtube.com/embed/LEmqJ_eQnR0';
        $Videos["215"] = 'https://www.youtube.com/embed/yD4uVbRS1C8';


        if (!(empty($Videos["$ItemID"]))) {
            $hasVideo = true;
        } else {
            $hasVideo = false;
        }
        if (!(@getimagesize($Image1))) {
            $Image1 = "images/" . $row['Photo'];
        }

        if ((@getimagesize($Image2)) || $hasVideo) {
            print('<div class="foto">');
            print('<div class="slider-holder">');
            print('<span id="slider-image-1"></span>');
            if ((@getimagesize($Image2))) {
                print('<span id="slider-image-2"></span>');
            }
            if ((@getimagesize($Image3))) {
                print('<span id="slider-image-3"></span>');
            }
            if ((@getimagesize($Image4))) {
                print('<span id="slider-image-4"></span>');
            }
            if ((@getimagesize($Image5))) {
                print('<span id="slider-image-5"></span>');
            }
            if ((@getimagesize($Image5))) {
                print('<span id="slider-image-5"></span>');
            }
            if ($hasVideo) {
                print('<span id="slider-video"></span>');
            }
            print('<div class="image-holder">');
            print('<img src="');
            print($Image1);
            print('" class="slider-image">');
            if ((@getimagesize($Image2))) {
                print('<img src="');
                print($Image2);
                print('" class="slider-image">');
            }
            if ((@getimagesize($Image3))) {
                print('<img src="');
                print($Image3);
                print('" class="slider-image">');
            }
            if ((@getimagesize($Image4))) {
                print('<img src="');
                print($Image4);
                print('" class="slider-image">');
            }
            if ((@getimagesize($Image5))) {
                print('<img src="');
                print($Image5);
                print('" class="slider-image">');
            }
            if ($hasVideo) {
                if (!(@getimagesize($Image2))) {
                    print('<img src="');
                    print($ImageFill);
                    print('" class="slider-image">');
                }
                if (!(@getimagesize($Image3))) {
                    print('<img src="');
                    print($ImageFill);
                    print('" class="slider-image">');
                }
                if (!(@getimagesize($Image4))) {
                    print('<img src="');
                    print($ImageFill);
                    print('" class="slider-image">');
                }
                if (!(@getimagesize($Image5))) {
                    print('<img src="');
                    print($ImageFill);
                    print('" class="slider-image">');
                }
                print('<iframe width="480" height="460" src="');
                print($Videos["$ItemID"]);
                print('">');
                print('</iframe>');
            }
            print('</div>');
            print('<div class="button-holder">');
            print('<a href="#slider-image-1" class="slider-change"></a>');
            if ((@getimagesize($Image2))) {
                print('<a href="#slider-image-2" class="slider-change"></a>');
            }
            if ((@getimagesize($Image3))) {
                print('<a href="#slider-image-3" class="slider-change"></a>');
            }
            if ((@getimagesize($Image4))) {
                print('<a href="#slider-image-4" class="slider-change"></a>');
            }
            if ((@getimagesize($Image5))) {
                print('<a href="#slider-image-5" class="slider-change"></a>');
            }
            if ($hasVideo) {
                print('<a href="#slider-video" class="slider-change"></a>');
            }
            print('</div>');
            print('</div>');
            print('</div>');
        } else {
            print("<img class='foto' src='$Image1'><br>");
        }


        print("<div class='naambeschrijvingprijsnogopvoorraad'>");
        print("<div class='naam'>" . $row["StockItemName"] . "</div><br>");

        /*print tags*/
        print"<div class='Alltags'>";
        if ($row["Tags"] == '["32GB","USB Powered"]') {
            print("<a class='Techtags' href='http://localhost/WWI/browse.php?zoek=32gb&toevoegen=Search'>" . substr('["32GB","USB Powered"]', -20, 4) . "</a>");
            print("<a class='Techtags' href='http://localhost/WWI/browse.php?zoek=USB&toevoegen=Search'>" . substr('["32GB","USB Powered"]', -13, 11) . "</a>");
            print("<a class='Techtags' href='easteregg.php'>" . "Easteregg" . "</a>");


        } elseif ($row["Tags"] == '["16GB","USB Powered"]') {
            print("<a class='Techtags' href='http://localhost/WWI/browse.php?zoek=16gb&toevoegen=Search'>" . substr('["16GB","USB Powered"]', -20, 4) . "</a>");
            print("<a class='Techtags' href='http://localhost/WWI/browse.php?zoek=USB&toevoegen=Search'>" . substr('["16GB","USB Powered"]', -13, 11) . "</a>");
            print("<a class='Techtags' href='easteregg.php'>" . "Easteregg" . "</a>");


        } elseif ($row["Tags"] == '["Radio Control","Realistic Sound"]') {
            print("<a class='RCtags' href='http://localhost/WWI/browse.php?zoek=rc&toevoegen=Search'>" . substr('["Radio Control","Realistic Sound"]', -33, 13) . "</a>");
            print("<a class='Toytags' href='http://localhost/WWI/browse.php?zoek=realistic+sound&toevoegen=Search'>" . substr('["Radio Control","Realistic Sound"]', -17, 15) . "</a>");
            print("<a class='Techtags' href='easteregg.php'>" . "Easteregg" . "</a>");


        } elseif ($row["Tags"] == '["Vintage","So Realistic"]') {
            print("<a class='Lifestyletags' href='http://localhost/WWI/browse.php?zoek=vintage&toevoegen=Search'>" . substr('["Vintage","So Realistic"]', -24, 11) . "</a>");
            print("<a class='Lifestyletags' href='http://localhost/WWI/browse.php?zoek=realistic&toevoegen=Search'>" . substr('["Vintage","So Realistic"]', -14, 12) . "</a>");
            print("<a class='Techtags' href='easteregg.php'>" . "Easteregg" . "</a>");


        } elseif ($row["Tags"] == '["Comfortable","Long Battery Life"]') {
            print("<a class='Lifestyletags' href='http://localhost/WWI/browse.php?zoek=vintage&toevoegen=Search'>" . substr('["Comfortable","Long Battery Life"]', -33, 11) . "</a>");
            print("<a class='Techtags' href='http://localhost/WWI/browse.php?zoek=long&toevoegen=Search'>" . substr('["Comfortable","Long Battery Life"]', -19, 17) . "</a>");
            print("<a class='Techtags' href='easteregg.php'>" . "Easteregg" . "</a>");


        } elseif ($row["Tags"] == '[]') {
            print"";

        } elseif ($row["Tags"] == '["So Realistic"]') {
            print("<a class='Lifestyletags' href='http://localhost/WWI/browse.php?zoek=realistic&toevoegen=Search'>" . substr('["Vintage","So Realistic"]', -14, 12) . "</a>");
            print("<a class='Techtags' href='easteregg.php'>" . "Easteregg" . "</a>");

        } else {
            $x = array('["', '"]');
            $y = ("http://localhost/WWI/browse.php?zoek=" . $row["Tags"] . "&toevoegen=Search");
            print("<a class='tags' href='$y'>" . str_replace($x, "", $row["Tags"]) . "</a>");
            print("<a class='Techtags' href='easteregg.php'>" . "Easteregg" . "</a>");

        }
        print"</div>";
        /*print tags*/

        /**/


        print("<div class='beschrijving2'>Description:</div><BR>" . "<div class='beschrijving'>" . $row["SearchDetails"] . "</div><br>");

        $price = $row["UnitPrice"];
        $kortingprijs = $price / 100 * 85;
        $nieuwekortingprijs = number_format($kortingprijs, 2);

        /*producten met korting*/
        if (in_array($row['StockItemName'], $productenmetkorting)) {
            print("<div class='paynow'>" . "Pay now!" . "</div>");
            if ($row['StockItemName'] == 'USB rocket launcher (Gray)') {
                print("<A class='prijs'>" . "€21.25" . "</A>");
            } else {
                print("<A class='prijs'>" . "€" . $nieuwekortingprijs . "</A>");
            }
            print("<A class='oudeprijs'>" . "<strike>€$price </strike>" . "</A>");
            print("<div class='safeoff'>" . "15% off save " . ($price / 100 * 15) . "</div><br>");


            ?>
            <div class="countdown">
<p id="demo"></p>

<script>
    // Set the date we're counting down to
    var countDownDate = new Date("Dec 20, 2019 15:37:25").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                document.getElementById("demo").innerHTML = "Just " + days + "d " + hours + "h "
                    + minutes + "m " + seconds + "s left!!";

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                }
            }, 1000);
</script>
</div>
            <br>
            <br>
            <br>
    <?php

            print("<H4 class='nogopvoorraad'>" . " In stock! </H4>");
            print("<H4 class='bezorgdatum'>" . $row['LeadTimeDays'] . " days to deliver</H4><br>");
            print("</div>");
            $heeftKorting = TRUE;
            /*producten met korting*/

            /*            producten zonder korting*/
        } else {
            print("<div class='prijs'>" . "€" . $price . "</div><br><br>");
            print("<h4 class='nogopvoorraad'>" . " In stock! </h4>");
            print("<h4 class='bezorgdatum'>" . $row['LeadTimeDays'] . " days to deliver</h4><br>");
            print("</div>");
            /*            producten zonder korting*/
            $heeftKorting = FALSE;
        }
    }
    ?>

    <!-- //aantallen selecteer formulee/toevoegen aan winkelmand knop-->
    <div class="aantallen">
        <form action="winkelmand.php" method="post">
            <input id="toevoegenaanwinkelmand" type="submit" value="Add to shopping cart">
            Amount: <input id="aantalx" type="number" value="1" name="quantity">
            <input type="hidden" name="ItemID" value="<?php print("$ItemID"); ?>">
            <input type="hidden" name="ItemPrice" value="<?php print("$price"); ?>">
            <input type="hidden" name="DealPrice" value="<?php print("$nieuwekortingprijs"); ?>">
            <input type="hidden" name="hasDeal" value="<?php print("$heeftKorting"); ?>">
        </form>
    </div>
</div>


<h1 style="text-align: center;">Reviews</h1>


<style>
    .star-rating {
        direction: rtl;
        display: inline-block;
        padding: 20px
    }

    .star-rating input[type=radio] {
        display: none
    }

    .star-rating label {
        color: #bbb;
        font-size: 18px;
        padding: 0;
        cursor: pointer;
    }

    .star-rating label:hover,
    .star-rating label:hover ~ label,
    .star-rating input[type=radio]:checked ~ label {
        color: #f2b600
    }

    .tableDisplayReviews {
        border: 0px;
        height: 100px;
        width: 600px;
        box-shadow: 0px 0px 2px 2px lightgrey;
    }
</style>

<?php
if (isset($_POST['verzendReview'])) {

    if (empty($_POST['star'])){
        $aantalSterren = 0;
    } else {
        $aantalSterren = $_POST['star'];
    }

    /*informatie over de gebruiker die de review maakt opvragen*/
    $id = $_SESSION['user_session'];
    $review = $_POST['Comment'];
    $productIDReview = $_GET['id'];
    /*informatie over de gebruiker die de review maakt opvragen*/


    /*naam van de gebruiker die de review maakt opvragen uit de database*/
    $getName = "SELECT FullName FROM people where PersonID = $id";
    $name = mysqli_query($connection, $getName);
    foreach ($name as $row) {
        $author = $row['FullName'];
    }
    /*naam van de gebruiker die de review maakt opvragen uit de database*/

    /*informatie uit de review in de database zetten*/
    $sql = mysqli_prepare($connection, "INSERT INTO reviews (PersonID, Naam, Text, aantalSterren, StockItemID) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql, 'issii', $id, $author, $review, $aantalSterren, $productIDReview);
    mysqli_stmt_execute($sql);
    /*informatie uit de review in de database zetten*/
}

/*query voor het opvragen van de bestaande reviews*/
$productIDReview = $_GET['id'];
$getreviews = "SELECT * FROM reviews WHERE StockItemID = $productIDReview ORDER BY ReviewID DESC limit 6";
$res_data2 = mysqli_query($connection, $getreviews);
$reviewArray = array();
$i = 0;
foreach ($res_data2 as $row) {
    if (mysqli_num_rows($res_data2) != 0) {
        $reviewArray[$i] = $row;
        $i++;
    }
}
/*query voor het opvragen van de bestaande reviews*/

/*aantal reviews berekenen om de juiste tabel te kunnen maken*/
$aantalReviews = mysqli_num_rows($res_data2);
/*aantal reviews berekenen om de juiste tabel te kunnen maken*/

/*checken of er reviews bestaan voor het product*/
if ($aantalReviews == 0) {
    print("<div style='text-align: center'>There are no reviews for this product yet</div><br><br>");
} else {
    /*checken of er reviews bestaan voor het product*/

    if (mysqli_num_rows($res_data2) != 0) {
        $teller = 0;
        print("<table style='border-collapse: separate; border-spacing: 2em; margin-left: auto; margin-right: auto;'>");
        for ($j = 0; $j < ($aantalReviews / 2); $j++) {
            print("<tr>");
            for ($q = 0; $q < 2; $q++) {
                if (isset($reviewArray[$teller]['Naam'])) {
                    $author2 = $reviewArray[$teller]['Naam'];
                    $aantalSterren2 = $reviewArray[$teller]['aantalSterren'];
                    $reviewText = $reviewArray[$teller]['Text'];
                    $teller++;
                    ?>
                    <td>
                    <table class='tableDisplayReviews' border='1'>
                        <tr>
                            <td style='width: 400px; height: 20px'><b><?php print($author2); ?></b></td>
                            <td style='width: 110px'><?php print('<div class="star-rating" style="height: 20px!important; margin-top: 0px; padding: 0px!important; margin-left: 10px; margin-right: auto">');
                                for ($Q = 0; $Q < $aantalSterren2; $Q++) {
                                    print('
                                    <label for="star-1" title="1 star" style="color: #f2b600">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                    </label>');
                                }
                                print('</div>'); ?></td>
                        </tr>
                        <tr>
                            <td colspan='2'><?php print($reviewText); ?></td>
                        </tr>
                    </table></td><?php }
            }
            print("</tr>");
        }
        print("</table>");

    }
}

if (isset($_SESSION['login']) && $_SESSION['login'] == TRUE) {
    $id = $_SESSION['user_session'];

    $getName = "SELECT FullName FROM people where PersonID = $id";
    $name = mysqli_query($connection, $getName);
    foreach ($name as $row) {
        $author = $row['FullName'];
    }
    ?>
    <form method="post">
        <table border="1"
               style="border: 0px; height: 100px; width: 600px; box-shadow: 0px 0px 2px 2px lightgrey; margin-left: auto; margin-right: auto"
               class="tableMakeReview">
            <tr style="height: 20px">
                <td style="width: 400px!important;">
                    <input type="text" name="Author" value="<?php print($author); ?>"
                           style="width: 100%!important; float: left">
                </td>
                <td style="width: 100px;">
                    <div class="rating" style="float: left; text-align: center">
                        <div class="star-rating"
                             style="height: 20px; margin-top: 0px; padding: 0px; margin-left: 10px; margin-right: auto">
                            <input id="star-5" type="radio" name="star" value="5">
                            <label for="star-5" title="5 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-4" type="radio" name="star" value="4">
                            <label for="star-4" title="4 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-3" type="radio" name="star" value="3">
                            <label for="star-3" title="3 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-2" type="radio" name="star" value="2">
                            <label for="star-2" title="2 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-1" type="radio" name="star" value="1" checked>
                            <label for="star-1" title="1 star">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                        </div>
                        <div class="clear"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <textarea name="Comment" placeholder="Text" style="height: 100px; width: 100%"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input class="reviewButton" type="submit" name="verzendReview" value="Verzend Review">
                </td>
            </tr>
        </table>
    </form><br><br>
    <?php
} else {
    print("<h4 style='text-align: center; margin-bottom: 30px'>You need to login to post a review</h4>");
}

include "includes/footer.php";