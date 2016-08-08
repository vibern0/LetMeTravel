<?php require 'station.php'; ?>

<html>
    <head>
        <title>LetMeTravel</title>
    </head>

    <body>
        <?php
            $stations = new Station;
        ?>
        <select>
            <option value="null">Select</option>
            <?php
                $array_stations = $stations->getAllStations();
                echo $stations->getStationsPrintable($array_stations);
            ?>
        </select>
    </body>
<html>
