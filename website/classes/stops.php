<?php
require 'db_conn.php';

class Stops
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
    function getHour($stop_id)
    {
        //
    }
    function getMinute($stop_id)
    {
        //
    }
}

?>
