<?php
include('mysql_connect.php');

if (isset($_POST['add_ticket'])) { // Check if the form is submitted
    $userid = $_POST['userid'];
    $requestor = $_POST['requestor']; // Retrieve the requestor's name from the input tag
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $company = $_POST['tocompany'];
    $todepartment = $_POST['todepartment'];
    $concern = $_POST['concern'];
    $status = "Pending";
    $email = $_POST['email'];
    $tobranch = $_POST['tobranch'];

    // Insert ticket information into the ticket table
    $insert_ticket_query = "INSERT INTO ticket (user_id, subject, to_company, to_dept, requestor, concern, status, email,to_branch) 
    VALUES ('$userid','$subject','$company','$todepartment','$requestor','$concern','$status','$email','$tobranch')";

    $insert_ticket_query_run = mysqli_query($con, $insert_ticket_query); // Run the query

    if ($insert_ticket_query_run) { // Check if the query was executed
        $ticket_id = mysqli_insert_id($con); // Get the last inserted ticket_id

        // Create folder for the ticket and user
        $folder_path = "ticket_files/ticket_" . $ticket_id . "_" . $requestor . "_" . date("F j, Y"); // Set desired folder path based on ticket_id and requestor's name

        if (!file_exists($folder_path)) { // Check if the folder exists
            mkdir($folder_path, 0777, true); // Create the folder
        }

        // Handle file uploads
        if (!empty($_FILES['files']['name'][0])) { // Check if files are uploaded
            $file_names = $_FILES['files']['name']; // Get the file names
            $file_tmps = $_FILES['files']['tmp_name']; // Get the temporary file names

            foreach ($file_names as $key => $file_name) { // Loop through the file names
                $file_destination = $folder_path . "/" . $file_name; // Set the file destination

                // Move uploaded file to the destination
                if (move_uploaded_file($file_tmps[$key], $file_destination)) { // Check if the file was moved successfully
                    // Insert file information into file_attachment table
                    $insert_file_query = "INSERT INTO file_attachment (user_id, ticket_id, file_name)
                    VALUES ('$userid', '$ticket_id', '$file_name')";
                    $insert_file_query_run = mysqli_query($con, $insert_file_query);

                    if (!$insert_file_query_run) {
                        echo '<script>alert("Error inserting file information. Please try again.");</script>';
                    }
                } else {
                    echo '<script>alert("Error uploading file. Please try again.");</script>';
                }
            }
        }

        // Send email notification to IT Department
        require "phpmailer/PHPMailerAutoload.php"; // Include the PHPMailer library
        $mail = new PHPMailer; // Create a new PHPMailer instance
        
        $mail->isSMTP(); // Enable SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify the SMTP server
        $mail->Port = 587; // Set the SMTP port
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption

        $mail->Username = 'odetocode04@gmail.com'; // email
        $mail->Password = 'mnugjcpwaslqthdn'; // email password

        $mail->setFrom('no-reply@gmail.com', 'no-reply'); // Set the sender of the email
        $sql = "SELECT email FROM user WHERE department = 'IT Department'"; // Select all IT emails
        $result = mysqli_query($con, $sql);

        $it_emails = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $it_emails[] = $row['email'];
        }

        $requestor_email = $_POST['email']; // Get the email address of the requestor

        // Send email notification to IT Department
        foreach ($it_emails as $email) {
            $mail->addAddress($email); // Send email to IT Department
        }

        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = "New Ticket has been created"; // Set the email subject
        $mail->Body = "Dear IT Department,<br>Ticket $ticket_id has been created. Please check.<br><br>Best regards,<br>CGG E-Ticketing"; // Set the email body

        // Send email to IT Department
        if (!$mail->send()) { // Check if the email was sent
            echo '<script>alert("Error sending email notification to IT Department. Please try again.");</script>';
        } else {
            // Clear all addresses for next email
            $mail->clearAddresses();

            // Send email notification to the requestor
            $mail->addAddress($requestor_email); // Send email to the requestor
            $mail->Subject = "Ticket Created Successfully"; // Set the email subject
            $mail->Body = "Dear $requestor,<br><br>Your ticket with subject '$subject' has been successfully created.<br><br>Thank you for using our system.<br><br>Best regards,<br>CGG E-Ticketing"; // Set the email body

            // Send email to the requestor
            if (!$mail->send()) { // Check if the email was sent
                echo '<script>alert("Error sending email notification to the requestor. Please try again.");</script>';
            } else {
                echo '<script>alert("Ticket Submitted. Email notifications sent.");</script>';
                echo '<script>window.location.href = "home_user.php";</script>';
                exit();
            }
        }
    } else {
        $reply = $_POST['reply'];
        $ticket_id = $_POST['ticket_id'];
        $userid = $_POST['userid'];
        $name = $_POST['sender'];

        // Insert the reply into the ticket_reply table
        $insert_reply = "INSERT INTO ticket_reply (reply, ticket_id,user_id,Name) 
        VALUES ('$reply', '$ticket_id','$userid', '$name')";
        $insert_reply_run = mysqli_query($con, $insert_reply);

        if ($insert_reply_run) {
            echo '<script>alert("Reply added.");</script>';
            echo '<script>window.location.href = "ticket_info.php?ticket_id=' . $ticket_id . '"</script>';
            exit();
        } else {
            // PHP code failed to execute
            echo '<script>alert("Error adding reply. Please try again.");</script>';
        }
    }
} else if (isset($_POST['upload'])) {
    $file = $_FILES['image'];
    $user_id = $_POST['userid'];
    $username = $_POST['username'];

    // Create a folder path based on User_id and Username
    $folder_path = "Images/$user_id-$username/";

    // Ensure the folder exists or create it
    if (!is_dir($folder_path)) {
        mkdir($folder_path, 0755, true);
    }

    // Set the target path with the folder
    $target = $folder_path . basename($_FILES['image']['name']);

    $image = $_FILES['image']['name']; // Get the image name

    // Update the image name in the database
    $sql = "UPDATE user SET image ='$image' WHERE user_id='$user_id';";
    mysqli_query($con, $sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded Successfully"; // Set the success message
    } else {
        $msg = "There was a problem uploading Image";
    }

    $action = 'Profile Picture Changed'; // Set the action for the audit trail
    $sql = "INSERT INTO audit_trail (user_id,action) VALUES('$user_id','$action');"; // Insert the action into the audit trail table
    $atrun = mysqli_query($con, $sql);
    echo "<script> location.href='User_Profile.php'; </script>";
} elseif (isset($_POST['saveChanges'])) {
    $userid = $_POST['userid'];
    $fn = $_POST['firstName'];
    $mI = $_POST['middleInitial'];
    $ln = $_POST['lastName'];
    $suffix = $_POST['suffix'];
    $company = $_POST['company'];
    $branch = isset($_POST['branch']) ? $_POST['branch'] : ''; // Check if branch is set, if not, set it to empty
    $department = $_POST['department'];
    $phone = $_POST['phone'];

    // Check if branch is not empty before including it in the SQL update
    $branchUpdate = !empty($branch) ? "`branch`='$branch'," : '';

    $sql = "UPDATE `user` SET `lastname`='$ln',`firstname`='$fn',`middleinitial`='$mI',`suffix`='$suffix',`company`='$company',
    $branchUpdate `department`='$department',`contact`='$phone' WHERE `user_id` = '$userid'; ";

    $run =  mysqli_query($con, $sql);

    $action = 'Profile Detail Edited'; // Set the action for the audit trail
    $atsql = "INSERT INTO audit_trail (user_id,action) VALUES('$userid','$action');";
    $atrun = mysqli_query($con, $atsql);

    if ($run) {
        echo '<script>alert("Changes Saved.");</script>';
        echo '<script>window.location.href = "User_Profile.php"</script>';
        exit();
    } else {
        // PHP code failed to execute
        echo '<script>alert("Error Changing. Please try again.");</script>';
    }
} else if (isset($_POST['change_status'])) {
    $ticket_id = $_POST['ticket_id'];
    $status = $_POST['status']; // Retrieve the selected status from the form data
    $email = $_POST['email'];
    $updatedby = $_POST['updatedby'];

    // Use prepared statements to prevent SQL injection
    $updateUser_query = "UPDATE ticket SET status=? WHERE ticket_id=?";
    $stmt = mysqli_prepare($con, $updateUser_query);

    // Bind parameters and execute the query
    mysqli_stmt_bind_param($stmt, "si", $status, $ticket_id);
    $updateUser_query_run = mysqli_stmt_execute($stmt);

    if ($updateUser_query_run) {
        // Retrieve requestor email based on ticket_id
        $getRequestorEmail_query = "SELECT email FROM ticket WHERE ticket_id=?";
        $stmt = mysqli_prepare($con, $getRequestorEmail_query);
        mysqli_stmt_bind_param($stmt, "i", $ticket_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $email);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if ($status == 'Resolved') {
            $updated_by = $updatedby; // Get the user ID of the resolver
            $sql = "UPDATE ticket SET updated_date = NOW(), updated_by = ? WHERE ticket_id = ?";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "ii", $updated_by, $ticket_id);
            $run = mysqli_stmt_execute($stmt);
        }

        if ($status == 'Unresolved') {
            $updated_by = $updatedby; // Get the user ID of the resolver
            $sql = "UPDATE ticket SET updated_date = NOW(), updated_by = ? WHERE ticket_id = ?";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "ii", $updated_by, $ticket_id);
            $run = mysqli_stmt_execute($stmt);
        }

        // Send email notification
        require "phpmailer/PHPMailerAutoload.php"; // Include the PHPMailer library
        $mail = new PHPMailer; // Create a new PHPMailer instance

        $mail->isSMTP(); // Enable SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify the SMTP server
        $mail->Port = 587; // Set the SMTP port
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption

        $mail->Username = 'odetocode04@gmail.com'; // email
        $mail->Password = 'mnugjcpwaslqthdn'; // email password

        $mail->setFrom('no-reply@gmail.com', 'no-reply'); // Set the sender of the email
        $mail->addAddress($email); // Send email to the requestor

        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = "Ticket Status Updated"; // Set the email subject
        $mail->Body = "Dear User,<br><br>Your ticket with ID #$ticket_id has been updated to '$status'.<br><br>Thank you for using our system.<br><br>Best regards,<br>CGG E-Ticketing"; // Set the email body

        // Send email
        if (!$mail->send()) { // Check if the email was sent
            echo '<script>alert("Error sending email notification. Please try again.");</script>';
        } else {
            echo '<script>alert("Status updated successfully. Email notification sent.");</script>';
            echo '<script>window.location.href = "ticket_info.php?ticket_id=' . $ticket_id . '";</script>';
            exit();
        }
    } else {
        // PHP code failed to execute
        echo '<script>alert("Error updating ticket status. Please try again.");</script>';
    }
} else if (isset($_POST['delete_ticket'])) {
    $ticket_id = $_POST['ticket_id'];
    $requestor = $_POST['requestor'];

    // Fetch requestor name from the ticket
    $sql = "SELECT requestor FROM ticket WHERE ticket_id = ?";
    $stmt = mysqli_prepare($con, $sql);

    if (!$stmt) {
        die('Error in preparing SQL query: ' . mysqli_error($con));
    }

    mysqli_stmt_bind_param($stmt, "i", $ticket_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $db_requestor);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Check if the requestor matches the currently authenticated user
    if ($db_requestor === $requestor) {
        // Delete the ticket
        $sql_delete = "DELETE FROM ticket WHERE ticket_id = ?";
        $stmt_delete = mysqli_prepare($con, $sql_delete);

        if (!$stmt_delete) {
            die('Error in preparing SQL query: ' . mysqli_error($con));
        }

        mysqli_stmt_bind_param($stmt_delete, "i", $ticket_id);
        mysqli_stmt_execute($stmt_delete);
        mysqli_stmt_close($stmt_delete);

        $usid = $_POST['user_id'];
        $action = 'Ticket Deletion';
        $sqlDel = "INSERT INTO audit_trail (user_id,action) VALUES('$usid','$action');";
        $atrun = mysqli_query($con, $sqlDel);

        echo '<script>alert("Ticket Deleted.");</script>';
        echo '<script>window.location.href = "home_user.php";</script>';
        exit();
    } else {
        // Unauthorized access
        echo '<script>alert("You are not authorized to delete this ticket.");</script>';
        echo '<script>window.location.href = "ticket_info.php?ticket_id=' . urlencode($ticket_id) . '";</script>';
    }
} else if (isset($_POST['cancel_ticket'])) {
    $ticket_id = $_POST['ticket_id'];
    $requestor = $_POST['requestor'];
    $cancel_reason = $_POST['cancel_reason'];

    // Fetch requestor name from the ticket
    $sql = "SELECT requestor FROM ticket WHERE ticket_id = ?";
    $stmt = mysqli_prepare($con, $sql);

    if (!$stmt) {
        die('Error in preparing SQL query: ' . mysqli_error($con));
    }

    mysqli_stmt_bind_param($stmt, "i", $ticket_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $db_requestor);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Check if the requestor matches the currently authenticated user
    if ($db_requestor === $requestor) {
        // Update the ticket status to 'cancelled'
        $sql_update = "UPDATE ticket SET status = 'Cancelled' WHERE ticket_id = ?";
        $stmt_update = mysqli_prepare($con, $sql_update);

        if (!$stmt_update) {
            die('Error in preparing SQL query: ' . mysqli_error($con));
        }
        mysqli_stmt_bind_param($stmt_update, "i", $ticket_id);
        mysqli_stmt_execute($stmt_update);
        mysqli_stmt_close($stmt_update);

        // Update updated_date and updated_by columns
        $updated_by = $requestor; // Get the user ID of the resolver
        $sql_update = "UPDATE ticket SET updated_date = NOW(), updated_by = ? WHERE ticket_id = ?";
        $stmt_update = mysqli_prepare($con, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "si", $updated_by, $ticket_id);
        $run_update = mysqli_stmt_execute($stmt_update);
        mysqli_stmt_close($stmt_update);

        if (!$run_update) {
            die('Error updating ticket: ' . mysqli_error($con));
        }

        // Update the reason for cancellation
        $cancel_query = "UPDATE ticket SET reason = '$cancel_reason' WHERE ticket_id = '$ticket_id'";
        $cancel_query_run = mysqli_query($con, $cancel_query);

        echo '<script>alert("Ticket Cancelled.");</script>';
        echo '<script>window.location.href = "ticket_info.php?ticket_id=' . urlencode($ticket_id) . '";</script>';
        exit();
    } else {
        // Unauthorized access
        echo '<script>alert("You are not authorized to cancel this ticket.");</script>';
        echo '<script>window.location.href = "ticket_info.php?ticket_id=' . urlencode($ticket_id) . '";</script>';
    }
} else if (isset($_POST['ChangePassword'])) {
    $user_id = $_POST['userid'];
    $oldpass = $_POST['password'];
    $newpass = $_POST['newpassword'];
    $connewpass = $_POST['renewpassword'];

    $sql = "SELECT * FROM user WHERE password = '$oldpass' AND user_id='$user_id';";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        if ($newpass <> $connewpass) {
            echo "<script>alert('Errorrr')</script>";
            echo '<script>window.location.href = "User_Profile.php"</script>';
        } else {
            $Usql = "UPDATE USER SET password = '$newpass' WHERE password = '$oldpass' AND user_id='$user_id';";
            $Uresult = mysqli_query($con, $Usql);
            echo "<script>alert('Password:Change Successfully')</script>";
            echo '<script>window.location.href = "User_Profile.php"</script>';
        }
    } else {
        echo "<script>alert('Wrong Current Password!')</script>";
        echo '<script>window.location.href = "User_Profile.php"</script>';
    }
} else if (isset($_POST['rate_requestor'])) {
    $ticket_id = $_POST['ticket_id'];
    $requestor_id = $_POST['requestor_id'];
    $resolver_id = $_POST['resolver_id'];
    $rate = $_POST['rating'];
    $feedback = $_POST['comment'];

    $check_query = "SELECT * FROM rating WHERE ticket_id = $ticket_id";
    $result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($result) == 0) {
        // If there are no records with the given ticket_id in the rating table, insert a new record
        $insert_query = "INSERT INTO rating (ticket_id, requestor_id, resolver_id, requestor_rating, requestor_comment) VALUES ('$ticket_id', '$requestor_id', '$resolver_id', '$rate', '$feedback')";
        mysqli_query($con, $insert_query);
        echo '<script>window.location.href = "resolvedtickets.php"</script>';
    } else {
        // If there are records with the given ticket_id, update the existing record
        $update_query = "UPDATE rating SET requestor_id = '$requestor_id', resolver_id = '$resolver_id', requestor_rating = '$rate', requestor_comment = '$feedback' WHERE ticket_id = $ticket_id";
        mysqli_query($con, $update_query);
        echo '<script>window.location.href = "resolvedtickets.php"</script>';
    }
} else if (isset($_POST['rate_resolver'])) {
    $ticket_id = $_POST['ticket_id'];
    $requestor_id = $_POST['requestor_id'];
    $resolver_id = $_POST['resolver_id'];
    $rate = $_POST['rating'];
    $feedback = $_POST['comment'];

    $check_query = "SELECT * FROM rating WHERE ticket_id = $ticket_id";
    $result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($result) == 0) {
        // If there are no records with the given ticket_id in the rating table, insert a new record
        $insert_query = "INSERT INTO rating (ticket_id, requestor_id, resolver_id, resolver_rating, resolver_comment) VALUES ('$ticket_id', '$requestor_id', '$resolver_id', '$rate', '$feedback')";
        mysqli_query($con, $insert_query);
        echo '<script>window.location.href = "resolvedtickets.php"</script>';
    } else {
        // If there are records with the given ticket_id, update the existing record
        $update_query = "UPDATE rating SET requestor_id = '$requestor_id', resolver_id = '$resolver_id', resolver_rating = '$rate', resolver_comment = '$feedback'  WHERE ticket_id = $ticket_id";
        mysqli_query($con, $update_query);
        echo '<script>window.location.href = "resolvedtickets.php"</script>';
    }
}
