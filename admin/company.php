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
    <title>Company</title>

    <!-- datatable css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- icon css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src='https://kit.fontawesome.com/ddada6a128.js' crossorigin='anonymous'></script>


    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <!-- bootstrap css -->
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
            <div class="row mb-3">
                <div class="col-md-4">
                    <select class="form-control" id="companyNameSearch">
                        <option value="">Select Company Name</option>
                        <?php
                        $companies = getAll("company");
                        if (mysqli_num_rows($companies) > 0) {
                            foreach ($companies as $company) {
                                echo "<option value='" . $company['company_name'] . "'>" . $company['company_name'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No Companies available</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="contactSearch" placeholder="Search by Contact" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="emailSearch" placeholder="Search by Email">
                </div>
                <div class="col-md-4">
                    <button type="button" id="resetFilters" class="btn btn-secondary" style="position: absolute; top: 125px; right: 70px;padding-right:15px;padding-left:15px;">Reset Filters</button>
                </div>
                <br> <br>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">Company</h4>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompanyModal">
                                <i class="fas fa-plus"></i>&nbsp;Add Company
                            </button>
                        </div>
                        <div class="card-body" id="category_table">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $company = getAll("company");

                                    if (mysqli_num_rows($company) > 0) {
                                        foreach ($company as $item) {
                                    ?>
                                            <tr>
                                                <td><?= $item['company_name']; ?></td>
                                                <td><?= $item['contact']; ?></td>
                                                <td><?= $item['email']; ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCompanyModal<?= $item['id']; ?>"><i class="fas fa-pencil"></i>&nbsp;Edit</a>
                                                    <a href="#" class="btn btn btn-danger" data-bs-toggle="modal" data-bs-target="#companyDepartmentModal<?= $item['id']; ?>">
                                                        <i class="fas fa-trash"></i>&nbsp;Delete
                                                    </a>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="companyDepartmentModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Company</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this Company?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <form action="code.php" method="POST">
                                                                <input type="hidden" name="company_id" value="<?= $item['id']; ?>">
                                                                <input type="hidden" name="company_name" value="<?= $item['company_name']; ?>">
                                                                <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                                                                <button type="submit" class="btn btn-danger" name="delete_company">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Edit Company Modal -->
                                            <div class="modal fade" id="editCompanyModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Company</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Your edit form content goes here -->
                                                            <form action="code.php" method="POST">
                                                                <input type="hidden" name="company_id" value="<?= $item['id']; ?>">

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-building"></i> Company Name</label>
                                                                    <input type="text" name="company_name" value="<?= $item['company_name']; ?>" class="form-control" required>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-location-dot"></i> Company Address</label>
                                                                    <input type="text" name="company_address" value="<?= $item['company_address']; ?>" class="form-control" required>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-phone"></i> Contact</label>

                                                                    <input name="contact" type="text" class="form-control" maxlength="11" value="<?php echo $contact ?>" oninput="restrictToNumbers(this)" required>
                                                                    <span class="note" style="display: none; color: red; font-size: 13px;">Please enter a valid 11-digit numbers.</span>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-envelope"></i> Email</label>
                                                                    <input type="text" name="email" value="<?= $item['email']; ?>" class="form-control" required>
                                                                </div>

                                                                <!-- Add other form fields for editing as needed -->
                                                                <hr>
                                                                <div class="form-group pull-right">
                                                                    <button class="btn btn-primary float-end" type="submit" name="edit_company">Save
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
    <!-- add modal -->
    <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="code.php" method="POST">

                        <div class="col-md-12 mt-3">
                            <label for=""><i class="fas fa-building"></i> Company Name</label>
                            <input type="text" name="company_name" placeholder="Enter Company Name" class="form-control" required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for=""><i class="fas fa-location-dot"></i> Company Address</label>
                            <input type="text" name="company_address" placeholder="Enter Company Address" class="form-control" required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for=""><i class="fas fa-phone"></i> Contact</label>
                            <input type="text" name="contact" placeholder="Enter Contact" maxlength="11" class="form-control" oninput="restrictToNumbers(this)" required>
                            <span class="note" style="display: none; color: red; font-size: 13px;">Please enter a valid 11-digit numbers.</span>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for=""><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" placeholder="Enter Email" class="form-control" required>
                        </div>

                        <hr>
                        <div class="form-group pull-right">
                            <button class="btn btn-primary float-end" type="submit" name="add_company">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
        document.addEventListener("DOMContentLoaded", function() {
            const companyNameSearch = document.getElementById('companyNameSearch');
            const contactSearch = document.getElementById('contactSearch');
            const emailSearch = document.getElementById('emailSearch');
            const resetFiltersButton = document.getElementById('resetFilters');

            companyNameSearch.addEventListener('input', filterCompanies);
            contactSearch.addEventListener('input', filterCompanies);
            emailSearch.addEventListener('input', filterCompanies);
            resetFiltersButton.addEventListener('click', resetFilters);

            function filterCompanies() {
                const companies = document.querySelectorAll('#example tbody tr');
                const companyNameValue = companyNameSearch.value.trim().toLowerCase();
                const contactValue = contactSearch.value.trim().toLowerCase();
                const emailValue = emailSearch.value.trim().toLowerCase();

                companies.forEach(company => {
                    const companyName = company.querySelector('td:first-child').textContent.trim().toLowerCase();
                    const contact = company.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
                    const email = company.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();

                    let shouldShow = companyName.includes(companyNameValue) &&
                        contact.includes(contactValue) &&
                        email.includes(emailValue);

                    company.style.display = shouldShow ? 'table-row' : 'none';
                });
            }

            function resetFilters() {
                companyNameSearch.value = ''; // Reset company name filter
                contactSearch.value = ''; // Reset contact filter
                emailSearch.value = ''; // Reset email filter
                filterCompanies(); // Apply filters after resetting
            }

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/sidebar.js"></script>
</body>

</html>