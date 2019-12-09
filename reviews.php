<?php
include "includes/header.php";

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<h1 style="text-align: center">Reviews</h1>



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

    .tableDisplayReviews{
        border: 0px;
        height: 100px;
        width: 600px;
        box-shadow: 0px 0px 2px 2px lightgrey;
    }
</style>

<?php
if(isset($_POST['verzendReview'])) {
    $id = $_SESSION['user_session'];
    $review = $_POST['Comment'];
    $aantalSterren = $_POST['star'];

    $getName = "SELECT FullName FROM people where PersonID = $id";
    $name = mysqli_query($connection, $getName);
    foreach ($name as $row){
        $author = $row['FullName'];
    }

    $sql = mysqli_prepare($connection, "INSERT INTO reviews (PersonID, Naam, Text, aantalSterren) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql,'issi', $id, $author, $review, $aantalSterren);
    mysqli_stmt_execute($sql);
}

    $getreviews = "SELECT * FROM reviews ORDER BY ReviewID DESC limit 6";
    $res_data = mysqli_query($connection, $getreviews);
    $reviewArray = array();
    $i = 0;
    foreach ($res_data as $row) {
        if (mysqli_num_rows($res_data) != 0) {
            $reviewArray[$i] = $row;
            $i++;
        }
    }
    $aantalReviews = mysqli_num_rows($res_data);
    /*foreach ($reviewArray as $row){
        $author2 = $row['Naam'];
        $aantalSterren2 = $row['aantalSterren'];
        $reviewText = $row['Text'];*/?><!--
        <table class='tableDisplayReviews' border='1'>
            <tr>
                <td style='width: 400px; height: 20px'><b><?php /*print($author2); */?></b></td>
                <td style='width: 110px'><?php /*print('<div class="star-rating" style="height: 20px!important; margin-top: 0px; padding: 0px!important; margin-left: 10px; margin-right: auto">');
                    for ($Q = 0; $Q < $aantalSterren2; $Q++) {
                        print('
                            <label for="star-1" title="1 star" style="color: #f2b600">
                            <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>');
                        }
                    print('</div>'); */?></td>
            </tr>
            <tr>
                <td colspan='2'><?php /*print($reviewText); */?></td>
            </tr>
            </table>
            --><?php
/*    }*/
    if (mysqli_num_rows($res_data) != 0) {
            $teller = 0;
            print("<table style='border-collapse: separate; border-spacing: 2em; margin-left: auto; margin-right: auto;'>");
            for ($j = 0; $j < ($aantalReviews/2); $j++) {
                print("<tr>");
                for ($q = 0; $q < 2; $q++) {
                    if(isset($reviewArray[$teller]['Naam'])){
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
            /*for ($i = 0; $i < mysqli_num_rows($res_data); $i++) {
                if(isset($reviewArray[$i]['Naam'])) {
                $author2 = $reviewArray[$i]['Naam'];
                $aantalSterren2 = $reviewArray[$i]['aantalSterren'];
                $reviewText = $reviewArray[$i]['Text'];
                    */ ?><!--
                <table class='tableDisplayReviews' border='1'>
                    <tr>
                        <td style='width: 400px; height: 20px'><b><?php /*print($author2); */ ?></b></td>
                        <td style='width: 110px'><?php /*print('<div class="star-rating" style="height: 20px; margin-top: 0px; padding: 0px; margin-left: 10px; margin-right: auto">');
                            for ($j = 0; $j < $aantalSterren2; $j++) {
                                print('
                                    <label for="star-1" title="1 star" style="color: #f2b600">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                    </label>');
                            } print('</div>'); */ ?></td>
                    </tr>
                    <tr>
                        <td colspan='2'><?php /*print($reviewText); */ ?></td>
                    </tr>
                </table><br>
                --><?php
            /*          } else {
                            print(" ");
                        }
                    }*/
        }
?>


<?php
if(isset($_SESSION['login']) &&  $_SESSION['login'] == TRUE) {
    $id = $_SESSION['user_session'];

    $getName = "SELECT FullName FROM people where PersonID = $id";
    $name = mysqli_query($connection, $getName);
    foreach ($name as $row){
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
                            <input id="star-1" type="radio" name="star" value="1">
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
    </form>
    <?php
}
?>




