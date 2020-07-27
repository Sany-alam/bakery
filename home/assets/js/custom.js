$(function(){
    countCart();
    show_cart();
    total_price();
    order_list();

    $("#bkash").click(function(){
        $("#exampleModalCenter").modal("show");
    });
});

function products(order_id) {
    var formdata = new FormData();
    formdata.append("order_no",order_id);
    formdata.append("product_det","product_det");
    $.ajax({
        processData:false,
        contentType:false,
        data:formdata,
        type:"post",
        url:"../admin/data.php",
        success:function(data)
        {
            $("#p-li").html(data);
            $("#products-detail-modal").modal('show');
        },
        cache:false
    });
}

function place_order() {
    var address = $("#address").val();
    var deliverymethod = $("input[name='deliverymethod']").val();
    if (address.length ==0 || deliverymethod.length==0) {
        $("#finalAlert").removeClass("alert-success").html("");
        $("#finalAlert").addClass("alert-danger").html("Ensure order information").show();
    }
    else{
        if ($("#onDeliver").is(':checked')) {
            deliverymethod = "onDeliver";
        }
        else if ($("#bkash").is(':checked')) {
            deliverymethod = "bkash";
        }
        if (deliverymethod = 'bkash') {
            if ($("#confirmation").val().length != 0) {
                submit();
            }else{
                $("#finalAlert").removeClass("alert-success").addClass("alert-danger").html("Confirm transiction code.").show();
            }
        }else{
            submit();
        }
    }

    function submit() {
        var formdata = new FormData();
        formdata.append("address",address);
        formdata.append("order","order");
        $.ajax({
            processData:false,
            contentType:false,
            data:formdata,
            type:"post",
            url:"data.php",
            success:function(data){
                $("#finalAlert").removeClass("alert-danger").addClass("alert-success").html("Your order adedd successfully! <a href='index.php'>Countinue shopping</a>").show();
                setTimeout(function(){ location.href="index.php"; }, 3000);
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
    cart_flash();
});

function cart_flash(){
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
}

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