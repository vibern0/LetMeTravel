<?php
require 'station.php';

define("MYSQL_HOST",        "localhost");
define("MYSQL_DATABASE",    "letmetravel");
define("MYSQL_USER",        "root");
define("MYSQL_PASSWORD",    "root");

class Connection
{
    var $connection;

    function connect()
    {
        if (!$this->connection = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD))
        {
            echo 'Error connecting to MySQL database.';
            exit;
        }

        if (!mysql_select_db(MYSQL_DATABASE, $this->connection))
        {
            echo 'Error selecting MySQL database.';
            exit;
        }

        //create table if it doesnt exist

        $sql = 'CREATE TABLE `'.STATIONS_TABLE.
            '` (`id` int(11) NOT NULL, `name` varchar(32) NOT NULL, PRIMARY KEY (`id`))';
        mysql_query($sql, $this->connection);
    }
    function getConnection()
    {
        return $this->connection;
    }
    function disconnect()
    {
        mysql_close($this->connection);
    }
};

?>
