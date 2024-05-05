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
    <title>Department </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <!-- icon css -->
    <link rel="stylesheet" href="css/fontawesome/css/all.css">

    <!-- datatable css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- datatable css -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
                    <select class="form-control" id="departmentNameSearch">
                        <option value="">Select Department Name</option>
                        <?php
                        $departments = getAll("department");
                        if (mysqli_num_rows($departments) > 0) {
                            foreach ($departments as $department) {
                                echo "<option value='" . $department['department_name'] . "'>" . $department['department_name'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No Departments available</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="departmentHeadSearch" placeholder="Search by Department Head">
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
                            <h4 class="text-center">List of Departments</h4>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartmentModal"><i class="fas fa-plus"></i>&nbsp;Add Department</button>
                        </div>

                        <div class="card-body">
                            <table id="example" class="table-responsive table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Branch Name</th>
                                        <th>Department Name</th>
                                        <th>Department Head</th>
                                        <th>Location</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $department = getAll("department");

                                    if (mysqli_num_rows($department) > 0) {
                                        foreach ($department as $item) {
                                    ?>
                                            <tr>
                                                <td><?= $item['company']; ?></td>
                                                <td><?= $item['branch']; ?></td>
                                                <td><?= $item['department_name']; ?></td>
                                                <td><?= $item['department_head']; ?></td>
                                                <td><?= $item['location']; ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editDepartmentModal<?= $item['id']; ?>"><i class="fas fa-pencil"></i>&nbsp;Edit</a>
                                                    <a href="#" class="btn btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDepartmentModal<?= $item['id']; ?>">
                                                        <i class="fas fa-trash"></i>&nbsp;Delete
                                                    </a>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="deleteDepartmentModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Department</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this department?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <form action="code.php" method="POST">
                                                                <input type="hidden" name="department_id" value="<?= $item['id']; ?>">
                                                                <input type="hidden" name="department_name" value="<?= $item['department_name']; ?>">
                                                                <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                                                                <button type="submit" class="btn btn-danger" name="delete_department">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Edit Company Modal -->
                                            <div class="modal fade" id="editDepartmentModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Your edit form content goes here -->
                                                            <form action="code.php" method="POST">
                                                                <input type="hidden" name="department_id" value="<?= $item['id']; ?>">

                                                                <div class="col-md-12 mt-3">
                                                                    <label for="company_name" class="form-label"> <i class="fas fa-building"></i> Company</label>
                                                                    <select class="form-control company_name" name="company_name">
                                                                        <option value="" disabled>Select Company</option>
                                                                        <?php
                                                                        $companyList = getAll("company");
                                                                        if (mysqli_num_rows($companyList) > 0) {
                                                                            foreach ($companyList as $companyItem) {
                                                                                $selected = ($item['company'] == $companyItem['company_name']) ? 'selected' : '';
                                                                                echo "<option value='" . $companyItem['company_name'] . "' $selected>" . $companyItem['company_name'] . "</option>";
                                                                            }
                                                                        } else {
                                                                            echo "<option value=''>No Company available</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for="branchedit" class="form-label"><i class="fas fa-code-branch"></i> Branch</label>
                                                                    <?php

                                                                    $deptCheck = "SELECT * FROM department WHERE id='" . $item['id'] . "';";
                                                                    $result = mysqli_query($con, $deptCheck);

                                                                    if ($result) {
                                                                        $department = mysqli_fetch_assoc($result);
                                                                        $branch = $department['branch'];
                                                                        $comp = $department['company'];

                                                                        $branlist = "SELECT * FROM branch WHERE company ='" . $comp . "';";
                                                                        $branresult = mysqli_query($con, $branlist);

                                                                        if ($branresult) {
                                                                            echo '<select class="form-control branchedit" name="branch"><option value="" selected disabled>Select Branch</option>';

                                                                            while ($branchrelist = mysqli_fetch_assoc($branresult)) {
                                                                                $otherbranch = $branchrelist['branch_name'];
                                                                                if ($otherbranch != $branch) {
                                                                                    echo '<option value="' . $otherbranch . '">' . $otherbranch . '</option>';
                                                                                }
                                                                            }

                                                                            echo '<option value="' . $branch . '" selected>' . $branch . '</option></select>';
                                                                        } else {
                                                                            // Handle query error
                                                                            echo "Error executing query: " . mysqli_error($con);
                                                                        }
                                                                    } else {
                                                                        // Handle query error
                                                                        echo "Error executing query: " . mysqli_error($con);
                                                                    }


                                                                    ?>

                                                                </div>



                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-users"></i> Department Name</label>
                                                                    <input type="text" name="department_name" value="<?= $item['department_name']; ?>" class="form-control">
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-user"></i> Department Head</label>
                                                                    <input type="text" name="department_head" value="<?= $item['department_head']; ?>" class="form-control" required>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for=""><i class="fas fa-location-dot"></i> Location</label>
                                                                    <input type="text" name="location" value="<?= $item['location']; ?>" class="form-control" required>
                                                                </div>

                                                                <!-- Add other form fields for editing as needed -->
                                                                <hr>
                                                                <div class="form-group pull-right">
                                                                    <button class="btn btn-primary float-end" type="submit" name="edit_department">Save
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
    </div>

    <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="code.php" method="POST">

                        <div class="col-md-12 mt-3">
                            <label for="company_name" class="form-label"> <i class="fas fa-building"></i> Company</label>
                            <select id="company" name="company_name" class="form-control" required>
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
                            <label for="branch" id="branchGroup" class="form-label"> <i class="fas fa-code-branch"></i> Branch:</label>
                            <select class="form-control" id="branch" name="branch" required>
                                <option value="">Select Branch:</option>
                            </select>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for=""><i class="fas fa-users"></i> Department Name</label>
                            <input type="text" name="department_name" placeholder="Enter Department Name" class="form-control" required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for=""><i class="fas fa-user"></i> Department Head</label>
                            <input type="text" name="department_head" placeholder="Enter Department Head" class="form-control" required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for=""><i class="fas fa-location-dot"></i> Location</label>
                            <input type="text" name="location" placeholder="Enter Location" class="form-control" required>
                        </div>

                        <hr>
                        <div class="form-group pull-right">
                            <button class="btn btn-primary float-end" type="submit" name="add_department">Submit</button>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="js/sidebar.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const companyNameSearch = document.getElementById('companyNameSearch');
            const departmentNameSearch = document.getElementById('departmentNameSearch');
            const departmentHeadSearch = document.getElementById('departmentHeadSearch');
            const resetFiltersButton = document.getElementById('resetFilters');

            companyNameSearch.addEventListener('input', filterDepartments);
            departmentNameSearch.addEventListener('input', filterDepartments);
            departmentHeadSearch.addEventListener('input', filterDepartments);
            resetFiltersButton.addEventListener('click', resetFilters);

            function filterDepartments() {
                const departments = document.querySelectorAll('#example tbody tr');
                const companyNameValue = companyNameSearch.value.trim().toLowerCase();
                const departmentNameValue = departmentNameSearch.value.trim().toLowerCase();
                const departmentHeadValue = departmentHeadSearch.value.trim().toLowerCase();

                departments.forEach(department => {
                    const companyName = department.querySelector('td:first-child').textContent.trim().toLowerCase();
                    const departmentName = department.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
                    const departmentHead = department.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();

                    let shouldShow = companyName.includes(companyNameValue) &&
                        departmentName.includes(departmentNameValue) &&
                        departmentHead.includes(departmentHeadValue);

                    department.style.display = shouldShow ? 'table-row' : 'none';
                });
            }

            function resetFilters() {
                companyNameSearch.value = ''; // Reset company name filter
                departmentNameSearch.value = ''; // Reset department name filter
                departmentHeadSearch.value = ''; // Reset department head filter
                filterDepartments(); // Apply filters after resetting
            }

        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to fetch branches based on selected company
            function fetchBranches(companyName, targetElement) {
                $.ajax({
                    url: 'get_branch.php',
                    type: 'POST',
                    data: {
                        company_name: companyName
                    },
                    success: function(response) {
                        console.log(response);
                        $(targetElement).html(response);
                        $(targetElement).parent().toggle(response.trim() !== '');
                    },
                    error: function() {
                        alert('Error fetching branches.');
                    }
                });
            }

            // Change event handler for company selection in add modal
            $('#company').change(function() {
                var companyName = $(this).val();
                // Fetch branches for the selected company in add modal
                fetchBranches(companyName, '#branch');
            });

            // Initial fetch of branches for the selected company in add modal
            var selectedCompanyAdd = $('#company').val();
            fetchBranches(selectedCompanyAdd, '#branch');
        });
    </script>

    <script>
        // JavaScript to filter branch options based on selected company
        document.getElementById('company_name').addEventListener('change', function() {
            var selectedCompany = this.value;
            var branchSelect = document.getElementById('branchedit');
            // Clear existing options
            branchSelect.innerHTML = '<option value="">Select Branch</option>';
            // Fetch branches with the selected company
            <?php
            $branchList = getAll("branch");
            if ($branchList && mysqli_num_rows($branchList) > 0) {
                while ($branchItem = mysqli_fetch_assoc($branchList)) {
                    echo "if ('" . $branchItem['company'] . "' === selectedCompany) {";
                    echo "branchSelect.innerHTML += '<option value=\"" . $branchItem['branch_name'] . "\">" . $branchItem['branch_name'] . "</option>';";
                    echo "}";
                }
            }
            ?>
        });
    </script>
    <script>
        $(document).ready(function() {
            // Change event handler for company selection
            $('.company_name').change(function() {
                var company_name = $(this).val();
                var branchDropdown = $(this).closest('.modal-content').find('.branchedit'); // Find the corresponding branch dropdown
                var selectedBranch = '<?php echo $branch; ?>'; // Get the selected branch for comparison

                if (company_name != '') {
                    // Reset the branch dropdown
                    branchDropdown.html('<option value="">Select Branch</option>');

                    // Fetch branches for the selected company
                    $.ajax({
                        url: 'get_branch.php',
                        type: 'POST',
                        data: {
                            company_name: company_name
                        },
                        success: function(response) {
                            branchDropdown.append(response);

                            // Select the branch if it matches $item['branch']
                            branchDropdown.find('option').each(function() {
                                if ($(this).val() == selectedBranch) {
                                    $(this).prop('selected', true);
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", error);
                        }
                    });
                } else {
                    // Reset the branch dropdown if no company is selected
                    branchDropdown.html('<option value="">Select Branch</option>');
                }
            });
        });
    </script>
</body>

</html>