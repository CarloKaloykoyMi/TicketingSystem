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
<title>Branch</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- datatable css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- icon css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

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
                            <h4>Branches</h4>
                            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addBranchModal">Add Branch</button>
                        </div>
                        <div class="card-body" id="category_table">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Branch Name</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $branch = getAll("branch");

                                    if (mysqli_num_rows($branch) > 0) {
                                        foreach ($branch as $item) {
                                    ?>
                                            <tr>
                                                <td><?= $item['company']; ?></td>
                                                <td><?= $item['branch_name']; ?></td>
                                                <td><?= $item['contact']; ?></td>
                                                <td><?= $item['email']; ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editBranchModal<?= $item['id']; ?>"><i class="fas fa-pencil"></i>&nbsp;Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#branchDepartmentModal<?= $item['id']; ?>">
                                                        <i class="fas fa-trash"></i>&nbsp;Delete
                                                    </a>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="branchDepartmentModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Department</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this Branch?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <form action="code.php" method="POST">
                                                                <input type="hidden" name="branch_id" value="<?= $item['id']; ?>">
                                                                <button type="submit" class="btn btn-danger" name="delete_branch">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Edit Company Modal -->
                                            <div class="modal fade" id="editBranchModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Company</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Your edit form content goes here -->
                                                            <form action="code.php" method="POST">
                                                                <input type="hidden" name="branch_id" value="<?= $item['id']; ?>">

                                                                <div class="col-md-12 mt-3">
                                                                    <label for="company_name" class="form-label"> <i class="fa-solid fa-location-dot"></i> Company</label>
                                                                    <select id=company_name name="company_name" class="form-control">
                                                                        <option value="<?= $item['company']; ?>"><?= $item['company']; ?></option>
                                                                        <?php
                                                                        $company = getAll("company");
                                                                        if (mysqli_num_rows($company) > 0) {
                                                                            foreach ($company as $company) {
                                                                        ?>
                                                                                <option value="<?= $company['company_name']; ?>"><?= $company['company_name']; ?></option>
                                                                        <?php
                                                                            }
                                                                        } else {
                                                                            echo "<option value=''>No Company available</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-building"></i> Branch Name</label>
                                                                    <input type="text" name="branch_name" value="<?= $item['branch_name']; ?>" class="form-control">
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fa-solid fa-location-dot"></i> Branch Address</label>
                                                                    <input type="text" name="branch_address" value="<?= $item['branch_address']; ?>" class="form-control">
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fa-solid fa-phone"></i> Contact</label>
                                                                    <input type="text" name="contact" value="<?= $item['contact']; ?>" class="form-control">
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-envelope"></i> Email</label>
                                                                    <input type="text" name="email" value="<?= $item['email']; ?>" class="form-control">
                                                                </div>

                                                                <!-- Add other form fields for editing as needed -->
                                                                <hr>
                                                                <div class="form-group pull-right">
                                                                    <button class="btn btn-primary float-end" type="submit" name="edit_branch">Save
                                                                        Changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Edit Company Modal -->

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


    <div class="modal fade" id="addBranchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="code.php" method="POST">

                        <div class="col-md-12 mt-3">
                            <label for="company_name" class="form-label"> <i class="fa-solid fa-location-dot"></i> Company</label>
                            <select id=company_name name="company_name" class="form-control" required>
                                <option value="" disabled selected>Select your Company</option>
                                <?php
                                $company = getAll("company");
                                if (mysqli_num_rows($company) > 0) {
                                    foreach ($company as $company) {
                                ?>
                                        <option value="<?= $company['company_name']; ?>"><?= $company['company_name']; ?></option>
                                <?php
                                    }
                                } else {
                                    echo "<option value=''>No Company available</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for=""><i class="fas fa-building"></i> Branch Name</label>
                            <input type="text" name="branch_name" placeholder="Enter Branch Name" class="form-control" required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for=""><i class="fa-solid fa-location-dot"></i> Branch Address</label>
                            <input type="text" name="branch_address" placeholder="Enter Branch Address" class="form-control" required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for=""><i class="fa-solid fa-phone"></i> Contact</label>
                            <input type="text" name="contact" placeholder="Enter Contact" class="form-control" required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for=""><i class="fas fa-envelope"></i> Email</label>
                            <input type="text" name="email" placeholder="Enter Email" class="form-control" required>
                        </div>

                        <hr>
                        <div class="form-group pull-right">
                            <button class="btn btn-primary float-end" type="submit" name="add_branch">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/sidebar.js"></script>

    <script>
        $(".btn-primary").click(function() {
            $("#myModal").modal("show");
        });
    </script>
</body>

</html>