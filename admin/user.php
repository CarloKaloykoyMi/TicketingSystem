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
    <title>Users</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- datatable css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- icon css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- datatable css -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src='https://kit.fontawesome.com/ddada6a128.js' crossorigin='anonymous'></script>
    <script defer src="js/table.js"></script>


    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="user.css">
</head>

<body>
    <div class="main p-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Users</h4>
                            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>

                            <!-- Filter dropdown -->
                            <div class="dropdown float-end ms-2">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Filter
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                    <li><a class="dropdown-item" href="#" id="filterEmployee">Employee</a></li>
                                    <li><a class="dropdown-item" href="#" id="filterAdmin">Admin</a></li>
                                    <!-- Add more filter options as needed -->
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Company</th>
                                        <th>Branch</th>
                                        <th>Department</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $company = getAll("user");

                                    if (mysqli_num_rows($company) > 0) {
                                        foreach ($company as $item) {
                                    ?>
                                            <tr>
                                                <td><?= $item['lastname']; ?></td>
                                                <td><?= $item['firstname']; ?></td>
                                                <td><?= $item['company']; ?></td>
                                                <td><?= $item['branch']; ?></td>
                                                <td><?= $item['department']; ?></td>
                                                <td><?= $item['email']; ?></td>
                                                <td><?= $item['role'] == 0 ? 'Admin' : 'Employee'; ?></td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="#" class="btn btn-primary" style="width: 80px;" data-bs-toggle="modal" data-bs-target="#editUserModal<?= $item['user_id']; ?>"><i class="fas fa-pencil"></i>&nbsp;Edit</a>
                                                        <button type="button" class="btn btn-sm btn-danger delete_category_btn" value="<?= $item['user_id']; ?>"><i class="fas fa-trash"></i> &nbsp; Delete</button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Edit User Modal -->
                                            <div class="modal fade" id="editUserModal<?= $item['user_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Your edit form content goes here -->
                                                            <form action="code.php" method="POST">
                                                                <input type="hidden" name="user_id" value="<?= $item['user_id']; ?>">

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-user"></i> Last Name</label>
                                                                    <input type="text" name="lastname" value="<?= $item['lastname']; ?>" class="form-control">
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-user"></i> First Name</label>
                                                                    <input type="text" name="firstname" value="<?= $item['firstname']; ?>" class="form-control">
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-user"></i> Middle Initial</label>
                                                                    <input type="text" name="middleinitial" value="<?= $item['middleinitial']; ?>" class="form-control">
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for="company"><i class="fas fa-building"></i> Company</label>
                                                                    <select name="company" class="form-control">
                                                                        <option value="company1" <?= ($item['company'] == 'company1') ? 'selected' : ''; ?>>Company 1</option>
                                                                        <option value="company2" <?= ($item['company'] == 'company2') ? 'selected' : ''; ?>>Company 2</option>
                                                                        <option value="company3" <?= ($item['company'] == 'company3') ? 'selected' : ''; ?>>Company 3</option>
                                                                        <!-- Add more options as needed -->
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for="branch"><i class="fa-solid fa-location-dot"></i> Branch</label>
                                                                    <select name="branch" class="form-control">
                                                                        <option value="branch1" <?= ($item['branch'] == 'branch1') ? 'selected' : ''; ?>>Branch 1</option>
                                                                        <option value="branch2" <?= ($item['branch'] == 'branch2') ? 'selected' : ''; ?>>Branch 2</option>
                                                                        <option value="branch3" <?= ($item['branch'] == 'branch3') ? 'selected' : ''; ?>>Branch 3</option>
                                                                        <!-- Add more options as needed -->
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for="department"><i class="fa-solid fa-users"></i> Department</label>
                                                                    <select name="department" class="form-control">
                                                                        <option value="department1" <?= ($item['department'] == 'department1') ? 'selected' : ''; ?>>Department 1</option>
                                                                        <option value="department2" <?= ($item['department'] == 'department2') ? 'selected' : ''; ?>>Department 2</option>
                                                                        <option value="department3" <?= ($item['department'] == 'department3') ? 'selected' : ''; ?>>Department 3</option>
                                                                        <!-- Add more options as needed -->
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-envelope"></i> Email</label>
                                                                    <input type="email" name="email" value="<?= $item['email']; ?>" class="form-control">
                                                                </div>

                                                                <!-- Add other form fields for editing as needed -->
                                                                <hr>
                                                                <div class="form-group pull-right">
                                                                    <button class="btn btn-primary float-end" type="submit" name="edit_user">Save Changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Edit User Modal -->
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

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="code.php" method="POST">


                        <div class="col-md-12 mt-3">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <i class="fas fa-user input-group-text"></i>
                                </span>
                                <label for="" class="sr-only"> Username</label>
                                <input type="text" name="username" placeholder="Enter Username" class="form-control" required>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <i class="fas fa-user input-group-text"></i>
                                    </span>
                                    <label for="" class="sr-only"> Last Name</label>
                                    <input type="text" name="lastname" placeholder="Enter Last Name" class="form-control" required>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <i class="fas fa-user input-group-text"></i>
                                        </span>
                                        <label for="" class="sr-only"> First Name</label>
                                        <input type="text" name="firstname" placeholder="Enter First Name" class="form-control" required>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <i class="fas fa-user input-group-text"></i>
                                            </span>
                                            <label for="" class="sr-only">Middle Initial</label>
                                            <input type="text" name="middleinitial" placeholder="Enter Middle Initial" class="form-control" required>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <div class="input-group">
                                                <span class="input-group-prepend">

                                                    <i class="fa fa-phone input-group-text"></i>
                                                </span>
                                                <label for="" class="sr-only">Contact Number</label>
                                                <input type="number" name="contact" placeholder="Enter Contact Number" class="form-control" required>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <i class="fas fa-user-friends input-group-text"></i>
                                                    </span>
                                                    <label for="role" class="sr-only">Role</label>
                                                    <select class="form-control" id="role" name="role" required>
                                                        <option value="">Select Role:</option>
                                                        <option value="0">Admin</option>
                                                        <option value="1">Employee</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <i class="fa-solid fa-building input-group-text"></i>
                                                    </span>
                                                    <label for="company" class="sr-only">Company</label>
                                                    <select class="form-control" id="company" name="company" required>
                                                        <option value="">Select Company:</option>
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
                                            </div>


                                            <div class="col-md-12 mt-3">
                                                <div class="form-group" style="display: none;" id="branchGroup">
                                                    <div class="input-group">
                                                        <i class="fa-solid fa-location-dot input-group-text"></i>
                                                        </span>
                                                        <label for="branch" class="sr-only">Branch:</label>
                                                        <select class="form-control" id="branch" name="branch" required>
                                                            <option value="">Select Branch:</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <i class="fa-solid fa-building input-group-text"></i>

                                                    </span>
                                                    <label for="department" class="sr-only">Department:</label>
                                                    <select class="form-control" id="department" name="department" required>
                                                        <option value="">Select Department:</option>
                                                        <?php
                                                        $department = getAll("department");
                                                        if (mysqli_num_rows($department) > 0) {
                                                            foreach ($department as $department) {
                                                        ?>
                                                                <option value="<?= $department['department_name']; ?>"><?= $department['department_name']; ?></option>
                                                        <?php
                                                            }
                                                        } else {
                                                            echo "<option value=''>No Department available</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <i class="fa fa-envelope input-group-text"></i>
                                                    </span>
                                                    <label for="" class="sr-only"> Email</label>
                                                    <input type="email" name="email" placeholder="Enter Email" class="form-control">
                                                </div>


                                                <div class="col-md-12 mt-3">
                                                    <div class="input-group">
                                                        <span class="input-group-prepend">
                                                            <i class="fa fa-lock input-group-text"></i>
                                                        </span>
                                                        <label for="password" class="sr-only"> Password</label>
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fas fa-eye"></i></button>
                                                    </div>
                                                </div>


                                                <hr>
                                                <div class="form-group pull-right">
                                                    <button class="btn btn-primary float-end" type="submit" name="add_user">Submit</button>
                                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/sidebar.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#company').change(function() {
                var companyName = $(this).val();

                $.ajax({
                    url: 'get_branch.php',
                    type: 'POST',
                    data: {
                        company_name: companyName
                    },
                    success: function(response) {
                        console.log(response);
                        $('#branch').html(response);
                        $('#branchGroup').toggle(response.trim() !== '');
                    },
                    error: function() {
                        alert('Error fetching branches.');
                    }
                });
            });
        });
    </script>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePasswordButton = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePasswordButton.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePasswordButton.querySelector('i').classList.toggle('fa-eye');
            togglePasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>



</body>

</html>