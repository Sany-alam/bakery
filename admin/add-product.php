<?php
include("../connection.php");
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themenate.com/enlink-bs/dist/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Nov 2019 04:53:35 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Easyfood - Admin</title>

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="assets/images/logo/favicon.png"> -->

    <!-- page css -->

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
                                <li class="active">
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
                    </ul>
                </div>
            </div>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">
                <!-- Content Wrapper START -->
                <div class="main-content">
                <div class="page-header">
                        <h2 class="header-title">Add Product</h2>
                        <div class="header-sub-title">
                            <nav class="breadcrumb breadcrumb-dash">
                                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                                <a class="breadcrumb-item" href="#">Product</a>
                                <span class="breadcrumb-item active">Add Product</span>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header my-4">
                            <h3 class="text-center">Add product</h3>
                        </div>
                        <div class="card-body ">
                        <div class="form-group">
                    <label for="add-item-name">Item name</label>
                    <input placeholder="Enter item name"type="text" class="form-control" id="add-item-name">
                </div>
                <div class="form-group">
                    <label for="add-item-category">Item category</label>
                    <select id="add-item-category" class="form-control form-control-sm">
                        <option value="">Category</option>
                        <?php
                        $sql_category = "SELECT * FROM `category`";
                        $res_category = mysqli_query($conn,$sql_category);
                        while ($item_category = mysqli_fetch_array($res_category)) {
                            $category = $item_category['category'];
                        ?>
                        <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="add-item-price">Item price</label>
                    <input placeholder="Enter item price" type="number" class="form-control" id="add-item-price">
                </div>
                <div class="form-group">
                    <label for="add-item-description">Item description</label>
                    <input placeholder="Enter item description" type="text" class="form-control" id="add-item-description">
                </div>
                <div class="form-group">
                    <label for="add-item-image">Item image</label>
                    <input type="file" class="form-control" id="add-item-image">
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" id="add_Items">Add product</button>
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