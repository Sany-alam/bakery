<?php
session_start();
if (isset($_SESSION['courier'])) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/app.min.css">
    <title>Courier</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">To-honey Couriers</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="myOrder.php">My orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="table-responsive my-3">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th>Order no</th>
                        <th>order date</th>
                        <th>Customer Name</th>
                        <th>Customer Address</th>
                        <th>Customer Phone</th>
                        <th>Products</th>
                        <th>#</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody id="orde-table">
                    
                
                </tbody>
            </table>
        </div>
    </div>
    <!-- modal -->
    <div class="modal fade" id="products-detail-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Products</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        x
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
</body>
    <script src="../assets/js/vendors.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script>
        $(function() {
            show_order()
        });
        function show_order() {
            formdata = new FormData();
            formdata.append('order_requests','order_requests');
            $.ajax({
                processData:false,
                contentType:false,
                data:formdata,
                type:"post",
                url:"data.php",
                success:function(data)
                {
                    $("#orde-table").html(data);
                },
                cache:false
            });
        }
        function complete_order(id){
            formdata = new FormData();
            formdata.append('order_id',id);
            formdata.append('order_complete','order_complete');
            $.ajax({
                processData:false,
                contentType:false,
                data:formdata,
                type:"post",
                url:"data.php",
                success:function(data)
                {
                    show_order()
                },
                cache:false
            });
        }
        function product_detail(order_no) {
            var formdata = new FormData();
            formdata.append("order_no",order_no);
            formdata.append("product_det","product_det");
            $.ajax({
                processData:false,
                contentType:false,
                data:formdata,
                type:"post",
                url:"data.php",
                success:function(data)
                {
                    $("#p-li").html(data);
                    $("#products-detail-modal").modal('show');
                },
                cache:false
            });
        }
        function reject_order(id) {
            var formdata = new FormData();
            formdata.append("order_no",id);
            formdata.append("reject_order","reject_order");
            $.ajax({
                processData:false,
                contentType:false,
                data:formdata,
                type:"post",
                url:"data.php",
                success:function(data)
                {
                    show_order();
                },
                cache:false
            });
        }
    </script>
</html>
    <?php
}else {
    header('location:login.php');
}
?>