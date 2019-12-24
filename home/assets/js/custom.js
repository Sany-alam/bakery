$(function(){
    countCart();
    show_cart();
    total_price();
});


function total_price() {
    var formdata = new FormData();
    formdata.append("total_price","total_price");
    $.ajax({
        processData:false,
        contentType:false,
        data:formdata,
        type:"post",
        url:"data.php",
        success:function(data){
            $("#total-price").html(data);
        },
        cache:false
    });
}


$("#remove_cart").click(function() {
    var formdata = new FormData();
    formdata.append("remove_cart","remove_cart");
    $.ajax({
        processData:false,
        contentType:false,
        data:formdata,
        type:"post",
        url:"data.php",
        success:function(data){
            countCart();
            show_cart();
        },
        cache:false
    });
});


function remove_cart_item(key) {
    var formdata = new FormData();
    formdata.append("key",key)
    formdata.append("remove_cart_item","remove_cart_item");
    $.ajax({
        processData:false,
        contentType:false,
        data:formdata,
        type:"post",
        url:"data.php",
        success:function(data){
            countCart();
            show_cart();
        },
        cache:false
    });
}


function show_cart() {
    var formdata = new FormData();
    formdata.append("show_cart","show_cart");
    $.ajax({
        processData:false,
        contentType:false,
        data:formdata,
        type:"post",
        url:"data.php",
        success:function(data){
            total_price();
            countCart();
            $("#show-cart").html(data);
        },
        cache:false
    });
}


$("#addTocart").click(function(){
    var id = $("#cart-hiddenid").val();
    var quantity = $("#quantity").val();
    if (quantity >= 1) {
    var formdata = new FormData();
    formdata.append("id",id);
    formdata.append("quantity",quantity);
    formdata.append("addCart","adCart");
    $.ajax({
        processData:false,
        contentType:false,
        data:formdata,
        type:"post",
        url:"data.php",
        success:function(data){
            countCart();
            show_cart();
            $("#AddToCartModal").modal('hide');
        },
        cache:false
    });
    }
    else{
        $("#AddToCartModal").modal('hide');
    }
    });


function countCart() {
    var formdata = new FormData();
    formdata.append("countCart","countCart");
    $.ajax({
        processData:false,
        contentType:false,
        data:formdata,
        type:"post",
        url:"data.php",
        success:function(data){
            $("#countCart").html(data);
        },
        cache:false
    });
}

function veiwItem(id) {
    var formdata = new FormData();
    formdata.append("id",id);
    formdata.append("viewIteminModal","viewIteminModal");
    $.ajax({
        processData:false,
        contentType:false,
        data:formdata,
        type:"post",
        url:"data.php",
        success:function(data){
            all = JSON.parse(data);
            $("#item-hiddenid").html(all.id);
            $("#item-img").attr("src",all.img);
            $("#item-name").html(all.name);
            $("#item-price").html(all.price+' Tk');
            $("#item-des").html(all.description);
            $("#item-cat").html(all.category);
            $("#ViewItemDeteailModal").modal('show');
        },
        cache:false
    });
}

function add_cart(id,name) {
    $("#cart-name").html(name);
    $("#cart-hiddenid").val(id);
    $("#quantity").val(1);
    $("#AddToCartModal").modal('show');
}