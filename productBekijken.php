<?php
include "includes/header.php";
?>


<?php
$ItemID = 120;

//Dit vraagt de gegevens van een gegeven ItemID
$sql = "SELECT * FROM stockitems S 
        LEFT JOIN stockitemholdings H ON S.StockItemID = H.StockItemID 
        WHERE S.StockItemID = $ItemID";
$result = mysqli_query($connection, $sql);


//
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $voorraad = $row["QuantityOnHand"];
    print($row["StockItemName"] . "<br>");
    print("<img src='images/120_dino_slippers.jpg'" . $row["Photo"] . "<br>");
    print("€" . $row["UnitPrice"] . "<br>");
    print($row["SearchDetails"] . "<br>");
}

print("Nog " . $voorraad . " op voorraad.<br>");
?>

<form>
    Aantal:
    <input type="number" name="quantity" min="1" max="<?php print("$voorraad"); ?>">
    <input type="submit" value="Toevoegen aan winkelmand">
</form>



<?php
include "includes/footer.php";
?>
