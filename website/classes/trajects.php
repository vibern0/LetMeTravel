<?php
require 'db_conn.php';

class Trajects
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
    function getAvailableTravelTime($id_station_from, $id_station_to, $week_day)
    {
        /*
        SELECT s.hour, s.minute FROM stops s, stations st, trajects t, weekday w,
        (SELECT t.order AS o, t.id AS t_id FROM stops s, trajects t, stations st WHERE s.id_station = 2 AND s.id_station = st.id AND t.id_stop = s.id) s1,
        (SELECT t.order AS o, t.id AS t_id FROM stops s, trajects t, stations st WHERE s.id_station = 3 AND s.id_station = st.id AND t.id_stop = s.id) s2
        WHERE s1.t_id = s2.t_id AND t.id = s1.t_id AND s.id_station = 2 AND s.id_station = st.id AND s.id = t.id_stop AND w.week_day = 4 AND w.id_traject = s1.t_id
        */

        $output = array();
        $sql = "SELECT DISTINCT s.time FROM stops s, stations st, trajects t, weekday w,".
            "(SELECT t.order AS o, t.id AS t_id FROM stops s, trajects t, stations st ".
                "WHERE s.id_station = ".$id_station_from." AND s.id_station = st.id AND t.id_stop = s.id) s1,".
            "(SELECT t.order AS o, t.id AS t_id FROM stops s, trajects t, stations st ".
                "WHERE s.id_station = ".$id_station_to." AND s.id_station = st.id AND t.id_stop = s.id) s2".
            " WHERE s1.t_id = s2.t_id AND t.id = s1.t_id AND s.id_station = ".$id_station_from.
            " AND s.id_station = st.id AND s.id = t.id_stop AND w.week_day = ".$week_day.
            " AND w.id_traject = s1.t_id";

        $result = $this->db_conn->query($sql);
        if (!$result)
        {
            echo "Database error during query!\n";
            echo 'MySQL error: ' . mysql_error();
            exit;
        }

        while ($row = $result->fetch_row())
        {
            array_push($output, array("time" => $row[0]));
        }

        $result->free();
        return $output;

    }
    function getAvailableTravelWeekDays($id_station_from, $id_station_to)
    {
        $output = array();
        $week_day_name = array(1 => "Sunday", 2 => "Monday", 3 =>"Tuesday", 4 =>"Wednesday", 5 =>"Thursday",6 =>"Friday", 7 =>"Saturday");
        $sql = "SELECT w.week_day FROM stops s, stations st, trajects t, weekday w,"
            ."(SELECT t.order AS o, t.id AS t_id FROM stops s, trajects t, stations st "
            ."WHERE s.id_station = 2 AND s.id_station = st.id AND t.id_stop = s.id) s1,"
            ."(SELECT t.order AS o, t.id AS t_id FROM stops s, trajects t, stations st "
            ."WHERE s.id_station = 3 AND s.id_station = st.id AND t.id_stop = s.id) s2 "
        ."WHERE s1.t_id = s2.t_id AND t.id = s1.t_id AND s.id_station = 2 AND s.id_station = st.id AND s.id = t.id_stop AND w.id_traject = s1.t_id";

        $result = $this->db_conn->query($sql);
        if (!$result)
        {
            echo "Database error during query!\n";
            echo 'MySQL error: ' . mysql_error();
            exit;
        }

        while ($row = $result->fetch_row())
        {
            $output[$row[0]] = $week_day_name[$row[0]];
        }

        $result->free();
        return $output;
    }
    function getAvailableTrajects($id_station_from, $id_station_to, $week_day, $time)
    {

    }
    function getPrintable($array_stations)
    {
        $output = '';
        foreach ($array_stations as $key=>$value)
        {
            $output .= '<option value="'.$key.'">'.$value.'</option>';
        }

        return $output;
    }
}
