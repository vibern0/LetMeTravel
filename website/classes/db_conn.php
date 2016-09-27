<?php
define("TRAJECTS_TABLE", "trajects");
define("STOPS_TABLE", "stops");
define("STATIONS_TABLE", "stations");
define("TRANSPORTS_TABLE", "transports");
define("TICKETS_TABLE", "tickets");

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
        if (!$this->connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD))
        {
            echo 'Error connecting to MySQL database.';
            exit;
        }

        if (!$this->connection->select_db(MYSQL_DATABASE))
        {
            if($this->connection->errno == 1049)
            {
                if(!$this->connection->query('CREATE DATABASE ' . MYSQL_DATABASE))
                {
                    echo 'Error creating MySQL database.';
                    echo $this->connection->errno;
                    exit;
                }
                else
                {
                    if (!$this->connection->select_db(MYSQL_DATABASE))
                    {
                        echo 'Error selecting MySQL database.';
                        echo $this->connection->errno;
                        exit;
                    }
                }
            }
            else
            {
                echo 'Error selecting MySQL database.';
                echo $this->connection->errno;
                exit;
            }
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
        $this->connection->close();
    }
    function getConnection()
    {
        return $this->connection;
    }

    function create_tables()
    {
        //create table if it doesnt exist

        $sql = 'CREATE TABLE IF NOT EXISTS `'.TRAJECTS_TABLE.
            '` ( `id` INT NOT NULL , `id_stop` INT NOT NULL , `order` INT NOT NULL)';
        $this->connection->query($sql);

        $sql = 'CREATE TABLE IF NOT EXISTS `'.STOPS_TABLE.
            '` ( `id` INT NOT NULL AUTO_INCREMENT , `id_station` INT NOT NULL '.
            ', `hour` INT NOT NULL , `minute` INT NOT NULL , PRIMARY KEY (`id`))';
        $this->connection->query($sql);

        $sql = 'CREATE TABLE IF NOT EXISTS `'.STATIONS_TABLE.
            '` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(32) NOT NULL , PRIMARY KEY (`id`))';
        $this->connection->query($sql);

        $sql = 'CREATE TABLE IF NOT EXISTS `' . TRANSPORTS_TABLE .
            '` ( `id` INT NOT NULL AUTO_INCREMENT , `id_traject` INT NOT NULL, ' .
            '`number` INT NOT NULL, `seats` INT NOT NULL, PRIMARY KEY (`id`))`';
        $this->connection->query($sql);

        $sql = 'CREATE TABLE IF NOT EXISTS `' . TICKETS_TABLE .
            '` ( `id` INT NOT NULL AUTO_INCREMENT , `id_transport` INT NOT NULL,'.
            '`id_stop_from` INT NOT NULL, `id_stop_to` INT NOT NULL , `seat` INT NOT NULL, PRIMARY KEY (`id`))`';
        $this->connection->query($sql);
        //
    }
    function destroy_tables()
    {
        //
        $sql = "DROP TABLE old_" . TRAJECTS_TABLE;
        $this->connection->query($sql);

        $sql = "DROP TABLE old_" . STOPS_TABLE;
        $this->connection->query($sql);

        $sql = "DROP TABLE old_" . STATIONS_TABLE;
        $this->connection->query($sql);

        $sql = "DROP TABLE old_" . TRANSPORTS_TABLE;
        $this->connection->query($sql);

        $sql = "DROP TABLE old_" . TICKETS_TABLE;
        $this->connection->query($sql);
    }
    function upgrade_database($new_version)
    {
        $sql = "ALTER TABLE ".TRAJECTS_TABLE." RENAME old_".TRAJECTS_TABLE;
        $this->connection->query($sql);

        $sql = "ALTER TABLE ".STOPS_TABLE." RENAME old_".STOPS_TABLE;
        $this->connection->query($sql);

        $sql = "ALTER TABLE ".STATIONS_TABLE." RENAME old_".STATIONS_TABLE;
        $this->connection->query($sql);

        $sql = "ALTER TABLE ".TRANSPORTS_TABLE." RENAME old_".TRANSPORTS_TABLE;
        $this->connection->query($sql);

        $sql = "ALTER TABLE ".TICKETS_TABLE." RENAME old_".TICKETS_TABLE;
        $this->connection->query($sql);

        //

        $this->create_tables();

        //

        $sql = "INSERT ".TRAJECTS_TABLE." SELECT * FROM old_".TRAJECTS_TABLE;
        $this->connection->query($sql);

        $sql = "INSERT ".STOPS_TABLE." SELECT * FROM old_". STOPS_TABLE;
        $this->connection->query($sql);

        $sql = "INSERT ".STATIONS_TABLE." SELECT * FROM old_".STATIONS_TABLE;
        $this->connection->query($sql);

        $sql = "INSERT ".TRANSPORTS_TABLE." SELECT * FROM old_".TRANSPORTS_TABLE;
        $this->connection->query($sql);

        $sql = "INSERT ".TICKETS_TABLE." SELECT * FROM old_".TICKETS_TABLE;
        $this->connection->query($sql);

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
