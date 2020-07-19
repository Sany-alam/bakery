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
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tohoney - Shop</title>
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
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<div class="account-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <div class="account-form form-style">
                        <h1 class="text-center">Login</h1>
                        <form id="login" action="data.php" method="post">
                        <p>Email Address *</p>
                        <input name="email" type="email">
                        <p>Password *</p>
                        <input name="password" type="Password">
                        <input type="hidden" name="login">
                        <div class="alert alert-danger"></div>
                        <button type="submit">SIGN IN</button>
                        <div class="text-center">
                            <a href="signup.php">Or Creat an Account</a>
                        </div>
                        </form>
                    </div>
                </div>
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
    <script>
        document.querySelector(".alert").style.display="none";
        $("#login").on('submit',function(e){
            e.preventDefault();
            if ($("input[name='email']").val().length!=0&&$("input[name='password']").length!=0) {
                $.ajax({
                    url:'data.php',
                    type:'post',
                    data:$("#login").serialize(),
                    success:function(data) {
                        console.log(data);
                        a = $.trim(data);
                        if (a == 'ok') {
                            document.querySelector(".alert").style.display="none";
                            location.reload();
                        }else{
                            document.querySelector(".alert.alert-danger").innerHTML="Invalid credentials";
                            document.querySelector(".alert").style.display="block";
                        }
                    }
                });
            }else{
                document.querySelector(".alert.alert-danger").innerHTML="Fiil up input";
                document.querySelector(".alert.alert-danger").style.display="block";
            }
        });
    </script>
</html>
<?php
}