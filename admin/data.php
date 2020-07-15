<?php
include("../connection.php");

if (isset($_POST['update_courier'])) {
    $id = $_POST['courier_id'];
    $name = $_POST['courier_name'];
    $phone = $_POST['courier_phone'];
    $password = $_POST['courier_password'];
    $sql = "UPDATE `courier` SET `name`='$name',`phone`='$phone',`password`='$password' WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
    if ($res) {
        echo "Done";
    }else{
        echo "error";
    }
}

if (isset($_POST['edit_courier'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM `courier` WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
    $item = mysqli_fetch_array($res);
    echo json_encode($item);
}

if (isset($_POST['delete_couriers'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM `courier` WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
}

if (isset($_POST['couriers'])) {
    $sql = "SELECT * FROM `courier` ORDER BY id desc";
    $res = mysqli_query($conn,$sql);
    ?>
    <div class="mt-5 table-responsive">
        <table class="table table-hover e-commerce-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Password</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fetch = mysqli_fetch_array($res)) {
                    ?>
                    <tr>
                        <td><?php echo $fetch['id']; ?></td>
                        <td><?php echo $fetch['name']; ?></td>
                        <td><?php echo $fetch['phone']; ?></td>
                        <td><?php echo $fetch['password']; ?></td>
                        <td>
                            <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="edit_courier(<?php echo $fetch['id']; ?>)">
                                <i class="anticon anticon-edit"></i>
                            </button>
                            <button class="btn btn-icon btn-hover btn-sm btn-rounded" onclick="delete_courier(<?php echo $fetch['id']; ?>)">
                                <i class="anticon anticon-delete"></i>
                            </button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/pages/e-commerce-order-list.js"></script>
    <?php
}

if (isset($_POST['add_courier'])) {
    $courier_name = $_POST['courier_name'];
    $courier_phone = $_POST['courier_phone'];
    $courier_password = $_POST['courier_password'];

    $sql = "SELECT * FROM `courier` WHERE `name` = '$courier_name'";
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
        echo "Courier exists";
    }
    else {
        $sql = "INSERT INTO `courier`(`name`, `phone`,`password`) VALUES ('$courier_name','$courier_phone','$courier_password')";
        $res = mysqli_query($conn,$sql);
    }
}

if (isset($_POST['complete_orders'])) {
        $sql = "SELECT * FROM `orders` where `status` = 'complete'";
        $res = mysqli_query($conn,$sql);
        while ($item = mysqli_fetch_assoc($res)) {
        ?>
    <tr role="row" class="odd">
        <td class="sorting_1">
            <div class="checkbox">
                <input id="check-item-1" type="checkbox">
                <label for="check-item-1" class="m-b-0"></label>
            </div>
        </td>
        <td>
            #<?php echo $item['order_no'] ?>
        </td>
        <td>
            <div class=" align-items-center">
                <h6 class="m-b-0"><?php echo $item['name'] ?></h6>
            </div>
        </td>
        <td><?php echo $item['order_date'] ?></td>
        <td>
        <?php echo $item['complete_order_date'] ?>
        </td>
        <td>
            <div class="d-flex align-items-center">
                <div class="badge badge-success badge-dot m-r-10"></div>
                <div>Complete Order</div>
            </div>
        </td>
    </tr>
        <?php
        }
}


if (isset($_POST['on_delivery_courier_detail'])) {
    $id = $_POST['id'];
    $sql = "SELECT * from `courier` where `id` = '$id'";
    $res = mysqli_query($conn,$sql);
    $item = mysqli_fetch_assoc($res)
    ?>
    <div class="row align-items-center">
        <div class="col-md-7">
            <div class="d-md-flex align-items-center">
                <div class="text-center text-sm-left m-v-15 p-l-30">
                    <h2 class="m-b-5"><?php echo $item['name']; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="row">
                <div class="d-md-block d-none border-left col-1"></div>
                <div class="col">
                    <ul class="list-unstyled m-t-10">
                        <li class="row">
                            <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                <i class="m-r-10 text-primary anticon anticon-phone"></i>
                                <span>Phone: </span> 
                            </p>
                            <p class="col font-weight-semibold"> <?php echo $item['phone']; ?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
}


if (isset($_POST['show_pending_orders'])) {
    $sql = "SELECT * from `orders` where `status` = 'processing' group by order_no desc";
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
        while ($item = mysqli_fetch_assoc($res)) {
            ?>
            <tr role="row" class="odd">
                <td class="sorting_1">
                    <div class="checkbox">
                        <input id="check-item-1" type="checkbox">
                        <label for="check-item-1" class="m-b-0"></label>
                    </div>
                </td>
                <td>
                    #<?php echo $item['order_no'] ?>
                </td>
                <td>
                    <div class=" align-items-center">
                        <h6 class="m-b-0"><?php echo $item['name'] ?></h6>
                    </div>
                </td>
                <td><?php echo $item['order_date'] ?></td>
                <td>
                    <?php 
                    $courier = $item['courier'];
                    $sql1 = "SELECT * FROM `courier` WHERE `id` = '$courier'";
                    $res1 = mysqli_query($conn,$sql1);
                    $item1 = mysqli_fetch_assoc($res1);
                    ?>
                    <a href="javascript:void(0)" onclick="on_delivery_courier_detail(<?php echo $item1['id']; ?>)">
                        <?php echo $item1['name']; ?>
                    </a>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="badge badge-primary badge-dot m-r-10">
                        </div>
                        <div>On delivery</div>
                    </div>
                </td>
            </tr>
            <?php
        }
    }
}



if (isset($_POST['assign_courier'])) {
    $id = $_POST['courier_id'];
    $order_no = $_POST['order_no'];
    $sql = "UPDATE `orders` SET `courier`= '$id',`status`= 'processing' WHERE `order_no` = '$order_no'";
    $res = mysqli_query($conn,$sql);

    $sql1 = "UPDATE `courier` SET `status`= '1' WHERE `id` = '$id'";
    $res1 = mysqli_query($conn,$sql1);
}



if (isset($_POST['courier_list'])) {
    $sql = "SELECT * FROM `courier` ORDER BY id";
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
        while ($item = mysqli_fetch_assoc($res)) {
            ?>
            <tr role="row" class="odd">
            <td><?php echo $item['id']; ?></td>
            <td>
            <div class="d-flex align-items-center">
            <img class="img-fluid rounded" src="<?php echo $item['img']; ?>" style="max-width: 60px" alt="">
            <h6 class="m-b-0 m-l-10"><?php echo $item['name']; ?></h6>
            </div>
            </td>
            <td><?php echo $item['phone']; ?></td>
            <?php 
            if ($item['status'] == false) {
                ?>
                <td>
                <div class="d-flex align-items-center">
                <div class="badge badge-success badge-dot m-r-10"></div>
                <div>Available</div>
                </div>
                </td>
                <td>
                <button class="btn btn-sm btn-danger" onclick="assign_courier(<?php echo $item['id']; ?>)">
                Assign
                </button>
                </td>
                <?php
            }
            else {
                ?>
                <td>
                <div class="d-flex align-items-center">
                <div class="badge badge-danger badge-dot m-r-10"></div>
                <div>Not available</div>
                </div>
                </td>
                <td>
                <button class="btn btn-sm btn-danger" disabled>
                Assign
                </button>
                </td>
                <?php
            }
            ?>
            </tr>
            <?php
        }
    }
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
            $sql1 = "SELECT * FROM `item-detail` where id = '$p_id'";
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


if (isset($_POST['show_order_req'])) {
    $r = "request";
    $sql = "SELECT * from `orders` where `status` = 'request' group by order_no desc";
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
        while ($item = mysqli_fetch_assoc($res)) {
            ?>
            <tr role="row" class="odd">
                <td class="sorting_1">
                    <div class="checkbox">
                        <input id="check-item-1" type="checkbox">
                        <label for="check-item-1" class="m-b-0"></label>
                    </div>
                </td>
                <td>
                    #<?php echo $item['order_no'] ?>
                </td>
                <td>
                    <div class=" align-items-center">
                        <h6 class="m-b-0"><?php echo $item['name'] ?></h6>
                    </div>
                </td>
                <td><?php echo $item['order_date'] ?></td>
                <td>
                    <button onclick="product_detail(<?php echo $item['order_no']; ?>)" class="btn btn-sm btn-primary" data-toggle="modal" data-target="products-modal">
                        Products
                    </button>
                </td>
            </tr>
            <?php
        }
    }
}


if (isset($_POST['save_category'])) {
    $id = $_POST['id'];
    $category = $_POST['category'];
    $sql = "UPDATE `category` SET `category`= '$category' WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
}


if (isset($_POST['edit_category'])) {
    $id = $_POST['category_id'];
    $sql = "SELECT * FROM `category` WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
    $item = mysqli_fetch_array($res);
    echo json_encode($item);
}


if (isset($_POST['delete_category'])) {
    $id = $_POST['category_id'];
    $sql = "DELETE FROM `category` WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
}



if (isset($_POST['category_list'])) {
    $sql = "SELECT * FROM `category` order by id desc";
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
        while ($item = mysqli_fetch_array($res)) {
    ?>
    <tr>
    <td>
        <div class="checkbox">
            <input id="check-item-<?php echo $item['id']; ?>" type="checkbox">
            <label for="check-item-<?php echo $item['id']; ?>" class="m-b-0"></label>
            </div>
        </td>
        <td>
            #<?php echo $item['id']; ?>
        </td>
        <td><?php echo $item['category']; ?></td>
        <td class="text-right">
            <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="edit_category(<?php echo $item['id']; ?>)">
                <i class="anticon anticon-edit"></i>
            </button>
            <button class="btn btn-icon btn-hover btn-sm btn-rounded" onclick="delete_category(<?php echo $item['id']; ?>)">
                <i class="anticon anticon-delete"></i>
            </button>
        </td>
    </tr>
    <?php
        }
    }
    
}



if (isset($_POST['add_category'])) {
    $category = $_POST['category'];
    $sql = "SELECT * FROM `category` where category = '$category'";
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
        echo "This category already exiest";
    }
    else {
        $sql = "INSERT INTO `category`(`category`) VALUES ('$category')";
        $res = mysqli_query($conn,$sql);
        if ($res) {
            echo "category added";
        }
    }
}


if (isset($_POST['save_Item'])) {
    $id = $_POST['save_Item_id'];
    $name = $_POST['save_Item_name'];
    $price = $_POST['save_Item_price'];
    $sql = "UPDATE `item-detail` SET `name`='$name',`price`='$price' WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
}


if (isset($_POST['edit_Item'])) {
    $id = $_POST['edit_Item_id'];
    $sql = "SELECT * FROM `item-detail` WHERE `id` = '$id'";
    $res = mysqli_query($conn,$sql);
    $item = mysqli_fetch_array($res);
    echo json_encode($item);
}


if (isset($_POST['display_item'])) {
    $sql = "SELECT * FROM `item-detail` order by id desc";
    $res = mysqli_query($conn,$sql);
    // if (mysqli_num_rows($res)>0) {
        // $i = 0;
        for ($i=1; $i < $item = mysqli_fetch_array($res); $i++) {
    ?>
    <tr>
    <td>
        <div class="checkbox">
            <input id="check-item-<?php echo $i; ?>" type="checkbox">
            <label for="check-item-<?php echo $i; ?>" class="m-b-0"></label>
            </div>
        </td>
        <td>#<?php echo $i; ?></td>
        <td>
            <div class="d-flex align-items-center">
                <img class="img-fluid rounded" src="<?php echo $item['img']; ?>" style="max-width: 60px" alt="">
                <h6 class="m-b-0 m-l-10"><?php echo $item['name']; ?></h6>
            </div>
        </td>
        <td><?php echo $item['category']; ?></td>
        <td><?php echo $item['price']; ?> Tk</td>
        <td class="text-right">
            <button onclick="editItem(<?php echo $item['id']; ?>)" class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                <i class="anticon anticon-edit"></i>
            </button>
            <button onclick="delItem(<?php echo $item['id']; ?>)" class="btn btn-icon btn-hover btn-sm btn-rounded">
                <i class="anticon anticon-delete"></i>
            </button>
        </td>
    </tr>
    <?php
        }
    // }
    // else {
        ?>
        <!-- <div class="text-center">No item available, add item to <a data-toggle="modal" href="#Additems">Click here</a></div> -->
        <?php
    // }
}



if (isset($_POST['add_item'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $des = $_POST['description'];
    $img = $_FILES['image'];
    $img_name = $_FILES['image']['name'];
    $dir = "../assets/images/";
    move_uploaded_file($img['tmp_name'],"../assets/images/".$img['name']);
    // echo $name." ".$des." ".$img['type'];
    $sql = "INSERT INTO `item-detail`(`name`, `category`, `price`,`description`, `img`) VALUES ('$name','$category','$price','$des','$dir$img_name')";
    $res = mysqli_query($conn,$sql);
}



if (isset($_POST['del_item'])) {
    $itemid = $_POST['item-id'];
    $sq = "SELECT * FROM `item-detail` WHERE `id` = '$itemid'";
    $re = mysqli_query($conn,$sq);
    $item = mysqli_fetch_array($re);
    if (unlink($item['img'])) {
        $sql = "DELETE FROM `item-detail` WHERE id = '$itemid'";
        $res = mysqli_query($conn,$sql);
    }
}

?>