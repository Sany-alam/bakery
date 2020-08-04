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
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<div class="m-0 row justify-content-center align-items-center">
    <div class="logo">
        <a href="index.php">
            <h1 style="font-weight:bold;font-size: 30px;margin: 0px;"><div class="d-inline-block" style="color:#ef4836;">Easy</div><div class="d-inline-block" style="color:#000;">Food</div></h1>
        </a>
    </div>
</div>
<hr class="m-0">
<div class="account-area ptb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <div class="account-form form-style">
                        <h1 class="text-center">Enter Email </h1>
                        <?php 
                        if (isset($_SESSION['register'])) {
                            ?>
                            <div class="alert alert-success"><?php echo $_SESSION['register'] ?></div>
                            <?php
                            unset($_SESSION['register']);
                        }
                        ?>
                        <form id="forgot_password_email" action="data.php" method="post">
                        <p>Enter Email</p>
                        <input name="email" type="email">
                
                        <input type="hidden" name="forgot_password_email">
                       
                        <div id="login-alert" class="alert alert-danger"></div>
                        <button type="submit">Send Email</button>
                        <!-- <div class="text-center">
                            <a href="signup.php">Or Create an Account</a>
                        </div> -->
                        
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
        document.querySelector("#login-alert").style.display="none";
        $("#forgot_password_email").on('submit',function(e){
            e.preventDefault();
            if ($("input[name='email']").val().length!=0) {
                $.ajax({
                    url:'data.php',
                    type:'post',
                    data:$("#forgot_password_email").serialize(),
                    success:function(data) {
                        console.log(data);
                        a = $.trim(data);
                     
                        if(a == 'registered'){
                            document.querySelector("#login-alert").innerHTML="Password reset link has sent to your email. Please check spam folder too.";
                            document.querySelector("#login-alert").style.display="block";
                            
                        }
                        else{
                            document.querySelector("#login-alert").innerHTML="Please enter registered email";
                            document.querySelector("#login-alert").style.display="block";
                        }
                    }
                });
            }else{
                document.querySelector("#login-alert").innerHTML="Fiil up input";
                document.querySelector("#login-alert").style.display="block";
            }
        });
    </script>
</html>
<?php
}