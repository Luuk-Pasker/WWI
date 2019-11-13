<?php
include "includes/header.php";

$sql = "SELECT * FROM stockgroups ORDER BY StockGroupName";
$result = mysqli_query($connection, $sql);

print("<form method='post'>");
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    print("<button type='submit' name='id' value='" . $row['StockGroupID'] . "'>" . $row['StockGroupName'] . "</button>");
}
print("</form>");

if(isset($_POST['id'])) {
    $id = $_POST['id'];
}



if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$no_of_records_per_page = 25;
$offset = ($page-1) * $no_of_records_per_page;


if (isset($_POST['id'])) {
    $total_pages_sql = "SELECT COUNT(DISTINCT StockItemID) FROM stockitemstockgroups WHERE StockGroupID = $id";
} else {
    $total_pages_sql = "SELECT COUNT(DISTINCT StockItemID) FROM stockitemstockgroups";
}

$result = mysqli_query($connection,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

if (isset($_POST['id'])){
    $sql = "SELECT * FROM stockitemstockgroups sisg JOIN stockitems si ON sisg.StockItemID = si.StockItemID JOIN stockitemholdings sih ON si.StockItemId = sih.StockItemId WHERE sisg.StockGroupID = $id ORDER BY si.StockItemName LIMIT $offset, $no_of_records_per_page";
} else {
    $sql = "SELECT * FROM stockitemstockgroups sisg JOIN stockitems si ON sisg.StockItemID = si.StockItemID JOIN stockitemholdings sih ON si.StockItemId = sih.StockItemId ORDER BY si.StockItemName LIMIT $offset, $no_of_records_per_page";
}


$res_data = mysqli_query($connection,$sql);
while($row = mysqli_fetch_array($res_data)){

    print($row["StockItemName"] . " €" . $row["UnitPrice"] . " Aantal:" . $row["QuantityOnHand"] . "<br>");

}

mysqli_close($connection);
?>
<ul class="pagination">
    <li><a href="?page=1">First</a></li>
    <li class="<?php if($page <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>">Prev</a>
    </li>
    <li>
        <a>
            <?php
            print($page);
            ?>
        </a>
    </li>
    <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>">Next</a>
    </li>
    <li><a href="?page=<?php echo $total_pages; ?>">Last</a></li>
</ul>

<?php
include "includes/footer.php";