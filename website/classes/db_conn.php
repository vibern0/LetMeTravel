<?php
define("STATIONS_TABLE",    "stations");
define("CONNECTIONS_TABLE", "connections");

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

        $sql = 'CREATE TABLE IF NOT EXISTS `'.STATIONS_TABLE.
            '` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(32) NOT NULL , PRIMARY KEY (`id`))';
        mysql_query($sql, $this->connection);

        $sql = 'CREATE TABLE IF NOT EXISTS`'.CONNECTIONS_TABLE.
            '` ( `id` INT NOT  NULL AUTO_INCREMENT , `id_from` INT NOT NULL , `id_to` INT NOT NULL , PRIMARY KEY (`id`))';
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
