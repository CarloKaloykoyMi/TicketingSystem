<?php include('function/myfunction.php');
include 'sidebar_navbar.php';
include('crud.php');

if (!isset($_SESSION['auth_user']['username'])) {
    session_destroy();
    unset($_SESSION['auth_user']['username']);
    unset($_SESSION['auth_user']['user_id']);
    unset($_SESSION['auth_user']['email']);
    unset($_SESSION['auth_user']['role']);
    unset($_SESSION['auth_user']['lastname']);
    unset($_SESSION['auth_user']['firstname']);
    echo '<script>window.location.href = "emplogin.php";</script>';
} else {
    $username = $_SESSION['auth_user']['username'];
    $userid = $_SESSION['userid'];
    $email = $_SESSION['auth_user']['email'];
    $role = $_SESSION['auth_user']['role'];
    $lname = $_SESSION['auth_user']['lastname'];
    $fname = $_SESSION['auth_user']['firstname'];
}

$sql = "SELECT * FROM user WHERE user_id = '$userid';";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
    $fn = $row['firstname'];
    $ml = $row['middleinitial'];
    $ln = $row['lastname'];
    $name = $fn . " " . $ml . ". " . $ln;
    $company = $row['company'];
    $branch = $row['branch'];
    $department = $row['department'];
    $contact = $row['contact'];
    $img = $row['image'];
}

$atsql = "SELECT * FROM audit_trail WHERE user_id = '$userid' ORDER BY `Date` desc";
$atresult= mysqli_query($con, $atsql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Edit Profile </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- datatable css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- icon css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <!-- datatable css -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="js/table.js"></script>
    <link rel="stylesheet" href="css/sidebar_navbar.css">
</head>
<style>
    body h2 {
        font-family: "Arial", sans-serif;
    }

    .container {
        margin-top: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-width: 800px;
        /* Increased max-width for better spacing */
        margin: 0 auto;
        /* Center the container */
    }

    label {
        margin-top: 10px;
        margin-bottom: 5px;
        color: #555;
    }

    input {
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        width: 100%;
    }

    button {
        background-color: #007BFF;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        background-color: #0056b3;
    }

    .logs-container {
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        .nav-tabs-bordered .nav-link:hover {
        background-color: #007bff; /* Replace with your preferred color */
        color: #fff; /* Text color on hover */
    }
</style>
</head>

<body>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Profile Picture</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="crud.php" enctype="multipart/form-data">
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
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
            <script src="js/sidebar.js"></script>

            <main id="main" class="main">
                <section class="section profile">
                    <div class="row">
                        <div class="col-xl-4">

                            <div class="card">
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                    <div class="card" style="width: 15rem;">
                                    <img src='<?php echo "Images/". $user_id."-".$username. "/" . $img ?>' class="card-img-top" alt="Profile" style="max-width: 100%; max-height: 220px;">
                                    </div>
                                    <h2><?php echo $name ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8">

                            <div class="card">
                                <div class="card-body pt-3">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered">

                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
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
                                            <h5 class="card-title"><b>Profile Details: ></b></h5>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-5 label "><i class="fas fa-user"></i> First Name:</div>
                                                <div class="col-lg-3 col-md-5"><?php echo $fname ?></div>
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
                                                <div class="col-lg-3 col-md-5"><?php echo $company ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-5 label"><i class="fas fa-location-dot"></i> Branch:</div>
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
                                            <form method="POST" action="crud.php">
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
                                                        <input name="firstName" type="text" class="form-control" id="fullName" value="<?php echo $fn ?>">
                                                        <input type="hidden" name="userid" value="<?=$userid ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="fullName" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-user"></i> Middle Initial</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <input name="middleInitial" type="text" class="form-control" id="fullName" value="<?php echo $ml ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="fullName" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-user"></i> Last Name</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <input name="lastName" type="text" class="form-control" id="fullName" value="<?php echo $ln ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="fullName" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-building"></i> Company</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <input name="company" type="text" class="form-control" id="fullName" value="<?php echo $company ?>">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Job" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-location-dot"></i> Branch</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <input name="job" type="text" class="form-control" id="Job" value="<?php echo $branch ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Address" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-users"></i> Department</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <input name="address" type="text" class="form-control" id="Address" value="<?php echo $department ?>">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Phone" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-phone"></i> Contact Number</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <input name="phone" type="text" class="form-control" id="Phone" value="<?php echo $contact ?>">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Email" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-envelope"></i> Email</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <input name="email" type="email" class="form-control" id="Email" value="<?php echo $email ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    
                                                    <div class="col-md-8 col-lg-9">
                                        
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <button type="submit" name="saveChanges" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form><!-- End Profile Edit Form -->

                                        </div>

                                        <div class="tab-pane fade pt-3" id="profile-settings">

                                            <!-- Settings Form -->
                                            <form>
                                        <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form><!-- End settings Form -->

                                        </div>

                                        <div class="tab-pane fade pt-3" id="profile-change-password">
                                            <!-- Change Password Form -->
                                            <form>

                                                <div class="row mb-3">
                                                    <label for="currentPassword" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-lock"></i> Current Password:</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <input name="password" type="password" class="form-control" id="currentPassword">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="newPassword" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-key"></i> New Password:</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="renewPassword" class="col-md-4 col-lg-4 col-form-label"><i class="fas fa-unlock"></i> Re-enter New Password:</label>
                                                    <div class="col-md-8 col-lg-8">
                                                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Change Password</button>
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

</body>

<!-- User Logs Section -->
<div class="logs-container mt-4" style="padding: 10px;">
    <h3>User Action Logs</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Action</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody id="userLogs">
            <?php
        while ($atrow = mysqli_fetch_array($atresult)) {
    $action = $atrow['Action'];
    $date = $atrow['Date'];

    echo "<tr>
            <td>$action</td>
            <td>$date</td>
          </tr>";
}

echo '    </tbody>
    </table>
</div>';?>

    <!-- Bootstrap and custom scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/sidebar.js"></script>
    </body>
</html>