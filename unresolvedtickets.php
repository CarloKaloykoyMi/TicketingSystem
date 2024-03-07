<?php include('function/myfunction.php');
include 'sidebar_navbar.php';
if (!isset($_SESSION['auth_user']['username'])) {
    session_destroy();
    unset($_SESSION['auth_user']['username']);
    unset($_SESSION['auth_user']['user_id']);
    unset($_SESSION['auth_user']['email']);
    unset($_SESSION['auth_user']['role']);
    echo '<script>window.location.href = "emplogin.php";</script>';
} else {
    $username = $_SESSION['auth_user']['username'];
    $userid = $_SESSION['userid'];
    $email = $_SESSION['auth_user']['email'];
    $role = $_SESSION['auth_user']['role'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="Images/Ticket -Logo-3.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unrnesolved</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
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
    h2 {
        font-family: "Arial", sans-serif;
        /* Change the font family here */
        font-style: italic;
        /* Example of additional font style */
    }
</style>

<body>
    <div class="main p-3">
        <div class="container-fluid">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
            <script src="js/sidebar.js"></script> <br>
            <div class="continer1">
                <style>
                    .custom-btn {
                        background-color: #37404a !important;
                        /* !important to override Bootstrap's default styles */
                        border-color: #37404a !important;
                        /* !important to override Bootstrap's default styles */
                    }

                    .custom-btn:hover {
                        background-color: #8C8C8C !important;
                        /* !important to override Bootstrap's default styles */
                        border-color: #8C8C8C !important;
                        /* !important to override Bootstrap's default styles */
                    }
                </style>

                <h3>
                    <center>Unresolved List</center>
                </h3>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Ticket ID</th>
                            <th scope="col">Requestor</th>
                            <th scope="col">To Department</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ticket = getUnresolvedStatus($userid);

                        if (mysqli_num_rows($ticket) > 0) {
                            foreach ($ticket as $item) {
                                $status = $item['status'];

                                // Only display rows with status "Unresolved"
                        ?>
                                    <tr>
                                        <td><u><a href="ticket_info.php?ticket_id=<?= $item['ticket_id']; ?>" class="text-body fw-bold">Ticket #<?= $item['ticket_id']; ?></a></u></td>
                                        <td><?= $item['requestor']; ?></td>
                                        <td><?= $item['to_dept']; ?></td>
                                        <td class="text-justify"><?= $item['subject']; ?></td>
                                        <td class="text-center">
                                            <span class="badge text-bg-primary"><?= $status; ?></span>
                                        </td>
                                        <td class="text-center"><?= date('F j, Y h:i:s A', strtotime($item['date_created'])); ?></td>
                                    </tr>
                        <?php
                                
                            }
                        } else {
                            echo "No Records Found!";
                        }
                        ?>
                    </tbody>
                </table>

            </div>

            <!-- Add Bootstrap JS script -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </div>
    </div>

</body>

</html>