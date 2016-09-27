<?php
require 'db_conn.php';

class Ticket
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
    function addTicket($name, $id_transport, $id_stop_from, $id_stop_to, $seat)
    {

    }
    function removeTicket($id_ticket)
    {

    }
};

?>
