<?php include('function/myfunction.php');
include 'sidebar_navbar.php';

if (!isset($_SESSION['auth_user']['username'])) {
    session_destroy();
    unset($_SESSION['auth_user']['username']);
    unset($_SESSION['userid']);
    unset($_SESSION['auth_user']['email']);
    unset($_SESSION['auth_user']['role']);
    unset($_SESSION['auth_user']['lastname']);
    unset($_SESSION['auth_user']['firstname']);
    echo '<script>window.location.href = "emplogin.php";</script>';
} else {
    $email = $_SESSION['auth_user']['email'];
    $role = $_SESSION['auth_user']['role'];
    $lname = $_SESSION['auth_user']['lastname'];
    $fname = $_SESSION['auth_user']['firstname'];
    $userid1 = $_SESSION['userid'];
}

if (isset($_GET['ticket_id'])) {
    $ticket_id = $_GET['ticket_id'];

    // Fetch order details from the ticket table
    $query = "SELECT * FROM ticket WHERE ticket_id = '$ticket_id'";

    $ticket_result = mysqli_query($con, $query);

    if ($ticket_result && mysqli_num_rows($ticket_result) > 0) {
        $ticket_data = mysqli_fetch_assoc($ticket_result);
        // Now you can use $ticket_data to access order information.
    } else {
        // Handle the case where order data couldn't be retrieved
        $error_message = "Error: Unable to retrieve order data.";
    }
} else {
    // Handle the case where the ticket_id parameter is not provided in the URL
    $error_message = "Error: Missing ticket_id parameter.";
}

$query = "SELECT * FROM ticket_reply WHERE ticket_id = '$ticket_id'";

$reply_result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="Images/Ticket -Logo-3.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requested Ticket Information</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/sidebar_navbar.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- jQuery and DataTables JavaScript -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="script.js"></script>

</head>

<style>
    .dialog-box {
        max-width: 60%;
        margin-bottom: 1rem;
        border-radius: 15px;
        display: flex;
        flex-direction: column;
        background-color: #f5f5f5;
        position: relative;
    }

    .dialog-header {
        padding: 0.5rem 1rem;
        background-color: #f5f5f5;
        border-radius: 15px 15px 0 0;
        border-bottom: 1px solid #ddd;
        display: flex;
        align-items: center;
    }

    .dialog-header img {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 0.5rem;
    }

    .dialog-header p {
        margin-bottom: 0;
    }

    .dialog-body {
        padding: 0.5rem 1rem;
        border-radius: 0 0 15px 15px;
        background-color: #fff;
    }

    .reply-dialog {
        align-self: flex-start;
    }

    .user-dialog {
        align-self: flex-end;
        background-color: #dcf8c6;
    }
</style>

<body>
    <div class="main p-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-ticket"></i> Tickets</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list-group fa-padding">
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-body">
                                                <div>
                                                    <hr>
                                                    <div class="text-right">
                                                        <a href="requested_tickets.php" class="btn btn-secondary mb-3" style="position: absolute; top: 40px; right: 10px;">Go Back</a>
                                                    </div>
                                                    <span class="number pull-right"><b>Ticket # <?php echo $ticket_data['ticket_id']; ?></b></span> <br>
                                                    <span class="number pull-right"><b>Status:
                                                            <?php
                                                            $status = $ticket_data['status'];

                                                            if ($status == 'Pending') {
                                                                echo '<span class="badge text-bg-warning">' . $status . '</span>';
                                                            } elseif ($status == 'Resolved') {
                                                                echo '<span class="badge text-bg-success">' . $status . '</span>';
                                                            } elseif ($status == 'Cancelled') {
                                                                echo '<span class="badge text-bg-danger">' . $status . '</span>';
                                                            } else {
                                                                echo '<span class="badge text-bg-primary">' . $status . '</span>';
                                                            }
                                                            ?>
                                                        </b></span>

                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="padding: 5px 10px; font-size: 10px;">
                                                        Update Status
                                                    </button>

                                                    <br>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Ticket Status</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="crud.php" method="POST">
                                                                        <label for="Status" class="form-label"><i class="fas fa-info-circle"></i> Status</label>
                                                                        <select id="Status" name="status" class="form-control" required>
                                                                            <option value="" disabled>Select your Status</option>
                                                                            <?php
                                                                            $currentStatus = $ticket_data['status'];
                                                                            $statusOptions = array("Pending", "Unresolved", "Resolved", "Cancelled");
                                                                            foreach ($statusOptions as $option) {
                                                                                $selected = ($option == $currentStatus) ? 'selected' : '';
                                                                                echo "<option value=\"$option\" $selected>$option</option>";
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <!-- Add the ticket_id input field -->
                                                                        <input type="hidden" name="ticket_id" value="<?php echo $ticket_data['ticket_id']; ?>">
                                                                        <div class="modal-footer">

                                                                            <!-- Move the submit button inside the form -->
                                                                            <button class="btn btn-primary float-end" type="submit" name="change_status">Save Changes</button>
                                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                        </div>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <br>
                                                    <span style="font-size:26px;padding-bottom:10px;"><b><i class="fas fa-file"></i> Subject: </b> <?php echo $ticket_data['subject']; ?></span>
                                                </div>

                                                <p class="info">Requested by <a href="#"><?php echo $ticket_data['requestor']; ?></a> &nbsp; <?php echo date('M d, Y', strtotime($ticket_data['date_created'])); ?></p>
                                                <hr>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#replyModal" style="position: absolute; top: 200px; right: 10px;">
                                                    Reply
                                                </button>
                                                <b><i class="fas fa-comments"></i> Concern:</b>
                                                <p><?php echo $ticket_data['concern']; ?></p>

                                                <!-- count of the attachment -->
                                                <?php
                                                $usID=$ticket_data['user_id'];
                                                $sql = "SELECT ticket_id, user_id,COUNT(*) as number_file FROM `file_attachment` WHERE ticket_id='$ticket_id' AND user_id = '$usID';";
                                                $result = mysqli_query($con, $sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $count_file = $row['number_file'];
                                                }

                                                $sql1 = "SELECT file_name FROM `file_attachment`WHERE ticket_id='$ticket_id' AND user_id = '$usID' ORDER BY file_name DESC;";
                                                $result = mysqli_query($con, $sql1);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $file = $row['file_name'];
                                                }
                                                ?>

                                                <span class="number pull-right"><strong>Attachment: <?php echo $count_file; ?></strong></span> <br>

                                                <?php
                                                if (mysqli_num_rows($result) > 0) {
                                                    foreach ($result as $item) {
                                                        echo '<div style="float:left; width:33.33%; padding: 10px;">';

                                                        // Check if the file name is an image
                                                        if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $item['file_name'])) {
                                                            echo '<img src="ticket_files/ticket_' . $ticket_id . '_' . $ticket_data['requestor'] . '_' . date("F j, Y") . '/' . $item['file_name'] . '" alt="Image Attachment" style="width:100%; height:250">';
                                                        } else {
                                                            // Check if the file name is a document
                                                            if (preg_match('/\.(doc|docx|pdf)$/i', $item['file_name'])) {
                                                                echo '<a href="ticket_files/' . $item['file_name'] . '" download="' . $item['file_name'] . '">Document Attachment: ' . $item['file_name'] . '</a>';
                                                            } else {
                                                                // If neither image nor document, just display the file name
                                                                echo 'Attachment: ' . $item['file_name'] . ' goes here';
                                                            }
                                                        }

                                                        echo '</div>';
                                                    }
                                                }
                                                ?>

                                                <!-- end of count attachment -->

                                                <!-- Modal of the Reply button -->
                                                <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Reply Message Box</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="crud.php" method="POST">
                                                                    <input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>"> <input type="hidden" name="userid" value="<?php echo $user_id; ?>">
                                                                    <input type="text" name="sender" style="display: none;" value="<?php echo $fname . " " . $lname; ?>">
                                                                    <div class="mb-3">
                                                                        <label for="replyMessage" class="form-label">Reply</label>
                                                                        <textarea class="form-control" name="reply" id="replyMessage" rows="3"></textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <!-- Move the submit button inside the form -->
                                                                        <button class="btn btn-primary float-end" type="submit" name="add_reply">Save Changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal of the Reply button -->
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <?php
                                // Check if there's any result
                                if ($reply_result->num_rows > 0) {
                                    // Output data of each row
                                    echo "<table>";
                                    while ($row = $reply_result->fetch_assoc()) {
                                        $name = $row["Name"];
                                        $reply = $row["reply"];
                                        $useID = $row["user_id"];
                                    

                                    $dpSql ="SELECT * FROM user Where user_id = '$useID';";
                                    $dpResult = mysqli_query($con,$dpSql);
                                    while($row = $dpResult->fetch_assoc()){
                                        $img=$row['image'];
                                        $usename =$row['username'];
                                        $foldername = $useID."-".$usename;
                                    }

                                ?>
                                    <div class="dialog-header">
                                        <img src=<?php echo "Images/" . $foldername . "/". $img ?> alt="Profile Icon" class="dialog-profile-icon">
                                        <p class="mb-0"><?php echo $name ?></p>
                                    </div>

                                <div class="dialog-body">
                                    <p class="mb-0"><?php echo "" . $reply; ?></p>
                                </div>
                                <?php
                                }
                                    echo "</table>";
                                }
                                ?>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/sidebar.js"></script>

</body>

</html>