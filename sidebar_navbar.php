<?php
$user_id = $_SESSION['userid'];
$email = $_SESSION['auth_user']['email'];
$role = $_SESSION['auth_user']['role'];
$lname = $_SESSION['auth_user']['lastname'];
$fname = $_SESSION['auth_user']['firstname'];
include('mysql_connect.php');
$sql = "SELECT * FROM user WHERE user_id='$user_id'";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
    $username = $row['username'];
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
?>


<script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #595959;">
    <div class="container-fluid">
        <!-- System Name (Upper Left Corner) -->
        <a class="navbar-brand" href="dashboard.php"><img src="Images/Ticket -Logo-3.png" height="40px" alt="CGG E-Support Logo"> CGG E-Support</a>

        <!-- Navbar Toggler (for responsive behavior) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content (Upper Right Corner) -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <!-- User Profile Picture -->
                <li class="nav-item">
                    <img src='<?php echo "Images/" . $user_id . "-" . $username . "/" . $img ?>' alt="User Profile" class="nav-link rounded-circle" style="width: 50px; height: 50px;">
                </li>

                <!-- User Name -->
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $fname . ' ' . $lname; ?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<style>
    .sidebar-link:hover,
    .sidebar-footer:hover {
        background-color: white;
        color: #FFF;
        /* Set the desired text color for hover state */
    }
</style>

<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-grid-alt"></i>
            </button>

        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="Home_User.php" class="sidebar-link">
                    <i class="fa-solid fa-HOME"></i>
                    <span><strong>MY REQUEST</strong></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="resolvedtickets.php"><i class="fa-solid fa-circle-check"></i>
                            <span class="nav-item">MY RESOLVED TICKETS</span></a></li>
                    <li><a href="unresolvedtickets.php"><i class="fa-solid fa-triangle-exclamation"></i>
                            <span class="nav-item">MY UNRESOLVED TICKETS </span></a></li>
                    <li><a href="pendingtickets.php"><i class="fa-solid fa-spinner"></i>
                            <span class="nav-item">MY PENDING TICKETS</span></a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="requested_tickets.php" class="sidebar-link">
                    <i class="fa-solid fa-ticket"></i>
                    <span><strong>REQUESTED TICKETS</strong></span>
                </a>
                <ul class="sub-menu">
                    <li><a href=""><i class="fa-solid fa-circle-check"></i>
                            <span class="nav-item">RESOLVED TICKETS</span></a></li>
                    <li><a href=""><i class="fa-solid fa-triangle-exclamation"></i>
                            <span class="nav-item">UNRESOLVED TICKETS </span></a></li>
                    <li><a href=""><i class="fa-solid fa-spinner"></i>
                            <span class="nav-item">PENDING TICKETS</span></a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="User_Profile.php" class="sidebar-link">
                    <i class="fa fa-gear"></i>
                    <span><strong>SETTINGS</strong></span>
                </a>
            </li>
            <hr style="border-color: white;">
            <div class="sidebar-item">
                <a href="logout.php" class="sidebar-link">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span><strong>LOGOUT</strong></span>
                </a>
            </div>
        </ul>
    </aside>