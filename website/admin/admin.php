<?php
require '../classes/db_conn.php';

class Admin
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
    function registerNewStation($name)
    {
        return 0;
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
