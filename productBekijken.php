<?php
include "includes/header.php";
?>


<?php
$ItemID = 120;

$sql = "SELECT * FROM stockitems S 
        LEFT JOIN stockitemholdings H ON S.StockItemID = H.StockItemID 
        WHERE S.StockItemID = $ItemID";
$result = mysqli_query($connection, $sql);

echo "<table>";
// loop langs alle rijen
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    print($row["StockItemName"] . "<br>");
    print($row["UnitPrice"] . "<br>");
    print($row["SearchDetails"] . "<br>");
    print($row["QuantityOnHand"] . "<br>");
    print("<img src='images/120_dino_slippers.jpg'" . $row["Photo"] . "<br>");
}
echo "</table>";

?>

<?php
include "includes/footer.php";
?>
