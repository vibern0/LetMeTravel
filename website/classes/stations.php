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

        while ($row = $result->fetch_row())
        {
            $output[$row[0]] = $row[1];
        }

        $result->free();
        return $output;
    }
    function getAvailableDestination($id_from_station)
    {
        $output = array();
        $sql = "SELECT DISTINCT st.id, st.name FROM stops s, stations st, trajects t,"
            ."(SELECT t.order AS o, t.id AS t_id FROM stops s, trajects t, stations st "
                ."WHERE s.id_station = " . $id_from_station . " AND t.id_stop = s.id) o "
            ."WHERE t.order > o.o AND st.id = s.id_station AND s.id = t.id_stop AND t.id = o.t_id";

        $result = $this->db_conn->query($sql);
        if (!$result)
        {
            echo "Database error during query!\n";
            echo 'MySQL error: ' . mysql_error();
            exit;
        }

        while ($row = $result->fetch_row())
        {
            //$output[$row[0]] = $row[1];
            array_push($output, array("id" => $row[0], "name" => $row[1]));
        }

        $result->free();
        return $output;
    }
    function getStationNameById($station_id)
    {
        $sql = "SELECT * FROM " . STATIONS_TABLE . " WHERE id=" . $station_id;

        $result = $this->db_conn->query($sql);
        if (!$result)
        {
            echo "Database error during query!\n";
            echo 'MySQL error: ' . mysql_error();
            exit;
        }

        $row = $result->fetch_row();
        $result->free();

        return $row[1];
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
