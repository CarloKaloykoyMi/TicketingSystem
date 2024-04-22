<?php
include('function/myfunction.php');

if (isset($_POST['download'])) {
    $query = "SELECT t.`ticket_id`, t.`subject`, t.`requestor`, t.`concern`, t.`status`, t.`date_created`, t.`email`, t.`to_branch`, t.`reason`, t.`updated_date`, CONCAT(u.`firstname`, ' ', u.`lastname`) AS updated_by 
              FROM ticket t 
              LEFT JOIN user u ON t.updated_by = u.user_id";
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
        $headers = array("ITR", "Subject", "Requestor", "Details", "Status", "Date Created", "Email", "Assigned Branch", "Reason", "Updated Date", "Updated By");
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