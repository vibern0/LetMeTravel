<?php
require '../classes/station.php';

$f = $_REQUEST["f"];
$t = $_REQUEST["t"];

$stations = new Station;
echo $stations->getTravelPrice($f, $t);

?>
