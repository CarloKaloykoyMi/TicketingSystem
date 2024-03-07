<?php session_start();
include('mysql_connect.php'); // connection to MySQL

if (isset($_POST['register'])) {

    // check if the form has been submitted
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $middleinitial = $_POST['middleinitial'];
    $company = $_POST['company'];
    $branch = $_POST['branch'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    // Check if password and confirm password match
    if ($password !== $confirm) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Passwords do not match!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    } else {
        if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM user WHERE email = '$email'")) > 0) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                This Email already exists!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } else {
            $verification_status = 0;
            // Insert the data into the database
            $query = mysqli_query($con, "INSERT INTO user (lastName,firstName,middleinitial,company,branch,department,email,contact,username,password,verification_status,role) 
            VALUES('$lastName','$firstName','$middleinitial','$company','$branch','$department','$email','$contact','$username','$password','$verification_status','1')");

            if ($query) {
                $otp = rand(100000, 999999);
                $_SESSION['otp'] = $otp;
                $_SESSION['mail'] = $email;
                require "phpmailer/PHPMailerAutoload.php";
                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';

                $mail->Username = 'odetocode04@gmail.com';
                $mail->Password = 'mnugjcpwaslqthdn';

                $mail->setFrom('no-reply@gmail.com', 'no-reply');
                $mail->addAddress($_POST["email"]);

                $mail->isHTML(true);
                $mail->Subject = "Your verify code";
                $mail->Body = "<p>Dear user, </p> <br> <p>Good Day! </p> <h3>I would like to inform you that your verification OTP code is $otp <br></h3> 
                    <p>Thank you.</p>
                    
                    <br><br>
                    <p>Best regrads,</p>
                    <b>CGG E-Ticketing </b>";

                // Send email
                if (!$mail->send()) {
?>
                    <script>
                        alert("<?php echo "Registration Failed " ?>");
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        alert("<?php echo "Registration Successful! Your OTP Code is send to " . $email ?>");
                        window.location.replace('verification.php');
                    </script>
<?php
                }
            }
        }
    }
} else if (isset($_POST['emp_login_btn'])) {
    // Employee login
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $login_query = "SELECT * FROM user WHERE email = '$email' AND password = '$password' LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);

        if (mysqli_num_rows($login_query_run) > 0) {
            $row = mysqli_fetch_array($login_query_run);
            if ($row['verification_status'] == "1") {
                $role = $row['role'];

                // Check if the user is not an admin
                if ($role != 0) {
                    $_SESSION['auth'] = true;
                    $_SESSION['userid'] = $row['user_id'];
                    $_SESSION['auth_user'] = [
                        'user_id' => $row['id'],
                        'username' => $row['username'],
                        'email' => $row['email'],
                        'firstname' => $row['firstname'],
                        'lastname' => $row['lastname'],
                        'role' => $row['role'],
                        'company' => $row['company'],
                        'department' => $row['department'],
                    ];
                    $user_id = $row['user_id'];
                    $_SESSION['role'] = $role;

                    if ($role == 1) {
                        // Regular user
                        header("Location: home_user.php");
                        $action ='Logged In';
                        $sql="INSERT INTO audit_trail (user_id,action) VALUES('$user_id','$action');";
                        $atrun= mysqli_query($con,$sql);
                        exit();
                    } else {
                        // Handle other roles here
                        $_SESSION['verification_status'] = "Access Denied!";
                        header("Location: emplogin.php");
                        exit();
                    }

                } else {
                    // Admin user, deny login
                    $_SESSION['verification_status'] = "Admins cannot log in via this form!";
                    header("Location: emplogin.php");
                    exit();
                }
            } else {
                $_SESSION['verification_status'] = "PLEASE VERIFY YOUR EMAIL!";
                header("Location: emplogin.php");
                exit();
            }
        } else {
            $_SESSION['verification_status'] = "EMAIL OR PASSWORD INVALID";
            header("Location: emplogin.php");
            exit();
        }
    } else {
        $_SESSION['verification_status'] = "ALL FIELDS MUST BE FILLED";
        header("Location: emplogin.php");
        exit();
    }
}

?>