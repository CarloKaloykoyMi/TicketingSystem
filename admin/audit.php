<?php
include('../function/myfunction.php');
include 'sidebar_navbar.php';

// Check if user is not authenticated, then redirect to login page
if (!isset($_SESSION['auth_user']['username'])) {
    session_destroy();
    echo '<script>window.location.href = "../adminlogin.php";</script>';
    exit; // Exit after redirection
} else {
    // Initialize session variables
    $username = $_SESSION['auth_user']['username'];
    $user_id = $_SESSION['auth_user']['user_id'];
    $email = $_SESSION['auth_user']['email'];
    $role = $_SESSION['auth_user']['role'];
    $lname = $_SESSION['auth_user']['lastname']; // Changed 'lastname' to 'lname'
    $fname = $_SESSION['auth_user']['firstname']; // Changed 'firstname' to 'fname'
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Trail</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/fontawesome/css/all.css">

    <!-- datatable css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- datatable css -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script defer src="js/table.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/sidebar.css">
</head>

<body>
    <div class="main p-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                <h4>Audit Trail</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#admin-audit">Admin Logs</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#user-audit">User Logs</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#delete-audit">Delete Logs</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#ticket-delete">Ticket Deleted</button>
                                </li>
                            </ul>

                            <div class="tab-content mt-3">
                                <div class="tab-pane fade show active" id="admin-audit">
                                    <table id="adminTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Action</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $adminlogs = "SELECT audit_trail.user_id, audit_trail.Action, audit_trail.Date, CONCAT(user.lastname, ', ', user.firstname) AS NAME, user.role FROM audit_trail JOIN user ON audit_trail.user_id = user.user_id WHERE user.role = 0 ORDER BY audit_trail.Date DESC";
                                            $adminlogsResult = mysqli_query($con, $adminlogs);
                                            while ($row1 = mysqli_fetch_assoc($adminlogsResult)) {
                                                echo "<tr>";
                                                echo "<td>" . $row1['NAME'] . "</td>";
                                                echo "<td>" . $row1['Action'] . "</td>";
                                                echo "<td>" . date('F j, Y g:i A', strtotime($row1['Date'])) . "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="user-audit">
                                    <table id="userTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Action</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $userlogs = "SELECT audit_trail.user_id, audit_trail.Action, audit_trail.Date, CONCAT(user.lastname, ', ', user.firstname) AS NAME, user.role FROM audit_trail JOIN user ON audit_trail.user_id = user.user_id WHERE user.role = 1 ORDER BY audit_trail.Date DESC";
                                            $userlogsResult = mysqli_query($con, $userlogs);
                                            while ($row2 = mysqli_fetch_assoc($userlogsResult)) {
                                                echo "<tr>";
                                                echo "<td>" . $row2['NAME'] . "</td>";
                                                echo "<td>" . $row2['Action'] . "</td>";
                                                echo "<td>" . date('F j, Y g:i A', strtotime($row2['Date'])) . "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="delete-audit">
                                    <table id="deleteTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Action</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $deleteLogs = "SELECT audit_trail.user_id, audit_trail.Action, audit_trail.Date, CONCAT(user.lastname, ', ', user.firstname) AS NAME FROM audit_trail JOIN user ON audit_trail.user_id = user.user_id WHERE audit_trail.Action LIKE '%deletion%' ORDER BY audit_trail.Date DESC";
                                            $deleteLogsResult = mysqli_query($con, $deleteLogs);
                                            while ($row3 = mysqli_fetch_assoc($deleteLogsResult)) {
                                                echo "<tr>";
                                                echo "<td>" . $row3['NAME'] . "</td>";
                                                echo "<td>" . $row3['Action'] . "</td>";
                                                echo "<td>" . date('F j, Y g:i A', strtotime($row3['Date'])) . "</td>"; // Changed $row2 to $row3
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="ticket-delete">
                                    <table id="ticketdeleteTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Action</th>
                                                <th>Reason</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $deleteLogs = "SELECT audit_trail.user_id, audit_trail.Action, audit_trail.delete_reason, audit_trail.Date, CONCAT(user.lastname, ', ', user.firstname) AS NAME FROM audit_trail JOIN user ON audit_trail.user_id = user.user_id WHERE audit_trail.Action = 'Ticket Deletion' ORDER BY audit_trail.Date DESC";
                                            $deleteLogsResult = mysqli_query($con, $deleteLogs);
                                            while ($row3 = mysqli_fetch_assoc($deleteLogsResult)) {
                                                echo "<tr>";
                                                echo "<td>" . $row3['NAME'] . "</td>";
                                                echo "<td>" . $row3['Action'] . "</td>";
                                                echo "<td>" . $row3['delete_reason'] . "</td>";
                                                echo "<td>" . date('F j, Y g:i A', strtotime($row3['Date'])) . "</td>"; // Changed $row2 to $row3
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Add more tab panes if needed -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="js/sidebar.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable for Admin Table
            $('#adminTable').DataTable({
                "order": [
                    [2, "desc"]
                ],
                "columnDefs": [{
                    "targets": [2],
                    "render": function(data, type, row) {
                        var date = new Date(data);
                        return formatDate(date);
                    },
                    "type": "date"
                }]
            });

            // Initialize DataTable for User Table
            $('#userTable').DataTable({
                "order": [
                    [2, "desc"]
                ],
                "columnDefs": [{
                    "targets": [2],
                    "render": function(data, type, row) {
                        var date = new Date(data);
                        return formatDate(date);
                    },
                    "type": "date"
                }]
            });

            // Initialize DataTable for Delete Table
            $('#deleteTable').DataTable({
                "order": [
                    [2, "desc"]
                ],
                "columnDefs": [{
                    "targets": [2],
                    "render": function(data, type, row) {
                        var date = new Date(data);
                        return formatDate(date);
                    },
                    "type": "date"
                }]
            });
            $('#ticketdeleteTable').DataTable({
                "order": [
                    [2, "desc"]
                ],
                "columnDefs": [{
                    "targets": [3],
                    "render": function(data, type, row) {
                        var date = new Date(data);
                        return formatDate(date);
                    },
                    "type": "date"
                }]
            });
        });

        // Function to format date as "Month Day, Year Time"
        function formatDate(date) {
            var options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            var formattedDate = date.toLocaleDateString('en-US', options);
            // Remove the "at" substring
            formattedDate = formattedDate.replace(" at", "");
            return formattedDate;
        }
    </script>

</body>

</html>