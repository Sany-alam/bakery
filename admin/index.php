<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themenate.com/enlink-bs/dist/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Nov 2019 04:53:35 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Enlink - Admin Dashboard Template</title>

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
            <?php include("includes/sidebar.php"); ?>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">
                <!-- Content Wrapper START -->
                <div class="main-content">
                <?php include("includes/content.php"); ?>
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