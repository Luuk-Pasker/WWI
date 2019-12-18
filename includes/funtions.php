<?php

/*zoek alle huidige producten met korting op*/
function GetDeals($connection)
{
    $sql = "SELECT * FROM stockitems sitem JOIN stockitemstockgroups sitemsgroup ON sitem.StockItemID = sitemsgroup.StockItemID WHERE sitemsgroup.StockGroupID IN (SELECT StockGroupID FROM specialdeals) limit 4";
    $results = mysqli_query($connection, $sql);
    return $results;
}

/*zoek alle huidige producten met korting op*/

/*zoek alle huidige producten met korting op voor browse pagina*/
function GetDealsBrowse($connection)
{
    /*SELECT * FROM stockitems sitem JOIN stockitemstockgroups sitemsgroup ON sitem.StockItemID = sitemsgroup.StockItemID WHERE sitemsgroup.StockGroupID IN (SELECT StockGroupID FROM specialdeals)";
    */
    $sql = "SELECT *, QuantityOnHand FROM stockitems sitem JOIN stockitemstockgroups sitemsgroup ON sitem.StockItemID = sitemsgroup.StockItemID join stockitemholdings sih on sitem.StockItemID = sih.StockItemID WHERE sitemsgroup.StockGroupID IN (SELECT StockGroupID FROM specialdeals)";
    $results = mysqli_query($connection, $sql);
    return $results;
}

/*zoek alle huidige producten met korting op voor browse pagina*/

/*zoek alle huidige producten die nieuw zijn voor op browse pagina*/
function GetLaatstToegevoegdBrowse($connection)
{
    $sql = "select * from stockitems order by StockItemID desc";
    $GetLatstToegevoed = mysqli_query($connection, $sql);
    return $GetLatstToegevoed;
}

/*zoek alle huidige producten die nieuw zijn voor op browse pagina*/

/*zoek de meest recent toegevoegde producten*/
function GetLaatstToegevoegd($connection)
{
    $sql = "select * from stockitems order by StockItemID desc limit 4";
    $GetLatstToegevoed = mysqli_query($connection, $sql);
    return $GetLatstToegevoed;
}

/*zoek de meest recent toegevoegde producten*/

function getName($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}