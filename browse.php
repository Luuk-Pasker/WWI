<?php
$active = "browse";
include "includes/header.php";
include "ZoekenProduct.php";
session_start();

$sql = "SELECT * FROM stockgroups ORDER BY StockGroupName";
$result = mysqli_query($connection, $sql);

print("<form method=\"post\" action=\"/WWI/browse.php\">
    <button type=\"submit\">Everything</button>
    </form>");

print("<form method='get'>");

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    print("<button type='submit' name='id' value='" . $row['StockGroupID'] . "'>" . $row['StockGroupName'] . "</button>");
}
print("</form>");


if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $_SESSION['id'] = $_GET['id'];
    $sID = $_SESSION['id'];
} else {
    $sID = 0;
}


if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$no_of_records_per_page = 25;
$offset = ($page-1) * $no_of_records_per_page;


if (isset($_GET['id'])) {
    $total_pages_sql = "SELECT COUNT(DISTINCT StockItemID) FROM stockitemstockgroups WHERE StockGroupID = $id";
} else {
    $total_pages_sql = "SELECT COUNT(DISTINCT StockItemID) FROM stockitemstockgroups";
}

$result = mysqli_query($connection,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

if (isset($_GET['id'])){
    $sql = "SELECT * FROM stockitemstockgroups sisg JOIN stockitems si ON sisg.StockItemID = si.StockItemID JOIN stockitemholdings sih ON si.StockItemId = sih.StockItemId WHERE sisg.StockGroupID = $id ORDER BY si.StockItemName LIMIT $offset, $no_of_records_per_page";
} else {
    $sql = "SELECT * FROM stockitemstockgroups sisg JOIN stockitems si ON sisg.StockItemID = si.StockItemID JOIN stockitemholdings sih ON si.StockItemId = sih.StockItemId ORDER BY si.StockItemName LIMIT $offset, $no_of_records_per_page";
}


$res_data = mysqli_query($connection,$sql);
$zoekopdracht = "";
if (isset($_GET['id'])) {

    while ($row = mysqli_fetch_array($res_data)) {

        print("<a href='productBekijken.php?id=" . $row['StockItemID'] . "'>" . $row["StockItemName"] . " €" . $row["UnitPrice"] . "</a><br>");

    }
    unset($_GET["zoek"]);
} elseif(isset($_GET["toevoegen"])){
    $sID = $_GET["zoek"];
    $_GET["page"] = 1;
    $_GET["id"] = $_GET["zoek"];
    $zoekopdracht = $_GET["zoek"];
    $zoekopdracht = "zoek=" . $zoekopdracht . "&toevoegen=Search&";
    $total_pages = TelZoek($connection, $_GET["zoek"]);
    PrintSearchResults($_GET["zoek"], $offset, $no_of_records_per_page);
} else {
    while ($row = mysqli_fetch_array($res_data)) {

        print("<a href='productBekijken.php?id=" . $row['StockItemID'] . "'>" . $row["StockItemName"] . " €" . $row["UnitPrice"] . "</a><br>");

    }
}

mysqli_close($connection);
?>
<ul class="pagination">
    <li><a href="<?php
        if ($sID == 0){
            echo '?page=1';
        } else {
            echo '?page=1&id=' . $sID;
        }
        ?>">First</a></li>
    <li class="<?php
    if($page <= 1){
        echo 'disabled';
    }
    ?>">
        <a href="<?php
        if($page <= 1){
            echo '#';
        } elseif($sID == 0) {
            echo "?" . $zoekopdracht . "page=".($page - 1);
        } else {
            echo "?page=".($page - 1) . "&id=" . $sID;
        }
        ?>">Prev</a>
    </li>
    <li>
        <a>
            <?php
            print($page);
            ?>
        </a>
    </li>
    <li class="<?php
        if($page >= $total_pages){
            echo 'disabled';
        }
        ?>">
        <a href="<?php
        if($page >= $total_pages){
            echo '#';
        }
        elseif($sID == 0){
            echo "?" . $zoekopdracht . "page=" . ($page + 1);
        } else {
            echo "?page=" . ($page + 1) . "&id=" . $sID;
        }
        ?>">Next</a>
    </li>
    <li><a href="<?php
        if ($sID == 0){
            echo '?page=' . $total_pages;
        } else {
            echo '?page=' . $total_pages . "&id=" . $sID;
        }
        ?>">Last</a></li>
</ul>

<?php
include "includes/footer.php";