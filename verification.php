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
    <link rel="shortcut icon" href="assets/images/home_logo.ico">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <title>Verification</title>

</head>

<body>

    <br><br>
    <p style="text-align: center; font-size: 25px; font-weight: bold;"> Email Verification Code</p>
    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        </div>
    </nav>

    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card" style="background-color: #e7e7e7;">
                        <div class="text-center" style="color: #232836;">
                            <p style="font-size: 18px;">Please enter the verification code sent from your email.</p>
                            <div class="card-body text-center">
                            </div>
                            <form action="#" method="POST">
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right" style="color: #232836; white-space: nowrap;"> <i class="fa-regular fa-envelope-open"></i> OTP Code:</label>
                                    <div class="col-md-6">
                                        <input type="text" id="otp" class="form-control" name="otp_code" required oninput="restrictToNumber(this)">
                                        <span class="note" style="display: none; color: orange;">Please enter numbers only.</span>
                                    </div>

                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" value="Verify" name="verify" class="btn btn-primary" style="background-color: #424949;">
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>
</body>

</html>
<?php
include('mysql_connect.php'); // connection to MySQL
session_start();

if (isset($_POST["verify"])) {
    $otp = $_SESSION['otp'];
    $email = $_SESSION['mail'];
    $otp_code = $_POST['otp_code'];

    if ($otp != $otp_code) {
?>
        <script>
            alert("Invalid OTP code");
        </script>
    <?php
    } else {
        // Fetch the user_id and username for the current user
        $user_query = mysqli_prepare($con, "SELECT user_id, username FROM user WHERE email = ?");
        mysqli_stmt_bind_param($user_query, "s", $email);
        mysqli_stmt_execute($user_query);
        mysqli_stmt_bind_result($user_query, $user_id, $username);
        mysqli_stmt_fetch($user_query);
        mysqli_stmt_close($user_query);

        // Construct the path to the default picture
        $default_picture_path = "img/user2.png";

        // Construct the path to the new folder
        $new_folder_path =  "Images/$user_id-$username/";

        // Create the new folder if it doesn't exist
        if (!file_exists($new_folder_path)) {
            mkdir($new_folder_path, 0777, true);
        }

        // Copy the default picture to the new folder
        $new_picture_path = $new_folder_path . "user2.png";
        if (file_exists($default_picture_path)) {
            copy($default_picture_path, $new_picture_path);
        }

        $picture = "user2.png";

        // Update the user's verification status and profile picture
        $update_query = mysqli_prepare($con, "UPDATE user SET verification_status = 1, image = ? WHERE email = ?");
        mysqli_stmt_bind_param($update_query, "ss", $picture, $email);
        mysqli_stmt_execute($update_query);
        mysqli_stmt_close($update_query);

    ?>
        <script>
            alert("Verify account done, you may sign in now");
            window.location.replace("emplogin.php");
        </script>
<?php
    }
}
?>

<script src="main.js"></script>

<script>
    function restrictToNumber(input) {
        var phoneNumberNote = input.parentNode.querySelector('.note');
        var inputValue = input.value;
        var numbersOnly = inputValue.replace(/[^0-9]/g, '');

        if (inputValue !== numbersOnly) {
            phoneNumberNote.style.display = 'block';
        } else {
            phoneNumberNote.style.display = 'none';
        }

        input.value = numbersOnly;
    }
</script>

</body>

</html>