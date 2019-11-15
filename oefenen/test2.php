<?php
$mysqli = new mysqli('localhost', 'root', '', 'wideworldimporters') or die($mysqli->connect_error);
$table = 'stockitems';

$result = $mysqli->query("SELECT Photo FROM $table") or die($mysqli->error);

while ($data = $result->fetch_assoc()){
    print  "<h2>{$data['name']}</h2>";
    print "<img src='{$data['img_dir']}' width='40%'>";
}
