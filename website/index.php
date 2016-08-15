<?php require 'classes/station.php'; ?>

<html>
    <head>
        <title>LetMeTravel</title>
        <script>
            function loadDestStations()
            {
                if (document.getElementById("toStations").value.localeCompare("null"))
                {
                    document.getElementById("toStations").innerHTML = "<option value=\"null\">Select</option>";
                }
                else
                {
                    var xmlhttp = new XMLHttpRequest();
                    var e = document.getElementById("fromStation");
                    xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            document.getElementById("toStations").innerHTML = xmlhttp.responseText;
                        }
                    };
                    xmlhttp.open("GET", "scripts/loadDestStations.php?f=" + e.options[e.selectedIndex].value, true);
                    xmlhttp.send();
                }
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
        <select id="toStations">
            <option value="null">Select</option>
        </select>
    </body>
<html>
