<?php
include('function/myfunction.php');
include 'sidebar_navbar.php';
include('crud.php');

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
    $username = $_SESSION['auth_user']['username'];
    $userid = $_SESSION['userid'];
    $email = $_SESSION['auth_user']['email'];
    $role = $_SESSION['auth_user']['role'];
    $lname = $_SESSION['auth_user']['lastname'];
    $fname = $_SESSION['auth_user']['firstname'];
    $fromcompany = $_SESSION['auth_user']['company'];
    $fromdept = $_SESSION['auth_user']['department'];
}

$sql_user = "SELECT * FROM user WHERE user_id='$userid';";
$result = mysqli_query($con, $sql_user);
while ($row = mysqli_fetch_array($result)) {
    $department = $row['department'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="Images/Ticket -Logo-3.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending</title>
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

<body>
    <div class="main p-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Requested Tickets</h4>
                        </div>
                        <div class="card-body" id="category_table">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Dates</th>
                                        <th>Subject</th>
                                        <th>Requested Department</th>
                                        <th>Requestor</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM ticket WHERE to_dept='$department';";
                                    $ticket = mysqli_query($con, $sql);
                                    if (mysqli_num_rows($ticket) > 0) {
                                        foreach ($ticket as $item) {
                                    ?>
                                            <tr>
                                                <td><?= date('F j, Y h:i:s A', strtotime($item['date'])); ?></td>
                                                <td><?= $item['subject']; ?></td>
                                                <td><?= $item['to_dept']; ?></td>
                                                <td><?= $item['requestor']; ?></td>
                                                <td>
                                                    <?php
                                                    $status = $item['status'];

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
                                                </td>
                                                <td class="table-action">
                                                    <a href="requested_ticket_info.php?ticket_id=<?php echo $item['ticket_id']; ?>" class="btn btn-primary"><i class="fas fa-eye"></i>View
                                                    </a>
                                                </td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/sidebar.js"></script>

    <script>
        $(document).ready(function() {
            // Handle the click event for the "Accept Changes" button
            $('.btn-accept-changes').click(function() {
                // Close the current modal
                $('#editCompanyModal').modal('hide');

                // Open the new modal for accepting changes
                $('#acceptChangesModal').modal('show');
            });

            // Handle the click event for the "Decline Changes" button
            $('.btn-decline-changes').click(function() {
                // Close the current modal
                $('#editCompanyModal').modal('hide');

                // Open the new modal for declining changes
                $('#declineChangesModal').modal('show');
            });
        });
    </script>

</body>

</html>