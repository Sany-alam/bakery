<?php
include("../connection.php");

if (isset($_POST['reject_order'])) {
    $id = $_POST['order_no'];
    $user = $_SESSION['courier']['id'];
    $sql= "UPDATE `orders` SET `status`='request' WHERE `order_no` = '$id' AND `status` = 'processing'";
    $res = mysqli_query($conn,$sql);
    $sql= "UPDATE `courier` SET `status`= 0 WHERE `id` = '$user'";
    $res = mysqli_query($conn,$sql);
}

if (isset($_POST['my_complete_order'])) {
    $user = $_SESSION['courier'];
    $id = $user['id'];
    $sql= "SELECT * FROM `orders` WHERE `courier` = '$id' AND `status`='complete' GROUP BY `order_no`";
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
        while ($fetch = mysqli_fetch_array($res)) {
        ?>
        <tr>
            <td><?php echo $fetch['id']; ?></td>
            <td><?php echo $fetch['order_date']; ?></td>
            <td><?php echo $fetch['name']; ?></td>
            <td><?php echo $fetch['address']; ?></td>
            <td><?php echo $fetch['phone']; ?></td>
            <td>
                <button class="btn btn-primary btn-sm" onclick="product_detail(<?php echo $fetch['order_no']; ?>)">Products</button>
            </td>
        </tr>
        <?php
        }
    }else {
        ?>
            <script>$("thead").hide();</script>
            <h1 class="display-1 text-center my-5">Empty</h1>
        <?php
    }
}

if (isset($_POST['order_complete'])) {
    date_default_timezone_set('Asia/Dhaka');
    $date = date('d-m-Y');
    $id = $_POST['order_id'];
    $user = $_SESSION['courier']['id'];
    $sql= "UPDATE `orders` SET `status`='complete',`complete_order_date`='$date' WHERE `order_no` = '$id' AND `status` = 'processing'";
    $res = mysqli_query($conn,$sql);
    $sql= "UPDATE `courier` SET `status`= 0 WHERE `id` = '$user'";
    $res = mysqli_query($conn,$sql);
}

if (isset($_POST['product_det'])) {
    $order_no = $_POST['order_no'];
    $sql = "SELECT * FROM orders where order_no = '$order_no'";
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
        ?>
             <table class="table table-hover">
            <thead>
                <tr role="row"><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="ID: activate to sort column ascending" style="width: 14px;">ID</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Product: activate to sort column ascending" style="width: 138px;">Product</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Category: activate to sort column ascending" style="width: 67px;">Quantity</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" style="width: 36px;">Price</th></tr>
            </thead>
            <tbody>
            <?php
            $total = 0;
        while ($item = mysqli_fetch_array($res)) {
            $p_quantity = $item['product_quantity'];
            $p_id = $item['product_id'];
            $sql1 = "SELECT * FROM `item-detail` where `id` = '$p_id'";
            $res1 = mysqli_query($conn,$sql1);
            ?>
            <tr role="row" class="odd">
            <?php
            $item1 = mysqli_fetch_array($res1);
                ?>
                <td>
                    <?php echo $item1['id']; ?>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid rounded" src="<?php echo $item1['img']; ?>" style="max-width: 60px" alt="">
                        <h6 class="m-b-0 m-l-10">
                            <?php echo $item1['name']; ?>
                        </h6>
                    </div>
                </td>
                <td>
                    <?php echo $p_quantity; ?>
                </td>
                <td>
                    <?php echo $item1['price']*$p_quantity; ?>
                </td>
                <?php  $total = $total+$item1['price']*$p_quantity;
            ?>
           </tr>
            <?php
        }
        ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-6">
                    <h5 class="text-right">Total amount is : </h5>
                </div>
                <div class="col-6">
                    <h5 class="text-left"><?php echo $total; ?></h5>
                </div>
            </div>
            <?php
    }
}

if (isset($_POST['order_requests'])) {
    $user = $_SESSION['courier'];
    $id = $user['id'];
    $sql= "SELECT * FROM `orders` WHERE `courier` = '$id' AND `status`='processing' GROUP BY `order_no`";
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
        while ($fetch = mysqli_fetch_array($res)) {
        ?>
        <tr>
            <td><?php echo $fetch['id']; ?></td>
            <td><?php echo $fetch['order_date']; ?></td>
            <td><?php echo $fetch['name']; ?></td>
            <td><?php echo $fetch['address']; ?></td>
            <td><?php echo $fetch['phone']; ?></td>
            <td>
                <button class="btn btn-primary btn-sm" onclick="product_detail(<?php echo $fetch['order_no']; ?>)">Products</button>
            </td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="reject_order(<?php echo $fetch['order_no']; ?>)">Reject</button>
            </td>
            <td>
                <button class="btn btn-success btn-sm" onclick="complete_order(<?php echo $fetch['order_no']; ?>)">Complete</button>
            </td>
        </tr>
        <?php
        }
    }else {
        ?>
            <script>$("thead").hide();</script>
            <h1 class="display-1 text-center my-5">Empty</h1>
        <?php
    }
}


if (isset($_POST['login'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    $sql= "SELECT * FROM `courier` WHERE `name` = '$name' AND `password` = '$password'";
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
        $f = mysqli_fetch_array($res);
        $_SESSION['courier'] = $f;
        echo "done";
    }else{
        echo "Credential error";
    }
}