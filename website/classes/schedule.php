<?php

class Schedule
{
    var $db_conn;

    function __construct()
    {
        $this->db_conn = new Connection;
        $this->db_conn->connect();
    }
    function getSchedule($from, $to)
    {
        //
    }
    function getFreeSeats($schedule_code)
    {
        //
    }
    function getLeaveTime($schedule_code)
    {
        //
    }
    function getArriveTime($schedule_code)
    {
        //
    }
    function getTravelTime($schedule_code)
    {
        //
    }
    function getTravelStops($schedule_code)
    {
        //
    }

    //

    function getPritableInTable($array_schedule)
    {
        //
    }
    function getPrintableInList($array_data)
    {
        //
    }
}

?>
