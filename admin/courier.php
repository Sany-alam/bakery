<?php
session_start();
if (isset($_SESSION['admin'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>To-honey - Admin</title>
    <!-- Core css -->
    <link href="assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
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
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center justify-content-center">
                                <h4>Courier list</h4>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#AddCourierModal">Add Courier</button>
                            </div>
                            <div  id="courier-table">
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="AddCourierModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">Add Courier</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="courier-name">Name :</label>
                                    <input id="courier-name" type="text" class="form-control" placeholder="Courier Name">
                                </div>
                                <div class="form-group">
                                    <label for="courier-phone">Phone :</label>
                                    <input id="courier-phone" type="text" class="form-control" placeholder="Courier Phone">
                                </div>
                                <div class="form-group">
                                    <label for="courier-password">Password :</label>
                                    <input id="courier-password" type="password" class="form-control" placeholder="Courier password">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-primary" id="AddCourier">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="UpdateCourierModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">Update Courier</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="hidden-courier-id">
                                <div class="form-group">
                                    <label for="update-courier-name">Name :</label>
                                    <input id="update-courier-name" type="text" class="form-control" placeholder="Courier">
                                </div>
                                <div class="form-group">
                                    <label for="update-courier-phone">Phone :</label>
                                    <input id="update-courier-phone" type="text" class="form-control" placeholder="Courier Phone">
                                </div>
                                <div class="form-group">
                                    <label for="update-courier-password">Password :</label>
                                    <input id="update-courier-password" type="password" class="form-control" placeholder="Courier password">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-primary" id="UpdateCourier">Save changes</button>
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
    <script>
        $(function(){
            $("#AddCourier").click(function(){
                var formdata = new FormData();
                formdata.append("add_courier","add_courier");
                formdata.append("courier_name",$("#courier-name").val());
                formdata.append("courier_phone",$("#courier-phone").val());
                formdata.append("courier_password",$("#courier-password").val());
                $.ajax({
                    processData:false,
                    contentType:false,
                    data:formdata,
                    type:"post",
                    url:"data.php",
                    success:function(data)
                    {
                        if ($.trim(data).length > 0) {
                            alert(data);
                        }
                        else{
                            showCourier();
                            $("#AddCourierModal").modal("hide");
                        }
                    },
                    cache:false
                });
            });

            $("#UpdateCourier").click(function(){
                var formdata = new FormData();
                formdata.append("update_courier","update_courier");
                formdata.append("courier_id",$("#hidden-courier-id").val());
                formdata.append("courier_name",$("#update-courier-name").val());
                formdata.append("courier_phone",$("#update-courier-phone").val());
                formdata.append("courier_password",$("#update-courier-password").val());
                $.ajax({
                    processData:false,
                    contentType:false,
                    data:formdata,
                    type:"post",
                    url:"data.php",
                    success:function(data)
                    {
                        showCourier()
                        $("#UpdateCourierModal").modal("hide");
                    },
                    cache:false
                });
            });
            showCourier();
        });
        

        function edit_courier(id) {
            var formdata = new FormData();
            formdata.append('id',id);
            formdata.append("edit_courier","edit_courier");
            $.ajax({
                processData:false,
                contentType:false,
                data:formdata,
                type:"post",
                url:"data.php",
                success:function(data)
                {
                    data = JSON.parse(data);
                    $("#update-courier-password").val(data.password);
                    $("#update-courier-phone").val(data.phone);
                    $("#update-courier-name").val(data.name);
                    $("#hidden-courier-id").val(data.id);
                    $("#UpdateCourierModal").modal("show");
                },
                cache:false
            });
        }

        function delete_courier(id){
            formdata = new FormData();
            formdata.append('id',id);
            formdata.append('delete_couriers','delete_couriers');
            $.ajax({
                processData:false,
                contentType:false,
                data:formdata,
                type:"post",
                url:"data.php",
                success:function(data)
                {
                    showCourier();
                },
                cache:false
            });
        }

        function showCourier() {
            formdata = new FormData();
            formdata.append('couriers','couriers');
            $.ajax({
                processData:false,
                contentType:false,
                data:formdata,
                type:"post",
                url:"data.php",
                success:function(data)
                {
                    $("#courier-table").html(data);
                },
                cache:false
            });
        }
    </script>
</body>
</html>
<?php
}
else {
    header("location:login.php");
}
?>