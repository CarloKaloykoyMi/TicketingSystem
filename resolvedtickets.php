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
    <!-- css -->
    <link rel="stylesheet" href="css/sidebar_navbar.css">
    <!-- bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- icons -->
    <link rel="stylesheet" href="css/lineicons.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- jQuery and DataTables JavaScript -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="script.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>

    <style>
        .rating {
            display: flex;
            flex-direction: row-reverse;
            /* Start from right to left */
            justify-content: flex-end;
        }

        .rating input {
            display: none;
        }

        .rating label {
            font-size: 30px;
            cursor: pointer;
        }

        .rating label.fa-star:before {
            content: '\2605';
            /* Unicode character for star */
            color: #838383;
            /* Default color for blank stars */
        }

        .rating input:checked~label.fa-star:before {
            color: #ffe400;
            /* Color when clicked */
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="main p-3">
            <div class="container-fluid">
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#admin-audit">Rate Resolver</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#user-audit">Rate Requestor</button>
                    </li>

                </ul>
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
                                                        <td><u><a href="ticket_info.php?ticket_id=<?= $item['ticket_id']; ?>" class="text-body fw-bold">ITR -<?= $item['ticket_id']; ?></a></u></td>
                                                        <td><?= $item['requestor'] ?></td>
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
                                                        <td>
                                                            <?php
                                                            $rating_query = "SELECT * FROM rating WHERE ticket_id = {$item['ticket_id']}";
                                                            $rating_result = mysqli_query($con, $rating_query);

                                                            // Check if there's a record in the rating table
                                                            if (mysqli_num_rows($rating_result) > 0) {
                                                                // Show "View" or "Rate" button modal
                                                                $viewsql = "SELECT * FROM rating WHERE ticket_id = {$item['ticket_id']} AND requestor_rating IS NOT NULL";
                                                                $viewresult = mysqli_query($con, $viewsql);
                                                                if (mysqli_num_rows($viewresult) > 0) {
                                                                    echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal' . $item['ticket_id'] . '"><i class="fa-solid fa-eye"></i> View</button>';
                                                                } else {
                                                                    echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rateModal' . $item['ticket_id'] . '"> <i class="fa-solid fa-star"></i> Rate</button>';
                                                                }
                                                            } else {
                                                                // Show "Rate" button modal
                                                                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rateModal' . $item['ticket_id'] . '"> <i class="fa-solid fa-star"></i> Rate</button>';
                                                            }

                                                            ?>
                                                            <!-- View Modal -->
                                                            <div class="modal fade" id="viewModal<?= $item['ticket_id'] ?>" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="viewModalLabel">View</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?php
                                                                            // Fetch the rating from the rating table
                                                                            $rating_query = "SELECT * FROM rating WHERE ticket_id = {$item['ticket_id']}";
                                                                            $rating_result = mysqli_query($con, $rating_query);

                                                                            // Check if there's a record in the rating table
                                                                            if (mysqli_num_rows($rating_result) > 0) {
                                                                                // Fetch the rating value
                                                                                $rating_row = mysqli_fetch_assoc($rating_result);
                                                                                $rating = $rating_row['requestor_rating'];
                                                                                $feedback = $rating_row['requestor_comment'];

                                                                                // Display the rating with stars
                                                                                echo '<div class="mb-3">';
                                                                                echo '<label for="formGroupExampleInput" class="form-label">Rating:</label>';
                                                                                echo '<div class="form-control" disabled>';
                                                                                for ($i = 1; $i <= 5; $i++) {
                                                                                    if ($i <= $rating) {
                                                                                        echo '<i class="fa fa-star" style="color: yellow;"></i>';
                                                                                    } else {
                                                                                        echo '<i class="fa fa-star-o" style="color: yellow;"></i>';
                                                                                    }
                                                                                }
                                                                                echo '</div>';
                                                                                echo '</div>';
                                                                                

                                                                                echo '<div class="mb-3">';
                                                                                echo '<label for="formGroupExampleInput" class="form-label">Feedback:</label>';
                                                                                echo '<input type="text" class="form-control" id="formGroupExampleInput" value="' . $feedback . '" disabled>';
                                                                                echo '</div>';
                                                                            } else {
                                                                                echo "No rating available";
                                                                            }
                                                                            ?>
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
                                                                            <h5 class="modal-title" id="rateModalLabel">Rate</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Rating form -->
                                                                            <form action="crud.php" method="post">
                                                                                <div class="form-group">
                                                                                    <label for="rating">Please Rate Resolver: <?= $resolved_row['firstname'] . ' ' . $resolved_row['lastname']; ?> </label>
                                                                                    <div class="rating-css">
                                                                                        <div class="star-icon">
                                                                                            <div class="rating">
                                                                                                <input type="radio" name="rating" id="rating<?= $counter; ?>_5" value="5">
                                                                                                <label for="rating<?= $counter; ?>_5" class="fa fa-star"></label>
                                                                                                <input type="radio" name="rating" id="rating<?= $counter; ?>_4" value="4">
                                                                                                <label for="rating<?= $counter; ?>_4" class="fa fa-star"></label>
                                                                                                <input type="radio" name="rating" id="rating<?= $counter; ?>_3" value="3">
                                                                                                <label for="rating<?= $counter; ?>_3" class="fa fa-star"></label>
                                                                                                <input type="radio" name="rating" id="rating<?= $counter; ?>_2" value="2">
                                                                                                <label for="rating<?= $counter; ?>_2" class="fa fa-star"></label>
                                                                                                <input type="radio" name="rating" id="rating<?= $counter; ?>_1" value="1">
                                                                                                <label for="rating<?= $counter; ?>_1" class="fa fa-star"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div><br>
                                                                                <div class="form-group">
                                                                                    <div class="mb-3">
                                                                                        <label for="comment" class="form-label" style="text-align: left;">Comment:</label>
                                                                                        <textarea id="comment" class="form-control" name="comment" id="exampleModal" rows="3"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" name="resolver_id" value="<?= $resolved_row['user_id']; ?>">
                                                                                <input type="hidden" name="ticket_id" value="<?= $item['ticket_id']; ?>">
                                                                                <input type="hidden" name="requestor_id" value="<?= $item['user_id']; ?>">

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" name="rate_resolver" class="btn btn-primary">Submit</button>
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                </div>
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
                                                    <td><u><a href="ticket_info.php?ticket_id=<?= $item['ticket_id']; ?>" class="text-body fw-bold">ITR -<?= $item['ticket_id']; ?></a></u></td>
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
                                                    <td>
                                                        <?php
                                                        $rating_query = "SELECT * FROM rating WHERE ticket_id = {$item['ticket_id']}";
                                                        $rating_result = mysqli_query($con, $rating_query);

                                                        // Check if there's a record in the rating table
                                                        if (mysqli_num_rows($rating_result) > 0) {
                                                            // Show "View" button modal
                                                            $viewsql = "SELECT * FROM rating WHERE ticket_id = {$item['ticket_id']} AND resolver_rating IS NOT NULL";
                                                            $viewresult = mysqli_query($con, $viewsql);
                                                            if (mysqli_num_rows($viewresult) > 0) {
                                                                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal1' . $item['ticket_id']  . '"><i class="fa-solid fa-eye"></i> View</button>';
                                                            } else {
                                                                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rateModal1' . $item['ticket_id']  . '"> <i class="fa-solid fa-star"></i> Rate</button>';
                                                            }
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
                                                                        <h5 class="modal-title" id="viewModalLabel">View</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <?php
                                                                        // Fetch the rating from the rating table
                                                                        $rating_query = "SELECT * FROM rating WHERE ticket_id = {$item['ticket_id']}";
                                                                        $rating_result = mysqli_query($con, $rating_query);

                                                                        // Check if there's a record in the rating table
                                                                        if (mysqli_num_rows($rating_result) > 0) {
                                                                            // Fetch the rating value
                                                                            $rating_row = mysqli_fetch_assoc($rating_result);
                                                                            $rating = $rating_row['resolver_rating'];
                                                                            $feedback = $rating_row['resolver_comment'];

                                                                            // Display the rating with stars
                                                                            echo '<div class="mb-3">';
                                                                            echo '<label for="formGroupExampleInput" class="form-label">Rating:</label>';
                                                                            echo '<div class="form-control" disabled>';
                                                                            for ($i = 1; $i <= 5; $i++) {
                                                                                if ($i <= $rating) {
                                                                                    echo '<i class="fa fa-star"></i>';
                                                                                } else {
                                                                                    echo '<i class="fa fa-star-o"></i>';
                                                                                }
                                                                            }
                                                                            echo '</div>';
                                                                            echo '</div>';

                                                                            echo '<div class="mb-3">';
                                                                            echo '<label for="formGroupExampleInput" class="form-label">Feedback:</label>';
                                                                            echo '<input type="text" class="form-control" id="formGroupExampleInput" value="' . $feedback . '" disabled>';
                                                                            echo '</div>';
                                                                        } else {
                                                                            echo "No rating available";
                                                                        }
                                                                        ?>
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
                                                                        <h5 class="modal-title" id="rateModalLabel">Rate</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Rating form -->
                                                                        <form action="crud.php" method="post">
                                                                            <div class="form-group">
                                                                                <label for="rating">Please Rate:</label>
                                                                                <div class="rating-css">
                                                                                    <div class="star-icon">
                                                                                        <div class="rating">
                                                                                            <input type="radio" name="rating" id="rating<?= $item['ticket_id']; ?>_5" value="5">
                                                                                            <label for="rating<?= $item['ticket_id']; ?>_5" class="fa fa-star"></label>
                                                                                            <input type="radio" name="rating" id="rating<?= $item['ticket_id']; ?>_4" value="4">
                                                                                            <label for="rating<?= $item['ticket_id']; ?>_4" class="fa fa-star"></label>
                                                                                            <input type="radio" name="rating" id="rating<?= $item['ticket_id']; ?>_3" value="3">
                                                                                            <label for="rating<?= $item['ticket_id']; ?>_3" class="fa fa-star"></label>
                                                                                            <input type="radio" name="rating" id="rating<?= $item['ticket_id']; ?>_2" value="2">
                                                                                            <label for="rating<?= $item['ticket_id']; ?>_2" class="fa fa-star"></label>
                                                                                            <input type="radio" name="rating" id="rating<?= $item['ticket_id']; ?>_1" value="1">
                                                                                            <label for="rating<?= $item['ticket_id']; ?>_1" class="fa fa-star"></label>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div><br>
                                                                            <div class="form-group">
                                                                                <div class="mb-3">
                                                                                    <label for="comment" class="form-label" style="text-align: left;">Comment:</label>
                                                                                    <textarea id="comment" class="form-control" name="comment" id="exampleModal" rows="3"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" name="resolver_id" value="<?= $resolved_row['user_id']; ?>">
                                                                            <input type="hidden" name="ticket_id" value="<?= $item['ticket_id']; ?>">
                                                                            <input type="hidden" name="requestor_id" value="<?= $item['user_id']; ?>">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" name="rate_requestor" class="btn btn-primary" style="margin-left: 350px;">Submit</button>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        </form>
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
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



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