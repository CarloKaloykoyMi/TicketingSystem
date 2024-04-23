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
    <script defer src="script.js"></script>

</head>

<body>
    <div class="main p-3">
        <div class="container-fluid">
            <h3>
                <center>Resolved List</center>
            </h3>
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#resolved">Resolved Tickets</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#un-resolved">Unresolved</button>
                    </li>
                </ul>

                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="resolved">
                        <table id="example" class="table table-striped" style="width:100%">
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
                                $ticket = getResolvedStatus();

                                if (mysqli_num_rows($ticket) > 0) {
                                    foreach ($ticket as $item) {
                                        $status = $item['status'];

                                        $resolved_by_query = "SELECT t.*, u.firstname, u.lastname  FROM ticket t INNER JOIN user u ON t.updated_by = u.user_id  WHERE t.ticket_id = " . $item['ticket_id'];
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
                                                <!-- Button to trigger rating modal -->
                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#infoModal<?= $item['ticket_id']; ?>">
                                                    <i class="fa-solid fa-star"></i>&nbsp;Rate
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Modal for rating -->
                                        <div class="modal fade" id="infoModal<?= $item['ticket_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Rating</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Rating form -->
                                                        <form action="submit_rating.php" method="post">
                                                            <div class="form-group">
                                                                <label for="rating">Rating:</label><br>
                                                                <!-- Star rating input -->
                                                                <div class="rating">
                                                                    <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 star"></label>
                                                                    <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 stars"></label>
                                                                    <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 stars"></label>
                                                                    <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 stars"></label>
                                                                    <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 stars"></label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="comment">Comment:</label><br>
                                                                <!-- Text area for comment -->
                                                                <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
                                                            </div>
                                                            <input type="hidden" name="ticket_id" value="<?= $item['ticket_id']; ?>">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            <style>
                                                                /* Hide the radio buttons */
                                                                .rating input[type="radio"] {
                                                                    display: none;
                                                                }

                                                                /* Define the star symbols */
                                                                .rating label:before {
                                                                    content: "\2605";
                                                                    font-size: 2em;
                                                                    color: #ddd;
                                                                    transition: color 0.3s;
                                                                }

                                                                /* Style for the selected (checked) stars */
                                                                .rating input[type="radio"]:checked~label:before {
                                                                    color: #ffcc00;
                                                                    /* Change to desired color */
                                                                }

                                                                /* Align the stars horizontally */
                                                                .rating label {
                                                                    display: inline-block;
                                                                    margin-right: 5px;
                                                                }
                                                            </style>
                                                        </form>
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
                    <div class="tab-pane fade show" id="un-resolved">
                        <table id="example" class="table table-striped" style="width:100%">
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
                                $ticket = getUnresolvedStatus();

                                if (mysqli_num_rows($ticket) > 0) {
                                    foreach ($ticket as $item) {
                                        $status = $item['status'];

                                        $resolved_by_query = "SELECT t.*, u.firstname, u.lastname  FROM ticket t INNER JOIN user u ON t.updated_by = u.user_id  WHERE t.ticket_id = " . $item['ticket_id'];
                                        $resolved_result = mysqli_query($con, $resolved_by_query);
                                        $resolved_row = mysqli_fetch_assoc($resolved_result);
                                ?>
                                        <tr>
                                            <td><u><a href="ticket_info.php?ticket_id=<?= $item['ticket_id']; ?>" class="text-body fw-bold">Ticket #<?= $item['ticket_id']; ?></a></u></td>
                                            <td><?= $item['requestor']; ?></td>
                                            <td><?= $item['to_dept']; ?></td>
                                            <td class="text-justify"><?= $item['subject']; ?></td>
                                            <td class="text-center">
                                                <span class="badge text-bg-primary"><?= $status; ?></span>
                                            </td>
                                            <td class="text-center"><?= date('F j, Y h:i A', strtotime($item['date_created'])); ?></td>
                                            <td class="text-center">
                                                <?= (!empty($resolved_row['firstname']) && !empty($resolved_row['lastname'])) ? $resolved_row['firstname'] . ' ' . $resolved_row['lastname'] : ''; ?>
                                            </td>
                                            <td class="text-center"><?php if (!empty($item['updated_date'])) {
                                                                        echo date('F j, Y h:i A', strtotime($item['updated_date']));
                                                                    } ?></td>
                                            <td class="text-center">
                                                <!-- Button to trigger rating modal -->
                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#infoModal<?= $item['ticket_id']; ?>">
                                                    <i class="fa-solid fa-star"></i>&nbsp;Rate
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Modal for rating -->
                                        <div class="modal fade" id="infoModal<?= $item['ticket_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Rating</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Rating form -->
                                                        <form action="submit_rating.php" method="post">
                                                            <div class="form-group">
                                                                <label for="rating">Rating:</label><br>
                                                                <!-- Star rating input -->
                                                                <div class="rating">
                                                                    <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 star"></label>
                                                                    <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 stars"></label>
                                                                    <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 stars"></label>
                                                                    <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 stars"></label>
                                                                    <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 stars"></label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="comment">Comment:</label><br>
                                                                <!-- Text area for comment -->
                                                                <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
                                                            </div>
                                                            <input type="hidden" name="ticket_id" value="<?= $item['ticket_id']; ?>">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </form>
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

    <!-- Add Bootstrap JS script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/sidebar.js"></script>



</body>

</html>