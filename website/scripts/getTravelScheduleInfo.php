<?php
require '../classes/schedule.php';

$f = $_REQUEST["f"];
$t = $_REQUEST["t"];
$w = $_REQUEST["w"];

$schedule = new Schedule;
$array = $schedule->getSchedule($f, $t, $w);
echo $schedule->getPritableInTable($array);

?>
