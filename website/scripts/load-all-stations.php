<?php
require '../classes/stations.php';

$stations = new Stations;
$array_stations = $stations->getAllStations();
echo json_encode($array_stations);

?>
