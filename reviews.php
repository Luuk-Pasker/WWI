<?php
include "includes/header.php";


?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<h1>Comments</h1>


add a comment
<form method="get">
    <table border="1" style="border: black; height: 100px; width: 600px;" class="tableMakeReview">
        <tr style="height: 20px">
            <td style="width: 400px!important;">
                <input type="text" placeholder="What is your name?" name="Author" style="width: 410px!important; float: left">
            </td>
            <td style="width: 100px;">
                <div class="rating" style="float: left; text-align: center">
                    <div class="star-rating" style="height: 20px; margin-top: 0px; padding: 0px; margin-left: 10px; margin-right: auto">
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
</style>

<?php
if(isset($_GET['verzendReview'])) {
    $author = $_GET['Author'];
    $review = $_GET['Comment'];
    $aantalSterren = $_GET['star'];
    $id = 5;

    $sql = "INSERT INTO reviews (PersonID, Naam, Text, aantalSterren) VALUES ('$id', '$author', '$review', '$aantalSterren')";
    $insertIntoReviews = mysqli_query($connection, $sql);
}

    $getreviews = "SELECT * FROM reviews";
    $res_data = mysqli_query($connection, $getreviews);
    $reviewArray = array();
    $i = 0;
    foreach ($res_data as $row) {
        if (mysqli_num_rows($res_data) != 0) {
            $reviewArray[$i] = $row;
            $i++;
        }
    }
    if (mysqli_num_rows($res_data) != 0) {
        for ($i = 0; $i < mysqli_num_rows($res_data); $i++) {
            if(isset($reviewArray[$i]['Naam'])) {
            $author2 = $reviewArray[$i]['Naam'];
            $aantalSterren2 = $reviewArray[$i]['aantalSterren'];
            $reviewText = $reviewArray[$i]['Text'];
                ?>
                <table class='tableDisplayReviews' border='1' style='border: black; height: 100px; width: 600px;'>
                    <tr>
                        <td style='width: 400px; height: 20px'><?php print($author2); ?></td>
                        <td style='width: 110px'><?php print('<div class="star-rating" style="height: 20px; margin-top: 0px; padding: 0px; margin-left: 10px; margin-right: auto">'); for ($j = 0; $j < $aantalSterren2; $j++) {
                                print('
                                    <label for="star-1" title="1 star" style="color: #f2b600">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                    </label>');
                            } print('</div>'); ?></td>
                    </tr>
                    <tr>
                        <td colspan='2'><?php print($reviewText); ?></td>
                    </tr>
                </table><br>
                <?php
            } else {
                print(" ");
            }
        }
    }
?>




