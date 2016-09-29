<?php
require 'db_conn.php';

class Trajects
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
    function getAvailableTrajects($id_station_from, $id_station_to)
    {
        //
    }
}
