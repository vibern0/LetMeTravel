$(function() { load_all_stations(); });

function load_all_stations()
{
    var f = document.getElementsByName("table_stations")[0];
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            //f.innerHTML = xmlhttp.responseText;
            var data = JSON.parse(xmlhttp.responseText);
        }
    };
    xmlhttp.open("GET", "scripts/load-all-stations.php", true);
    xmlhttp.send();
}
