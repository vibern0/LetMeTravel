<?php
require 'db_conn.php';

class Stops
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
}

?>
