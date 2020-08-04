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
    if (address.length ==0) {
        $(".alert").removeClass("alert-success").html("");
        $(".alert").addClass("alert-danger").html("Ensure your address").show();
    }
    else{
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
                alert("Your order adedd successfully! Countinue shopping");
                location.href="index.php";
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
    var maxQuantity = $("#cart-hiddenQuantity").val();
    if (quantity >= 1) {
        if (Number(maxQuantity)==0) {
            alert("Out of stock");
        }else{
            if (Number(quantity)>Number(maxQuantity)) {
                alert("Add maxmum "+maxQuantity+" items");
            }else{
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
                        a = $.trim(data);
                        if (a=="ok") {
                            countCart();
                            show_cart();
                            $("#AddToCartModal").modal('hide'); 
                        }else{
                            alert(data);
                        }
                    },
                    cache:false
                });
            }
        }
    }
    else{
        alert("Add minimum 1 item")
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

function add_cart(id) {
    formdata = new FormData();
    formdata.append("id",id);
    formdata.append("viewIteminCardModal","viewIteminCardModal");
    $.ajax({
        processData:false,
        contentType:false,
        data:formdata,
        type:"post",
        url:"data.php",
        success:function(data){
            all = JSON.parse(data);
            $("#cart-img").attr('src',all.img);
            $("#cart-name").html(all.name+" ("+all.quantity+")");
            $("#cart-hiddenQuantity").val(all.quantity);
            $("#cart-hiddenid").val(all.id);
            $("#quantity").val(1);
            $("#quantity").attr("max",all.quantity);
            $("#cart-price").html(all.price+" Tk");
            $("#AddToCartModal").modal('show');
        },
        cache:false
    });
}