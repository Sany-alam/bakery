<?php
include("../connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Easyfood - Admin</title>
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
                                <li class="active">
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
                                <li>
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
                        <h2 class="header-title">Product List</h2>
                        <div class="header-sub-title">
                            <nav class="breadcrumb breadcrumb-dash">
                                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                                <a class="breadcrumb-item" href="#">Product</a>
                                <span class="breadcrumb-item active">Product list</span>
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
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper END -->
                <!-- modal -->
                <div class="modal fade" id="edit_item_modal">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="edit_product_id">
                                <div class="form-group">
                                    <label for="edit_product_name">Name</label>
                                    <input id="edit_product_name" type="text" class="form-control" placeholder="Enter item name">
                                </div>
                                <div class="form-group">
                                    <label for="edit_product_quantity">Item quantity</label>
                                    <input min="1" placeholder="Enter item quantity" type="number" class="form-control" id="edit_product_quantity">
                                </div>
                                <div class="form-group">
                                    <label for="edit_product_price">Price</label>
                                    <input id="edit_product_price" type="text" class="form-control" placeholder="Enter item price">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button id="edit_product_save" type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
                <!-- Footer START -->
                <?php include("includes/footer.php"); ?>
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->
        </div>
    </div>

    <!-- Core Vendors JS -->
    <script src="assets/js/vendors.min.js"></script>

    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>
    <!-- custom js -->
    <script src="assets/js/custom.js"></script>

</body>
</html>