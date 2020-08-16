<?php
$sql_category = "SELECT * FROM `category` order by `id` desc";
$res_category = mysqli_query($conn,$sql_category);
?>
<?php 
    while ($category = mysqli_fetch_assoc($res_category)) {
        $q_category = $category['category'];
    ?>
    <?php 
$sql = "SELECT * FROM `item-detail` WHERE `category` = '$q_category' ORDER BY `id` DESC";
$res = mysqli_query($conn,$sql);
?>
<div class="tab-pane" id="<?php echo $q_category ?>">
    <ul class="row">
    <?php if (mysqli_num_rows($res)>0) { 
        while ($item = mysqli_fetch_array($res)) {
        ?>
        <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
            <div class="product-wrap">
                <div class="product-img">
                    <img src="<?php echo $item['img'] ?>" alt="">
                    <div class="product-icon flex-style">
                        <ul>
                            <li><a href="javascript:void(0)" onclick="add_cart(<?php echo $item['id']; ?>,'<?php echo $item['name']; ?>',<?php echo $item['quantity']; ?>,'<?php echo $item['img']; ?>','<?php echo $item['price']; ?>')"><i class="fa fa-cart-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="product-content">
                    <h3><a href="javascript:void(0)"><?php echo $item['name'] ?></a></h3>
                    <p class="pull-left"><?php echo $item['price'] ?>Tk</p>
                    <p class="pull-right" style="color: white;background: #ef4836;padding-left:10px;padding-right:10px;"><?php echo ($item['quantity'] > 0 ? 'In stock' : 'Out of stock') ?></p>
                </div>
            </div>
        </li>
        <?php } }
        else {
            ?>
            <div class="text-center">item not available right now, visit leter</div>
            <?php
        } ?>
    </ul>
</div>
    <?php
}
?>