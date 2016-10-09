<?php
require '../classes/stations.php';

$i = $_REQUEST["i"];

$stations = new Stations;
echo $stations->getStationNameById($i);

?>
