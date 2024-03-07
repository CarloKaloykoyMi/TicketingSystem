<?php
session_start();
include('mysql_connect.php');

function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($con, $query);
}

function getTicket($table, $user_id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE `user_id` = $user_id ORDER BY `ticket_id` DESC, `date_created` ASC";

    return $query_run = mysqli_query($con, $query);
}


function getPendingStatus($user_id)
{
    global $con;
    $query = "SELECT * FROM `ticket` WHERE `user_id` = $user_id AND `status` = 'Pending' ORDER BY `ticket_id` DESC, `date_created` ASC";

    return $query_run = mysqli_query($con, $query);
}

function getResolvedStatus($user_id)
{
    global $con;
    $query = "SELECT * FROM `ticket` WHERE `user_id` = $user_id AND `status` = 'Resolved' ORDER BY `ticket_id` DESC, `date_created` ASC";

    return $query_run = mysqli_query($con, $query);
}

function getUnresolvedStatus($user_id)
{
    global $con;
    $query = "SELECT * FROM `ticket` WHERE `user_id` = $user_id AND `status` = 'Unresolved' ORDER BY `ticket_id` DESC, `date_created` ASC";

    return $query_run = mysqli_query($con, $query);
}

function getRecent()
{
    global $con;
    $query = "SELECT * FROM ticket ORDER BY date_created DESC LIMIT 5";
    return $query_run = mysqli_query($con, $query);
}

function getAllCom($table, $department)
{
    global $con;
    // Assuming $company is properly sanitized to prevent SQL injection
    $query = "SELECT to_company FROM $table WHERE to_company = '$department'";
    return $query_run = mysqli_query($con, $query);
}

?>