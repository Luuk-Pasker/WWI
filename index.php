<?php
$active = "home";
include "includes/header.php";
include "includes/funtions.php";


print("<link rel='stylesheet' type='text/css' href = 'css/home.css'>");
print("<link rel='stylesheet' type='text/css' href='css/home.css'>");

/* sql query voor alle categorien*/
$sql = "SELECT * FROM stockgroups ORDER BY StockGroupName";
$result = mysqli_query($connection, $sql);
/* sql query voor alle categorien   */

/*print alle namen op de knoppen*/
print("<form method='get' action=\"/WWI/browse.php\">");

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    /*navigationbar*/
    print("<button class='button' name='id' value='" . $row['StockGroupID'] . "'>" . $row['StockGroupName'] . "</button>");
}
/*navigationbar*/

print("</form></div>");

/*maak een array met de verkregen deals*/
$results = GetDeals($connection);
$aantalpaginas = floor(mysqli_num_rows($results) / 3);
$fullarray = array();
$i = 0;
foreach ($results as $row) {
    if (mysqli_num_rows($results) != 0) {
        $fullarray[$i] = $row;
        $i++;
    }
}
/*maak een array met de verkregen deals*/

/*maak een array met de laatst toegevoegde items*/
$laatstToegevoegd = GetLaatstToegevoegd($connection);
$fullArrayLaatstToegevoegd = array();
$i = 0;
foreach ($laatstToegevoegd as $row) {
    if (mysqli_num_rows($results) != 0) {
        $fullArrayLaatstToegevoegd[$i] = $row;
        $i++;
    }
}
/*maak een array met de laatst toegevoegde items*/
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


<div class="homebody">


    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin: 0 auto;">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" style ="display: flex!important; justify-content: center">
            <div class="item active">
                <table>
                    <tr>
                        <th>
                            <a href='productBekijken.php?id=" . $fullarray[$i]['StockItemID'] . "'>
                            <img src="images/slippers.jpg" alt="Los Angeles" style="height:200px;float: left; text-align: center">
                            </a>
                        </th>
                        <th>
                            <img src="images/toys.jpg" alt="Los Angeles" style="height:200px;float: left; margin-left: auto;margin-right: auto">
                        </th>
                        <th>
                            <img src="images/packaging.jpg" alt="Los Angeles" style="height:200px;float: left; margin-left: auto;margin-right: auto">
                        </th>
                    </tr>
                </table>
                <!--<img src="images/slippers.jpg" alt="Los Angeles" style="height:200px;float: left; text-align: center">
                <img src="images/clothing.jpg" alt="Los Angeles" style="height:200px;float: left; text-align: center">
                <img src="images/mug.jpg" alt="Los Angeles" style="height:200px;float: left; text-align: center">-->
            </div>

            <div class="item" style="text-align: center">
                <img src="images/packaging.jpg" alt="Los Angeles" style="height:200px;float: left; margin-left: auto;margin-right: auto">
                <img src="images/toys.jpg" alt="Los Angeles" style="height:200px;float: left; margin-left: auto;margin-right: auto">
                <img src="images/usb.jpg" alt="Los Angeles" style="height:200px;float: left; margin-left: auto;margin-right: auto">
            </div>

            <div class="item">
                <img src="images/t-shirt.jpg" alt="Los Angeles" style="height:200px;float: left">
                <img src="images/slippers.jpg" alt="Los Angeles" style="height:200px;float: left">
                <img src="images/slippers.jpg" alt="Los Angeles" style="height:200px;float: left">
            </div>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

        <script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}
        x[myIndex-1].style.display = "block";
        setTimeout(carousel, 3000); // Change image every 2 seconds
    }
</script>


    <table width="100%" class="table table-bordered">
        <tr>
            <?php
            for($i=0; $i < mysqli_num_rows($results); $i++){
                print("<th class='thhome'><a href='productBekijken.php?id=" . $fullarray[$i]['StockItemID'] . "'><img class='foto' src='images/" . $fullarray[$i]['Photo'] . "' width='100%'><BR>");
                print($fullarray[$i]['StockItemName'] . "</a></th>");
            }
            ?>
        </tr>
        <tr>
            <td colspan="4" style="border: none!important;">
                <a href="browse.php">
                    <div style="text-align: center">
                        <button type="button" class="btn btn-primary">See More Deals</button>
                    </div>
                </a>
            </td>
        </tr>
    </table>

    <table width="100%" class="table table-bordered">
        <tr>
            <?php
            for($i=0; $i < mysqli_num_rows($results); $i++){
                print("<th class='thhome'><a href='productBekijken.php?id=" . $fullArrayLaatstToegevoegd[$i]['StockItemID'] . "'><img class='foto' src='images/" . $fullarray[$i]['Photo'] . "' width='100%'><BR>");
                print($fullArrayLaatstToegevoegd[$i]['StockItemName'] . "</a></th>");
            }
            ?>
        </tr>
        <tr>
            <td colspan="4" style="border: none!important;">
                <a href="browse.php">
                    <div style="text-align: center">
                        <button type="button" class="btn btn-primary">See More New Products</button>
                    </div>
                </a>
            </td>
        </tr>
    </table>
</div>

<?php
include "includes/footer.php";
?>
