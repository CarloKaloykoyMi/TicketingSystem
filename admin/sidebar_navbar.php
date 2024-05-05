<head>
    <link rel="icon" href="img/logo2.png" type="image/x-icon">
</head>
<?php
$username = $_SESSION['auth_user']['username'];
$user_id = $_SESSION['auth_user']['user_id'];
$email = $_SESSION['auth_user']['email'];
$role = $_SESSION['auth_user']['role'];
include('mysql_connect.php');
$sql = "SELECT * FROM user WHERE user_id='$user_id'";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
    $username = $row['username'];
    $fn = $row['firstname'];
    $ml = $row['middleinitial'];
    $ln = $row['lastname'];
    $name = $fn . " " . ($ml ? $ml . ". " : "") . $ln; // check if middle initial is not empty, if not, include it in the name
    $company = $row['company'];
    $branch = $row['branch'];
    $department = $row['department'];
    $contact = $row['contact'];
    $img = $row['image'];
}
?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #595959;">
    <div class="container-fluid">
        <!-- System Name (Upper Left Corner) -->
        <a class="navbar-brand" href="dashboard.php"><img src="img/logooo.png" height="40px" alt="CGG Logo"> CGG Nexus</a>

        <!-- Navbar Toggler (for responsive behavior) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content (Upper Right Corner) -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <!-- User Profile Picture -->
                <li class="nav-item">
                    <img src='<?php echo "../Images/" . $user_id . "-" . $username . "/" . $img ?>' alt="User Profile" class="nav-link rounded-circle" style="width: 40px; height: 40px;">
                </li>

                <!-- User Name -->
                <li class="nav-item">
                    <a class="nav-link" href="admin_profile.php">
                        <?php
                        echo $name;
                        ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="sidebar-logo">
                <a href="#">CGG NEXUS</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="dashboard.php" class="sidebar-link">
                    <i class="fa-solid fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="ticket.php" class="sidebar-link">
                    <i class="fa-solid fa-ticket"></i>
                    <span>Tickets</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-tools"></i>
                    <span><strong>Manage</strong></span>
                    <i class="fa fa-sort-down"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="company.php"><i class="fa-solid fa-building"></i>
                            <span class="nav-item">Company</span></a></li>
                    <li><a href="branch.php"><i class="fa-solid fa-location-dot"></i>
                            <span class="nav-item">Branch </span></a></li>
                    <li><a href="department.php"><i class="fa-solid fa-users"></i>
                            <span class="nav-item">Department</span></a></li>

                </ul>
            </li>
            <li class="sidebar-item">
                <a href="user.php" class="sidebar-link">
                    <i class="fa-solid fa-user-large"></i>
                    <span>Employees</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="audit.php" class="sidebar-link">
                    <i class="fa-solid fa-list-ul"></i>
                    <span>Audit Trail</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="contact_us.php" class="sidebar-link">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Contact Us</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="admin_profile.php" class="sidebar-link">
                    <i class="fa fa-gear"></i>
                    <span>Profile</span>
                </a>
            </li>
            <hr style="border-color: white;">
            <div class="sidebar-item">
                <a href="logoutadmin.php" class="sidebar-link">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </div>
        </ul>
    </aside>