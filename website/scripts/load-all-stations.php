<?php
require '../classes/stations.php';

$stations = new Stations;
$array_stations = $stations->getAllStations();
echo "<option value=\"null\">Select</option>".$stations->getStationsPrintable($array_stations);

?>
