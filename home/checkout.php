<?php
include("../connection.php");
if (isset($_SESSION['user'])) {
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
    <title>Easyfood</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- bootstrap v3.3.7 css -->
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
    <!-- header-area start -->
    <?php include("includes/header-bottom.php"); ?>
    <!-- header-area end -->
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="order-area">
                        <h3>Your Order</h3>
                        <ul class="total-cost" id="order-list">
                            
                        </ul>
                        <!-- <h5 class="text-primary text-center">Cash on delivery</h5> -->
                        <textarea id="address" class="form-control mb-2" placeholder="Your address"></textarea>
                        <div class="alert">Ensure your address</div>
                        <button onclick="place_order()">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
    <!-- .footer-area start -->
    <?php include("includes/footer.php"); ?>
    <!-- .footer-area end -->
    <!-- all js -->
    <?php include("includes/scripts.php"); ?>
    <script>
    document.querySelector(".alert").style.display='none';
    </script>
</body>
</html>
<?php
}else{
    header("location:login.php");
}
?>