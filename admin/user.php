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
    <title>Users</title>

    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.css">


    <!-- datatable css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

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
                            <h4 class="text-center">Users</h4>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fas fa-plus"></i>&nbsp;Add User</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
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
                                        $user = getAll("user");

                                        if (mysqli_num_rows($user) > 0) {
                                            foreach ($user as $item) {
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
                                                                        <input type="text" name="lastname" value="<?= $item['lastname']; ?>" class="form-control" required>
                                                                    </div>

                                                                    <div class="col-md-12 mt-3">
                                                                        <label for=""><i class="fas fa-user"></i> First Name</label>
                                                                        <input type="text" name="firstname" value="<?= $item['firstname']; ?>" class="form-control" required>
                                                                    </div>

                                                                    <div class="col-md-12 mt-3">
                                                                        <label for=""><i class="fas fa-user"></i> Middle Initial</label>
                                                                        <input type="text" name="middleinitial" value="<?= $item['middleinitial']; ?>" class="form-control">
                                                                    </div>

                                                                    <div class="col-md-12 mt-3">
                                                                        <label for="company"><i class="fas fa-building"></i> Company</label>
                                                                        <select name="company" id="company_edit" class="form-control">
                                                                            <?php
                                                                            $companies = getAll("company");

                                                                            foreach ($companies as $company) {
                                                                                $selected = ($item['company'] == $company['company_name']) ? 'selected' : '';
                                                                                echo '<option value="' . $company['company_name'] . '" ' . $selected . '>' . $company['company_name'] . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-12 mt-3">
                                                                        <label for="department"><i class="fas fa-users"></i> Department</label>
                                                                        <select name="department" class="form-control">
                                                                            <?php
                                                                            $departments = getAll("department");

                                                                            foreach ($departments as $department) {
                                                                                $selected = ($item['department'] == $department['department_name']) ? 'selected' : '';
                                                                                echo '<option value="' . $department['department_name'] . '" ' . $selected . '>' . $department['department_name'] . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select>
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
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <i class="fas fa-user input-group-text"></i>
                                </span>
                                <label for="" class="sr-only"> Last Name</label>
                                <input type="text" name="lastname" placeholder="Enter Last Name" id="lastNameInput" class="form-control" oninput="restrictToLettersWithSingleSpace(this)" required>
                                <span class="note" style="display: none; color: red;">Please enter letters only.</span>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <i class="fas fa-user input-group-text"></i>
                                </span>
                                <label for="" class="sr-only"> First Name</label>
                                <input type="text" name="firstname" placeholder="Enter First Name" id="firstNameInput" class="form-control" oninput="restrictToLettersWithSingleSpace(this)" required>
                                <span class="note" style="display: none; color: red;">Please enter letters only.</span>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <i class="fas fa-user input-group-text"></i>
                                </span>
                                <label for="" class="sr-only">Middle Initial</label>
                                <input type="text" name="middleinitial" id="middleNameInput" placeholder="Enter Middle Initial" class="form-control">
                                <span class=" note" style="display: none; color: red;">Please enter letters only.</span>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <i class="fas fa-user input-group-text"></i>
                                </span>
                                <label for="" class="sr-only">Suffix</label>
                                <input type="text" name="suffix" placeholder="Enter Suffix" class="form-control">
                                <span class=" note" style="display: none; color: red;">Please enter letters only.</span>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <i class="fas fa-address-book input-group-text"></i>
                                </span>
                                <label for="" class="sr-only">Contact Number</label>
                                <input type="text" name="contact" id="phoneNumberInput" placeholder="Enter Contact Number" oninput="restrictToNumbers(this)" class="form-control" required>
                                <span class="note" style="display: none; color: red;">Please enter a valid 11-digit numbers.</span>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <i class="fas fa-user input-group-text"></i>
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
                                    <i class="fas fa-building input-group-text"></i>
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
                                    <i class="fas fa-building input-group-text"></i>
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
                                    <i class="fas fa-building input-group-text"></i>

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
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <i class="fas fa-eye-slash input-group-text"></i>
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

    <script src="js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/sidebar.js"></script>


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

    <script>
        function restrictToLettersWithSingleSpace(input) {
            var lastNameNote = input.parentNode.querySelector('.note');
            var inputValue = input.value;

            // Replace multiple spaces with a single space
            inputValue = inputValue.replace(/  +/g, ' ');

            // Remove any non-letter characters except spaces
            var lettersOnly = inputValue.replace(/[^A-Za-zñÑ ]/g, '');

            if (inputValue !== lettersOnly && inputValue.trim() !== '') {
                lastNameNote.style.display = 'block';
            } else {
                lastNameNote.style.display = 'none';
            }

            input.value = lettersOnly;
        }
    </script>

    <script>
        function restrictToNumbers(input) {
            var phoneNumberNote = input.parentNode.querySelector('.note');
            var inputValue = input.value;
            var numbersOnly = inputValue.replace(/[^0-9]/g, '').slice(0, 11);

            if (inputValue !== numbersOnly || inputValue.length !== 11) {
                phoneNumberNote.style.display = 'block';
            } else {
                phoneNumberNote.style.display = 'none';
            }

            input.value = numbersOnly;
        }
    </script>
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