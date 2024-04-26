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
}

$sql = "SELECT * FROM user WHERE user_id = '$user_id';";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
    $fn = $row['firstname'];
    $ml = $row['middleinitial'];
    $ln = $row['lastname'];
    $name = $fn . " " . ($ml ? $ml . ". " : "") . $ln; // check if middle initial is not empty, if not, include it in the name
    $company = $row['company'];
    $branch = $row['branch'];
    $department = $row['department'];
    $contact = $row['contact'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Profile</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- LineIcons -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <!--css -->
    <link rel="stylesheet" href="css/sidebar.css">

</head>
<style>
    /* The message box is shown when the user clicks on the password field */
    #message {
        display: none;
        background: #f1f1f1;
        color: #000;
        position: relative;
        padding: 15px;
        margin-top: 9px;
    }

    #message p {
        padding: 9px 30px;
        font-size: 14px;
    }

    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
        color: green;
    }

    .valid:before {
        position: relative;
        left: -35px;
        content: "✅";
    }

    /*copy & paste symbol*/
    /* Add a red text color and an "x" when the requirements are wrong */
    .invalid {
        color: red;
    }

    .invalid:before {
        position: relative;
        left: -35px;
        content: "❌";
    }
</style>

<body>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Profile Picture</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="code.php" enctype="multipart/form-data">
                        <input type="hidden" name="size" value="1000000">
                        <input type="hidden" name="userid" value=<?= $user_id ?>>
                        <input type="hidden" name="username" value=<?= $username ?>>
                        <input type="file" name="image">
                        <input type="submit" name="upload" value="Upload Image">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="main p-3">
        <div class="container-fluid">
            <main id="main" class="main">
                <section class="section profile">
                    <div class="row">
                        <div class="col-xl-4">

                            <div class="card">
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                    <div class="card" style="width: 15rem; background-color:#555;">
                                        <img src='<?php echo "../Images/" . $user_id . "-" . $username . "/" . $img ?>' class="card-img-top" alt="Profile" style="max-width: 100%; max-height: 220px;">
                                    </div>
                                    <br>
                                    <h3><?php echo $name ?></h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8">

                            <div class="card">
                                <div class="card-body pt-3">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered">

                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                                        </li>

                                    </ul>
                                    <div class="tab-content pt-2">

                                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                            <br>
                                            <h5 class="card-title"><b>Profile Details:</b></h5>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-5 label "><i class="fas fa-user"></i> First Name:</div>
                                                <div class="col-lg-3 col-md-5"><?php echo $fn ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-5 label "><i class="fas fa-user"></i> Middle Initial:</div>
                                                <div class="col-lg-3 col-md-5"><?php echo $ml ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-5 label "><i class="fas fa-user"></i> Last Name:</div>
                                                <div class="col-lg-3 col-md-5"><?php echo $lname ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-5 label"><i class="fas fa-building"></i> Company:</div>
                                                <div class="col-lg-5"><?php echo $company ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-5 label"><i class="fas fa-code-branch"></i> Branch:</div>
                                                <div class="col-lg-3 col-md-5"><?php echo $branch ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-5 label"><i class="fas fa-users"></i> Department:</div>
                                                <div class="col-lg-3 col-md-5"><?php echo $department ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-5 label"><i class="fas fa-phone"></i> Contact Number :</div>
                                                <div class="col-lg-4 col-md-5"><?php echo $contact ?></div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                            <!-- Profile Edit Form -->
                                            <form method="POST" action="code.php">
                                                <div class="row mb-3">
                                                    <label for="profileImage" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-id-badge"></i> Profile Image</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> Change Profile Picture </button>
                                                        <div class="pt-2">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="fullName" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-user"></i> First Name</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <input name="firstName" type="text" class="form-control" id="fullName" value="<?php echo $fn ?>" oninput="restrictToLettersWithSingleSpace(this)" required>
                                                        <span class="note" style="display: none; color: red; font-size: 13px;">Please enter letters only.</span>
                                                        <input type="hidden" name="userid" value="<?= $user_id ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="fullName" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-user"></i> Middle Initial</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <input name="middleInitial" type="text" class="form-control" id="fullName" value="<?php echo $ml ?>" oninput="restrictToLettersWithSingleSpace(this)">
                                                        <span class="note" style="display: none; color: red; font-size: 13px;">Please enter letters only.</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="fullName" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-user"></i> Last Name</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <input name="lastName" type="text" class="form-control" id="fullName" value="<?php echo $ln ?>" oninput="restrictToLettersWithSingleSpace(this)" required>
                                                        <span class="note" style="display: none; color: red; font-size: 13px;">Please enter letters only.</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="company" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-building"></i> Company</label>
                                                    <div class="col-md-8 col-lg">
                                                        <?php
                                                        $companies = getAll("company");

                                                        if ($companies) {
                                                            echo '<select name="company" class="form-control" id="company">';
                                                            foreach ($companies as $row) {
                                                                $selected = ($row['company_name'] == $company) ? 'selected' : '';
                                                                echo '<option value="' . $row['company_name'] . '" ' . $selected . '>' . $row['company_name'] . '</option>';
                                                            }
                                                            echo '</select>';
                                                        } else {
                                                            echo '<p>Error fetching data from the database</p>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="row mb-3" id="branchGroup">
                                                    <label for="branch" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-code-branch"></i> Branch</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <select name="branch" class="form-control" value="<?php echo $branch ?>" id="branch"></select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="department" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-users"></i> Department</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <?php
                                                        $departments = getAll("department");

                                                        if ($departments) {
                                                            echo '<select name="department" class="form-control" id="department">';
                                                            foreach ($departments as $row) {
                                                                $selected = ($row['department_name'] == $department) ? 'selected' : '';
                                                                echo '<option value="' . $row['department_name'] . '" ' . $selected . '>' . $row['department_name'] . '</option>';
                                                            }
                                                            echo '</select>';
                                                        } else {
                                                            echo '<p>Error fetching data from the database</p>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Phone" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-phone"></i> Contact Number</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <input name="phone" type="text" class="form-control" maxlength="11" value="<?php echo $contact ?>" oninput="restrictToNumbers(this)" required>
                                                        <span class="note" style="display: none; color: red; font-size: 13px;">Please enter a valid 11-digit numbers.</span>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Email" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-envelope"></i> Email</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <input name="email" type="email" class="form-control" disabled value="<?php echo $email ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">

                                                    <div class="col-md-8 col-lg-9">

                                                    </div>
                                                </div>

                                                <div class="text-center"> 
                                                        </div>
                                                    </div>
                                                    <div id="message">
                                                        <h6>Password must contain:</h6>
                                                        <p id="letter" class="invalid">At least one letter</p>
                                                        <p id="capital" class="invalid">At least one capital letter</p>
                                                        <p id="number" class="invalid">At least one number</p>
                                                        <p id="special" class="invalid">At least one special character</p>
                                                        <p id="length" class="invalid">Minimum 8 characters</p>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="renewPassword" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-unlock"></i> Re-enter New Password:</label>
                                                    <div class="col-md-5 col-lg-5">
                                                        <div class="input-group">
                                                            <input name="renewpassword" type="password" class="form-control" id="renewPassword" placeholder="Re-enter your new password">
                                                            <button class="btn btn-outline-secondary" type="button" id="toggleRePassword" style="height: 38px;"><i class="fas fa-eye"></i></button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <input type="hidden" name="userid" value="<?= $userid ?>">
                                                    <button type="submit" name="ChangePassword" class="btn btn-primary">Change Password</button>
                                                </div>
                                            </form><!-- End Change Password Form -->

                                        </div>

                                    </div><!-- End Bordered Tabs -->

                                </div>
                            </div>

                        </div>
                    </div>
                </section>

            </main>

        </div>
    </div>

    <!-- Bootstrap and custom scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/sidebar.js"></script>

    <script>
        $(document).ready(function() {
            $('#company').change(function() {
                var companyName = $(this).val();

                $.ajax({
                    url: 'get_branches.php',
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
        var myInput = document.getElementById("password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            var specialCharacters = /[!@#$%^&*(),.?\:{}|<>]/g;
            if (myInput.value.match(specialCharacters)) {
                special.classList.remove("invalid");
                special.classList.add("valid");
            } else {
                special.classList.remove("valid");
                special.classList.add("invalid");
            }

            // Validate length
            if (myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }
    </script>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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

    <script>
        const toggleConfirmPasswordButton = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('confirmPassword');

        toggleConfirmPasswordButton.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            toggleConfirmPasswordButton.querySelector('i').classList.toggle('fa-eye');
            toggleConfirmPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>

    <script>
        document.getElementById('toggleRePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('renewPassword');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>

</body>

</html>