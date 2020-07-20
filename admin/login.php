<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("location:index.php");
}
else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Easyfood - Admin</title>
    <!-- Core css -->
    <link href="assets/css/app.min.css" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="container-fluid">
            <div class="d-flex full-height p-v-15 flex-column justify-content-between">
                <div class="d-none d-md-flex p-h-40">
                    <img src="../home/assets/images/logo.png" alt="">
                    <!-- <img src="assets/images/logo/logo.png" alt=""> -->
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="m-t-20">Sign In</h2>
                                    <p class="m-b-30">Enter your credential to get access</p>
                                    <?php
                                    if (isset($_SESSION['congo'])) {
                                        echo $_SESSION['congo'];
                                        session_unset();
                                    }
                                    ?>
                                    <form>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="userName">Username:</label>
                                        <div class="input-affix">
                                            <i class="prefix-icon anticon anticon-user"></i>
                                            <input type="text" class="form-control" id="userName" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="password">Password:</label>
                                        <div class="input-affix m-b-10">
                                            <i class="prefix-icon anticon anticon-lock"></i>
                                            <input type="password" class="form-control" id="password" placeholder="Password">
                                        </div>
                                        <?php
                                        if (isset($_SESSION['logout'])) {
                                            echo $_SESSION['logout'];
                                            session_unset();
                                        }
                                        ?>
                                        <small id="login_alert" style="display:block" class=" text-danger text-center"></small>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <button type="button" class="btn btn-primary" id="signin">Sign In</button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <div class="offset-md-1 col-md-6 d-none d-md-block">
                            <img class="img-fluid" src="assets/images/others/login-2.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Core Vendors JS -->
    <script src="assets/js/vendors.min.js"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>

    <!-- custom js -->
    <script src="assets/js/LoginValidation.js"></script>

</body>
</html>
<?php
}
?>