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
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">My orders</a>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="orde-table">
                    
                
                </tbody>
            </table>
        </div>
    </div>
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
                    console.log(data);
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