<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/select-seat.css">
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/select-seat.js"></script>
    </head>

    <body>
        <div>
            <span>
                From : <span id="from_station"></span>
                <script>get_station_name_by_id(document.getElementById("from_station"), <?php echo $_POST['from_station']; ?>)</script>
                | To : <span id="to_station"></span>
                <script>get_station_name_by_id(document.getElementById("to_station"), <?php echo $_POST['to_stations']; ?>)</script>
            </span>
            Seat : <select>
                <option value="null">Select</select>
            </select>

            <form method="post" action="select-seat.html">
                <input type="button" value="Continue">
            </form>
        </div>
    </body>
</html>
