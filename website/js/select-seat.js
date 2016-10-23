
function get_station_name_by_id(element, id)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            element.innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "scripts/get-station-name-by-id.php?i=" + id, true);
    xmlhttp.send();
}

function get_available_seats(traject_id, station_from_id, station_to_id, date, time)
{
    var output = array();

    return output;
}
