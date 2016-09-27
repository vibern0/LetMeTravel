<?php
require '../classes/db_conn.php';

class Prices
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
    function registerNewStation()
    {
        //
    }
    function registerNewPrice()
    {
        //
    }
    function registerNewTraject()
    {
        //
    }
    function registerNewStop()
    {
        //
    }
    function registerNewTransport()
    {
        //
    }
}
