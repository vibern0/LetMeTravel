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
                        document.getElementById("week_day").selectedIndex = 0;
                        //clear schedule table
                        document.getElementById("no_travel_available").style.visibility = "hidden";
                        document.getElementById("schedule_table").innerHTML =
                            "<tr><th>Leave time</th><th>Travel time</th><th>Arrive time</th><th>Select</th></tr>";
                        document.getElementById("bt_buy_ticket").style.visibility = "hidden";
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
                        document.getElementById("week_day").selectedIndex = 0;
                        //clear schedule table
                        document.getElementById("no_travel_available").style.visibility = "hidden";
                        document.getElementById("schedule_table").innerHTML =
                            "<tr><th>Leave time</th><th>Travel time</th><th>Arrive time</th><th>Select</th></tr>";
                        document.getElementById("bt_buy_ticket").style.visibility = "hidden";
                    }
                };
                xmlhttp.open("GET", "scripts/getTravelPrice.php?f=" +
                    f.options[f.selectedIndex].value + "&t=" + t.options[t.selectedIndex].value, true);
                xmlhttp.send();
            }
            function loadTravelSchedule()
            {
                var t = document.getElementById("toStations");
                var f = document.getElementById("fromStation");
                var w = document.getElementById("week_day");
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("schedule_table").innerHTML =
                            "<tr><th>Leave time</th><th>Travel time</th><th>Arrive time</th><th>Select</th></tr>" +
                            xmlhttp.responseText;
                        if(xmlhttp.responseText.length > 0)
                        {
                            document.getElementById("no_travel_available").style.visibility = "hidden";
                            document.getElementById("bt_buy_ticket").style.visibility = "visible";
                        }
                        else
                        {
                            document.getElementById("no_travel_available").style.visibility = "visible";
                            document.getElementById("bt_buy_ticket").style.visibility = "hidden";
                        }
                    }
                };
                xmlhttp.open("GET", "scripts/getTravelScheduleInfo.php?f=" +
                    f.options[f.selectedIndex].value + "&t=" + t.options[t.selectedIndex].value +
                    "&w=" + w.options[w.selectedIndex].value, true);
                xmlhttp.send();
            }
            function buyTicket()
            {
                var select_travel_time = document.forms[0];
                var i;
                var checked = false;
                for (i = 0; i < select_travel_time.length; i++)
                {
                    if (select_travel_time[i].checked)
                    {
                        checked = true;
                        break;
                    }
                }

                if(checked)
                    alert("Travel ID " + select_travel_time[i].value);
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
        <span id="travelPrice">0€</span>
        Week day
        <select id="week_day" onchange="loadTravelSchedule()">
            <option value="null">Select</option>
            <option value="1">Monday</option>
            <option value="2">Tuesday</option>
            <option value="3">Wednesday</option>
            <option value="4">Thursday</option>
            <option value="5">Friday</option>
            <option value="6">Saturday</option>
            <option value="7">Sunday</option>
        </select>
        Schedule
        <form action="">
            <table id="schedule_table">
                <tr>
                    <th>Leave time</th>
                    <th>Travel time</th>
                    <th>Arrive time</th>
                    <th>Select<!-- <input type="radio" name="name" value="value">Value<br> --></th>
                </tr>
            </table>
        </form>
        <button id="bt_buy_ticket" style="visibility:hidden" type="button" onclick="buyTicket()">Buy ticket</button>
        <p id="no_travel_available"  style="visibility:hidden">No Travel Available!</p>
        <!-- select seat -->
        <!-- payment method -->
        <!-- pay -->
        <!-- confirm and recieve ticket -->
    </body>
<html>
