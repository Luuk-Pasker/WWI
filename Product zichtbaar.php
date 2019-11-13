<html>
<head>
    <title>Pagination</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$no_of_records_per_page = 25;
$offset = ($page-1) * $no_of_records_per_page;

$conn=mysqli_connect("localhost","root","","wideworldimporters");
// Check connection
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

$total_pages_sql = "SELECT COUNT(*) FROM stockitems";
$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM stockitems LIMIT $offset, $no_of_records_per_page";
$res_data = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($res_data)){
    print($row['StockItemID'] . $row['StockItemName'] . "<br>");
}
mysqli_close($conn);
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
</body>
</html>