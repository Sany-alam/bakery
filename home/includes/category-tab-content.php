<?php
$sql = "SELECT * FROM `category` order by `id` asc";
$res = mysqli_query($conn,$sql);
?>
<ul class="nav">
    <li>
        <a class="active" data-toggle="tab" href="#all">All food</a>
    </li>
    <?php 
    while ($category = mysqli_fetch_assoc($res)) {
    ?>
    <li>
        <a data-toggle="tab" href="#<?php echo $category['category']; ?>"><?php echo $category['category']; ?></a>
    </li>
    <?php
}
?>
</ul>