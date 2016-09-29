<?php
require 'db_conn.php';

class Ticket
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
    function addTicket($name, $id_transport, $id_stop_from, $id_stop_to, $seat)
    {

    }
    function removeTicket($id_ticket)
    {

    }
};

?>
