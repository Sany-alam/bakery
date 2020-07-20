<?php
include("../connection.php");
if (isset($_SESSION['user'])) {
    header('location:index.php');
}else{
function ip()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDER_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDER_FOR'];
  }
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
//   echo $ip;
}
$ip = ip();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array($ip);
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tohoney - Shop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <!-- font-awesome v4.6.3 css -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- flaticon.css -->
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <!-- jquery-ui.css -->
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <!-- metisMenu.min.css -->
    <link rel="stylesheet" href="assets/css/metisMenu.min.css">
    <!-- swiper.min.css -->
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
    </style>
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<div class="account-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <div class="account-form form-style">
                        <form action="data.php" method="post" id="register">
                            <h1 class="text-center">Signup</h1>
                        <p>User Name *</p>
                        <div class="text-danger" id="name_alert"></div>
                        <input name="name" type="text">
                        
                        <p>Phone Number *</p>
                        <div class="text-danger" id="phone_alert"></div>
                        <input name="phone" type="number">
                        
                        <p>Email Address *</p>
                        <div class="text-danger" id="email_alert"></div>
                        <input name="email" type="email">

                        <p>Password *</p>
                        <div class="text-danger" id="password_alert"></div>
                        <input name="password" type="Password">

                        <p>Confirm Password *</p>
                        <div class="text-danger" id="rpassword_alert"></div>
                        <input name="confirm_password" type="Password">

                        <input type="hidden" name="register">
                        <button type="submit">Register</button>
                        <div class="alert alert-danger"></div>
                        </form>
                        <div class="text-center">
                            <a href="login.php">Or Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- mouse_scroll.js -->
    <script src="assets/js/mouse_scroll.js"></script>
    <!-- scrollup.js -->
    <script src="assets/js/scrollup.js"></script>
    <!-- isotope.pkgd.min.js -->
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <!-- imagesloaded.pkgd.min.js -->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- jquery.zoom.min.js -->
    <script src="assets/js/jquery.zoom.min.js"></script>
    <!-- swiper.min.js -->
    <script src="assets/js/swiper.min.js"></script>
    <!-- metisMenu.min.js -->
    <script src="assets/js/metisMenu.min.js"></script>
    <!-- mailchimp.js -->
    <script src="assets/js/mailchimp.js"></script>
    <!-- jquery-ui.min.js -->
    <script src="assets/js/jquery-ui.min.js"></script>
    <!-- main js -->
    <script src="assets/js/scripts.js"></script>
    <!-- custom java scripts and ajax -->
    <script>
        $(function(){
            $("#name_alert").hide();
            $("#email_alert").hide();
            $("#password_alert").hide();
            $("#rpassword_alert").hide();

            // varriables for return true or false from success function
            var valid_email = false;

            //Name
            $("input[name='name']").focusout(function(){
                name();
            });

            function name()
            {
                if($("input[name='name']").val().length == 0)
                {
                    $("#name_alert").html("Name is required!");
                    $("#name_alert").show();
                    return true;
                }
                else
                {
                    $("#name_alert").hide();
                    return false;
                }
            }


    //Email
    $("input[name='email']").focusout(function(){
        email();
    });

    function email()
    {
        if ($("input[name='email']").val().length == 0) {
            $("#email_alert").html("Email is requierd");
            $("#email_alert").show();
            return true;
        }
        else
        {
            var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
            if(!pattern.test($("input[name='email']").val()))
            {
                $("#email_alert").html("invalid email type");
                $("#email_alert").show();
                return true;
            }
            else
            {
                var email = $("input[name='email']").val();
                var valid = false;
                var formdata = new FormData();
                formdata.append("email",email);
                formdata.append("email_check",'email_check');
                $.ajax({
                    processData:false,
                    contentType:false,
                    data:formdata,
                    type:"post",
                    url:"data.php",
                    success:function(data)
                    {
                        var msg = $.trim(data);
                        if (msg == "found email")
                        {
                            valid_email = true;
                            $("#email_alert").html("Email already exiest, Email must be unique!");
                            $("#email_alert").show();
                        }
                        else if(msg == "Found no email")
                        {
                            $("#email_alert").hide();
                            valid_email = false;
                        }
                    }
                });
                return valid_email;
            }
        }
    }




    //password
    $("input[name='password']").focusout(function(){
        pass();
    });
    function pass()
    {
        if($("input[name='password']").val().length == 0)
        {
            $("#password_alert").html("password is required");
            $("#password_alert").show();
            return true;
        }
        else
        {
            $("#password_alert").hide();
            return false;
        }
    }



    // Retype password
    $("input[name='confirm_password']").focusout(function(){
        rpass();
    });
    function rpass()
    {
        if ($("input[name='confirm_password']").val().length !== 0)
        {
            if ($("input[name='confirm_password']").val() == $("input[name='password']").val())
            {
                $("#rpassword_alert").hide();
                return false;
            }
            else
            {
                $("#rpassword_alert").html("Password not matched");
                $("#rpassword_alert").show();
                return true;
            }
        }
        else
        {
            $("#rpassword_alert").html("Confirm password requierd");
            $("#rpassword_alert").show();
            return true;
        }
    }


    $("input[name='phone']").focusout(function(){
        phn();
    });

    function phn() 
    {
        if ($("input[name='phone']").val().length == 0) 
        {
            $("#phone_alert").html("Phone number is required");
            $("#phone_alert").show();
            return true;
        }
        else
        {
            $("#phone_alert").hide();
            return false;
        }
    }

    
    document.querySelector(".alert").style.display="none";
    $("#register").on('submit',function(e){
        e.preventDefault();
        if (name() == false && email() == false && phn() == false && pass() == false  && rpass() == false) {
            $.ajax({
                url:'data.php',
                type:'post',
                data:$("#register").serialize(),
                success:function(data) {
                    a = $.trim(data);
                    if (a == 'ok') {
                        document.querySelector(".alert").style.display="none";
                        location.href="login.php";
                    }else{
                        document.querySelector(".alert.alert-danger").innerHTML=a;
                        document.querySelector(".alert").style.display="block";
                    }
                }
            });
        }
        else{
            if (name() == true)
            {
                $("#name_alert").show();
            }

            if (email() == true)
            {
                $("#email_alert").show();
            }

            if (phn() == true)
            {
                $("#phone_alert").show();
            }

            if (pass() == true)
            {
                $("#password_alert").show();
            }


            if (rpass() == true)
            {
                $("#rpassword_alert").show();
            }
        }
    });

});
</script>
</html>
<?php
}