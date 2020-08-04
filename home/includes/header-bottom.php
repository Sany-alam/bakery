<div class="header-bottom">
    <div class="fluid-container">
        <div class="row">
            <div class="col-lg-3 col-md-7 col-sm-6 col-6">
                <div class="logo">
                    <a href="index.php">
                        <h1 style="font-weight:bold;font-size: 30px;margin: 0px;"><div class="d-inline-block" style="color:#ef4836;">Easy</div><div class="d-inline-block" style="color:#000;">food</div></h1>
                    </a>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <nav class="mainmenu">
                    <ul class="d-flex">
                        <li><a href="index.php">Home</a></li>
                        <?php
                        if (isset($_SESSION['user'])) {
                            ?>
                            <li><a href="myorders.php">My Orders</a></li>
                            <li><a href="change-password.php">Change password</a></li>
                            <li><a href="logout.php" onclick="cart_flash()">Logout</a></li>
                            <li>
                                <div class="d-flex justify-content-between" style="color: #ef4836;border: 1px solid #ef4836;">
                                <span style="padding: 0px 10px;"><i class="fa fa-user"></i>
                                <?php echo $_SESSION['user']['name']; ?></span>
                                </div>
                            </li>
                            <?php
                        }else {
                            ?>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="signup.php">Signup</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>
            <div class="col-md-4 col-lg-2 col-sm-5 col-4">
                <ul class="search-cart-wrapper d-flex">
                    <!-- cart.php -->
                    <li><a href="cart.php"><i class="flaticon-shop"></i> 
                    <span id="countCart"></span>
                    </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-1 col-sm-1 col-2 d-block d-lg-none">
                <div class="responsive-menu-tigger">
                    <a href="javascript:void(0);">
                <span class="first"></span>
                <span class="second"></span>
                <span class="third"></span>
                </a>
                </div>
            </div>
        </div>
    </div>
    <!-- responsive-menu area start -->
    <div class="responsive-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-12 d-block d-lg-none">
                    <ul class="metismenu">
                    <?php
                        if (isset($_SESSION['user'])) {
                            $user = $_SESSION['user'];
                            $user_id = $user['id'];
                            $sql_user_status = "SELECT * FROM `orders` WHERE `customer` = '$user_id' GROUP BY `order_no`";
                            $res_user_status = mysqli_query($conn,$sql_user_status);
                            if (mysqli_num_rows($res_user_status)<11) {
                                $user_status = 'NEW USER';
                            }else if(mysqli_num_rows($res_user_status)<21){
                                $user_status = 'GOLD USER';
                            }else{
                                $user_status = 'PREMIUM USER';
                            }
                            ?>
                            <li>
                                <div class="d-flex justify-content-between" style="color: #ef4836;border: 1px solid #ef4836;">
                                <span style="padding: 0px 10px;"><i class="fa fa-user"></i>
                                <?php echo $user['name']; ?></span>
                                <span style="background:#ef4836;color:white;padding: 0px 5px;"><?php echo $user_status; ?></span>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                        <li><a href="index.php">Home</a></li>
                        <?php
                        if (isset($_SESSION['user'])) {
                            ?>
                            <li><a href="myorders.php">My Orders</a></li>
                            <li><a href="logout.php" onclick="cart_flash()">Logout</a></li>
                            <?php
                        }else {
                            ?>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="signup.php">Signup</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- responsive-menu area start -->
</div>