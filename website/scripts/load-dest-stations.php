<?php
require '../classes/stations.php';

$f = $_REQUEST["f"];

$stations = new Stations;
$array_stations = $stations->getAvailableDestination($f);
echo "<option value=\"null\">Select</option>".$stations->getStationsPrintable($array_stations);

?>
