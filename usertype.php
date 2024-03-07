<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Account Type </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/des5.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <link rel="stylesheet" href="css/user.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>

    <!-- Navbar -->
    <header id="header">
        <nav class="navbar">
            <div class="navbar-logo">
                <a href="index.php">
                    <img src="img/logo2.png" alt="">
                </a>
                <span class="logo-text">CGG e-Ticketing</span>
            </div>
            <div class="links">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="index.php#aboutus">About</a>
                    </li>
                    <li>
                        <a href="index.php#contact">Contact</a>
                    </li>
                    <li><a href="usertype.php" class="active">LOGIN</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <style>
        .grid-item {
            width: 48%;
            margin: 1%;
        }

        @media (max-width: 767px) {
            .grid-item {
                width: 100%;
                margin: 0;
            }
        }

        .grid-item {
            width: 48%;
            margin: 1%;
            float: left;
        }

        @media (max-width: 767px) {
            .grid-item {
                width: 100%;
                margin: 0;
                float: none;
            }
        }

        .footer {
            padding: 10px 0;
        }

        .logo img {
            width: 100px;
            height: auto;
        }

        .copyright {
            text-align: center;
        }

        .copyright p {
            font-weight: bold;
            font-size: 16px;
        }

        .logo-text {
            font-size: 24px;
            margin-left: 10px;
            font-weight: bold;
            color: #fff;
        }

        .gallery-image img {
            width: 250px;
            height: auto;
            border-radius: 15px;
        }
    </style>
    <br><br>
    </head>
    <div class="container">
        <h2>Select Account Type</h2>
        <div class="button-group">
            <a href="adminlogin.php" class="btn btn-primary">
                <div class="button-option">
                    <img src="img/user1.png" alt="Enterprise User">
                    Admin
                </div>
            </a>

            <a href="emplogin.php" class="btn btn-primary">
                <div class="button-option">
                    <img src="img/user2.png" alt="Staff Individual User">
                    Employee
                </div>
            </a>
        </div>
    </div>

    <br><br><BR>

    <body>
        <!-- Footer -->
        <footer class="footer">
            <div class="bottom-footer">

                <div class="copyright">
                    <p class="text">
                        &copy; 2024 Comfac Global Group.
                    </p>
                </div>

                <div class="followme-wrap">
                    <div class="followme">
                        <h3>Follow Us</h3>
                        <span class="footer-line"></span>
                        <div class="social-media">
                            <a href="https://www.facebook.com/ComfacGlobalGroupRecruitment/">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </div>
                    </div>

                    <div class="followme-wrap">
                        <div class="followme">

                            <div class="social-media">
                                <a href="https://www.instagram.com/cornersteelsystemscorp/">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </div>
                        </div>

                        <div class="back-btn-wrap">
                            <a href="#" class="back-btn">
                                <i class="fas fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>

</html>