<?php
include('mysql_connect.php');

if (isset($_POST['add_ticket'])) { // Check if the form is submitted
    $userid = $_POST['userid'];
    $requestor = $_POST['requestor']; // Retrieve the requestor's name from the input tag
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $company = $_POST['company'];
    $todepartment = $_POST['todepartment'];
    $concern = $_POST['concern'];
    $status = "Pending";

    // Insert ticket information into the ticket table
    $insert_ticket_query = "INSERT INTO ticket (user_id, subject, to_company, to_dept, requestor, concern, status) 
    VALUES ('$userid','$subject','$company','$todepartment','$requestor','$concern','$status')";

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
        $mail->Subject = "Ticket Created Successfully"; // Set the email subject
        $mail->Body = "Dear $requestor,<br><br>Your ticket with subject '$subject' has been successfully created.<br><br>Thank you for using our system.<br><br>Best regards,<br>CGG E-Ticketing"; // Set the email body

        // Send email
        if (!$mail->send()) { // Check if the email was sent
            echo '<script>alert("Error sending email notification. Please try again.");</script>';
        } else {
            echo '<script>alert("Ticket Submitted. Email notification sent.");</script>';
            echo '<script>window.location.href = "home_user.php";</script>';
            exit();
        }
    } else {
        echo '<script>alert("Error submitting ticket. Please try again.");</script>';
    }

    
} else if (isset($_POST['add_reply'])) { // Check if the form is submitted
    if(empty($_POST['reply'])){ // Check if the reply is empty
        $ticket_id = $_POST['ticket_id']; // Retrieve the ticket_id from the input tag
        echo '<script>alert("Empty Reply. Please try again.");</script>';
        echo '<script>window.location.href = "ticket_info.php?ticket_id=' . $ticket_id . '"</script>'; // Redirect to the ticket_info page
    }else{ 
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

    $action ='Profile Picture Changed'; // Set the action for the audit trail
    $sql="INSERT INTO audit_trail (user_id,action) VALUES('$user_id','$action');"; // Insert the action into the audit trail table
    $atrun= mysqli_query($con,$sql);
    echo "<script> location.href='User_Profile.php'; </script>";
    
} elseif (isset($_POST['saveChanges'])) { 
    $userid = $_POST['userid'];
    $fn = $_POST['firstName'];
    $mI = $_POST['middleInitial'];
    $ln = $_POST['lastName'];
    $company = $_POST['company'];
    $branch = isset($_POST['branch']) ? $_POST['branch'] : ''; // Check if branch is set, if not, set it to empty
    $department = $_POST['department'];
    $phone = $_POST['phone'];

    // Check if branch is not empty before including it in the SQL update
    $branchUpdate = !empty($branch) ? "`branch`='$branch'," : '';

    $sql = "UPDATE `user` SET `lastname`='$ln',`firstname`='$fn',`middleinitial`='$mI',`company`='$company',
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
}

// Change the status of the ticket
else if (isset($_POST['change_status'])) {
    $ticket_id = $_POST['ticket_id'];
    $status = $_POST['status']; // Retrieve the selected status from the form data

    // Use prepared statements to prevent SQL injection
    $updateUser_query = "UPDATE ticket SET status=? WHERE ticket_id=?";
    $stmt = mysqli_prepare($con, $updateUser_query);

    // Bind parameters and execute the query
    mysqli_stmt_bind_param($stmt, "si", $status, $ticket_id);
    $updateUser_query_run = mysqli_stmt_execute($stmt);

    if ($updateUser_query_run) {
        echo '<script>alert("Status updated successfully.");</script>';
        echo '<script>window.location.href = "ticket_info.php?ticket_id=' . $ticket_id . '";</script>';
        exit();
    } else {
        // PHP code failed to execute
        echo '<script>alert("Error updating user request. Please try again.");</script>';
    }
}else if(isset($_POST['ChangePassword'])){
        $user_id=$_POST['userid'];
        $oldpass=$_POST['password'];
        $newpass=$_POST['newpassword'];
        $connewpass=$_POST['renewpassword'];

        $sql="SELECT * FROM user WHERE password = '$oldpass' AND user_id='$user_id';";
        $result = mysqli_query($con,$sql);

        if (mysqli_num_rows($result) > 0) {
            if($newpass <> $connewpass){
                echo "<script>alert('Errorrr')</script>";
                echo '<script>window.location.href = "User_Profile.php"</script>';
            }else{
                $Usql="UPDATE USER SET password = '$newpass' WHERE password = '$oldpass' AND user_id='$user_id';";
                $Uresult = mysqli_query($con,$Usql);
                echo "<script>alert('Password:Change Successfully')</script>";
                echo '<script>window.location.href = "User_Profile.php"</script>'; 
            }
        }else{
            echo "<script>alert('Wrong Current Password!')</script>";
            echo '<script>window.location.href = "User_Profile.php"</script>';

        }
        

}
