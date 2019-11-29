<?php
include "includes/header.php";
?>
<h1>Comments</h1>


add a comment
<form method="get">
    <table border="1" style="border: black; height: 100px; width: 500px;" class="tableMakeReview">
        <tr style="height: 20px">
            <td style="width: 400px!important;">
                <input type="text" placeholder="What is your name?" name="Author" style="width: 410px!important; float: left">
            </td>
            <td style="width: 100px;">
                <div class="rating" style="float: left; text-align: center">
                    <input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
                    <label for="star5">☆</label>
                    <input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
                    <label for="star4">☆</label>
                    <input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
                    <label for="star3">☆</label>
                    <input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
                    <label for="star2">☆</label>
                    <input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
                    <label for="star1">☆</label>

                    <div class="rating">
                        <span><i class="rating4 fa fa-star"></i></span><span><i class="rating4 fa fa-star"></i></span><span><i class="rating4 fa fa-star"></i></span><span><i class="rating4 fa fa-star"></i></span><span><i class="rating4 fa fa-star"></i></span>
                    </div>
                    <i class="rating4 fa fa-star"></i>
                    <i class="rating4 fa fa-star"></i>
                    <i class="rating4 fa fa-star"></i>
                    <i class="rating4 fa fa-star"></i>
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
        for ($i = 0; $i < 4; $i++) {
            if(isset($reviewArray[$i]['Naam'])) {
            $author2 = $reviewArray[$i]['Naam'];
            $aantalSterren2 = $reviewArray[$i]['aantalSterren'];
            $reviewText = $reviewArray[$i]['Text'];
                ?>
                <table class='tableDisplayReviews' border='1' style='border: black; height: 100px; width: 500px;'>
                    <tr>
                        <td style='width: 400px; height: 20px'><?php print($author2); ?></td>
                        <td style='width: 100px'><?php for ($j = 0; $j < $aantalSterren2; $j++) {
                                print('<i class="rating2 fa fa-star"></i>');
                            } ?></td>
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











<style>
    .txt-center {
        text-align: center;
    }
    .hide {
        display: none;
    }

    .clear {
        float: none;
        clear: both;
    }

    .rating {
        width: 90px;
        unicode-bidi: bidi-override;
        direction: rtl;
        text-align: center;
        position: relative;
    }

    .rating > label {
        float: right;
        display: inline;
        padding: 0;
        margin: 0;
        position: relative;
        width: 1.1em;
        cursor: pointer;
        color: #000;
    }

    .rating > label:hover,
    .rating > label:hover ~ label,
    .rating > input.radio-btn:checked ~ label {
        color: transparent;
    }

    .rating > label:hover:before,
    .rating > label:hover ~ label:before,
    .rating > input.radio-btn:checked ~ label:before,
    .rating > input.radio-btn:checked ~ label:before {
        content: "\2605";
        position: absolute;
        left: 0;
        color: #FFD700;
    }
</style>


<h1>User Rating</h1>
<i class="rating2 fa fa-star"></i>


<style>
    .rating2:before {
        position: inherit;
        float: left;
        top: 100%;
        height: 100%;
        width: 20%!important;
        color: #eb0;
        font-size: 120%;
        text-align: center;
        margin-top: 5px;
        margin-bottom: auto;
    }

    .rating4{
        color: green;
    }
    .rating4:hover{
        color: #eb0;
    }
    .rating4:hover:first-child{
        color: purple;
    }


</style>

