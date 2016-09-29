<?php
require 'db_conn.php';

class Transport
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
    function getNumberOfSeats($id_transport)
    {
        //
    }
    function getNumberOfFreeSeats($id_transport, $id_station_from, $id_station_to)
    {
        //
    }
}

?>
