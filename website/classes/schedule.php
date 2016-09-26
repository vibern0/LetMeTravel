<?php
require 'db_conn.php';

class Schedule
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
    function getSchedule($from, $to, $week_day)
    {
        $sql        = 'SELECT id, leave_time, travel_time FROM ' . SCHEDULE_TABLE .
                    ' WHERE id_from=' . $from . ' AND id_to=' . $to . ' AND week_day=' . $week_day;
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
            array_push($output, array($row['id'], $row['leave_time'], $row['travel_time']));
        }

        mysql_free_result($result);

        return $output;
    }
    function getFreeSeats($schedule_code, $id_from, $id_to)
    {
        //
    }
    function getLeaveTime($schedule_code)
    {
        $sql        = 'SELECT leave_time FROM ' . SCHEDULE_TABLE . ' WHERE id=' . $schedule_code;
        $result     = mysql_query($sql, $this->db_conn->getConnection());

        if (!$result)
        {
            echo "Database error during query!\n";
            echo 'MySQL error: ' . mysql_error();
            exit;
        }

        $row = mysql_fetch_assoc($result);
        mysql_free_result($result);

        return strtotime($row['leave_time']);
    }
    function getArriveTime($schedule_code)
    {
        //
        $leave_time = $this->getLeaveTime($schedule_code);
        $travel_time = $this->getTravelTime($schedule_code);
        //
        $arrive_time = $leave_time + $travel_time - strtotime(date("Ymd"));;
        //
        return $arrive_time;
    }
    function getTravelTime($schedule_code)
    {
        $sql        = 'SELECT travel_time FROM ' . SCHEDULE_TABLE . ' WHERE id=' . $schedule_code;
        $result     = mysql_query($sql, $this->db_conn->getConnection());

        if (!$result)
        {
            echo "Database error during query!\n";
            echo 'MySQL error: ' . mysql_error();
            exit;
        }

        $row = mysql_fetch_assoc($result);
        mysql_free_result($result);

        return strtotime($row['travel_time']);
    }
    function getTravelStops($schedule_code)
    {
        //
    }

    //

    function getPritableInTable($array_schedule)
    {
        //
        $output = '';
        foreach ($array_schedule as $schedule)
        {
            $output .=
            '<tr>'.
                '<td>'.date("H:i", strtotime($schedule[1])).'</td>'.
                '<td>'.date("H:i", strtotime($schedule[2])).'</td>'.
                '<td>'.date("H:i", $this->getArriveTime($schedule[0])).'</td>'.
                '<td><input type="radio" name="travel_id" value="'.$schedule[0].'"></td>'.
            '</tr>';
        }

        return $output;
    }
    function getPrintableInList($array_data)
    {
        //
    }
}

?>
