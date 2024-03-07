<?php
$username = "root";
$password = "";
$database = "ticketing";
$con = mysqli_connect("localhost", $username, $password);
mysqli_select_db($con, $database) or die("Unable to select database");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
