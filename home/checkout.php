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

                        <h5><b>Payment</b></h5>
                        <input id="onDeliver" type="radio" name="deliverymethod" class="mr-2">
                        <label for="onDeliver">Cash on delivery</label>
                        <input id="bkash" type="radio" name="deliverymethod">
                        <label for="bkash">Bkash</label>
                        <div id="payment-alert" style="display:none;" class="alert alert-danger">Chose a payment method</div>

                        <hr>
                        <textarea id="address" class="form-control mb-2" placeholder="Your address"></textarea>
                        <div id="address-alert" style="display:none;" class="alert alert-danger">Ensure your address</div>
                        <button onclick="place_order()">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width:500px;">
            <div class="modal-content" >
                <button style="position: absolute;right: -48px;top: -48px;width: 50px;height: 50px;background: #ef4836;text-align: center;font-size: 24px;border: none;color: #fff;opacity: 1;" type="button" class="close" data-dismiss="modal" aria-label="Close" style="width: 40px;height: 40px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <p><strong>Merchant No: +8801858814456</strong></p>
                    <hr>
                    <label for="transaction">Enter transaction id</label>
                    <input id="transaction" type="text" class="form-control mb-3" autofocus>
                    <div class="alert alert-danger" id="transaction-alert" style="display:none;">Ensure transaction id</div>
                    <button id="transaction_submit" style="height: 45px;width: 100%;background: #ef4836;text-transform: uppercase;color: #fff;border: none;">Submit</button>
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
        var delMethod = '';
        $("#bkash").click(function(){
            delMethod = 'bkash';
            $("#exampleModalCenter").modal("show");
        });
        $("#onDeliver").click(function(){
            delMethod = 'delivery';
        });

        function deliveryMethod(){
            if (delMethod.length!=0) {
                if (delMethod == 'bkash') {
                    // transactionCheck();
                    if ($("#transaction").val().length!=0) {
                        $("#exampleModalCenter").modal("hide");
                        $("#transaction-alert").hide();
                        return false;
                    }else{
                        $("#exampleModalCenter").modal("show");
                        $("#transaction-alert").show();
                        return true;
                    }
                    $("#payment-alert").hide();
                }
                else{
                    $("#payment-alert").hide();
                    return false;
                }
            }else{
                $("#payment-alert").show();
                return true;
            }
        }

        $("#address").focusout(function(){
            addressInput();
        });

        function addressInput() 
        {
            if ($("#address").val().length!=0) {
                $("#address-alert").hide();
                return false;
            }else{
                $("#address-alert").show();
                return true;
            }
        }

        $("#transaction_submit").click(function() {
            if (deliveryMethod()) {
                $("#transaction-alert").show();
            }else{
                $("#transaction-alert").hide();
                $("#exampleModalCenter").modal("hide");
            }
        });
        
        function place_order() {
            if (addressInput() == false && deliveryMethod() == false) {
                var address = $("#address").val();
                var payment_method = delMethod;
                var formdata = new FormData();
                formdata.append("address",address);
                formdata.append("payment_method",payment_method);
                formdata.append("transaction",$("#transaction").val());
                formdata.append("order","order");
                $.ajax({
                    processData:false,
                    contentType:false,
                    data:formdata,
                    type:"post",
                    url:"data.php",
                    success:function(data){
                        alert("Your order adedd successfully! Countinue shopping");
                        location.href="index.php";
                    },
                    cache:false
                });
            }else{
                if (addressInput() == true) {
                    $("#address-alert").show();
                }
                if (deliveryMethod() == true) {
                    
                }
            }
        }

    </script>
</body>
</html>
<?php
}else{
    header("location:login.php");
}
?>