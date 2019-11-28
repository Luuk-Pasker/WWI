UPDATE stockitems SET Photo = "clothing.jpg" WHERE StockItemID IN (SELECT StockItemID FROM stockitemstockgroups WHERE StockGroupID = 2);
UPDATE stockitems SET Photo = "mug.jpg" WHERE StockItemID IN (SELECT StockItemID FROM stockitemstockgroups WHERE StockGroupID = 3);
UPDATE stockitems SET Photo = "t-shirts.jpg" WHERE StockItemID IN (SELECT StockItemID FROM stockitemstockgroups WHERE StockGroupID = 4);
UPDATE stockitems SET Photo = "usb.jpg" WHERE StockItemID IN (SELECT StockItemID FROM stockitemstockgroups WHERE StockGroupID = 7);
UPDATE stockitems SET Photo = "slippers.jpg" WHERE StockItemID IN (SELECT StockItemID FROM stockitemstockgroups WHERE StockGroupID = 8);
UPDATE stockitems SET Photo = "toys.jpg" WHERE StockItemID IN (SELECT StockItemID FROM stockitemstockgroups WHERE StockGroupID = 9);
UPDATE stockitems SET Photo = "packaging.jpg" WHERE StockItemID IN (SELECT StockItemID FROM stockitemstockgroups WHERE StockGroupID = 10);