<?php
session_start();
if (isset($_SESSION['admin'])) {
    include("../connection.php");
    $sql_item = "SELECT * FROM `item-detail`";
    $res_item = mysqli_query($conn,$sql_item);

    $sql_complete_order = "SELECT * FROM `orders` WHERE `status` = 'complete' GROUP BY order_no";
    $res_complete_order = mysqli_query($conn,$sql_complete_order);

    $sql_request_order = "SELECT * FROM `orders` WHERE `status` = 'request' GROUP BY order_no";
    $res_request_order = mysqli_query($conn,$sql_request_order);

    $sql_customer = "SELECT * FROM `orders` GROUP BY `name`";
    $res_customer = mysqli_query($conn,$sql_customer);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>To-honey - Admin</title>
    <!-- Core css -->
    <link href="assets/css/app.min.css" rel="stylesheet">
</head>
<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <?php include("includes/header.php"); ?>   
            <!-- Header END -->
            <!-- Side Nav START -->
            <?php include("includes/sidebar.php"); ?>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">
                <!-- Content Wrapper START -->
                <div class="main-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                                    <i class="anticon anticon-database"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <h2 class="m-b-0"><?php echo mysqli_num_rows($res_item); ?></h2>
                                        <p class="m-b-0 text-muted">Total Items</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                        <i class="anticon anticon-user"></i>
                                    </div>
                                    <div class="m-l-15">
                                    <h2 class="m-b-0"><?php echo mysqli_num_rows($res_customer); ?></h2>
                                        <p class="m-b-0 text-muted">Total customers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="avatar avatar-icon avatar-lg avatar-gold">
                                        <i class="anticon anticon-line-chart"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <h2 class="m-b-0"><?php echo mysqli_num_rows($res_complete_order); ?></h2>
                                        <p class="m-b-0 text-muted">Total completed orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="avatar avatar-icon avatar-lg avatar-purple">
                                        <i class="anticon anticon-profile"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <h2 class="m-b-0"><?php echo mysqli_num_rows($res_request_order) ?></h2>
                                        <p class="m-b-0 text-muted">Orders in request</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content Wrapper END -->
        </div>
    </div>

    <!-- modals -->
    <?php include("includes/modals.php"); ?>
    <!-- Core Vendors JS -->
    <script src="assets/js/vendors.min.js"></script>

    <!-- page js -->
    <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <!-- <script src="assets/js/pages/dashboard-default.js"></script> -->

    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>
    <!-- custom js -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
<?php
}
else {
    header("location:login.php");
}
?>