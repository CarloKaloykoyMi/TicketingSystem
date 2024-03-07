
<?php
include('function/myfunction.php');
include 'sidebar_navbar.php';
include('crud.php');

if (!isset($_SESSION['auth_user']['username'])) {
    session_destroy();
    unset($_SESSION['auth_user']['username']);
    unset($_SESSION['userid']);
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
    $fromcompany = $_SESSION['auth_user']['company'];
    $fromdept = $_SESSION['auth_user']['department'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/sidebar_navbar.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- jQuery and DataTables JavaScript -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="script.js"></script>
    <title>Home</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
    .btn-custom {
        background-color: #333333;
        color: #ffffff;
        transition: color 0.3s;
    }

    .btn-custom:hover {
        color: #ffffff;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
    .btn-custom:hover {
        background-color: gray;
        color: #fff;
        /* Set the desired text color for hover state */
    }

    .sender {
        color: black;
        /* Set text color */
        padding: 5px;
        /* Add padding for better appearance */
        margin: 10px;
        border-radius: 5px;
        /* Add border-radius for rounded corners */
        display: inline-block;
        /* Make it an inline block to fit content */
    }

    .icon-container {
        background-color: #6c757d;
        /* Set background color */
        color: #fff;
        /* Set text color */
        padding: 10px;
        /* Add padding for better appearance */
        border-radius: 7px;
        /* Add border-radius for rounded corners */
        margin-right: 3px;
        /* Add margin for spacing */
    }
</style>

<body>
    <div class="main p-3">
        <div class="container-fluid">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
            <script src="js/sidebar.js"></script> <br>
            <div class="container1">
                <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#myModal" style="position: absolute; top: 70px; right: 10px;">Create Ticket</button>
                <h3>
                    <center>Overall Ticket List </center>
                </h3>
                <table id="example" class="table table-responsive hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Ticket ID</th>
                            <th class="text-center">Requestor</th>
                            <th class="text-center">To Department</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ticket = getTicket("ticket", $userid);

                        if (mysqli_num_rows($ticket) > 0) {
                            foreach ($ticket as $item) {
                        ?>
                                <tr>
                                    <td><u><a href="ticket_info.php?ticket_id=<?php echo $item['ticket_id']; ?>" class="text-body fw-bold">Ticket #<?php echo $item['ticket_id']; ?></a></u></td>
                                    <td><?= $item['requestor']; ?></td>
                                    <td><?= $item['to_dept']; ?></td>
                                    <td class="text-justify"><?= $item['subject']; ?></td>
                                    <td class="text-center">
                                        <?php
                                        $status = $item['status'];

                                        if ($status == 'Pending') {
                                            echo '<span class="badge text-bg-warning">' . $status . '</span>';
                                        } elseif ($status == 'Resolved') {
                                            echo '<span class="badge text-bg-success">' . $status . '</span>';
                                        } elseif ($status == 'Cancelled') {
                                            echo '<span class="badge text-bg-danger">' . $status . '</span>';
                                        } else {
                                            echo '<span class="badge text-bg-primary">' . $status . '</span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center"><?= date('F j, Y h:i:s A', strtotime($item['date_created'])); ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "No Records Found!";
                        }
                        ?>
                    </tbody>


                </table>
            </div>

            <div class="modal fade" id="myModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fas fa-ticket"></i> Submit a Ticket</h4>
                        </div>
                        <div class="modal-body">
                            <form action="crud.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <h5>
                                        <div class="sender">
                                            SENDER:
                                        </div>
                                        <div class="input-group">
                                            <span class="icon-container">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                                            <input type="hidden" name="email" value="<?php echo $email; ?>">

                                            <label for="requestor" class="sr-only">Requestor</label>
                                            <input type="text" class="form-control" name="requestor" placeholder="Requestor" value="<?php echo $fname . ' ' . $lname; ?>" readonly>
                                        </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="icon-container">
                                            <i class="fa-solid fa-file"></i>
                                        </span>
                                        <label for="subject" class="sr-only">Subject</label>
                                        <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                                    </div>
                                </div>
                                <br>

                                <div class="input-group">
                                    <span class="icon-container">
                                        <i class="fa-solid fa-building"></i>
                                    </span>
                                    <label for="company" class="sr-only">Company</label>
                                    <input type="text" class="form-control" name="fromcompany" value="<?php echo $fromcompany; ?>" disabled required>
                                </div>

                                <br>
                                <div class="input-group">
                                    <span class="icon-container">
                                        <i class="fa-solid fa-building"></i>
                                    </span>
                                    <label for="deparment" class="sr-only">Deparment</label>
                                    <input type="text" class="form-control" name="fromDeparment" value="<?php echo $fromdept; ?>" disabled required>
                                </div>

                                <br>
                                <h5>
                                    <div class="sender">
                                        RECEIVER:
                                    </div>
                                    <div class="input-group">
                                        <span class="icon-container">
                                            <i class="fa-solid fa-building"></i>
                                        </span>
                                        <label for="company" class="sr-only">Company</label>
                                        <select class="form-control" name="company" required>
                                            <option value=""> To Company:</option>
                                            <?php
                                            $companies = getAll("company");
                                            if (mysqli_num_rows($companies) > 0) {
                                                foreach ($companies as $company) {
                                            ?>
                                                    <option value="<?= $company['company_name']; ?>"><?= $company['company_name']; ?></option>
                                            <?php
                                                }
                                            } else {
                                                echo "<option value=''>No Company available</option>";
                                            }
                                            ?>
                                        </select>
                                    </div> <br>
                                    <div class="input-group">
                                        <span class="icon-container">
                                            <i class="fa-solid fa-building"></i>

                                        </span>
                                        <label for="department" class="sr-only">Department</label>
                                        <select class="form-control" name="todepartment" required>
                                            <option value="" data-icon="fas fa-users">To Department:</option>
                                            <?php
                                            $departments = getAll("department");
                                            if (mysqli_num_rows($departments) > 0) {
                                                foreach ($departments as $department) {
                                            ?>
                                                    <option value="<?= $department['department_name']; ?>" data-icon="fas fa-users"><?= $department['department_name']; ?></option>
                                            <?php
                                                }
                                            } else {
                                                echo "<option value='' data-icon='fas fa-users'>No Department available</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="icon-container">
                                                <i class="fa-solid fa-comment-alt"></i>
                                            </span>
                                            <label for="concerns" class="sr-only">Concerns/Questions/Inquiries:</label>
                                            <textarea class="form-control" name="concern" rows="4" placeholder="Concerns" required></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="icon-container">
                                                <i class="fa fa-chain">&nbsp;</i>
                                            </span>

                                            <!-- File input -->
                                            <label for="file" class="sr-only">Attach File:</label>
                                            <input type="file" id="example-fileinput" class="form-control" name="files[]" multiple>
                                        </div>
                                        <div id="image-preview">
                                            <img id="preview-image" src="img/empty.png" height="200" alt="Image Preview">
                                        </div>
                                    </div>
                        
                        <div class="modal-footer">
                            <button type="submit" name="add_ticket" class="btn btn-success" style="background-color: #6C757D;">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        const fileInput = document.getElementById('example-fileinput');
        const imagePreview = document.getElementById('image-preview');

        fileInput.addEventListener('change', function() {
            imagePreview.innerHTML = ''; // Clear previous previews

            const files = this.files;

            for (const file of files) {
                const reader = new FileReader();

                reader.addEventListener('load', function() {
                    if (file.type === 'application/pdf' || file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || file.type === 'application/vnd.openxmlformats-officedocument.presentationml.presentation') {
                        // If file is pdf, docx, or ppt, display only the filename
                        const filenameElement = document.createElement('p');
                        filenameElement.textContent = file.name;
                        imagePreview.appendChild(filenameElement);
                    } else if (file.type.startsWith('image/')) {
                        // If file is an image, display the preview
                        const imgElement = document.createElement('img');
                        imgElement.src = reader.result;
                        imgElement.height = 200;
                        imgElement.alt = 'Image Preview';
                        imagePreview.appendChild(imgElement);
                    }
                });

                if (file.type === 'application/pdf' || file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || file.type === 'application/vnd.openxmlformats-officedocument.presentationml.presentation') {
                    reader.readAsDataURL(new Blob([file.name]));
                } else {
                    reader.readAsDataURL(file);
                }
            }
        });
    </script>

</body>

</html>