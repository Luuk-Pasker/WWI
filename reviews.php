<h1>Comments</h1>


add a comment
<form method="get">
    <table border="1" style="border: black; height: 100px; width: 500px;" class="tableMakeReview">
        <tr style="height: 20px">
            <td style="width: 410px!important;">
                <input type="text" placeholder="wat is uw naam" name="Author" style="width: 410px!important; float: left">
            </td>
            <td style="width: 90px;">
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
                    <div class="clear"></div>
                </div>
           </td>
       </tr>
       <tr>
           <td colspan="2">
               <textarea name="Comment" style="height: 100px; width: 100%"></textarea>
          </td>
      </tr>
      <tr>
          <td colspan="2">
              <input type="submit" name="verzendReview" value="Verzend Review">
          </td>
      </tr>
    </table>
</form>


<?php
if(isset($_GET['verzendReview'])){
    $author = $_GET['Author'];
    $review = $_GET['Comment'];
    $aantalSterren = $_GET['star'];

    print("<table class='tableDisplayReviews'border='1' style='border: black; height: 100px; width: 500px;'>
<tr><td style='width: 410px;'>$author</td><td style='width: 90px'> $aantalSterren</td></tr>
<tr><td colspan='2'>$review</td></tr>
</table>");
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
