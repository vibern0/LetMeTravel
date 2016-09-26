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

define("FILE_VERSION_URL",  ".cache/version");
define("FOLDER_VERSION_URL",".cache");

class Connection
{
    var $connection;
    var $version;

    function __construct()
    {
        $this->version = 1;
        if(!is_dir(FOLDER_VERSION_URL))
        {
            mkdir(FOLDER_VERSION_URL);
        }
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

        $version_in_file = 0;
        //check version
        if(file_exists(FILE_VERSION_URL))
        {
            $handle = fopen(FILE_VERSION_URL, "r");
            $version_in_file = intval(fread($handle, filesize(FILE_VERSION_URL)));
            fclose($handle);
        }

        //update if necessary!
        if($this->version > $version_in_file)
        {
            $this->upgrade_database($this->version);
        }
    }
    function disconnect()
    {
        mysql_close($this->connection);
    }
    function getConnection()
    {
        return $this->connection;
    }

    function create_tables()
    {
        //create table if it doesnt exist

        $sql = 'CREATE TABLE IF NOT EXISTS `'.STATIONS_TABLE.
            '` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(32) NOT NULL , PRIMARY KEY (`id`))';
        mysql_query($sql, $this->connection);

        $sql = 'CREATE TABLE IF NOT EXISTS `'.CONNECTIONS_TABLE.
            '` ( `id` INT NOT NULL AUTO_INCREMENT , `id_from` INT NOT NULL '.
            ', `id_to` INT NOT NULL , `price` FLOAT NOT NULL , PRIMARY KEY (`id`))';
        mysql_query($sql, $this->connection);

        $sql = 'CREATE TABLE IF NOT EXISTS `'.SCHEDULE_TABLE.
            '` ( `id` INT NOT NULL AUTO_INCREMENT , `id_from` INT NOT NULL '.
            ', `id_to` INT NOT NULL , `week_day` INT NOT NULL , `leave_time` TIME NOT NULL '.
            ', `travel_time` TIME NOT NULL, `total_seats` INT NOT NULL , PRIMARY KEY (`id`))';
        mysql_query($sql, $this->connection);

        $sql = 'CREATE TABLE IF NOT EXISTS `' . STOPS_TABLE .
            '` ( `id_connection` INT NOT NULL , `id_station` INT NOT NULL)`';
        mysql_query($sql, $this->connection);

        $sql = 'CREATE TABLE IF NOT EXISTS `' . SEATS_TABLE .
            '` ( `id_schedule` INT NOT NULL , `id_from` INT NOT NULL, `id_to` INT NOT NULL, `seat` INT NOT NULL)`';
        mysql_query($sql, $this->connection);
        //
    }
    function destroy_tables()
    {
        //
        $sql = "DROP TABLE old_" . STATIONS_TABLE;
        mysql_query($sql, $this->connection);

        $sql = "DROP TABLE old_" . CONNECTIONS_TABLE;
        mysql_query($sql, $this->connection);

        $sql = "DROP TABLE old_" . SCHEDULE_TABLE;
        mysql_query($sql, $this->connection);

        $sql = "DROP TABLE old_" . STOPS_TABLE;
        mysql_query($sql, $this->connection);

        $sql = "DROP TABLE old_" . SEATS_TABLE;
        mysql_query($sql, $this->connection);
    }
    function upgrade_database($new_version)
    {
        $sql = "ALTER TABLE ".STATIONS_TABLE." RENAME old_".STATIONS_TABLE;
        mysql_query($sql, $this->connection);

        $sql = "ALTER TABLE ".CONNECTIONS_TABLE." RENAME old_".CONNECTIONS_TABLE;
        mysql_query($sql, $this->connection);

        $sql = "ALTER TABLE ".SCHEDULE_TABLE." RENAME old_".SCHEDULE_TABLE;
        mysql_query($sql, $this->connection);

        $sql = "ALTER TABLE ".STOPS_TABLE." RENAME old_".STOPS_TABLE;
        mysql_query($sql, $this->connection);

        $sql = "ALTER TABLE ".SEATS_TABLE." RENAME old_".SEATS_TABLE;
        mysql_query($sql, $this->connection);

        //

        $this->create_tables();

        //

        $sql = "INSERT ".STATIONS_TABLE." SELECT * FROM old_".STATIONS_TABLE;
        mysql_query($sql, $this->connection);

        $sql = "INSERT ".CONNECTIONS_TABLE." SELECT * FROM old_".CONNECTIONS_TABLE;
        mysql_query($sql, $this->connection);

        $sql = "INSERT ".SCHEDULE_TABLE." SELECT * FROM old_".SCHEDULE_TABLE;
        mysql_query($sql, $this->connection);

        $sql = "INSERT ".STOPS_TABLE." SELECT * FROM old_".STOPS_TABLE;
        mysql_query($sql, $this->connection);

        $sql = "INSERT ".SEATS_TABLE." SELECT * FROM old_".SEATS_TABLE;
        mysql_query($sql, $this->connection);

        //

        $this->destroy_tables();

        //

        $handle = fopen(FILE_VERSION_URL, 'w+');
        ftruncate($handle, 0);
        rewind($handle);
        fwrite($handle, $new_version);
        fclose($handle);
    }
};

?>
