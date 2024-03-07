<?php include('../function/myfunction.php');
include('sidebar_navbar.php');
include('mysql_connect.php');

if (!isset($_SESSION['auth_user']['username'])) {
    session_destroy();
    unset($_SESSION['auth_user']['username']);
    unset($_SESSION['auth_user']['user_id']);
    unset($_SESSION['auth_user']['email']);
    unset($_SESSION['auth_user']['role']);
    unset($_SESSION['auth_user']['lastname']);
    unset($_SESSION['auth_user']['firstname']);
    echo '<script>window.location.href = "../adminlogin.php";</script>';
} else {
    $username = $_SESSION['auth_user']['username'];
    $user_id = $_SESSION['auth_user']['user_id'];
    $email = $_SESSION['auth_user']['email'];
    $role = $_SESSION['auth_user']['role'];
    $lname = $_SESSION['auth_user']['lastname'];
    $fname = $_SESSION['auth_user']['firstname'];
}

$sql = "SELECT COUNT(*) AS ticket_count FROM ticket";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ticketCount = $row["ticket_count"];
} else {
    $ticketCount = 0;
}
// --------------------------------------------------------------------------------------------
// Count of tickets with status "Pending"
$sql = "SELECT COUNT(DISTINCT ticket_id) AS pending_count FROM ticket WHERE status = 'Pending'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pendingCount = $row["pending_count"];
} else {
    $pendingCount = 0;
}
// --------------------------------------------------------------------------------------------
// Count of tickets with status "Resolved"
$sql = "SELECT COUNT(DISTINCT ticket_id) AS resolved_count FROM ticket WHERE status = 'Resolved'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $resolvedCount = $row["resolved_count"];
} else {
    $resolvedCount = 0;
}
// --------------------------------------------------------------------------------------------
// Count of tickets with status "Unresolved"
$sql = "SELECT COUNT(DISTINCT ticket_id) AS Unresolved_count FROM ticket WHERE status = 'Unresolved'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $unresolvedCount = $row["Unresolved_count"];
} else {
    $unresolvedCount = 0;
}

// ---------------------------------------------------------------------------------------------
// Fetch data from the database
$query = "SELECT status, COUNT(*) as count FROM ticket GROUP BY status";
$result = mysqli_query($con, $query);

// Prepare data for the chart
$labels = [];
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['status'];
    $data[] = $row['count'];
}

// ----------------------------------------------------------------------------------------------
// Fetch data for "Pending" tickets from the database
$query1 = "SELECT status, COUNT(*) as count FROM ticket WHERE status = 'Pending'";
$result1 = mysqli_query($con, $query1);

// Prepare data for the chart
$labels1 = ['Pending']; // You only have one label for "Pending" status
$data1 = [];

if ($row1 = mysqli_fetch_assoc($result1)) {
    $data1[] = $row1['count'];
}

// Fetch data for "Resolved" and "Unresolved" tickets from the database
$query = "SELECT status, COUNT(*) as count FROM ticket WHERE status IN ('Resolved', 'Unresolved') GROUP BY status";
$result = mysqli_query($con, $query);

// Prepare data for the chart
$labels2 = [];
$data2 = [];

while ($row = mysqli_fetch_assoc($result)) {
    $labels2[] = $row['status'];
    $data2[] = $row['count'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/sidebar.css">
    <title>Dashboard</title>
</head>

<body>


    <div class="main p-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Dashboard</h4>
                        </div>
                        <br>
                        <h2>&nbsp; Welcome, <?php echo $fname . " " . $lname; ?>!</h2>

                        <p>&nbsp;&nbsp;&nbsp;&nbsp;This dashboard provides you with tools to manage tickets, users, and system settings efficiently.</p>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card widget-card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title"><i class="fas fa-info-circle"></i> Total Tickets</h5>
                                            <p><?php echo $ticketCount; ?> Tickets</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card widget-card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title"><i class="fa-solid fa-triangle-exclamation"></i> Pending Tickets</h5>
                                            <p><?php echo $pendingCount; ?> Tickets</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card widget-card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title"><i class="fa-solid fa-check"></i> Resolved Tickets</h5>
                                            <p><?php echo $resolvedCount; ?> Tickets</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card widget-card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title"><i class="fa-solid fa-spinner"></i> UnResolved Tickets</h5>
                                            <p><?php echo $unresolvedCount; ?> Tickets</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </center>
                    </div>
                    <br>
                    <div class="row">
                        <!-- Total Tickets Chart -->
                        <div class="col-md-4">
                            <div class="card widget-card">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-info-circle"></i> Total Tickets</h5>
                                    <canvas id="ticketChart" width="200" height="200"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Ticket Status Chart -->
                        <div class="col-md-4">
                            <div class="card widget-card">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fa-solid fa-ticket"></i> Ticket Status</h5>
                                    <canvas id="ticketStatusChart" width="200" height="200"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Tickets Chart -->
                        <div class="col-md-4">
                            <div class="card widget-card">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fa-solid fa-triangle-exclamation"></i> Pending Tickets</h5>
                                    <canvas id="pendingTicketsChart" width="200" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Additional Content -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4>Recent Tickets</h4>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Ticket ID</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $recent = getRecent();
                                    if (mysqli_num_rows($recent) > 0) {
                                        foreach ($recent as $item) {
                                    ?>
                                            <tr>
                                                <td>Ticket #<?= $item['ticket_id']; ?></td>
                                                <td><?= $item['subject']; ?></td>
                                                <td><?= $item['status']; ?></td>
                                            </tr>
                                </tbody>
                        <?php
                                        }
                                    }
                        ?>
                            </table>
                        </div>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
                    <script src="js/sidebar.js"></script>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <!-- Add JavaScript to create the chart -->
                    <script>
                        var ctx = document.getElementById('ticketChart').getContext('2d');
                        var ticketChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: <?php echo json_encode($labels); ?>,
                                datasets: [{
                                    label: 'Ticket Status',
                                    data: <?php echo json_encode($data); ?>,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>

                    <!-- Add JavaScript to create the chart -->
                    <script>
                        var ctx = document.getElementById('pendingTicketsChart').getContext('2d');
                        var pendingTicketsChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: <?php echo json_encode($labels1); ?>,
                                datasets: [{
                                    label: 'Pending Tickets',
                                    data: <?php echo json_encode($data1); ?>,
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Customize the color as needed
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>

                    <script>
                        var ctx = document.getElementById('ticketStatusChart').getContext('2d');
                        var ticketStatusChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: <?php echo json_encode($labels2); ?>,
                                datasets: [{
                                    data: <?php echo json_encode($data2); ?>,
                                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'], // Customize colors as needed
                                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true
                            }
                        });
                    </script>




                    <script>
                        $(".btn-primary").click(function() {
                            $("#myModal").modal("show");
                        });
                    </script>

                    <script>
                        // Sample data for the chart
                        var ticketStatusData = {
                            labels: ["Resolved", "Pending"],
                            datasets: [{
                                data: [120, 20],
                                backgroundColor: ["#28a745", "#ffc107"],
                            }],
                        };

                        var ticketStatusOptions = {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                display: false,
                            },
                        };

                        // Create and render the chart
                        var ctx = document.getElementById("ticketStatusChart").getContext("2d");
                        var ticketStatusChart = new Chart(ctx, {
                            type: "doughnut",
                            data: ticketStatusData,
                            options: ticketStatusOptions,
                        });
                    </script>
</body>

</html>