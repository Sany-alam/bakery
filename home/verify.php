
<?php
include("../connection.php");
if (isset($_SESSION['user'])) {
    header('location:index.php');
}else{
function ip()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDER_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDER_FOR'];
  }
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
//   echo $ip;
}
$ip = ip();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array($ip);
}

if ($_GET['token']) {
    $token = $_GET['token'];
    $sql = "UPDATE `customer` SET `email_status`='active' WHERE `token` = '$token'";
    $res = mysqli_query($conn,$sql);
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Easyfood</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <!-- font-awesome v4.6.3 css -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- flaticon.css -->
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <!-- jquery-ui.css -->
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <!-- metisMenu.min.css -->
    <link rel="stylesheet" href="assets/css/metisMenu.min.css">
    <!-- swiper.min.css -->
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
    </style>
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<div class="row m-0 justify-content-center align-iteams-center" style="height:100vh;">
        <div class="card col-6" style="height: 30%;margin-bottom: auto;margin-top: auto;">
            <div class="card-body">
                <div class="text-center"><a href="index.php">
                    <h1 style="font-weight:bold;font-size: 30px;margin: 0px;"><div class="d-inline-block" style="color:#ef4836;">Easy</div><div class="d-inline-block" style="color:#000;">Food</div></h1>
                </a></div>
                <hr>
                <p class="text-center">Your have verifies successfully your email.</p>
                <p class="text-center">Visit <a href="login.php"><u>here</u></a> to Login</p>
            </div>
        </div>
</div>
</body>
<script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- mouse_scroll.js -->
    <script src="assets/js/mouse_scroll.js"></script>
    <!-- scrollup.js -->
    <script src="assets/js/scrollup.js"></script>
    <!-- isotope.pkgd.min.js -->
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <!-- imagesloaded.pkgd.min.js -->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- jquery.zoom.min.js -->
    <script src="assets/js/jquery.zoom.min.js"></script>
    <!-- swiper.min.js -->
    <script src="assets/js/swiper.min.js"></script>
    <!-- metisMenu.min.js -->
    <script src="assets/js/metisMenu.min.js"></script>
    <!-- mailchimp.js -->
    <script src="assets/js/mailchimp.js"></script>
    <!-- jquery-ui.min.js -->
    <script src="assets/js/jquery-ui.min.js"></script>
    <!-- main js -->
    <script src="assets/js/scripts.js"></script>
    <!-- custom java scripts and ajax -->
</html>
<?php
}