<?php
session_start();
include('../mysql_connect.php');

if (isset($_POST['add_company'])) {
    $company_name = $_POST['company_name'];
    $company_address = $_POST['company_address'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];

    $insert_company_query = "INSERT INTO company (company_name, company_address, contact, email) 
    VALUES ('$company_name','$company_address','$contact','$email')";
    $insert_company_query_run = mysqli_query($con, $insert_company_query);

    if ($insert_company_query_run) {
        echo '<script>alert("Company added successfully.");</script>';
        echo '<script>window.location.href = "company.php";</script>';
        exit();
    } else {
        // PHP code failed to execute
        echo '<script>alert("Error adding company. Please try again.");</script>';
    }
} else if (isset($_POST['edit_company'])) {
    $id = $_POST['company_id'];
    $company_name = $_POST['company_name'];
    $company_address = $_POST['company_address'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];


    $updateCompany_query = "UPDATE company SET company_name='$company_name', company_address='$company_address', 
    contact='$contact', email='$email' WHERE id='$id' ";
    $updateCompany_query_run = mysqli_query($con, $updateCompany_query);

    if ($updateCompany_query_run) {
        echo '<script>alert("Company updated successfully.");</script>';
        echo '<script>window.location.href = "company.php";</script>';
        exit();
    } else {
        // PHP code failed to execute
        echo '<script>alert("Error updating company. Please try again.");</script>';
    }
} else if (isset($_POST['add_branch'])) {
    $company_name = $_POST['company_name'];
    $branch_name = $_POST['branch_name'];
    $branch_address = $_POST['branch_address'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];


    $insert_branch_query = "INSERT INTO branch (company,branch_name, branch_address, contact, email) 
    VALUES ('$company_name','$branch_name','$branch_address','$contact','$email')";
    $insert_branch_query_run = mysqli_query($con, $insert_branch_query);

    if ($insert_branch_query_run) {
        echo '<script>alert("Branch added successfully.");</script>';
        echo '<script>window.location.href = "branch.php";</script>';
        exit();
    } else {
        // PHP code failed to execute
        echo '<script>alert("Error adding Branch. Please try again.");</script>';
    }
} else if (isset($_POST['edit_branch'])) {
    $id = $_POST['branch_id'];
    $company_name = $_POST['company_name'];
    $branch_name = $_POST['branch_name'];
    $branch_address = $_POST['branch_address'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];


    $updateBranch_query = "UPDATE branch SET company='$company_name', branch_name='$branch_name', branch_address='$branch_address', 
    contact='$contact', email='$email' WHERE id='$id' ";
    $updateBranch_query_run = mysqli_query($con, $updateBranch_query);

    if ($updateBranch_query_run) {
        echo '<script>alert("Branch updated successfully.");</script>';
        echo '<script>window.location.href = "branch.php";</script>';
        exit();
    } else {
        // PHP code failed to execute
        echo '<script>alert("Error updating. Please try again.");</script>';
    }
} else if (isset($_POST['add_department'])) {
    $company_name = $_POST['company_name'];
    $department_name = $_POST['department_name'];
    $department_head = $_POST['department_head'];
    $location = $_POST['location'];

    $insert_department_query = "INSERT INTO department (company,department_name, department_head, location) 
    VALUES ('$company_name','$department_name','$department_head','$location')";
    $insert_department_query_run = mysqli_query($con, $insert_department_query);

    if ($insert_department_query_run) {
        echo '<script>alert("Department added successfully.");</script>';
        echo '<script>window.location.href = "department.php";</script>';
        exit();
    } else {
        // PHP code failed to execute
        echo '<script>alert("Error adding Department. Please try again.");</script>';
    }
} else if (isset($_POST['edit_department'])) {
    $id = $_POST['department_id'];
    $company_name = $_POST['company_name'];
    $department_name = $_POST['department_name'];
    $department_head = $_POST['department_head'];
    $location = $_POST['location'];


    $updateDepartment_query = "UPDATE department SET company='$company_name', department_name='$department_name', department_head='$department_head', 
    location='$location' WHERE id='$id' ";
    $updateDepartment_query_run = mysqli_query($con, $updateDepartment_query);

    if ($updateDepartment_query_run) {
        echo '<script>alert("Department updated successfully.");</script>';
        echo '<script>window.location.href = "department.php";</script>';
        exit();
    } else {
        // PHP code failed to execute
        echo '<script>alert("Error updating status. Please try again.");</script>';
    }
} else if (isset($_POST['edit_user'])) {
    $user_id = $_POST['user_id'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middleinitial = $_POST['middleinitial'];
    $company = $_POST['company'];
    $branch = $_POST['branch'];
    $department = $_POST['department'];
    $email = $_POST['email'];

    $updateUser_query = "UPDATE user SET lastname='$lastname', middleinitial='$middleinitial', firstname='$firstname', company='$company', 
    branch='$branch', department='$department', email='$email' WHERE user_id='$user_id' ";
    $updateUser_query_run = mysqli_query($con, $updateUser_query);

    if ($updateUser_query_run) {
        echo '<script>alert("User status updated successfully.");</script>';
        echo '<script>window.location.href = "user.php";</script>';
        exit();
    } else {
        // PHP code failed to execute
        echo '<script>alert("Error updating user status. Please try again.");</script>';
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
        require "../phpmailer/PHPMailerAutoload.php"; // Include the PHPMailer library
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
} else if (isset($_POST['add_reply'])) {
    $reply = $_POST['reply'];
    $ticket_id = $_POST['ticket_id'];
    $userid = $_POST['userid'];
    $name = $_POST['sender'];


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
} else if (isset($_POST['add_user'])) {
    $lastName = $_POST['lastname'];
    $firstName = $_POST['firstname'];
    $middleinitial = $_POST['middleinitial'];
    $company = $_POST['company'];
    $branch = $_POST['branch'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $username = $_POST['username']; // Changed variable name to $username
    $role = $_POST['role'];

    // Insert the user into the database
    $insert_user_query = mysqli_query($con, "INSERT INTO user (lastName, firstName, middleinitial, company, branch, department, email, contact, username, password, verification_status, role) 
    VALUES('$lastName', '$firstName', '$middleinitial', '$company', '$branch', '$department', '$email', '$contact', '$username', '$password', '1', $role)");

    if ($insert_user_query) {
        // Get the last inserted user_id
        $user_id = mysqli_insert_id($con);
        echo "User ID from database: " . $user_id; // Add this line to check the user ID

        // Set the path to the folder where default profile images are stored
        $profile_image_folder = '../Images/';
        $new_folder_path = $profile_image_folder . $user_id . '-' . $username;

        // Create the folder if it doesn't exist
        if (!file_exists($new_folder_path)) {
            mkdir($new_folder_path, 0777, true);
        }

        // Create the default profile image filename
        $profile_image_filename = 'user2.png';

        // Copy the default profile image to the user's folder
        $default_profile_image = '../img/user2.png';
        $destination = $new_folder_path . '/' . $profile_image_filename;
        if (copy($default_profile_image, $destination)) {
            // Update the user's profile image filename in the database
            mysqli_query($con, "UPDATE user SET image = '$profile_image_filename' WHERE user_id = $user_id");

            echo '<script>alert("User added successfully.");</script>';
            echo '<script>window.location.href = "user.php";</script>';
            exit();
        } else {
            echo '<script>alert("Error copying default profile image.");</script>';
        }
    } else {
        // PHP code failed to execute
        echo '<script>alert("Error adding user. Please try again.");</script>';
    }
} else if (isset($_POST['upload'])) {
    $file = $_FILES['image'];
    $user_id = $_POST['userid'];
    $username = $_POST['username'];

    // Create a folder path based on User_id and Username
    $folder_path = "../Images/$user_id-$username/";

    // Ensure the folder exists or create it
    if (!is_dir($folder_path)) {
        mkdir($folder_path, 0755, true);
    }

    // Set the target path with the folder
    $target = $folder_path . basename($_FILES['image']['name']);

    $image = $_FILES['image']['name'];

    // Update the image name in the database
    $sql = "UPDATE user SET image ='$image' WHERE user_id='$user_id';";
    mysqli_query($con, $sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded Successfully";
    } else {
        $msg = "There was a problem uploading Image";
    }

    $action = 'Profile Picture Changed';
    $sql = "INSERT INTO audit_trail (user_id,action) VALUES('$user_id','$action');";
    $atrun = mysqli_query($con, $sql);
    echo "<script> location.href='admin_profile.php'; </script>";
} elseif (isset($_POST['delete_department'])) {
    $id = $_POST['department_id'];
    $sql = "DELETE FROM department WHERE id = '$id';";
    $sqlRun =  mysqli_query($con, $sql);
    echo "<script> location.href='../admin/department.php'; </script>";
} elseif (isset($_POST['delete_company'])) {
    $id = $_POST['company_id'];
    $sql = "DELETE FROM company WHERE id = '$id';";
    $sqlRun =  mysqli_query($con, $sql);
    echo "<script> location.href='../admin/company.php'; </script>";
} elseif (isset($_POST['delete_branch'])) {
    $id = $_POST['branch_id'];
    $sql = "DELETE FROM branch WHERE id = '$id';";
    $sqlRun =  mysqli_query($con, $sql);
    echo "<script> location.href='../admin/branch.php'; </script>";
} elseif (isset($_POST['saveChanges'])) {
    $userid = $_POST['userid'];
    $fn = $_POST['firstName'];
    $mI = $_POST['middleInitial'];
    $ln = $_POST['lastName'];
    $company = $_POST['company'];
    $branch = $_POST['branch'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];

    $sql = "UPDATE `user` SET `lastname`='$ln',`firstname`='$fn',`middleinitial`='$mI',`company`='$company',
    `branch`='$branch',`department`='$department',`contact`='$phone' WHERE `user_id` = '$userid'; ";
    $run =  mysqli_query($con, $sql);

    $action = 'Profile Detail Edited';
    $atsql = "INSERT INTO audit_trail (user_id,action) VALUES('$userid','$action');";
    $atrun = mysqli_query($con, $atsql);

    if ($run) {
        echo '<script>alert("Changes Saved.");</script>';
        echo '<script>window.location.href = "admin_profile.php"</script>';
        exit();
    } else {
        // PHP code failed to execute
        echo '<script>alert("Error Changing. Please try again.");</script>';
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
            echo '<script>window.location.href = "admin_Profile.php"</script>';
        }
    } else {
        echo "<script>alert('Wrong Current Password!')</script>";
        echo '<script>window.location.href = "admin_Profile.php"</script>';
    }
}
