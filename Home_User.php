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
    <!-- css -->
    <link rel="stylesheet" href="css/sidebar_navbar.css">
    <!-- bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- icons -->
    <link rel="stylesheet" href="css/lineicons.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- jQuery and DataTables JavaScript -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="script.js"></script>
    <title>Home</title>
</head>
<style>
    .btn-custom {
        background-color: #333333;
        color: #ffffff;
        transition: color 0.3s;
    }

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

    .table th:nth-child(7),
    .table td:nth-child(7) .table th:nth-child(9),
    .table td:nth-child(9) {
        white-space: pre-wrap;
    }
</style>

<body>
    <div class="main p-3">
        <div class="container-fluid">
            <div class="container1">
                <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#myModal" style="position: absolute; top: 190px; right: 30px;">Create Ticket</button>
                <form action="dl.php" method="post">
                    <input type="submit" class="btn btn-secondary" name="download" value="Download CSV" style="position: absolute; top: 190px; right: 150px;">
                </form>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="ticketNumberSearch" placeholder="Search by Ticket Number">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="statusFilter">
                            <option value="">Filter by Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Resolved">Resolved</option>
                            <option value="Unresolved">Unresolved</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="requestorSearch" placeholder="Search by Requestor">
                    </div>
                    <div class="col-lg-3">
                        <button type="button" id="resetFilters" class="btn btn-secondary" style="padding-right: 20px; padding-left: 10px;">Reset Filters</button>
                    </div>
                </div>
                <h3>
                    <center>Ticket List</center>
                </h3>
                <table id="example" class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Ticket ID</th>
                            <th class="text-center">Requestor</th>
                            <th class="text-center">Assigned Branch</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ticket = getAll("ticket");

                        if (mysqli_num_rows($ticket) > 0) {
                            foreach ($ticket as $item) {
                                $updated_by = "SELECT t.*, u.firstname, u.lastname 
                      FROM ticket t 
                      INNER JOIN user u ON t.updated_by = u.user_id 
                      WHERE t.ticket_id = " . $item['ticket_id'];
                                $updated_by_result = mysqli_query($con, $updated_by);
                                $updatedby_result = mysqli_fetch_assoc($updated_by_result);
                        ?>
                                <tr>
                                    <td><u><a href="ticket_info.php?ticket_id=<?php echo $item['ticket_id']; ?>" class="text-body fw-bold">ITR -<?php echo $item['ticket_id']; ?></a></u></td>
                                    <td class="text-center"><?= $item['requestor']; ?></td>
                                    <td class="text-center"><?= $item['to_branch']; ?></td>
                                    <td class="text-justify"><?= $item['subject']; ?></td>
                                    <td class="text-center">
                                        <?php
                                        $status = $item['status'];

                                        if ($status == 'Pending') {
                                            echo '<span class="badge text" style="background-color: #F7E1A1; color: black">' . $status . '</span>';
                                        } elseif ($status == 'Resolved') {
                                            echo '<span class="badge text" style="background-color: #BBDABB; color: black">' . $status . '</span>';
                                        } elseif ($status == 'Cancelled') {
                                            echo '<span class="badge text" style="background-color: #FF6961; color: black">' . $status . '</span>';
                                        } else {
                                            echo '<span class="badge text" style="background-color: #A1C1DF; color: black">' . $status . '</span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#infoModal<?= $item['ticket_id']; ?>">
                                            <i class="fas fa-eye"></i>&nbsp;View
                                        </a>
                                    </td>
                                </tr>

                                <!-- View Modal -->
                                <div class="modal fade" id="infoModal<?= $item['ticket_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ticket Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Your view form content goes here -->
                                                <div class="col-md-12 mt-3">
                                                    <label for=""><i class="fas fa-envelope"></i> Updated by</label>
                                                    <input type="text" name="email" value="<?= (!empty($updatedby_result['firstname']) && !empty($updatedby_result['lastname'])) ? (($updatedby_result['status'] == 'Resolved') ? 'Resolved by ' . $updatedby_result['firstname'] . ' ' . $updatedby_result['lastname'] : (($updatedby_result['status'] == 'Unresolved') ? 'Unresolved by ' . $updatedby_result['firstname'] . ' ' . $updatedby_result['lastname'] : '')) : '';
                                                                                            if ($status == 'Cancelled') {
                                                                                                echo 'Cancelled by ' . $item['updated_by'];
                                                                                            } ?>" class="form-control" disabled>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="col-md-12 mt-3">
                                                        <label for="concern"><i class="fas fa-message"></i> Reason</label>
                                                        <textarea class="form-control" name="concern" rows="3" required disabled><?= $item['reason']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <label for=""><i class="fas fa-user"></i> Date Created</label>
                                                    <input type="text" name="name" value="<?= date('F j, Y h:i A', strtotime($item['date_created'])) ?>" class="form-control" disabled>
                                                </div>

                                                <?php if (!empty($item['updated_date'])) { ?>
                                                    <div class="col-md-12 mt-3">
                                                        <label for=""><i class="fas fa-envelope"></i> Updated Date</label>
                                                        <input type="text" name="email" value="<?= date('F j, Y h:i A', strtotime($item['updated_date'])); ?>" class="form-control" disabled>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for=""><i class="fas fa-clock"></i> Ticket Duration</label>
                                                        <?php
                                                        // Calculate time difference
                                                        $createdTimestamp = strtotime($item['date_created']);
                                                        $updatedTimestamp = strtotime($item['updated_date']);
                                                        $timeDifference = $updatedTimestamp - $createdTimestamp;

                                                        // Calculate days, hours, and minutes
                                                        $days = floor($timeDifference / (60 * 60 * 24));
                                                        $remainingHours = $timeDifference % (60 * 60 * 24);
                                                        $hours = floor($remainingHours / (60 * 60));
                                                        $remainingMinutes = $remainingHours % (60 * 60);
                                                        $minutes = floor($remainingMinutes / 60);

                                                        // Construct the time difference string
                                                        if ($days > 0) {
                                                            $timeDifferenceStr = $days . ' days ' . $hours . ' hours ' . $minutes . ' minutes';
                                                        } else {
                                                            $timeDifferenceStr = $hours . ' hours ' . $minutes . ' minutes';
                                                        }
                                                        ?>

                                                        <input type="text" name="time_difference" value="<?= $timeDifferenceStr; ?>" class="form-control" disabled>

                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-md-12 mt-3">
                                                        <label for=""><i class="fas fa-envelope"></i> Updated Date</label>
                                                        <input type="text" name="email" value="" class="form-control" disabled>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for=""><i class="fas fa-clock"></i> Time Difference</label>
                                                        <input type="text" name="time_difference" value="" class="form-control" disabled>
                                                    </div>
                                                <?php } ?>

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

            <!-- MODAL -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fas fa-ticket"></i> Submit a Ticket</h4>
                        </div>
                        <div class="modal-body">
                            <form id="ticket-form" action="crud.php" method="POST" enctype="multipart/form-data">
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
                                    </h5>
                                </div>
                                <h5>
                                    <div class="sender">
                                        RECEIVER:
                                    </div>

                                    <div class="input-group">
                                        <span class="icon-container">
                                            <i class="fa-solid fa-building"></i>
                                        </span>
                                        <label for="tocompany" class="sr-only">To Company</label>
                                        <select class="form-control" name="tocompany" id="company" required>
                                            <option value="" disabled selected>Select To Company</option>
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
                                            <i class="fa-solid fa-code-branch"></i>
                                        </span>
                                        <label for="branch" class="sr-only">Branch</label>
                                        <select class="form-control" name="tobranch" id="branch" required>
                                            <option value="">Select To Branch</option>
                                        </select>
                                    </div> <br>

                                    <div class="input-group">
                                        <span class="icon-container">
                                            <i class="fa-solid fa-building"></i>

                                        </span>
                                        <label for="todepartment" class="sr-only">To Department</label>
                                        <select name="todepartment" class="form-control" readonly>
                                            <?php
                                            // Execute the SQL query
                                            $misql = "SELECT department_name FROM department WHERE department_name = 'IT Department' LIMIT 1;";
                                            $misres = mysqli_query($con, $misql);

                                            // Check if there are any rows returned
                                            if (mysqli_num_rows($misres) > 0) {
                                                // Fetch the department name
                                                $department_name = mysqli_fetch_assoc($misres)['department_name'];
                                                // Output the option tag with the fetched department name
                                                echo '<option value="' . $department_name . '">' . $department_name . '</option>';
                                            } else {
                                                // If no rows are returned, you may choose to show a default option or handle it differently
                                                echo '<option value="">No department found</option>';
                                            }
                                            ?>
                                        </select>

                                        <!-- <select class="form-control" name="todepartment" required>
                                            <option value="" data-icon="fas fa-users">To Department:</option>
                                            <!-- <//?php
                                            // $departments = getAll("department");
                                            // if (mysqli_num_rows($departments) > 0) {
                                            //     foreach ($departments as $department) {
                                            ?>
                                                    <option value="<//?= $department['department_name']; ?>" data-icon="fas fa-users"><//?= $department['department_name']; ?></option>
                                            <//?php
                                            //     }
                                            // } else {
                                            //     echo "<option value='' data-icon='fas fa-users'>No Department available</option>";
                                            // }
                                            ?> -->
                                        <!-- </select> -->
                                    </div>
                                    <div class="form-group">
                                        <div class="sender">
                                            SUBJECT:
                                        </div>
                                        <div class="input-group">
                                            <span class="icon-container">
                                                <i class="fa-solid fa-file"></i>
                                            </span>
                                            <label for="subject" class="sr-only">Subject</label>
                                            <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="icon-container">
                                                <i class="fa-solid fa-comment-alt"></i>
                                            </span>
                                            <label for="concern" class="sr-only">Details</label>
                                            <textarea class="form-control" name="concern" rows="4" placeholder="Details" required></textarea>
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
                                        <br>
                                        <div id="image-preview">
                                            <img id="preview-image" src="img/empty.png" height="200" alt="Image Preview">
                                        </div>

                                        <!-- Spinner -->
                                        <div id="loading-spinner" class="text-center d-none">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Submitting...</span>
                                            </div>
                                            <div>Submitting...</div>
                                        </div>
                                        <!-- End Spinner -->
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="add_ticket" class="btn" style="background-color: #6C757D; color: #FFF;">Submit</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>

        <script src="js/sidebar.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

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
            document.addEventListener("DOMContentLoaded", function() {
                const statusFilter = document.getElementById('statusFilter');
                const requestorSearch = document.getElementById('requestorSearch');
                const ticketNumberSearch = document.getElementById('ticketNumberSearch');
                const resetFiltersButton = document.getElementById('resetFilters');
                statusFilter.addEventListener('change', filterTickets);
                requestorSearch.addEventListener('input', filterTickets);
                ticketNumberSearch.addEventListener('input', filterTickets);
                resetFiltersButton.addEventListener('click', resetFilters);

                function filterTickets() {
                    const tickets = document.querySelectorAll('#example tbody tr');
                    const statusValue = statusFilter.value.toLowerCase();
                    const requestorValue = requestorSearch.value.toLowerCase();
                    const ticketNumberValue = ticketNumberSearch.value.toLowerCase();

                    tickets.forEach(ticket => {
                        const ticketID = ticket.querySelector('td:first-child').textContent.toLowerCase();
                        const requestor = ticket.querySelector('td:nth-child(2)').textContent.toLowerCase();
                        const status = ticket.querySelector('td:nth-child(5) span').textContent.toLowerCase(); // Modified to select only the text content within <span>

                        let shouldShow = ticketID.includes(ticketNumberValue) &&
                            requestor.includes(requestorValue);

                        // Check if status matches selected status or if no status is selected
                        if (statusValue !== '' && status !== statusValue) {
                            shouldShow = false;
                        }

                        ticket.style.display = shouldShow ? 'table-row' : 'none';
                    });
                }

                function resetFilters() {
                    statusFilter.value = ''; // Reset status filter
                    requestorSearch.value = ''; // Reset requestor search
                    ticketNumberSearch.value = ''; // Reset ticket number search
                    filterTickets(); // Apply filters after resetting
                }
            });
        </script>
        <script>
            document.getElementById('ticket-form').addEventListener('submit', function() {
                // Show spinner when form is submitted
                document.getElementById('loading-spinner').classList.remove('d-none');
                // Disable submit button to prevent multiple submissions
                document.getElementById('submit-btn').setAttribute('disabled', 'true');
            });
        </script>
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


</body>

</html>