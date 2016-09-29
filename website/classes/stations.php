<?php
require 'db_conn.php';

class Stations
{
    var $db_conn;
    var $connection;

    function __construct()
    {
        $this->connection = new Connection;
        $this->db_conn = $this->connection->connect();
    }
    function __destruct()
    {
        $this->connection->disconnect();
    }
    function getAllStations()
    {
        $output = array();
        $sql = "SELECT * FROM " . STATIONS_TABLE;

        $result = $this->db_conn->query($sql);
        if (!$result)
        {
            echo "Database error during query!\n";
            echo 'MySQL error: ' . mysql_error();
            exit;
        }

        while ($row = $result->fetch_assoc())
        {
            $output[$row['id']] = $row['name'];
        }

        $result->free();
        return $output;
    }
    function getAvailableDestination($id_from_station)
    {
		//
    }
    function getStationsPrintable($array_stations)
    {
        $output = '';
        foreach ($array_stations as $key=>$value)
        {
            $output .= '<option value="'.$key.'">'.$value.'</option>';
        }

        return $output;
    }
};

?>
