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
    <title>Resolved</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <!-- css -->
    <link rel="stylesheet" href="css/sidebar_navbar.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- jQuery and DataTables JavaScript -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>




    <script defer src="script.js"></script>
    <style>
        .rating-css div {
            color: #ffe400;
        }

        .rating-css input {
            display: none;
        }

        .rating-css input+label {
            font-size: 60px;
            text-shadow: 60px;
            cursor: pointer;
        }

        .rating-css input:checked+label~label {
            color: #838383;
        }

        .rating-css label:active {
            transform: scale(0.8);
            transition: 0.3s ease;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="main p-3">
            <div class="container-fluid">
                <div class="container">
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <button class="nav-link " disabled data-bs-toggle="tab" data-bs-target="#admin-audit"></button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#admin-audit">Rate As Requestor</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#user-audit">Rate as Resolver</button>
                        </li>

                    </ul>
                </div>
                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="admin-audit">
                        <div class="card-body">
                            <div class="tab-content mt-3">
                                <div class="tab-pane fade show active" id="resolved">
                                    <table id="example1" class="table table-responsive table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">Ticket ID</th>
                                                <th scope="col">Requestor</th>
                                                <th scope="col">To Department</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date Created</th>
                                                <th class="text-center">Resolved by</th>
                                                <th class="text-center">Resolved date</th>
                                                <th class="text-center">Rating</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ticketsql = "SELECT * FROM ticket WHERE user_id ='$userid' AND status='Resolved';";
                                            $ticket = mysqli_query($con, $ticketsql);

                                            if (mysqli_num_rows($ticket) > 0) {
                                                $counter = 1;
                                                foreach ($ticket as $item) {
                                                    $status = $item['status'];

                                                    $resolved_by_query = "SELECT t.*, u.firstname, u.lastname, u.user_id  FROM ticket t INNER JOIN user u ON t.updated_by = u.user_id  WHERE t.ticket_id = " . $item['ticket_id'];
                                                    $resolved_result = mysqli_query($con, $resolved_by_query);
                                                    $resolved_row = mysqli_fetch_assoc($resolved_result);
                                            ?>
                                                    <tr>
                                                        <td><u><a href="ticket_info.php?ticket_id=<?= $item['ticket_id']; ?>" class="text-body fw-bold">Ticket #<?= $item['ticket_id']; ?></a></u></td>
                                                        <td><?= $item['requestor']; ?></td>
                                                        <td><?= $item['to_dept']; ?></td>
                                                        <td class="text-justify"><?= $item['subject']; ?></td>
                                                        <td class="text-center">
                                                            <span class="badge text-bg-success"><?= $status; ?></span>
                                                        </td>
                                                        <td class="text-center"><?= date('F j, Y h:i A', strtotime($item['date_created'])); ?></td>
                                                        <td class="text-center">
                                                            <?= (!empty($resolved_row['firstname']) && !empty($resolved_row['lastname'])) ? $resolved_row['firstname'] . ' ' . $resolved_row['lastname'] : ''; ?>
                                                        </td>
                                                        <td class="text-center"><?php if (!empty($item['updated_date'])) {
                                                                                    echo date('F j, Y h:i A', strtotime($item['updated_date']));
                                                                                } ?></td>
                                                        <td class="text-center">
                                                            <?php
                                                            $rating_query = "SELECT * FROM rating WHERE ticket_id = {$item['ticket_id']}";
                                                            $rating_result = mysqli_query($con, $rating_query);

                                                            // Check if there's a record in the rating table
                                                            if (mysqli_num_rows($rating_result) > 0) {
                                                                // Show "View" button modal
                                                                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal' . $item['ticket_id']  . '"><i class="fa-solid fa-eye"></i> View</button>';
                                                            } else {
                                                                // Show "Rate" button modal
                                                                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rateModal' . $item['ticket_id']  . '"> <i class="fa-solid fa-star"></i> Rate</button>';
                                                            }
                                                            ?>
                                                        </td>

                                                        <!-- View Modal -->
                                                        <div class="modal fade" id="viewModal<?= $item['ticket_id'] ?>" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="viewModalLabel">View Modal</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Add content for view modal here -->
                                                                        This is the content of the view modal.
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Rate Modal -->
                                                        <div class="modal fade" id="rateModal<?= $item['ticket_id'] ?>" tabindex="-1" aria-labelledby="rateModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="rateModalLabel">Rate Modal</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Rating form -->
                                                                        <form action="crud.php" method="post">
                                                                            <div class="form-group">
                                                                                <label for="rating">Rating: <?= $item['ticket_id'] ?></label><br>
                                                                                <!-- Star rating input -->
                                                                                <div class="rating-css">
                                                                                    <!-- Adjust the radio button IDs and labels accordingly -->
                                                                                    <div class="star-icon">
                                                                                        <input type="radio" name="rating" id="rating<?= $counter; ?>_1" value="1">
                                                                                        <label for="rating<?= $counter; ?>_1" class="fa fa-star"></label>
                                                                                        <input type="radio" name="rating" id="rating<?= $counter; ?>_2" value="2">
                                                                                        <label for="rating<?= $counter; ?>_2" class="fa fa-star"></label>
                                                                                        <input type="radio" name="rating" id="rating<?= $counter; ?>_3" value="3">
                                                                                        <label for="rating<?= $counter; ?>_3" class="fa fa-star"></label>
                                                                                        <input type="radio" name="rating" id="rating<?= $counter; ?>_4" value="4">
                                                                                        <label for="rating<?= $counter; ?>_4" class="fa fa-star"></label>
                                                                                        <input type="radio" name="rating" id="rating<?= $counter; ?>_5" value="5">
                                                                                        <label for="rating<?= $counter; ?>_5" class="fa fa-star"></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="mb-3">
                                                                                    <label for="comment" class="form-label" style="text-align: left;">Comment:</label>
                                                                                    <textarea id="comment" class="form-control" name="comment" id="exampleModal" rows="3"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <input type="text" name="resolver_id" value="<?= $resolved_row['user_id']; ?>">
                                                                            <input type="text" name="ticket_id" value="<?= $item['ticket_id']; ?>">
                                                                            <input type="text" name="requestor_id" value="<?= $item['user_id']; ?>">
                                                                            <button type="submit" name="rate_requestor" class="btn btn-primary" style="margin-left: 350px;">Submit</button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    // Increment the counter
                                                    $counter++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="user-audit">
                        <div class="card-body">
                            <div class="tab-content mt-3">
                                <div class="tab-pane fade show active" id="resolved">
                                    <table id="example2" class="table table-responsive table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">Ticket ID</th>
                                                <th scope="col">Requestor</th>
                                                <th scope="col">To Department</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date Created</th>
                                                <th class="text-center">Resolved by</th>
                                                <th class="text-center">Resolved date</th>
                                                <th class="text-center">Rating</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ticketsql = "SELECT * FROM ticket WHERE updated_by ='$userid' AND status='Resolved';";
                                            $ticket = mysqli_query($con, $ticketsql);

                                            if (mysqli_num_rows($ticket) > 0) {
                                                $counter = 1;
                                                foreach ($ticket as $item) {
                                                    $status = $item['status'];

                                                    $resolved_by_query = "SELECT t.*, u.firstname, u.lastname, u.user_id  FROM ticket t INNER JOIN user u ON t.updated_by = u.user_id  WHERE t.ticket_id = " . $item['ticket_id'];
                                                    $resolved_result = mysqli_query($con, $resolved_by_query);
                                                    $resolved_row = mysqli_fetch_assoc($resolved_result);
                                            ?>
                                                    <tr>
                                                        <td><u><a href="ticket_info.php?ticket_id=<?= $item['ticket_id']; ?>" class="text-body fw-bold">Ticket #<?= $item['ticket_id']; ?></a></u></td>
                                                        <td><?= $resolved_row['requestor']; ?></td>
                                                        <td><?= $item['to_dept']; ?></td>
                                                        <td class="text-justify"><?= $item['subject']; ?></td>
                                                        <td class="text-center">
                                                            <span class="badge text-bg-success"><?= $status; ?></span>
                                                        </td>
                                                        <td class="text-center"><?= date('F j, Y h:i A', strtotime($item['date_created'])); ?></td>
                                                        <td class="text-center">
                                                            <?= (!empty($resolved_row['firstname']) && !empty($resolved_row['lastname'])) ? $resolved_row['firstname'] . ' ' . $resolved_row['lastname'] : ''; ?>
                                                        </td>
                                                        <td class="text-center"><?php if (!empty($item['updated_date'])) {
                                                                                    echo date('F j, Y h:i A', strtotime($item['updated_date']));
                                                                                } ?></td>
                                                        <td class="text-center">
                                                            <?php
                                                            $rating_query = "SELECT * FROM rating WHERE ticket_id = {$item['ticket_id']}";
                                                            $rating_result = mysqli_query($con, $rating_query);

                                                            // Check if there's a record in the rating table
                                                            if (mysqli_num_rows($rating_result) > 0) {
                                                                // Show "View" button modal
                                                                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal1' . $item['ticket_id']  . '"><i class="fa-solid fa-eye"></i> View</button>';
                                                            } else {
                                                                // Show "Rate" button modal
                                                                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rateModal1' . $item['ticket_id']  . '"> <i class="fa-solid fa-star"></i> Rate</button>';
                                                            }
                                                            ?>
                                                            <!-- View Modal -->
                                                            <div class="modal fade" id="viewModal1<?= $item['ticket_id'] ?>" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="viewModalLabel">View Modal</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Add content for view modal here -->
                                                                            This is the content of the view modal.
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Rate Modal -->
                                                            <div class="modal fade" id="rateModal1<?= $item['ticket_id'] ?>" tabindex="-1" aria-labelledby="rateModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="rateModalLabel">Rate Modal</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Rating form -->
                                                                            <form action="crud.php" method="post">
                                                                                <div class="form-group">
                                                                                    <label for="rating">Rating:</label><br>
                                                                                    <!-- Star rating input -->
                                                                                    <div class="rating-css">
                                                                                        <!-- Adjust the radio button IDs and labels accordingly -->
                                                                                        <div class="star-icon">
                                                                                            <input type="radio" name="rating" id="rating<?= $counter; ?>_1" value="1">
                                                                                            <label for="rating1<?= $counter; ?>_1" class="fa fa-star"></label>
                                                                                            <input type="radio" name="rating" id="rating<?= $counter; ?>_2" value="2">
                                                                                            <label for="rating1<?= $counter; ?>_2" class="fa fa-star"></label>
                                                                                            <input type="radio" name="rating" id="rating<?= $counter; ?>_3" value="3">
                                                                                            <label for="rating1<?= $counter; ?>_3" class="fa fa-star"></label>
                                                                                            <input type="radio" name="rating" id="rating<?= $counter; ?>_4" value="4">
                                                                                            <label for="rating1<?= $counter; ?>_4" class="fa fa-star"></label>
                                                                                            <input type="radio" name="rating" id="rating<?= $counter; ?>_5" value="5">
                                                                                            <label for="rating1<?= $counter; ?>_5" class="fa fa-star"></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="mb-3">
                                                                                        <label for="comment" class="form-label" style="text-align: left;">Comment:</label>
                                                                                        <textarea id="comment" class="form-control" name="comment" id="exampleModal" rows="3"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="text" name="resolver_id" value="<?= $resolved_row['user_id']; ?>">
                                                                                <input type="text" name="ticket_id" value="<?= $item['ticket_id']; ?>">
                                                                                <input type="text" name="requestor_id" value="<?= $item['user_id']; ?>">
                                                                                <button type="submit" name="rate_requestor" class="btn btn-primary" style="margin-left: 350px;">Submit</button>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    // Increment the counter
                                                    $counter++;
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
        </div>
    </div>


    <!-- Add Bootstrap JS script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/sidebar.js"></script>


    <script>
        $(document).ready(function() {
            // Initialize DataTable for the first table
            $('#example1').DataTable();

            // Initialize DataTable for the second table
            $('#example2').DataTable();
        });
    </script>

</body>

</html>