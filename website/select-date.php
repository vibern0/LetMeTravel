<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/select-date.css">
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/select-date.js"></script>
    </head>

    <body>
        <div>
            From : <select id="from_station" onchange="load_dest_stations()">
                <option value="null">Select</select>
            </select>
            To : <select id="to_stations" onchange="get_available_travel_week_days()">
                <option value="null">Select</select>
            </select>
            Week Day : <select id="week_days" onchange="check_info()">
                <option value="null">Select</select>
            </select>
            <form method="post" action="select-seat.php">
                <input type="submit" id="submit_button" disabled="true" value="Continue">
            </form>
        </div>
    </body>
</html>
