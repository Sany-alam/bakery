<div class="featured-area featured-area2">
        <div class="container">
            <div style="text-align:center;"><h1 style="color:#ef4836;display:inline-block;">FEATURED AREA</h1></div>
            <div class="row">
                <div class="col-12">
                    <div class="featured-active2 owl-carousel next-prev-style">
                        <?php
                        $sql = "SELECT * FROM `item-detail` order by id";
                        $res = mysqli_query($conn,$sql);
                        while ($item = mysqli_fetch_assoc($res)) {
                            ?>
                            <div class="featured-wrap">
                            <div class="featured-img">
                                <img src="<?php echo $item['img']; ?>" alt="">
                                <div class="featured-content">
                                    <a href="javascript:void(0)"><?php echo $item['name']; ?></a>
                                </div>
                            </div>
                        </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>