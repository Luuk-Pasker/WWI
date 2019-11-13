<?php
include "includes/header.php";
?>


<?php
$ItemID = 120;

$sql = "SELECT * FROM stockitems S 
        LEFT JOIN stockitemholdings H ON S.StockItemID = H.StockItemID 
        WHERE S.StockItemID = $ItemID";
$result = mysqli_query($connection, $sql);


// loop langs alle rijen
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    print($row["StockItemName"] . "<br>");
    print("€" . $row["UnitPrice"] . "<br>");
    print($row["SearchDetails"] . "<br>");
    print("Nog " . $row["QuantityOnHand"] . " op voorraad.<br>");
    print("<img src='images/120_dino_slippers.jpg'" . $row["Photo"] . "<br>");
}


print("<form>");
print("Aantal:");
print('<input type="number" name="quantity" min="1" max=<?php$row["QuantityOnHand"]?>');
print('<input type="submit" value="Toevoegen aan winkelmand">');
print("</form>");

?>
<?php
include "includes/footer.php";
?>
