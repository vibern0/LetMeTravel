<?php
require '../classes/station.php';

$f = $_REQUEST["f"];

$stations = new Station;
$array_stations = $stations->getAvailableDestination($f);
echo "<option value=\"null\">Select</option>".$stations->getStationsPrintable($array_stations);

?>
