
<form METHOD="POST">
I have a discount code: <input type="text" name="discountcode">
<input type="submit" name="discount" value="discountsubmit">
</form>


       <?php
       $_SESSION['TotalPrice'] = 10;
       $discount = 10;
       $code = "SALE";
        if(isset($_POST['discountcode'])) {
            $dcode = $_POST['discountcode'];

            $correct = $_SESSION["TotalPrice"] * (100 - $discount) / 100;
            /*door de code heen*/
            {
                if ($code == $dcode) {
                    print ($correct);
                } else {
                    print("This is no discount code.");
                }
            }
        }
