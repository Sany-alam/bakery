<?php
session_start();
if (!isset($_SESSION['admin'])) {
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themenate.com/enlink-bs/dist/sign-up-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Nov 2019 04:57:48 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Enlink - Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.png">

    <!-- page css -->
    <link href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Core css -->
    <link href="assets/css/app.min.css" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="container-fluid p-0 h-100">
            <div class="row no-gutters h-100 full-height">
                <div class="col-lg-4 d-none d-lg-flex bg" style="background-image:url('assets/images/others/sign-up-1.jpg')">
                    <div class="d-flex h-100 p-h-40 p-v-15 flex-column justify-content-between">
                        <div>
                            <img src="assets/images/logo/logo-white.png" alt="">
                        </div>
                        <div>
                            <h1 class="text-white m-b-20 font-weight-normal">Exploring Enlink</h1>
                            <p class="text-white font-size-16 lh-2 w-80 opacity-08">Climb leg rub face on everything give attitude nap all day for under the bed. Chase mice attack feet but rub face on everything hopped up.</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-white">© 2019 ThemeNate</span>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-white text-link" href="#">Legal</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-white text-link" href="#">Privacy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 bg-white">
                    <div class="container h-100">
                        <div class="row no-gutters h-100 align-items-center">
                            <div class="col-md-8 col-lg-7 col-xl-6 mx-auto">
                                <h2>Sign Up</h2>
                                <p class="m-b-30">Create your account to get access</p>
                                <form enctype="multipart/form-data">
                                <div id="final-form">
                                    <div class="form-group">
                                        <label>Birth date:</label>
                                        <div class="input-affix m-b-10">
                                            <i class="prefix-icon anticon anticon-calendar"></i>
                                            <input id="birthdate" type="text" class="form-control datepicker-input" placeholder="Pick a date" autocomplete="off">
                                            <small class="text-danger text-center" id="birthdate_alert"></small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="address">Full Address:</label>
                                        <input type="text" class="form-control" id="address" placeholder="Full Address">
                                        <small class="text-danger text-center" id="address_alert"></small>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="city">State & City:</label>
                                        <input type="text" class="form-control" id="city" placeholder="State & City">
                                        <small class="text-danger text-center" id="city_alert"></small>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="language">Language</label>
                                        <select id="language" class="form-control">
                                            <option value="English">Select Language</option>
                                            <option value="English">English</option>
                                            <option value="Bangla">Bangla</option>
                                            <option value="Arebic">Arebic</option>
                                        </select>
                                        <small class="text-danger text-center" id="language_alert"></small>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between p-t-15">
                                            <div class="checkbox">
                                                <input id="agreement_check" type="checkbox">
                                                <label for="agreement_check"><span>I have read the <a href="javascript:void(0)">agreement</a></span></label>
                                            </div>
                                            <button type="button" id="submit" class="btn btn-primary">Sign In</button>
                                        </div>
                                        <div class="font-size-13 text-muted text-center">
                                            Already have an account?
                                            <a class="small" href="login.php"> Sign in</a>
                                        </div>
                                    </div>
                                </div>
                                <div id="initial-form">
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="userName">Username:</label>
                                        <input type="text" class="form-control" id="name" placeholder="name" autocomplete="off">
                                        <small class="text-danger text-center" id="name_alert"></small>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email">
                                        <small class="text-danger" id="email_alert"></small>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="phone">Phone number:</label>
                                        <input type="number" class="form-control" id="phone" placeholder="Phone number">
                                        <small class="text-danger text-center" id="phone_alert"></small>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="password">Password:</label>
                                        <input type="password" class="form-control" id="password" placeholder="Password">
                                        <small class="text-danger" id="password_alert"></small>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="confirmPassword">Confirm Password:</label>
                                        <input type="password" class="form-control" id="rpassword" placeholder="Confirm Password">
                                        <small class="text-danger" id="rpassword_alert"></small>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between p-t-15">
                                            <button type="button" id="submit-next" class="btn btn-primary">Next</button>
                                        </div>
                                        <div class="font-size-13 text-muted text-center">
                                            Already have an account?
                                            <a class="small" href="login.php"> Sign in</a>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Core Vendors JS -->
    <script src="assets/js/vendors.min.js"></script>

    <!-- page js -->
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/SignupValidation.js"></script>


</body>
</html>
<?php
}
else {
    header('location:index.php');
}
?>