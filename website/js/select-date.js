$(function() { load_all_stations(); });

function load_all_stations()
{
    var f = document.getElementsByName("from_station")[0];
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            f.innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "scripts/load-all-stations.php", true);
    xmlhttp.send();
}

function load_dest_stations()
{
    var t = document.getElementsByName("to_stations")[0];
    var f = document.getElementsByName("from_station")[0];
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            t.innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "scripts/load-dest-stations.php?f=" + f.options[f.selectedIndex].value, true);
    xmlhttp.send();
}
function get_available_travel_week_days()
{
    var t = document.getElementsByName("to_stations")[0];
    var f = document.getElementsByName("from_station")[0];
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementsByName("week_days")[0].innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "scripts/get-available-travel-week-days.php?f=" +
        f.options[f.selectedIndex].value + "&t=" + t.options[t.selectedIndex].value, true);
    xmlhttp.send();
}
function check_info()
{
    document.getElementById("submit_button").disabled = false;
}
