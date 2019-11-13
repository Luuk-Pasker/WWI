<?php
include "includes/header.php";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$no_of_records_per_page = 25;
$offset = ($page-1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM stockitems";
$result = mysqli_query($connection,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM stockitems si JOIN stockitemholdings sih ON si.StockItemId = sih.StockItemId ORDER BY si.StockItemName LIMIT $offset, $no_of_records_per_page";
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