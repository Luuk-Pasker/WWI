<?php
include "includes/header.php";
session_start();
?>

<a href="index.php">back</a>
<h1> Payment </h1> <br>

<h3> Step 1: Information </h3>
<form method="POST"  action="Betaling product.php">
    E-mail adres: <input type="email" name="email"> <br>
    Sign up for the newspaper:<input type ="checkbox" name="Sign up"> <br> <br>
    Name: <input type="textarea" name="voornaam" placeholder="First name">  <input type="textarea" name="last name" placeholder="Last name"> <br>
    <input type="radio"> Mevr. <input type="radio"> Mnr. <br> <br>
    Adres: <input type="textarea" placeholder="Street">  <input type="textarea" placeholder="Number"> <br> <br>
    Postcode: <input type="textarea" name="cijfers postcode" placeholder="4 cijfers">  <input type="textarea" name="letters postcode" placeholder="2 letters"> <br> <br>
    Woonplaats: <input type="textarea" name="woonplaats"> <br> <br> <br>

</form>

<h3> Step 2: Verzendmethode </h3>
<input type="radio" name="Thuisbezorgd"> Thuisbezorgd via <select>
    <option value="company">company</option>
</select> <br> verzendkosten:  <br> <br>

<input type="radio" name="Ophalen winkel"> Ophalen bij een winkel in de buurt <select>
    <option value="winkel">winkel</option>
</select>
<br> verzendkosten:

<br> <br> <br>

<input type="submit" value="Next steps">
<?php
include "includes/footer.php";
?>
