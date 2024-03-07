<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./css/des5.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <link rel="stylesheet" href="css/user.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <div class="container">
        <h2>Select Account Type</h2>
        <form action="process.php" method="post">
            <div class="button-group">
                <button type="button" class="btn btn-primary" onclick="selectAccountType('enterpriseUser')">
                    <div class="button-option">
                        <img src="img/1.png" alt="Enterprise User">
                        Admin
                    </div>
                </button>

                <button type="button" class="btn btn-primary" onclick="selectAccountType('staffIndividualUser')">
                    <div class="button-option">
                        <img src="img/2.png" alt="Staff Individual User">
                        Employee
                    </div>
                </button>
            </div>

            <!-- Hidden input to store the selected account type -->
            <input type="hidden" name="accountType" id="selectedAccountType" value="enterpriseUser">
        </form>
    </div>
</body>



<!-- Hidden input to store the selected account type -->
<input type="hidden" name="accountType" id="selectedAccountType" value="enterpriseUser">

</form>
</div>

<script>
    function selectAccountType(type) {
        document.getElementById('selectedAccountType').value = type;
    }
</script>
</body>

</html>