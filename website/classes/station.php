<?php
require 'db_conn.php';

class Station
{
    public $db_conn;

    public function Station()
    {
        $this->db_conn = new Connection;
        $this->db_conn->connect();
    }
    public function getAllStations()
    {
        $sql        = 'SELECT * FROM '.STATIONS_TABLE;
        $result     = mysql_query($sql, $this->db_conn->getConnection());
        $output     = array();

        if (!$result)
        {
            echo "Database error during query!\n";
            echo 'MySQL error: ' . mysql_error();
            exit;
        }

        while ($row = mysql_fetch_assoc($result))
        {
            $output[$row['id']] = $row['name'];
        }

        mysql_free_result($result);

        return $output;
    }
    public function getAvailableDestination($from)
    {
        $sql        = 'SELECT s.`id`, `name` FROM `'.STATIONS_TABLE.'` s, `'.CONNECTIONS_TABLE.
                        '` WHERE s.`id`=`id_to` AND `id_from`='.$from;
        //SELECT `name` FROM `stations` s, `connections` WHERE s.`id`=`id_to` AND `id_from`=1

        $result     = mysql_query($sql, $this->db_conn->getConnection());
        $output     = array();

        if (!$result)
        {
            echo "Database error during query!\n";
            echo 'MySQL error: ' . mysql_error();
            exit;
        }

        while ($row = mysql_fetch_assoc($result))
        {
            $output[$row['id']] = $row['name'];
        }

        mysql_free_result($result);

        return $output;
    }
    public function getTravelPrice($from, $to)
    {
        $sql        = 'SELECT `price` FROM `'.CONNECTIONS_TABLE.
                        '` WHERE `id_from`='.$from.' AND `id_to`='.$to;
        $result     = mysql_query($sql, $this->db_conn->getConnection());
        $output     = array();

        if (!$result)
        {
            echo "Database error during query!\n";
            echo 'MySQL error: ' . mysql_error();
            exit;
        }

        $row = mysql_fetch_assoc($result);
        mysql_free_result($result);

        return $row['price'];
    }
    public function getStationsPrintable($array_stations)
    {
        $output = '';
        foreach ($array_stations as $key=>$value)
        {
            $output .= '<option value="'.$key.'">'.$value.'</option>';
        }

        return $output;
    }
};

?>
