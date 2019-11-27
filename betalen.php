<link rel="stylesheets" type="text/css" href="css/betalen.css">

<?php
active:"betalen";
include "includes/header.php";


$sql = "SELECT DeliveryMethodName FROM deliverymethods";
$result = mysqli_query($connection, $sql);

$costs = "SELECT RecommendedRetailPrice FROM stockitems";
$result1 = mysqli_query($connection, $costs);

?>

<a href="winkelmand.php"> back to shoppingcart </a>
<h1> Payment </h1> <br>

<?php
include "includes/footer.php";
?>

<div class="row" style="width: 75%" style="height= 100%">
    <div class="column">
        <!--step 1: information-->
        <div class="information">
            <h3> <img src="images/(step 1).JPG" width="35" height="30" alt="step 1"> Information </h3>
            <form method="$_GET"  action="betalen 2.0.php">
                *E-mail adres: <input type="email" name="email" <!--required-->> <br>
                Sign up for the newspaper:<input type ="checkbox" name="Sign up"> <br> <br>
                *Name: <input type="textarea" name="voornaam" placeholder="First name" <!--required-->>  <input type="textarea" name="last name" placeholder="Last name" <!--required-->> <br>
                <input type="radio"> Mevr. <input type="radio"> Mnr. <br> <br>
                *Adres: <input type="textarea" placeholder="Street" <!--required-->>  <input type="textarea" placeholder="Number" <!--required-->> <br> <br>
                *Postcode: <input type="textarea" name="cijfers postcode" placeholder="4 cijfers" <!--required-->>  <input type="textarea" name="letters postcode" placeholder="2 letters" <!--required-->> <br> <br>
                <input type="submit" value="Next step" class="nextstep">
            </form>
        </div>
    </div>

    <div class="column">
        <!--step 2 verzendmethode-->
        <div class="verzendmethode">

            <form>
                <h3> <img src="images/(step 2).JPG" width="35" height="30" alt="step 1"> Verzendmethode </h3>
                <input type="radio" name="Thuisbezorgd"> Thuisbezorgd via
                <select>
                    <?php while($row = mysqli_fetch_array($result)):; ?>
                        <option> <?php print ($row[0]); ?> </option>
                    <?php endwhile; ?>
                </select>
                <br> verzendkosten:<?php $costs ?>
                <?php
                if($costs<50){
                    print("€6,95 <br> <br> Shipping price is €6.95 for orders below €50.00!");
                } else {
                    print("€0,00");
                }
                ?>
            </form>
        </div>

    </div>

    <div class="column">
        <br> <br>
        <h4 class="total"> Total </h4>
    </div>
</div>

</body>
</html>

