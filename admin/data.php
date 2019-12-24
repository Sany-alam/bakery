<?php
$conn = mysqli_connect('localhost','root','','bakery');



if (isset($_POST['display_item'])) {
    $sql = "SELECT * FROM `item-detail` order by id desc";
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
        while ($item = mysqli_fetch_array($res)) {
            ?>
    <li class="list-group-item p-h-0">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex">
                <div class="avatar avatar-image m-r-15">
                    <img src="<?php echo $item['img']; ?>">
                </div>
                <div>
                    <h6 class="m-b-0">
                        <a href="javascript:void(0);" class="text-dark"><?php echo $item['name']; ?></a>
                    </h6>
                    <span class="text-muted font-size-13"><?php echo $item['description']; ?></span>
                </div>
            </div>
            <span class="badge badge-pill badge-cyan font-size-12">
                <span class="font-weight-semibold m-l-5">
                <?php echo $item['price']; ?>Tk
                </span>
            </span>
            <button class='btn btn-danger' onclick="delItem(<?php echo $item['id']; ?>)"><i class="fa fa-trash"></i></button>
        </div>
    </li>
    <?php
        }
    }
    else {
        ?>
        <div class="text-center">No item available, add item to <a data-toggle="modal" href="#Additems">Click here</a></div>
        <?php
    }
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