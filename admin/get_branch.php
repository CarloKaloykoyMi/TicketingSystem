<?php
include('mysql_connect.php');

if (isset($_POST['company_name'])) {
    $companyName = mysqli_real_escape_string($con, $_POST['company_name']);

    $query = "SELECT * FROM branch WHERE company = '$companyName'";
    $result = mysqli_query($con, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
        }
    } else {
        echo "<option value=''>No branch available</option>";
    }
} else {
    echo "<option value=''>Invalid request</option>";
}
?>