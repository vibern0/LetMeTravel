$(function() { load_all_stations(); });

function add_edit_button(id_btn)
{
    return "<button type=\"button\" class=\"edit-station\" id=\"" + id_btn + "\">Edit</button> ";
}

function load_all_stations()
{
    var f = document.getElementById("table_stations");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            var data = JSON.parse(xmlhttp.responseText);
            for(var d = 0; d < data.length; d++)
            {
                f.innerHTML += "<tr><td>" + data[d].name +
                    "</td><td>" + add_edit_button(data[d].id) + "</td></tr>";
            }
        }
    };
    xmlhttp.open("GET", "../scripts/load-all-stations.php", true);
    xmlhttp.send();
}
