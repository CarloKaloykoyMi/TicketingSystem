<?php session_start();

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';

?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/images/logo3.ico">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/forgot.css">

    <link rel="icon" href="Favicon.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Recover Password</title>
</head>

<body>

    <!-- Navbar -->
    <header id="header">
        <nav class="navbar">
            <div class="navbar-logo">
                <a href="index.php">
                    <img src="img/logo2.png">
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

    <br><br>
    <p style="text-align: center; font-size: 25px; font-weight: bold;">Forgot Password?</p>


    <main class="login-form">
        <div class="container"> <!-- Add the "container" class to center the content -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card" style="background-color: #e7e7e7;">
                        <div class="text-center" style="color: #232836;">
                            <p style="text-align: center; font-size: 18px;">Please enter your email to change your password.</p>
                            <div class="card-body">
                                <form action="#" method="POST" name="recover_psw">
                                    <div class="form-group row">
                                        <label for="email_address" style="color: #232836;"> <i class="fa-solid fa-envelope"></i> Email Address:&nbsp;&nbsp; </label>
                                        <div class="form-control-center">
                                            <input type="text" id="email_address" class="form-control" name="email" required autofocus size="25">
                                        </div>
                                    </div>

                                    <div class="form-group row justify-content-center"> <!-- Center the content -->
                                        <div class="col-md-6">
                                            <!-- Adjust the width here -->
                                            <input type="submit" value="Submit" name="recover" class="btn btn-primary" style="background-color: #424949;">

                                        </div> <!-- Add Bootstrap button styles -->
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="bottom-footer">

                <div class="copyright">
                    <p class="text">
                        &copy; 2024 Comfac Global Group.
                    </p>
                </div>

                <!-- Follow Us -->
                <div class="followme-wrap">
                    <div class="followme">
                        <h3>Follow Us</h3>
                        <span class="footer-line"></span>
                        <div class="social-media">
                            <a href="https://www.facebook.com/ComfacGlobalGroupRecruitment/">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.instagram.com/cornersteelsystemscorp/">
                                <i class="fab fa-instagram"></i>
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

<?php
if (isset($_POST["recover"])) {
    include('mysql_connect.php'); // connection to MySQL
    $email = $_POST["email"];

    $sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
    $query = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_assoc($sql);
    $row = mysqli_fetch_assoc($sql);

    if (mysqli_num_rows($sql) <= 0) {
?>
        <script>
            alert("<?php echo "Sorry, no emails exists " ?>");
        </script>
    <?php
    } else if ($fetch["status"] == 0) {
    ?>
        <script>
            alert("Sorry, your account must verify first, before you recover your password !");
            window.location.replace("index.php");
        </script>
        <?php
    } else {
        // generate token by binaryhexa 
        $token = bin2hex(random_bytes(50));

        //session_start ();
        $_SESSION['token'] = $token;
        $_SESSION['email'] = $email;
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        // h-hotel account
        $mail->Username = 'tekuno.space@gmail.com';
        $mail->Password = 'tomc vgby fire ytio';

        // send by h-hotel email
        $mail->setFrom('tekuno.space@gmail.com', 'Password Reset');
        // get email from input
        $mail->addAddress($_POST["email"]);
        //$mail->addReplyTo('lamkaizhe16@gmail.com');

        // HTML body
        $mail->isHTML(true);
        $mail->Subject = "Recover your password";
        $mail->Body = "<b>My Dear Customer</b>
            <h3>We received a request to reset your password.</h3>
            <p>Kindly click the below link to reset your password</p>
            https://tekuno.tech/reset_pass.php
            <br><br>
            <p>With regrads,</p>
            <b>Kat&Ren Construction Supply</b>";

        if (!$mail->send()) {
        ?>
            <script>
                alert("<?php echo " Invalid Email " ?>");
            </script>
        <?php
        } else {
        ?>
            <script>
                window.location.replace("login.php");
                alert("<?php echo "Kindly check your email for reset password" ?>");
            </script>
<?php
        }
    }
}


?>
</body>

</html>