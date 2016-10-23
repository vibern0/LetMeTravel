<?php
require '../classes/trajects.php';

$f = $_REQUEST["f"];
$t = $_REQUEST["t"];
$w = $_REQUEST["w"];
$ti = $_REQUEST["ti"];

$trajects = new Trajects;
$array_out = $trajects->getAvailableTrajects($f, $t, $w, $ti);
echo json_encode($array_out);

?>
