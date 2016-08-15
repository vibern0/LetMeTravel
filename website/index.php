<?php require 'classes/station.php'; ?>

<html>
    <head>
        <title>LetMeTravel</title>
        <script>
            function loadDestStations()
            {
                var t = document.getElementById("toStations");
                var f = document.getElementById("fromStation");
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        t.innerHTML = xmlhttp.responseText;
                        document.getElementById("travelPrice").innerHTML = '0€';
                    }
                };
                xmlhttp.open("GET", "scripts/loadDestStations.php?f=" + f.options[f.selectedIndex].value, true);
                xmlhttp.send();
            }
            function getTravelPrice()
            {
                var t = document.getElementById("toStations");
                var f = document.getElementById("fromStation");
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("travelPrice").innerHTML = xmlhttp.responseText + '€';
                    }
                };
                xmlhttp.open("GET", "scripts/getTravelPrice.php?f=" +
                    f.options[f.selectedIndex].value + "&t=" + t.options[t.selectedIndex].value, true);
                xmlhttp.send();
            }
        </script>
    </head>

    <body>
        <?php
            $stations = new Station;
        ?>
        <select id="fromStation" onchange="loadDestStations()">
            <option value="null">Select</option>
            <?php
                $array_stations = $stations->getAllStations();
                echo $stations->getStationsPrintable($array_stations);
            ?>
        </select>
        <select id="toStations" onchange="getTravelPrice()">
            <option value="null">Select</option>
        </select>
        <span id="travelPrice">0€</price>
    </body>
<html>
