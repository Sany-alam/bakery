<?php
session_start();
if(!isset($_SESSION['courier'])){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/app.min.css">
        <title>Easyfood Courier</title>
    </head>
    <body>
        <div style="height:100vh;" class="d-flex justify-content-center align-items-center">
            <div class="card">
                <div class="card-body">
                <div class="d-flex p-h-40 mb-3">
                 <?php include("../admin/includes/logo.php"); ?>
                </div>
                <h6 class="text-center">(Courier Panel)</h6>
                <hr class="mt-0 mb-4">
                <div id="alert"></div>
                    <div class="form-group">
                        <label for="name">Enter name</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="password">Enter password</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" id="login">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="../assets/js/vendors.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script>
        $(function() {
            console.log("hi");

            $("#login").click(function(){
                var formdata = new FormData();
                formdata.append("login","login");
                formdata.append("name",$("#name").val());
                formdata.append("password",$("#password").val());
                $.ajax({
                    processData:false,
                    contentType:false,
                    data:formdata,
                    type:"post",
                    url:"data.php",
                    success:function(data)
                    {
                        if ($.trim(data) == "done") {
                            $("#alert").removeClass("aler alert-danger p-1").html("");
                            location.href="index.php";
                        }else{
                            $("#alert").addClass("aler alert-danger p-1").html(data);
                        }
                    },
                    cache:false
                });
            });
        });
    </script>
    </html>
    <?php
}else{
    header("location:index.php");
}