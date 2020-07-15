<?php
session_start();
include("../connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Enlink - Admin Dashboard Template</title>

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="assets/images/logo/favicon.png"> -->

    <!-- page css -->
    <link href="assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
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
                                <li class="active">
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
                                <li>
                                    <a href="complete-orders.php">Complete Orders</a>
                                </li>
                            </ul>
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
                        <h2 class="header-title">Category List</h2>
                        <div class="header-sub-title">
                            <nav class="breadcrumb breadcrumb-dash">
                                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                                <a class="breadcrumb-item" href="#">Category</a>
                                <span class="breadcrumb-item active">Category list</span>
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
                                            <th>Category</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="category-list">
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper END -->

                <!-- modals -->
                <div class="modal fade" id="bd-example-edit-category-modal-sm">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h4">Edit category</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="text" id="hidden_edit_category_id">
                                <div class="form-group">
                                    <label for="edit_category"></label>
                                    <input id="edit_category" type="text" class="form-control" placeholder="Enter category">
                                </div>
                                <div class="form-group">
                                    <input id="save_edit_category" type="button" class="btn btn-primary form-control" value="Save">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal -->
                
                <!-- Footer START -->
                <?php include("includes/footer.php"); ?>
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->
        </div>
    </div>

    <!-- Core Vendors JS -->
    <script src="assets/js/vendors.min.js"></script>

    <!-- page js -->
    <script src="assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/pages/e-commerce-order-list.js"></script>
    <!-- <script src="assets/vendors/chartjs/Chart.min.js"></script> -->
    <!-- <script src="assets/js/pages/dashboard-default.js"></script> -->

    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>
    <!-- custom js -->
    <script src="assets/js/custom.js"></script>

</body>
</html>