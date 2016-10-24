<?php
require '../classes/trajects.php';

$f = $_REQUEST["f"];
$t = $_REQUEST["t"];
$w = $_REQUEST["w"];

$trajects = new Trajects;
$array_out = $trajects->getAvailableTravelTime($f, $t, $w);
echo json_encode($array_out);

?>
