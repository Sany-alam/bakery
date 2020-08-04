<?php
include("../connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Easyfood - Admin</title>

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="assets/images/logo/favicon.png"> -->

    <!-- page css -->
    <link href="assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendors/select2/select2.css" rel="stylesheet">

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
            <div class="side-nav">
                <div class="side-nav-inner">
                    <ul class="side-nav-menu scrollable">
                        <li>
                            <a href="index.php">
                            <span class="icon-holder"><i class="anticon anticon-appstore"></i></span>
                                <span class="title">Home</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-appstore"></i>
                                </span>
                                <span class="title">Product</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="add-product.php">Add product</a>
                                </li>
                                <li>
                                    <a href="product-detail.php">Product Detail</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-appstore"></i>
                                </span>
                                <span class="title">Category</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="add-category.php">Add category</a>
                                </li>
                                <li>
                                    <a href="category-list.php">View Categories</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-appstore"></i>
                                </span>
                                <span class="title">Orders</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="order-request.php">Order request</a>
                                </li>
                                <li>
                                    <a href="pending-orders.php">Pending Orders</a>
                                </li>
                                <li class="active">
                                    <a href="complete-orders.php">Complete Orders</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="courier.php">
                                <span class="icon-holder">
                                    <i class="anticon anticon-appstore"></i>
                                </span>
                                <span class="title">Courier</span>
                            </a>
                        </li>
                        <li>
                            <a href="user_list.php">
                                <span class="icon-holder">
                                    <i class="anticon anticon-appstore"></i>
                                </span>
                                <span class="title">Customer</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">
                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="page-header">
                        <h2 class="header-title">Complete Orders</h2>
                        <div class="header-sub-title">
                            <nav class="breadcrumb breadcrumb-dash">
                                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                                <span class="breadcrumb-item active">Orders</span>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                        <div class="table-responsive">
                                <table class="table table-hover e-commerce-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="checkbox">
                                                    <input id="checkAll" type="checkbox">
                                                    <label for="checkAll" class="m-b-0"></label>
                                                </div>
                                            </th>
                                            <th>ID</th>
                                            <th>Customer</th>
                                            <th>Courier</th>
                                            <th>Order Date</th>
                                            <th>Complete Order Date</th>
                                            <th>Products</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="complete-order">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                <?php include("includes/footer.php"); ?>
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->
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
    <div class="modal fade delivery-courier-detail" id="exampleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Couriei detail</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body" id="delivery-courier-detail">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->

    <!-- Core Vendors JS -->
    <script src="assets/js/vendors.min.js"></script>

    <!-- page js -->
    <script src="assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/pages/e-commerce-order-list.js"></script>
    <!-- <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/js/pages/dashboard-default.js"></script> -->
    <script src="assets/vendors/select2/select2.min.js"></script>

    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>
    <!-- custom js -->
    <script src="assets/js/custom.js"></script>
    <script>
    $(function() {
        $('.select2').select2();
    });
    </script>

</body>
</html>