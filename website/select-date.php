<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/select-date.css">
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/select-date.js"></script>
    </head>

    <body>
        <div>
            <form method="POST" action="select-seat.php">

                From : <select name="from_station" onchange="load_dest_stations()">
                    <option value="null">Select</option>
                </select>
                To : <select name="to_stations" onchange="get_available_travel_week_days()">
                    <option value="null">Select</option>
                </select>
                Week Day : <select name="week_days" onchange="get_available_leave_time()">
                    <option value="null">Select</option>
                </select>
                Time : <select name="leave_time" onchange="check_info()">
                    <option value="null">Select</option>
                </select>

                <input type="submit" id="submit_button" disabled="true" value="Continue">
            </form>
        </div>
    </body>
</html>
