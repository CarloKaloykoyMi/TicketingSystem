<?php session_start();
include('mysql_connect.php'); // connection to MySQL
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Employee Login </title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-logo">
            <a href="index.php"><img src="img/logo2.png"></a>
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

    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>Employee Login</header>
                <form action="code.php" method="POST">
                    <div class="field input-field">
                        <input type="email" name="email" placeholder="Email" class="input">
                    </div>

                    <div class="field input-field">
                        <input type="password" name="password" placeholder="Password" class="password">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <div class="form-link">
                        <a href="forgotpass.php" class="forgot-pass">Forgot password?</a>
                    </div>

                    <div class="field button-field">
                        <button type="submit" name="emp_login_btn">Sign In</button>
                    </div>
                </form>

                <div class="form-link">
                    <span>Don't have an account yet? <a href="register.php" class="button">Signup</a></span>
                </div>
            </div>
        </div>

    </section>

    <!-- JavaScript -->
    <script>
        const forms = document.querySelector(".forms"),
            pwShowHide = document.querySelectorAll(".eye-icon"),
            links = document.querySelectorAll(".link");

        pwShowHide.forEach(eyeIcon => {
            eyeIcon.addEventListener("click", () => {
                let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");

                pwFields.forEach(password => {
                    if (password.type === "password") {
                        password.type = "text";
                        eyeIcon.classList.replace("bx-hide", "bx-show");
                        return;
                    }
                    password.type = "password";
                    eyeIcon.classList.replace("bx-show", "bx-hide");
                })

            })
        })

        links.forEach(link => {
            link.addEventListener("click", e => {
                e.preventDefault(); //preventing form submit
                forms.classList.toggle("show-signup");
            })
        })
    </script>


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