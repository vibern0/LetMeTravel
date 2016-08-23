<?php
define("STATIONS_TABLE",    "stations");
define("CONNECTIONS_TABLE", "connections");
define("SCHEDULE_TABLE",    "schedule");
define("STOPS_TABLE",       "stops");
define("SEATS_TABLE",       "seats");

define("MYSQL_HOST",        "localhost");
define("MYSQL_DATABASE",    "letmetravel");
define("MYSQL_USER",        "root");
define("MYSQL_PASSWORD",    "root");

class Connection
{
    var $connection;
    var $version;

    function __construct()
    {
        $version = 1;
        //
        //check version
        //update if necessary!
    }
    function __destruct()
    {
        mysql_close($this->connection);
    }
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

        $sql = 'CREATE TABLE IF NOT EXISTS `'.CONNECTIONS_TABLE.
            '` ( `id` INT NOT  NULL AUTO_INCREMENT , `id_from` INT NOT NULL '.
            ', `id_to` INT NOT NULL , `price` FLOAT NOT NULL , PRIMARY KEY (`id`))';
        mysql_query($sql, $this->connection);

        $sql = 'CREATE TABLE IF NOT EXISTS `'.SCHEDULE_TABLE.
            '` ( `id` INT NOT  NULL AUTO_INCREMENT , `id_from` INT NOT NULL '.
            ', `id_to` INT NOT NULL , `week_day` INT NOT NULL , `leave_time` TIME NOT NULL '.
            ', `travel_time` TIME NOT NULL , PRIMARY KEY (`id`))';
        mysql_query($sql, $this->connection);

        $sql = 'CREATE TABLE IF NOT EXISTS `' . STOPS_TABLE .
            '` ( `id_connection` INT NOT  NULL , `id_station` INT NOT  NULL)`';
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
