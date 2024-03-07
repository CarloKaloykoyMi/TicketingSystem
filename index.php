<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E Ticketing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/des5.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
</head>

<body>
    <main>
        <header id="header">
            <div class="overlay overlay-lg"></div>
            <nav>
                <div class="container">
                    <div class="logo">
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
                                <a href="#aboutus">About</a>
                            </li>
                            <li>
                                <a href="#contact">Contact</a>
                            </li>
                            <li><a href="usertype.php" class="active">LOGIN</a></li>
                        </ul>
                    </div>

                    <div class="hamburger-menu">
                        <div class="bar"></div>
                    </div>
                </div>
            </nav>
        </header>

        <section class="portfolio section" id="portfolio">
            <div class="background-bg">
                <div class="overlay overlay-sm">
                    <img src="./img/shapes/half-circle.png" class="shape half-circle1" alt="" />
                    <img src="./img/shapes/half-circle.png" class="shape half-circle2" alt="" />
                    <img src="./img/shapes/wave.png" class="shape wave" alt="" />
                    <img src="./img/shapes/circle.png" class="shape circle" alt="" />
                    <img src="./img/shapes/triangle.png" class="shape triangle" alt="" />
                    <img src="./img/shapes/x.png" class="shape xshape" alt="" />
                </div>
            </div>

            <script>
                function addToCartBtn(link) {
                    // You can perform any additional actions here before redirecting
                    window.location.href = link;
                }
            </script>

            <div class="container">
                <div class="section-header">
                    <h3 class="title">COMPANIES </h3>
                </div>

                <div class="section-body">
                    <div class="grid">
                        <div class="grid-item logo-design">
                            <div class="gallery-image">
                                <img src="./img/portfolio/compf.png" alt="" />
                                <div class="img-overlay">
                                    <div class="img-description">
                                        <center>
                                            <h3><b>COMFAC CORPORATION</b></h3>
                                        </center>
                                        <center>Integrating technology solutions for workspace and people.</center>
                                    </div>
                                    <a href="javascript:void(0);" onclick="addToCartBtn('http://comfaccorp.com/')" class="btn">Click</a>
                                </div>
                            </div>
                        </div>

                        <div class="grid-item webdev">
                            <div class="gallery-image">
                                <img src="./img/portfolio/cors.png" alt="" />
                                <div class="img-overlay">
                                    <div class="img-description">
                                        <center>
                                            <h3><b>CORNERSTEEL SYSTEMS CORPORATION</b></h3>
                                        </center>
                                        <center> Marketing and manufacturing modular and custom-made furniture.</center>
                                    </div>
                                    <a href="javascript:void(0);" onclick="addToCartBtn('http://cornersteelsystems.com/')" class="btn">Click</a>
                                </div>
                            </div>
                        </div>

                        <div class="grid-item ui webdev">
                            <div class="gallery-image">
                                <img src="./img/portfolio/esco1.png" alt="" />
                                <div class="img-overlay">
                                    <div class="img-description">
                                        <center>
                                            <h3><b>ESCO INC.</b></h3>
                                        </center>
                                        <center> Facilities maintenance and sustainability solutions.</center>
                                    </div>
                                    <a href="javascript:void(0);" onclick="addToCartBtn('http://escoincsolutions.com/')" class="btn">Click</a>
                                </div>
                            </div>
                        </div>

                        <div class="grid-item ui webdev">
                            <div class="gallery-image">
                                <img src="./img/portfolio/comft.png" alt="" />
                                <div class="img-overlay">
                                    <div class="img-description">
                                        <center>
                                            <h3><b>COMFAC TECHNOLOGY OPTIONS</b></h3>
                                        </center>
                                        <center> Consulting and information technology services to enterprise. </center>
                                    </div>
                                    <a href="javascript:void(0);" onclick="addToCartBtn('https://www.comfactechoptions.com/')" class="btn">Click</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>


        <section class="aboutus section" id="aboutus">
            <div class="header-content">
                <div class="container grid-2">
                    <div class="column-1">
                        <h1 class="header-title">E-TICKET</h1>
                        <p class="text">
                            Our E-Ticketing System for Support Concerns is a specialized platform designed to
                            streamline and enhance the users' support process by leveraging digital technology.
                            It serves as a centralized hub for users to report issues, seek assistance, and
                            receive timely resolutions, ensuring a seamless support experience.
                        </p>
                    </div>
                    <div class="container-about">
                        <div class="column-2 image">
                            <img src="./img/cover2.jpg" class="img-element z-index" alt="" />
                        </div>
                        <div class="column-2 image1">
                            <img src="./img/cover1.jpg" class="img-element z-index" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact" id="contact">
            <div class="container">
                <div class="contact-box">
                    <div class="contact-info">
                        <h3 class="title">Get in touch</h3>
                        <p class="text">
                            If you need our assistance, we invite you to fill out the forms on our website.
                            Our team is available to answer any questions or concerns.
                        </p>
                        <div class="information-wrap">
                            <div class="information">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <p class="info-text">536 Calbayog St. Mandaluyong City, Metro Manila 1550</p>
                            </div>
                            <div class="information">
                                <div class="contact-icon">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                                <p class="info-text">cornetsteel@gmail.com</p>
                            </div>
                            <div class="information">
                                <div class="contact-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <p class="info-text">02-7907-15-07</p>
                            </div>
                        </div>
                    </div>
                    <?php
                    // Include the MySQL connection file
                    include "mysql_connect.php";

                    // Check if the form is submitted
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Retrieve form data
                        $first_name = $_POST['first_name'];
                        $last_name = $_POST['last_name'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $message = $_POST['message'];

                        // Prepare and execute the SQL query
                        $stmt = $con->prepare("INSERT INTO contact_us (first_name, last_name, phone, email, message) VALUES (?, ?, ?, ?, ?)");
                        $stmt->bind_param("sssss", $first_name, $last_name, $phone, $email, $message);
                        $stmt->execute();

                        // Close the statement
                        $stmt->close();

                        // Show SweetAlert2 after successful submission
                        echo "<script>
                            Swal.fire({
                                title: 'Success!',
                                text: 'Your message has been sent.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect or perform any other action after the alert is closed
                                    window.location.href = 'index.php';
                                }
                            });
                        </script>";
                    }
                    ?>
                    <div class="contact-form">
                        <h3 class="title">Contact Us</h3>
                        <form method="post" action="">
                            <div class="row">
                                <input type="text" name="first_name" class="contact-input" placeholder="First Name" />
                                <input type="text" name="last_name" class="contact-input" placeholder="Last Name" />
                            </div>
                            <div class="row">
                                <input type="text" name="phone" maxlength="11" class="contact-input" placeholder="Phone" />
                                <input type="email" name="email" class="contact-input" placeholder="Email" />
                            </div>
                            <div class="row">
                                <textarea name="message" class="contact-input textarea" placeholder="Message"></textarea>
                            </div>
                            <input type="submit" name="submit" value="Send" class="btn">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/isotope.pkgd.min.js"></script>
    <script src="./js/app.js"></script>

</body>

</html>