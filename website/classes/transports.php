<?php
require 'db_conn.php';

class Transport
{
    var $db_conn;

    function __construct()
    {
        $this->db_conn = new Connection;
        $this->db_conn->connect();
    }
    function __destruct()
    {
        $this->db_conn->disconnect();
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
