<?php
$sql = "SELECT * FROM `item-detail` ORDER BY `id` DESC";
$res = mysqli_query($conn,$sql);
?>
<div class="tab-pane active" id="all">
<ul class="row">
<?php
if (mysqli_num_rows($res)>0) {
    while ($items = mysqli_fetch_array($res)) {
        ?>
        <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
        <div class="product-wrap">
        <div class="product-img">
        <img src="<?php echo $items['img'] ?>" alt="">
        <div class="product-icon flex-style">
        <ul>
        <!-- <li><a href="javascript:void(0)" onclick="veiwItem(<?php echo $items['id'] ?>)"><i class="fa fa-eye"></i></a></li> -->
        <li><a href="javascript:void(0)" onclick="add_cart('<?php echo $items['id']; ?>','<?php echo $items['name']; ?>','<?php echo $items['img']; ?>','<?php echo $items['price']; ?>')"><i class="fa fa-cart-plus"></i></a></li>
        </ul>
        </div>
        </div>
        <div class="product-content">
        <h3><a href="javascript:void(0);"><?php echo $items['name'] ?></a></h3>
        <p class="pull-left"><?php echo $items['price']."Tk" ?><del><?php echo $items['price']+(5)."Tk"; ?></del></p>
        </div>
        </div>
        </li>
        <?php
        }
    }
    else {
        ?>
        <div class="text-center">item not available right now, visit leter</div>
        <?php
    }
    ?>
    </ul>
    </div>