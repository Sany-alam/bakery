<?php session_start();
$conn = mysqli_connect('localhost','root','','bakery');


if (isset($_POST['total_price'])) {
        $total = 0;
        for ($i=1; $i < count($_SESSION['cart']); $i++)
        {
            // $price = $_SESSION['cart'][$i]['price']*$_SESSION['cart'][$i]['quantity'];
            $total = $total+$_SESSION['cart'][$i]['price']*$_SESSION['cart'][$i]['quantity'];
        }
        ?>
        <div class="cart-total text-right">
        <h3>Cart Totals</h3>
        <ul>
        <li><span class="pull-left">Subtotal </span><?php echo $total." Tk"; ?></li>
        <li><span class="pull-left"> Total </span><?php echo $total." Tk"; ?></li>
        </ul>
        <a href="checkout.html">Proceed to Checkout</a>
        </div>
        <?php
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
                        <td class="product"><a href="single-product.html"><?php echo $_SESSION['cart'][$key]['name']; ?></a></td>
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
                    $fetch['quantity'] = $q;
                    unset($_SESSION['cart'][$key]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                    array_push($_SESSION['cart'],$fetch);
                }
            }
        }
    } 
}
else {
    $fetch['quantity'] = $quantity;
    array_push($_SESSION['cart'],$fetch);
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