<?php
require '../classes/trajects.php';

$f = $_REQUEST["f"];
$t = $_REQUEST["t"];

$trajects = new Trajects;
$array_out = $trajects->getAvailableTravelWeekDays($f, $t);
echo "<option value=\"null\">Select</option>".$trajects->getPrintable($array_out);

?>
