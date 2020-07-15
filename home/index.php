<?php
include("../connection.php");
$ip = ip();
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
    <!-- <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png"> -->
    <!-- Place favicon.ico in the root directory -->
    <!-- all css here -->
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
    <!--Start Preloader-->
    <!-- <div class="preloader-wrap">
        <div class="spinner"></div>
    </div> -->
    <!-- search-form here -->
    <!-- <div class="search-area flex-style">
        <span class="closebar">Close</span>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 col-12">
                    <div class="search-form">
                        <form action="javascript:void(0)">
                            <input type="text" placeholder="Search Here...">
                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- search-form here -->
    <!-- header-area start -->
    <header class="header-area">
        <?php //include("includes/header-top.php"); ?>
        <?php include("includes/header-bottom.php"); ?>
    </header>
    <!-- header-area end -->
    <!-- slider or .breadcumb-area start -->
    <?php include("includes/slider.php"); ?>
    <!-- slider or .breadcumb-area end -->
    <!-- featured-area start -->
    <?php include("includes/featured-area.php"); ?>
    <!-- featured-area end -->
    <!-- product-area start -->
    <div class="product-area pt-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="product-menu mx-auto">
                        <?php include("includes/category-tab-content.php"); ?>
                    </div>
                </div>
            </div>
            <!-- filter tab -->
            <?php //include("includes/filter.php"); ?>
            <div class="tab-content">
                <!-- tab pane - all -->
                <?php include("includes/all-food.php"); ?>
                <!-- tavb pane - cakes -->
                <?php include("includes/categorize.php"); ?>
            </div>
        </div>
    </div>
    <!-- product-area end -->
    <!-- banner-area start -->
    <div class="banner-area bg-img-8">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-6 col-md-8 offset-md-4">
                    <div class="banner-wrap">
                        <p>Birthday Cake</p>
                        <h2>upto<span>50%</span> Off</h2>
                        <a href="javascript:void(0)">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area end -->
    <!-- product-area start -->
    <div class="product-area">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Our Latest Items</h2>
                        <img src="assets/images/section-title.png" alt="">
                    </div>
                </div>
            </div>
            <ul class="row">
                <?php
                $sqla = "SELECT * FROM `item-detail` ORDER BY id DESC LIMIT 4";
                $resa = mysqli_query($conn,$sqla);
                while ($items = mysqli_fetch_array($resa)) {
                    ?>
                    <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                    <div class="product-wrap">
                        <div class="product-img">
                            <span>Sale</span>
                            <img src="<?php echo $items['img']; ?>" alt="">
                            <div class="product-icon flex-style">
                            <ul>
                               <li><a href="javascript:void(0)" onclick="add_cart('<?php echo $items['id']; ?>','<?php echo $items['name']; ?>','<?php echo $items['img']; ?>','<?php echo $items['price']; ?>')"><i class="fa fa-cart-plus"></i></a></li>
                            </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="single-product.html"><?php echo $items['name']; ?></a></h3>
                            <p class="pull-left"><?php echo $items['price']; ?>
                            </p>
                        </div>
                    </div>
                </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <!-- start social-newsletter-section -->
    <?php include("includes/subscription.php"); ?>
    <!-- end social-newsletter-section -->
    <!-- .footer-area start -->
    <?php include("includes/footer.php"); ?>
    <!-- .footer-area end -->
    <!-- Modal area start -->
    <?php include("includes/cartmodal.php"); ?>
    <!-- Modal area end -->
    <!-- jquery latest version -->
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
    <script src="assets/js/custom.js"></script>
</body>


<!-- Mirrored from themepresss.com/tf/html/tohoney/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 21 Dec 2019 08:47:01 GMT -->
</html>