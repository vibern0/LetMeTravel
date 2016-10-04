<?php
require '../prices.php';

$f = $_REQUEST["f"];
$t = $_REQUEST["t"];

$prices = new Prices;
echo $prices->getTravelPrice($f, $t);

?>
