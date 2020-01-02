$(function(){
    countCart();
    show_cart();
    total_price();
    order_list();
});


function place_order() {
    var name = $("#name").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var address = $("#address").val();
    if (name.length == 0 || email.length == 0 || phone.length == 0 || address.length ==0) {
        alert("Fill up form and countinue");
    }
    else{
    var formdata = new FormData();
    formdata.append("name",name);
    formdata.append("email",email);
    formdata.append("phone",phone);
    formdata.append("address",address);
    formdata.append("order","order");
    $.ajax({
        processData:false,
        contentType:false,
        data:formdata,
        type:"post",
        url:"data.php",
        success:function(data){
            alert("Your order adedd successfully! Countinue shopping");
            window.location.href="index.php";
        },
        cache:false
    });
}
}



function order_list() {
    var formdata = new FormData();
    formdata.append("order_list","order_list");
    $.ajax({
        processData:false,
        contentType:false,
        data:formdata,
        type:"post",
        url:"data.php",
        success:function(data){
            $("#order-list").html(data);
        },
        cache:false
    });
}


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

function add_cart(id,name,img,price) {
    $("#cart-img").attr('src',img);
    $("#cart-name").html(name);
    $("#cart-hiddenid").val(id);
    $("#quantity").val(1);
    $("#cart-price").html(price+" Tk");
    $("#AddToCartModal").modal('show');
}