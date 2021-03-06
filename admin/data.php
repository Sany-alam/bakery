<?php
include("../connection.php");

if (isset($_POST['reject_order'])) {
    $id = $_POST['order_no'];
    $sql= "SELECT * FROM `orders` WHERE `order_no` = '$id'";
    $res = mysqli_query($conn,$sql);
    $fetch=mysqli_fetch_array($res);
    $courier=$fetch['courier'];
    $sql_order= "UPDATE `orders` SET `status`='request',`courier`='' WHERE `order_no` = '$id' AND `status` = 'processing'";
    $res_order = mysqli_query($conn,$sql_order);
    $sql_courier= "UPDATE `courier` SET `status`= 0 WHERE `id` = '$courier'";
    $res_courier = mysqli_query($conn,$sql_courier);
}

if(isset($_POST['sell_by_day'])){
    $date = $_POST['date'];
    $pieces_of_date = explode("-",$date);
    $new_date = $pieces_of_date[2]."-".$pieces_of_date[1]."-".$pieces_of_date[0];
    $sql= "SELECT * FROM `orders` WHERE `status` = 'complete' AND `complete_order_date` = '$new_date' GROUP BY `order_no`";
    $res = mysqli_query($conn,$sql);
    ?>
    <div class="card-body">
        <div class="m-t-25 table-responsive">
            <table id="data-table" class="table table-hover e-commerce-table">
                <thead>
                    <tr>
                    <tr>
                        <th>Order no</th>
                        <th>Customer Detail</th>
                        <th>Courier Detail</th>
                        <th>Products</th>
                    </tr>
                    </tr>
                </thead>
                <tbody class="table-striped">
                <?php 
                $total = 0;
                while ($fetch = mysqli_fetch_array($res)) {
                    ?>
                    <tr role="row" class="odd">
                        <td>
                            #<?php echo $fetch['order_no'] ?>
                        </td>
                        <td>
                            <div class=" align-items-center">
                            <?php 
                            $customer = $fetch['customer'];
                            $sql_customer = "SELECT * FROM `customer` WHERE `id` = '$customer'";
                            $res_customer = mysqli_query($conn,$sql_customer);
                            $item_customer = mysqli_fetch_assoc($res_customer);
                            ?>
                                <h6 class="m-b-0">
                                    <?php echo $item_customer['name']; ?>
                                </h6>
                            </div>
                        </td>
                        <td>
                            <div class=" align-items-center">
                                <h6 class="m-b-0"><?php echo $fetch['address'] ?></h6>
                            </div>
                        </td>
                        <td>
                            <?php 
                            $courier = $fetch['courier'];
                            $sql1 = "SELECT * FROM `courier` WHERE `id` = '$courier'";
                            $res1 = mysqli_query($conn,$sql1);
                            $item1 = mysqli_fetch_assoc($res1);
                            ?>
                            <a href="javascript:void(0)" onclick="on_delivery_courier_detail(<?php echo $item1['id']; ?>)">
                                <?php echo $item1['name']; ?>
                            </a>
                        </td>
                        <td>
                            <button onclick="product_detail(<?php echo $fetch['order_no']; ?>)" class="btn btn-sm btn-primary" data-toggle="modal" data-target="products-modal">
                                Products
                            </button>
                        </td>
                    </tr>
                    <?php
                }
                $sql_total= "SELECT * FROM `orders` WHERE `status` = 'complete' AND `complete_order_date` = '$new_date'";
                $res_total = mysqli_query($conn,$sql_total);
                while ($fetch_total = mysqli_fetch_array($res_total)) {
                    $p_quantity = $fetch_total['product_quantity'];
                    $p_id = $fetch_total['product_id'];
                    $sql_last = "SELECT * FROM `item-detail` where id = '$p_id'";
                    $res_last = mysqli_query($conn,$sql_last);
                    $item_last = mysqli_fetch_array($res_last);
                    $total = $total+$item_last['price']*$p_quantity;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <h1>Total sell : <?php echo $total; ?>Tk</h1>
    </div>
    <script src='.asset("assets/admin/vendors/datatables/jquery.dataTables.min.js").'></script>
    <script src='.asset("assets/admin/vendors/datatables/dataTables.bootstrap.min.js").'></script>
    <script src='.asset("assets/admin/js/pages/datatables.js").'></script>
    <script>
    $("#data-table").DataTable({
        // paging: false,
        scrollY: 250,
        order:[[0,"desc" ]],
        responsive: true
    });
    </script>
    <?php
}

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
        $sql = "SELECT * FROM `orders` where `status` = 'complete' GROUP BY `order_no`";
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
                    <?php 
                    $customer = $item['customer'];
                    $sql_customer = "SELECT * FROM `customer` WHERE `id` = '$customer'";
                    $res_customer = mysqli_query($conn,$sql_customer);
                    if (mysqli_num_rows($res_customer)>0) {
                        $item_customer = mysqli_fetch_array($res_customer);
                        $cuatomer_name = $item_customer['name'];
                    }else {
                        $cuatomer_name = "Unknown";
                    }
                    ?>
                    <h6 class="m-b-0"><?php echo $cuatomer_name ?></h6>
                </div>
            </td>
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
            <td><?php echo $item['order_date'] ?></td>
            <td>
            <?php echo $item['complete_order_date'] ?>
            </td>
            <td>
                <button onclick="product_detail(<?php echo $item['order_no']; ?>)" class="btn btn-sm btn-primary" data-toggle="modal" data-target="products-modal">
                    Products
                </button>
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

if (isset($_POST['tranctions'])) {
    $id = $_POST['user_id']; // customer id
    $sql = "SELECT * FROM `transactions` WHERE `customer_id` = $id";
    $res = mysqli_query($conn,$sql);
    $data = '<table class="table">
    <thead>
        <tr>
            <td>Order no</td>
            <td>Payment method</td>
            <td>Transaction code</td>
        </tr>
    </thead>
    <tbody>';
    $i=0;
    while ($item = mysqli_fetch_assoc($res)) {
        $data .='<tr>
            <td>'.$item['order_no'].'</td>
            <td>'.$item['payment_method'].'</td>
            <td>'.$item['transaction_code'].'</td>
        </tr>';
        $i++;
    }
    $data.='</tbody>
    </table>';

    echo $data;
}


if (isset($_POST['on_delivery_courier_detail'])) {
    $id = $_POST['id'];
    $sql = "SELECT * from `courier` where `id` = '$id'";
    $res = mysqli_query($conn,$sql);
    $item = mysqli_fetch_assoc($res);
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
                    <?php 
                    $customer = $item['customer'];
                    $sql_customer = "SELECT * FROM `customer` WHERE `id` = '$customer'";
                    $res_customer = mysqli_query($conn,$sql_customer);
                    $item_customer = mysqli_fetch_assoc($res_customer);
                    ?>
                        <h6 class="m-b-0"><?php echo $item_customer['name'] ?></h6>
                    </div>
                </td>
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
                <td><?php echo $item['order_date'] ?></td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="badge badge-primary badge-dot m-r-10">
                        </div>
                        <div>On delivery</div>
                    </div>
                </td>
                <td>
                    <button onclick="product_detail(<?php echo $item['order_no']; ?>)" class="btn btn-sm btn-primary" data-toggle="modal" data-target="products-modal">
                        Products
                    </button>
                </td>
                <td>
                    <button onclick="cancel_order(<?php echo $item['order_no']; ?>)" class="btn btn-sm btn-danger">Cancel</button>
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
                    <?php 
                    $customer = $item['customer'];
                    $sql_customer = "SELECT * FROM `customer` WHERE `id` = '$customer'";
                    $res_customer = mysqli_query($conn,$sql_customer);
                    $item_customer = mysqli_fetch_assoc($res_customer);
                    ?>
                        <h6 class="m-b-0"><?php echo $item_customer['name'] ?></h6>
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
if (isset($_POST['customers'])) {
    $sql = "SELECT * FROM `customer` ORDER BY id desc";
    $res = mysqli_query($conn,$sql);
    ?>
    <div class="mt-5 table-responsive">
        <table class="table table-hover e-commerce-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Transations</th>
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
                        <td><?php echo $fetch['email']; ?></td>
                        <td><button onclick="transactions(<?php echo $fetch['id']; ?>)" class="btn btn-sm btn-primary"><i class="fas fa-exchange-alt"></i></button></td>
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


if (isset($_POST['save_Item'])) {
    $id = $_POST['save_Item_id'];
    $name = $_POST['save_Item_name'];
    $quantity = $_POST['save_Item_quantity'];
    $price = $_POST['save_Item_price'];
    $sql = "UPDATE `item-detail` SET `name`='$name',`quantity`='$quantity',`price`='$price' WHERE `id` = '$id'";
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
        <td><?php echo $item['quantity']; ?></td>
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
    <!-- page js -->
    <script src="assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/pages/e-commerce-order-list.js"></script>
    <?php
    }
}



if (isset($_POST['add_item'])) {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $des = $_POST['description'];
    $img = $_FILES['image'];
    $img_name = $_FILES['image']['name'];
    $dir = "../assets/images/";
    move_uploaded_file($img['tmp_name'],"../assets/images/".$img['name']);
    $sql = "INSERT INTO `item-detail`(`name`,`quantity`, `category`, `price`,`description`, `img`) VALUES ('$name','$quantity','$category','$price','$des','$dir$img_name')";
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