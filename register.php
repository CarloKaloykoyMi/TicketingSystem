<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/regis1.css"> <!-- Your custom CSS -->

    <link rel="shortcut icon" href="image/ticket_logo.png">
    <?php
    include('function/myfunction.php');
    ?>

</head>
<style>
    /* The message box is shown when the user clicks on the password field */
    #message {
        display: none;
        background: #f1f1f1;
        color: #000;
        position: relative;
        padding: 15px;
        margin-top: 9px;
    }

    #message p {
        padding: 9px 30px;
        font-size: 14px;
    }

    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
        color: green;
    }

    .valid:before {
        position: relative;
        left: -35px;
        content: "✅";
    }

    /*copy & paste symbol*/
    /* Add a red text color and an "x" when the requirements are wrong */
    .invalid {
        color: red;
    }

    .invalid:before {
        position: relative;
        left: -35px;
        content: "❌";
    }
</style>

<body>

    <!-- Navbar -->
    <header id="header">
        <nav class="navbar">
            <div class="navbar-logo">
                <img src="img/logo2.png">
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

    <!-- Logo-->
    <div class="container">
        <div class="logo-container">
            <a href="index.html">
                <span><img src="image/ticket_logo.png" alt="" height="80"></span>
            </a>
        </div>
        <div class="text-center w-75 m-auto">
            <h4 class="" style="color: #232836;">Free Sign Up</h4>
            <p class="" style="color: 232836;"> Don't have an account yet? Create your account, it takes less than a minute. </p>
        </div>
        <br>
        <div class="content">
            <form action="code.php" method="post" name="register">
                <div class="row mb-3">
                    <span class="title" style="color: #232836;">Personal Details</span>

                    <div class="col-md-4 mt-2">
                        <label for="lastname" class="form-label"><i class="fas fa-user"></i> Last Name</label>
                        <input class="form-control" type="text" name="lastName" id="lastNameInput" placeholder="Enter your Last Name" oninput="restrictToLettersWithSingleSpace(this)" required>
                        <span class="note" style="display: none; color: red;">Please enter letters only.</span>
                    </div>

                    <div class="col-md-4 mt-2">
                        <label for="firstname" class="form-label"> <i class="fas fa-user"></i> First Name</label>
                        <input class="form-control" type="text" name="firstName" id="firstNameInput" placeholder="Enter your First Name" oninput="restrictToLettersWithSingleSpace(this)" required>
                        <span class="note" style="display: none; color: red;">Please enter letters only.</span>
                    </div>

                    <div class="col-md-4 mt-2">
                        <label for="middlename" class="form-label"> <i class="fas fa-user"></i> Middle Initial</label>
                        <input class="form-control" type="text" name="middleinitial" id="middleNameInput" placeholder="Enter your Middle Initial (Optional)" oninput="restrictToLettersWithSingleSpace(this)" maxlength="2">
                        <span class=" note" style="display: none; color: red;">Please enter letters only.</span>

                    </div>

                    <div class="col-md-4 mt-2">
                        <label for="company" class="form-label"><i class="fa-solid fa-building"></i> Company</label>
                        <select id=company name="company" class="form-control" required>
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

                    <div class="col-md-4 mt-2">
                        <label for="branch" id="branchGroup" class="form-label"> <i class="fa-solid fa-location-dot"></i> Branch:</label>
                        <select class="form-control" id="branch" name="branch" required>
                            <option value="">Select Branch:</option>
                        </select>
                    </div>

                    <div class="col-md-4 mt-2">
                        <label for="department" class="form-label"><i class="fa-solid fa-users"></i> Department</label>
                        <select id=department name="department" class="form-control" required>
                            <option value="" disabled selected>Select your Department</option>
                            <?php
                            $department = getAll("department");
                            if (mysqli_num_rows($department) > 0) {
                                foreach ($department as $department) {
                            ?>
                                    <option value="<?= $department['department_name']; ?>"><?= $department['department_name']; ?></option>
                            <?php
                                }
                            } else {
                                echo "<option value=''>No Department available</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="contact" class="form-label"> <i class="fa-solid fa-phone"></i> Contact Number</label>
                        <input class="form-control" type="text" name="contact" id="phoneNumberInput" placeholder="Enter your Contact Number" required oninput="restrictToNumbers(this)" required>
                        <span class="note" style="display: none; color: red;">Please enter a valid 11-digit numbers.</span>
                    </div>


                    <div class="col-md-4 mt-2">
                        <label for=" username" class="form-label"> <i class="fas fa-user"></i> Username</label>
                        <input class="form-control" type="text" name="username" id="firstNameInput" placeholder="Enter your Username" required>
                        <span class="note" style="display: none; color: red;">Please enter letters only.</span>
                    </div>

                    <div class="col-md-4 mt-2">
                        <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Enter your password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fas fa-eye"></i></button>
                        </div>
                        <div id="message">
                            <h6>Password must contain:</h6>
                            <p id="letter" class="invalid">At least one letter</ p>
                            <p id="capital" class="invalid">At least one capital letter</p>
                            <p id="number" class="invalid">At least one number</p>
                            <p id="special" class="invalid">At least one special character</p>
                            <p id="length" class="invalid">Minimum 8 characters</p>
                        </div>
                    </div>

                    <div class="col-md-4 mt-2">
                        <label for="confirmPassword" class="form-label"><i class="fas fa-lock"></i> Confirm Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="confirm" id="confirmPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*(),.?\:{}|<>]).{8,}" placeholder="Confirm your password" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>

                    <div>
                        <div class="row justify-content-center">
                            <label class="form-check-label text-center">
                                <br><input class="form-check-input" type="checkbox" value="" id="policyCheckbox" required>
                                I agree to the terms and conditions of the <a href="policy.php" class="text-orange">Policy</a>
                            </label>
                        </div>
                    </div>

                </div>
                <div class="button-container">
                    <button type="submit" name="register" class="btn btn-primary"><i class="fas fa-user-plus"></i> Register</button>
                </div>

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="" style="color: #232836;">Already have an account? <a href="emplogin.php" class="text-orange">Login</a>
                    </div> <!-- end col-->
                </div>


            </form>
        </div>
    </div>

    <script>
        function show() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    <script>
        var myInput = document.getElementById("password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            var specialCharacters = /[!@#$%^&*(),.?\:{}|<>]/g;
            if (myInput.value.match(specialCharacters)) {
                special.classList.remove("invalid");
                special.classList.add("valid");
            } else {
                special.classList.remove("valid");
                special.classList.add("invalid");
            }

            // Validate length
            if (myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }
    </script>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        const togglePasswordButton = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePasswordButton.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePasswordButton.querySelector('i').classList.toggle('fa-eye');
            togglePasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>

    <script>
        const toggleConfirmPasswordButton = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('confirmPassword');

        toggleConfirmPasswordButton.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            toggleConfirmPasswordButton.querySelector('i').classList.toggle('fa-eye');
            toggleConfirmPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>

    <script>
        // Function to show the success modal
        function showSuccessModal() {
            $('#successModal').modal('show');
        }
    </script>

    <script>
        function restrictToLettersWithSingleSpace(input) {
            var lastNameNote = input.parentNode.querySelector('.note');
            var inputValue = input.value;

            // Replace multiple spaces with a single space
            inputValue = inputValue.replace(/  +/g, ' ');

            // Remove any non-letter characters except spaces
            var lettersOnly = inputValue.replace(/[^A-Za-z ]/g, '');

            if (inputValue !== lettersOnly && inputValue.trim() !== '') {
                lastNameNote.style.display = 'block';
            } else {
                lastNameNote.style.display = 'none';
            }

            input.value = lettersOnly;
        }
    </script>

    <script>
        var input = document.getElementById("bdate");

        input.addEventListener("input", function() {
            var selectedDate = new Date(this.value);
            var currentDate = new Date();
            var minDate = new Date(currentDate.getFullYear() - 18, currentDate.getMonth(), currentDate.getDate());

            if (selectedDate > minDate) {
                this.setCustomValidity("You must be at least 18 years old.");
            } else {
                this.setCustomValidity("");
            }
        });
    </script>

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
    </script>

    <script>
        function restrictToNum(input) {
            var postalNote = input.parentNode.querySelector('.note');
            var inputValue = input.value;
            var numbersOnly = inputValue.replace(/[^0-9]/g, '').slice(0, 4);

            if (inputValue !== numbersOnly || inputValue.length !== 4) {
                postalNote.style.display = 'block';
            } else {
                postalNote.style.display = 'none';
            }

            input.value = numbersOnly;
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#company').change(function() {
                var companyName = $(this).val();

                $.ajax({
                    url: 'get_branches.php',
                    type: 'POST',
                    data: {
                        company_name: companyName
                    },
                    success: function(response) {
                        console.log(response);
                        $('#branch').html(response);
                        $('#branchGroup').toggle(response.trim() !== '');
                    },
                    error: function() {
                        alert('Error fetching branches.');
                    }
                });
            });
        });
    </script>
</body>

</html>