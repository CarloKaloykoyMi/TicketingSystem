<?php include('../function/myfunction.php');
include 'sidebar_navbar.php';

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
    <title>Contact Us</title>

    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- datatable css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- icon css -->
    <link rel="stylesheet" href="css/fontawesome/css/all.css">

    <!-- datatable css -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="js/table.js"></script>
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
                                <h4>Contact Us</h4>
                            </div>
                        </div>
                        <div class="card-body" id="category_table">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contact = getAll("contact_us");

                                    if (mysqli_num_rows($contact) > 0) {
                                        foreach ($contact as $item) {
                                    ?>
                                            <tr>
                                                <td><?= $item['first_name'] . ' ' . $item['last_name']; ?></td>
                                                <td><?= $item['phone']; ?></td>
                                                <td><?= $item['email']; ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#infoModal<?= $item['id']; ?>"><i class="fas fa-eye"></i>&nbsp;View</a>
                                                </td>
                                            </tr>

                                            <!-- View Company Modal -->
                                            <div class="modal fade" id="infoModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Contact Us</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Your view form content goes here -->
                                                            <div class="col-md-12 mt-3">
                                                                <label for=""><i class="fas fa-user"></i> Name</label>
                                                                <input type="text" name="name" value="<?= $item['first_name'] . ' ' . $item['last_name']; ?>" class="form-control" disabled>
                                                            </div>

                                                            <div class="col-md-12 mt-3">
                                                                <label for=""><i class="fas fa-phone"></i> Contact</label>
                                                                <input type="text" name="phone" value="<?= $item['phone']; ?>" class="form-control" disabled>
                                                            </div>

                                                            <div class="col-md-12 mt-3">
                                                                <label for=""><i class="fas fa-envelope"></i> Email</label>
                                                                <input type="text" name="email" value="<?= $item['email']; ?>" class="form-control" disabled>
                                                            </div>

                                                            <div class="col-md-12 mt-3">
                                                                <div class="col-md-12 mt-3">
                                                                    <label for="concern"><i class="fas fa-message"></i> Message</label>
                                                                    <textarea class="form-control" name="concern" rows="3" placeholder="Concerns" required disabled><?= $item['message']; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Edit Company Modal -->
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

    <script src="js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="js/sidebar.js"></script>
</body>

</html>