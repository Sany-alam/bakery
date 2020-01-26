<?php
session_start();
if (isset($_SESSION['admin'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Enlink - Admin Dashboard</title>
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
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>All Products</h5>
                            <div>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Additems">Add items</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="m-t-30">
                                <ul class="list-group list-group-flush" id="item">
                                    
                                </ul> 
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

            <!-- Search Start-->
            <?php include("includes/searchBAR.php"); ?>
            <!-- Search End-->
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