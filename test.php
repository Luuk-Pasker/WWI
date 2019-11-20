<?php
$active = "home";
include "includes/header.php";

print("<link rel=\"stylesheet\" type=\"text/css\" href = \"css/home.css\">");

/* sql query voor alle categorien*/
$sql = "SELECT * FROM stockgroups ORDER BY StockGroupName";
$result = mysqli_query($connection, $sql);
/* sql query voor alle categorien   */


/*alle producten weergeven KNOP*/
//print("<div class='everything'>");
//print("<div class='div'><form method=\"post\" action=\"/WWI/browse.php\"><button class='button' type=\"submit\">Everything</button></form>");
//print("</div>");
/*alle producten weergeven KNOP*/


/*print alle namen op de knoppen*/
print("<form method='get' action=\"/WWI/browse.php\">");

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    /*navigationbar*/
    print("<button class='button' name='id' value='" . $row['StockGroupID'] . "'>" . $row['StockGroupName'] . "</button>");
}
/*navigationbar*/

print("</form></div>");



include "includes/footer.php";
?>