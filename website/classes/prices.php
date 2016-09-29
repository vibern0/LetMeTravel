<?php
require 'db_conn.php';

class Prices
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
    function getTravelPrice($id_station_from, $id_station_to)
    {
        //get leave time and arrive time
        //calculate the diference
        //multiply by 2.3

        $sql = "SELECT s1.h, s1.m, s2.h, s2.m FROM "
            ."(SELECT s.hour AS h, s.minute AS m, t.id AS t "
            ."FROM stops s, trajects t, stations st WHERE s.id_station = ".$id_station_from
            ." AND t.id_stop = s.id) s1,"
            ."(SELECT s.hour AS h, s.minute AS m, t.id AS t "
            ."FROM stops s, trajects t, stations st WHERE s.id_station = ".$id_station_to
            ." AND t.id_stop = s.id) s2 "
            ."WHERE s1.t = s2.t LIMIT 1";

        $result = $this->db_conn->query($sql);
        if (!$result)
        {
            echo "Database error during query!\n";
            echo 'MySQL error: ' . mysql_error();
            exit;
        }

        $row = $result->fetch_row();

        $difference = intval($row[2]) - intval($row[0]);

        $result->free();
        return 8.0 + $difference * 2.3;
    }
}
