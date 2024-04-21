<?php
include('function/myfunction.php');
if(isset($_POST['download'])){
    $query = "SELECT * FROM ticket";
$result = $con->query($query);

// Check if records are found
if ($result->num_rows > 0) {
    // Filename for the downloaded file
    $filename = "records.csv";

    // Set headers for download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Open file pointer
    $fp = fopen('php://output', 'w');

    // Write CSV headers
    $headers = array("Ticket ID","User ID", "Subject", "Company", "requestor", "concern", "status", "date_created", "to_dept", "email", "to_branch", "reason", "updated_date", "updated_by"); // Replace these with your actual column names
    fputcsv($fp, $headers);

    // Loop through each row and write to CSV file
    while ($row = $result->fetch_assoc()) {
        fputcsv($fp, $row);
    }

    // Close file pointer
    fclose($fp);


    exit; // Terminate script after file download
} else {
    echo "No records found in the table.";


}
}
?>