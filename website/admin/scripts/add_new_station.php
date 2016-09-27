<?php
require '../classes/station.php';

$name = $_REQUEST["name"];

$admin = new Admin;
echo $admin->registerNewStation($name);

?>
