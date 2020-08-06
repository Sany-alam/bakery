<?php
include("../connection.php");

if (isset($_POST['changing_password'])) {
    $id = $_SESSION['user']['id'];
    $sql="select * from customer where id = '$id'";
    $res=mysqli_query($conn,$sql);
    $fetch = mysqli_fetch_array($res);
    $password = $fetch['password'];
    if ($password!==$_POST['o-password']) {
        echo "Previous password not matched";
    }elseif($_POST['r-password']!==$_POST['password']){
        echo "New password not matched";
    }else{
        $pass = $_POST['password'];
        $sql="Update customer set password='$pass' where id = '$id'";
        $res=mysqli_query($conn,$sql);
        echo "ok";
    }
}

if(isset($_POST['forgot_password']))
{
   
    $password = $_POST['password'];
    $r_passowrd = $_POST['r-password'];
    $token = $_POST['token'];
    file_put_contents('test.txt',$password." ".$r_passowrd." ".$token);

    if($password === $r_passowrd)
    {
       $sql = "Update customer set password = '$password' where token = '$token'";
       mysqli_query($conn,$sql);
       echo "ok";
    }
}

if(isset($_POST['forgot_password_email']))
{
    $email = $_POST['email'];
   
    $sql = "SELECT * FROM customer where email  = '$email'";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($res);
    $num_row = mysqli_num_rows($res);
    $token = $row['token'];
    $name = $row['name'];
    //file_put_contents('test.txt',$token);
   
    if($num_row == 0)
    {
        echo "not_register";
    }
    else
    {
        $subject = "Verify Email";
        $body = "Hi $name, Click here http://localhost/bakery/home/forgot_password.php?token=$token to verify your email...";
        $from = "From: playerc950@gmail.com ";
        if (mail($email,$subject,$body,$from)) {
            $_SESSION['register']='Successfully registered! Check your email to verify email.';
        }else{
            echo "Error";
        }
        echo "registered";
    }
  
}

if (isset($_POST['register'])) {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];
    $token = bin2hex(random_bytes(15));
    $sql="INSERT INTO `customer`(`name`, `email`, `password`, `phone`,`token`,`email_status`) VALUES ('$name','$email','$password','$phone','$token','inactive')";
    $res=mysqli_query($conn,$sql);
    if ($res) {
        $subject = "Verify Email";
        $body = "Hi $name, Click here http://localhost/bakery/home/verify.php?token=$token to verify your email...";
        $from = "From: playerc950@gmail.com ";
        if (mail($email,$subject,$body,$from)) {
            echo "ok";
            $_SESSION['register']='Successfully registered! Check your email to verify email.';
        }else{
            echo "Error";
        }
    }else {
        echo "Server error";
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `customer` WHERE `email` = '$email' AND `password` = '$password'";
    $res = mysqli_query($conn,$sql);
    $fetch = mysqli_fetch_array($res);
    if (mysqli_num_rows($res)==1) {
        if ($fetch['email_status']!='active') {
            echo "email";
        }else{
            echo "ok";
            $_SESSION['user']=$fetch;
        }
    }else {
        echo "not ok";
    }
}

if (isset($_POST['email_check'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM `customer` WHERE `email` = '$email'";
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
        echo "found email";
    }else {
        echo "Found no email";
    }
}

if (isset($_POST['order'])) {
    date_default_timezone_set('Asia/Dhaka');
    $date = date('Y-m-d');
    $address = $_POST['address'];
    
        $order_sql = "SELECT MAX(order_no) AS `order_no` FROM `orders`";
        $order_res = mysqli_query($conn,$order_sql);
        if (mysqli_num_rows($order_res)>0) {
            $order_list = mysqli_fetch_array($order_res);
            $order_no = $order_list['order_no']+1;
        }
        else {
            $order_no = 1;
        }
        date_default_timezone_set('Asia/Dhaka');
        $date = date('d-m-Y');
        $time = date('H:i:s');
        $status = "request";
        
    for ($i=1; $i < count($_SESSION['cart']); $i++) { 
        $product_id = $_SESSION['cart'][$i]['id'];
        $product_quantity = $_SESSION['cart'][$i]['quantity'];
        if (isset($_SESSION['user'])) {
            $customer = $_SESSION['user']['id'];
        }else {
            $customer = 0;
        }

        $sql = "INSERT INTO `orders`(`address`, `product_id`,`product_quantity`,`order_no`,`status`,`order_date`,`order_time`,`customer`) VALUES ('$address','$product_id','$product_quantity','$order_no','$status','$date','$time','$customer')";
        $res = mysqli_query($conn,$sql);

        $sql_items = "SELECT * FROM `item-detail` WHERE `id` = '$product_id'";
        $res_items = mysqli_query($conn,$sql_items);
        $fetch_items = mysqli_fetch_array($res_items);
        $quantity_limit = $fetch_items['quantity'];
        $qa = $quantity_limit-$product_quantity;

        $sql_quantity = "UPDATE `item-detail` SET `quantity`='$qa' WHERE `id` = '$product_id'";
        $res_quantity = mysqli_query($conn,$sql_quantity);
    }
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
}


if (isset($_POST['order_list'])) {
    $total = 0;
    for ($i=1; $i < count($_SESSION['cart']); $i++) { 
        ?>
        <li><?php echo $_SESSION['cart'][$i]['name']; ?> *<?php echo $_SESSION['cart'][$i]['quantity']; ?> <span class="pull-right"><?php echo $_SESSION['cart'][$i]['price']*$_SESSION['cart'][$i]['quantity']; ?></span></li>
    <?php
    $total = $total+$_SESSION['cart'][$i]['price']*$_SESSION['cart'][$i]['quantity'];
    //$total = $total+100;
    
    
    }
    $total = $total+100;
    $discount = $_SESSION['discount'];
    $discount_price = floor(($total/$discount));
    $total = $total-$discount_price;

    ?>
    <!-- <li>Subtotal <span class="pull-right"><strong>$380.00</strong></span></li> -->
    <li>Delivery charge <span class="pull-right"><?php $charge = 100; echo $charge; ?></span></li>
    <li>Discount (<?php echo $discount ?>%) <span class="pull-right"><?php $charge = 100; echo '-'.$discount_price ?></span></li>
    <li>Total<span class="pull-right"><?php echo $total; ?></span></li>
    <?php
}



if (isset($_POST['total_price'])) {
        $total = 0;
        for ($i=1; $i < count($_SESSION['cart']); $i++)
        {
            // $price = $_SESSION['cart'][$i]['price']*$_SESSION['cart'][$i]['quantity'];
            $total = $total+$_SESSION['cart'][$i]['price']*$_SESSION['cart'][$i]['quantity'];
        }
        if (count($_SESSION['cart'])>1) {
        ?>
        <div class="cart-total text-right">
        <h3>Cart Totals</h3>
        <ul>
        <li><span class="pull-left">Subtotal </span><?php echo $total." Tk"; ?></li>
        <li><span class="pull-left"> Total </span><?php echo $total." Tk"; ?></li>
        </ul>
        <?php
        if (isset($_SESSION['user'])) {
            ?>
            <a href="checkout.php">Proceed to Checkout</a>
            </div>
            <?php
        }else{
            ?>
            <a href="login.php">Login to checkout!</a>
            </div>
            <?php
        }
    }
}


    // Remopve all item from cart
if (isset($_POST['remove_cart']))
{
  foreach ($_SESSION['cart'] as $key => $value)
  {
    if ($key>0) {
      unset($_SESSION['cart'][$key]);
    }
  }
}


if (isset($_POST['remove_cart_item'])) {
    $key = $_POST['key'];
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}



// echo "<pre>";
// print_r($_SESSION['cart']);
// echo "</pre>";
if (isset($_POST['show_cart'])) {
    if (!isset($_SESSION['cart'][1])) {
        ?>
        <div class="text-center">There is no item available in your cart, <a href="index.php">countitnue shopping!</a></div>
        <?php
    }
    else {
        ?>
        <table class="table-responsive cart-wrap">
            <thead>
                <tr>
                    <th class="images">Image</th>
                    <th class="product">Product</th>
                    <th class="ptice">Price</th>
                    <th class="quantity">Quantity</th>
                    <th class="total">Total</th>
                    <th class="remove">Remove</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($key == 0) {
                        
                    }
                    else {
                        ?>
                        <tr><td class="images"><img src="<?php echo $_SESSION['cart'][$key]['img']; ?>" alt=""></td>
                        <td class="product"><a href="javascript:void(0)"><?php echo $_SESSION['cart'][$key]['name']; ?></a></td>
                    <td class="price"
                    ><?php echo $_SESSION['cart'][$key]['price']; ?></td>
                    <td class="quantity cart-plus-minus">
                        <input type="text" value="<?php echo $_SESSION['cart'][$key]['quantity']; ?>" disabled />
                    </td>
                    <?php $total = $_SESSION['cart'][$key]['quantity']*$_SESSION['cart'][$key]['price']; ?>
                    <td class="total"><?php echo $total; ?></td>
                    <td class="remove"><i class="fa fa-trash" onclick="remove_cart_item(<?php echo $key; ?>)"></i></td></tr>
                        <?php
                    }
                }
                    ?>
            </tbody>
        </table>
                <?php
            }
}


if (isset($_POST['viewIteminCardModal'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM `item-detail` WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
    echo json_encode(mysqli_fetch_array($res));
}


if (isset($_POST['addCart'])) {
    $quantity = $_POST['quantity'];
    $id = $_POST['id'];
    $sql = "SELECT * FROM `item-detail` WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
    $fetch = mysqli_fetch_assoc($res);
    if (count($_SESSION['cart'])>1) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($key > 0) {
                if (in_array($id,$value)) {
                    if ($value['id'] === $id) {
                        $q = $value['quantity']+$quantity;
                        if ($q>$fetch['quantity']) {
                            echo "Stock limit reached";
                        }else{
                            $fetch['quantity'] = $q;
                            unset($_SESSION['cart'][$key]);
                            $_SESSION['cart'] = array_values($_SESSION['cart']);
                            array_push($_SESSION['cart'],$fetch);
                            echo "ok";
                        }
                    }
                }
            }
        } 
    }
    else {
        $fetch['quantity'] = $quantity;
        array_push($_SESSION['cart'],$fetch);
        echo "ok";
    }
    function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($key > 0) {
                if ($val['id'] == $id) {
                    return $key;
                }
            }
        }
        return null;
    }
    $cart = searchForId($id, $_SESSION['cart']);
    if ($cart == null) {
        $fetch['quantity'] = $quantity;
        array_push($_SESSION['cart'],$fetch);
        echo "ok";
    }
}


if (isset($_POST['countCart'])) {
    echo count($_SESSION['cart'])-1;
}


if (isset($_POST['viewIteminModal'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM `item-detail` WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
    $items = mysqli_fetch_array($res);
    echo json_encode($items);
}