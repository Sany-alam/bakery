<?php
include("../connection.php");

if (isset($_POST['order_complete'])) {
    date_default_timezone_set('Asia/Dhaka');
    $date = date('Y-m-d');
    $id = $_POST['order_id'];
    $user = $_SESSION['courier']['id'];
    $sql= "UPDATE `orders` SET `status`='complete',`complete_order_date`='$date' WHERE `order_no` = '$id' AND `status` = 'processing'";
    $res = mysqli_query($conn,$sql);
    $sql= "UPDATE `courier` SET `status`= 0 WHERE `id` = '$user'";
    $res = mysqli_query($conn,$sql);
}

if (isset($_POST['order_requests'])) {
    $user = $_SESSION['courier'];
    $id = $user['id'];
    $sql= "SELECT * FROM `orders` WHERE `courier` = '$id' AND `status`='processing' GROUP BY courier";
    $res = mysqli_query($conn,$sql);
    while ($fetch = mysqli_fetch_array($res)) {
    ?>
    <tr>
        <td><?php echo $fetch['id']; ?></td>
        <td><?php echo $fetch['order_date']; ?></td>
        <td><?php echo $fetch['name']; ?></td>
        <td><?php echo $fetch['address']; ?></td>
        <td><?php echo $fetch['phone']; ?></td>
        <td>
            <button class="btn btn-primary btn-sm" onclick="">Products</button>
        </td>
        <td>
        <button class="btn btn-success btn-sm" onclick="complete_order(<?php echo $fetch['order_no']; ?>)">Complete</button>
        </td>
    </tr>
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