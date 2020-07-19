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
$customer = $_SESSION['user']['id'];
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
    <!-- header-area start -->
    <header class="header-area">
        <?php include("includes/header-bottom.php"); ?>
    </header>
    
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>MY ORDERS</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row mt-60">
                <div class="col-12">
                    <div class="single-product-menu">
                        <ul class="nav">
                            <li><a class="active" data-toggle="tab" href="#request">In request</a></li>
                            <li><a data-toggle="tab" href="#processing">Processing</a></li>
                            <li><a data-toggle="tab" href="#complete">Complete</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="request">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table-responsive cart-wrap">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Date</th>
                                                <th>Products</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql_req = "SELECT * FROM `orders` WHERE `customer` = '$customer' AND `status` = 'request' GROUP BY `order_no`";
                                            $res_req = mysqli_query($conn,$sql_req);
                                            if (mysqli_num_rows($res_req)>0) {
                                                while ($fetch_req = mysqli_fetch_array($res_req)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $fetch_req['id']; ?></td>
                                                        <td><?php echo $fetch_req['order_date']; ?></td>
                                                        <td><a onclick="products('<?php echo $fetch_req['order_no']; ?>')" href="javascript:;">Products</a></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }else {
                                                ?><tr><td colspan="3">No data available</td></tr><?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="processing">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table-responsive cart-wrap">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Date</th>
                                                <th>Products</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql_pro = "SELECT * FROM `orders` WHERE `customer` = '$customer' AND `status` = 'processing' GROUP BY `order_no`";
                                            $res_pro = mysqli_query($conn,$sql_pro);
                                            if (mysqli_num_rows($res_pro)>0) {
                                                while ($fetch_pro = mysqli_fetch_array($res_pro)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $fetch_pro['id']; ?></td>
                                                        <td><?php echo $fetch_pro['order_date']; ?></td>
                                                        <td><a onclick="products('<?php echo $fetch_pro['order_no']; ?>')" href="javascript:;">Products</a></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }else {
                                                ?><tr><td colspan="3">No data available</td></tr><?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="complete">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table-responsive cart-wrap">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Ordered in</th>
                                                <th>Completed in</th>
                                                <th>Products</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql_com = "SELECT * FROM `orders` WHERE `customer` = '$customer' AND `status` = 'complete' GROUP BY `order_no`";
                                            $res_com = mysqli_query($conn,$sql_com);
                                            if (mysqli_num_rows($res_com)>0) {
                                                while ($fetch_com = mysqli_fetch_array($res_com)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $fetch_com['id']; ?></td>
                                                        <td><?php echo $fetch_com['order_date']; ?></td>
                                                        <td><?php echo $fetch_com['complete_order_date']; ?></td>
                                                        <td><a onclick="products('<?php echo $fetch_com['order_no']; ?>')" href="javascript:;">Products</a></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }else {
                                                ?><tr><td colspan="3">No data available</td></tr><?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="products-detail-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Products</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="p-li">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->

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
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php
}else{
    header('location:index.php');
}