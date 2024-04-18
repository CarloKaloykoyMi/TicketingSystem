<?php
include('../function/myfunction.php');
include 'sidebar_navbar.php';
$ticket = getAll("ticket");

if (!isset($_SESSION['auth_user']['username'])) {
    session_destroy();
    unset($_SESSION['auth_user']['username']);
    unset($_SESSION['auth_user']['user_id']);
    unset($_SESSION['auth_user']['email']);
    unset($_SESSION['auth_user']['role']);
    unset($_SESSION['auth_user']['fname']);
    unset($_SESSION['auth_user']['lname']);
    echo '<script>window.location.href = "../adminlogin.php";</script>';
} else {
    $username = $_SESSION['auth_user']['username'];
    $user_id = $_SESSION['auth_user']['user_id'];
    $email = $_SESSION['auth_user']['email'];
    $role = $_SESSION['auth_user']['role'];
    $lname = $_SESSION['auth_user']['lastname'];
    $fname = $_SESSION['auth_user']['firstname'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Lineicons CSS -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <!-- Your existing CSS -->
    <link rel="stylesheet" href="css/sidebar.css">

    <!-- jQuery and DataTables JavaScript -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="js/table.js"></script>

</head>

<body>
    <div class="main p-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">Ticket List</h4>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th>Ticket ID</th>
                                        <th class="text-center">Requestor</th>
                                        <th class="text-center">Assigned<br>Department</th>
                                        <th class="text-center">Subject</th>
                                        <th class="text-center">Status</th>
                                        <!-- <th class="text-center">Date Created</th>
                            <th class="text-center">Updated by</th>
                            <th class="text-center">Updated Date</th>
                            <th class="text-center">Reason</th> -->
                                        <th class="text-center">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ticket = getAll("ticket");

                                    if (mysqli_num_rows($ticket) > 0) {
                                        foreach ($ticket as $item) {
                                            $updated_by = "SELECT t.*, u.firstname, u.lastname 
                      FROM ticket t 
                      INNER JOIN user u ON t.updated_by = u.user_id 
                      WHERE t.ticket_id = " . $item['ticket_id'];
                                            $updated_by_result = mysqli_query($con, $updated_by);
                                            $updatedby_result = mysqli_fetch_assoc($updated_by_result);
                                    ?>
                                            <tr>
                                                <td><u><a href="ticket_info.php?ticket_id=<?php echo $item['ticket_id']; ?>" class="text-body fw-bold">ITR -<?php echo $item['ticket_id']; ?></a></u></td>
                                                <td><?= $item['requestor']; ?></td>
                                                <td class="text-center"><?= $item['to_dept']; ?></td>
                                                <td class="text-justify"><?= $item['subject']; ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    $status = $item['status'];

                                                    if ($status == 'Pending') {
                                                        echo '<span class="badge text" style="background-color: #F7E1A1; color: black">' . $status . '</span>';
                                                    } elseif ($status == 'Resolved') {
                                                        echo '<span class="badge text" style="background-color: #BBDABB; color: black">' . $status . '</span>';
                                                    } elseif ($status == 'Cancelled') {
                                                        echo '<span class="badge text" style="background-color: #FF6961; color: black">' . $status . '</span>';
                                                    } else {
                                                        echo '<span class="badge text" style="background-color: #A1C1DF; color: black">' . $status . '</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#infoModal<?= $item['ticket_id']; ?>">
                                                        <i class="fas fa-eye"></i>&nbsp;View
                                                    </a>
                                                </td>
                                            </tr>

                                            <!-- View Modal -->
                                            <div class="modal fade" id="infoModal<?= $item['ticket_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Ticket Information</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Your view form content goes here -->
                                                            <div class="col-md-12 mt-3">
                                                                <label for=""><i class="fas fa-envelope"></i> Updated by</label>
                                                                <input type="text" name="email" value="<?= (!empty($updatedby_result['firstname']) && !empty($updatedby_result['lastname'])) ? (($updatedby_result['status'] == 'Resolved') ? 'Resolved by ' . $updatedby_result['firstname'] . ' ' . $updatedby_result['lastname'] : (($updatedby_result['status'] == 'Unresolved') ? 'Unresolved by ' . $updatedby_result['firstname'] . ' ' . $updatedby_result['lastname'] : '')) : '';
                                                                                                        if ($status == 'Cancelled') {
                                                                                                            echo 'Cancelled by ' . $item['updated_by'];
                                                                                                        } ?>" class="form-control" disabled>
                                                            </div>

                                                            <div class="col-md-12 mt-3">
                                                                <div class="col-md-12 mt-3">
                                                                    <label for="concern"><i class="fas fa-message"></i> Reason</label>
                                                                    <textarea class="form-control" name="concern" rows="3" required disabled><?= $item['reason']; ?></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mt-3">
                                                                <label for=""><i class="fas fa-user"></i> Date Created</label>
                                                                <input type="text" name="name" value="<?= date('F j, Y h:i A', strtotime($item['date_created'])) ?>" class="form-control" disabled>
                                                            </div>

                                                            <?php if (!empty($item['updated_date'])) { ?>
                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-envelope"></i> Updated Date</label>
                                                                    <input type="text" name="email" value="<?= date('F j, Y h:i A', strtotime($item['updated_date'])); ?>" class="form-control" disabled>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-clock"></i> Ticket Duration</label>
                                                                    <?php
                                                                    // Calculate time difference
                                                                    $createdTimestamp = strtotime($item['date_created']);
                                                                    $updatedTimestamp = strtotime($item['updated_date']);
                                                                    $timeDifference = $updatedTimestamp - $createdTimestamp;

                                                                    // Calculate days, hours, and minutes
                                                                    $days = floor($timeDifference / (60 * 60 * 24));
                                                                    $remainingHours = $timeDifference % (60 * 60 * 24);
                                                                    $hours = floor($remainingHours / (60 * 60));
                                                                    $remainingMinutes = $remainingHours % (60 * 60);
                                                                    $minutes = floor($remainingMinutes / 60);

                                                                    // Construct the time difference string
                                                                    if ($days > 0) {
                                                                        $timeDifferenceStr = $days . ' days ' . $hours . ' hours ' . $minutes . ' minutes';
                                                                    } else {
                                                                        $timeDifferenceStr = $hours . ' hours ' . $minutes . ' minutes';
                                                                    }
                                                                    ?>

                                                                    <input type="text" name="time_difference" value="<?= $timeDifferenceStr; ?>" class="form-control" disabled>

                                                                </div>
                                                            <?php } else { ?>
                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-envelope"></i> Updated Date</label>
                                                                    <input type="text" name="email" value="" class="form-control" disabled>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-clock"></i> Time Difference</label>
                                                                    <input type="text" name="time_difference" value="" class="form-control" disabled>
                                                                </div>
                                                            <?php } ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
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
</body>

</html>