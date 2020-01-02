$(function(){
    show_items();
    show_order_req();
    show_pending_orders();
    complete_orders();
    category_list();
});


function complete_orders() {
    var formdata = new FormData();
    formdata.append("complete_orders","complete_orders");
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        $("#complete-order").html(data);
    },
    cache:false
    });
}


function on_delivery_courier_detail(id) {
    var formdata = new FormData();
    formdata.append("on_delivery_courier_detail","on_delivery_courier_detail");
    formdata.append("id",id);
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        $("#delivery-courier-detail").html(data);
        $(".delivery-courier-detail").modal('show');
    },
    cache:false
    });
}


function show_pending_orders() {
    var formdata = new FormData();
    formdata.append("show_pending_orders","show_pending_orders");
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        $("#order-on-delivery").html(data);
    },
    cache:false
    });
}


function assign_courier(id){
    var order_no = $("#hidden-order-no").val();
    // alert(order_no+" "+id);
    var formdata = new FormData();
    formdata.append("courier_id",id);
    formdata.append("order_no",order_no);
    formdata.append("assign_courier","assign_courier");
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        show_order_req();
        show_pending_orders();
        $("#assign-courier-modal").modal('hide');
    },
    cache:false
    });
}

function product_detail(order_no) {
    var formdata = new FormData();
    formdata.append("order_no",order_no);
    formdata.append("product_det","product_det");
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        $("#p-li").html(data);
        
    },
    cache:false
    });
    $("#products-detail-modal").modal('show');
    $("#assign-courier").click(function(){
        $("#products-detail-modal").modal('hide');
        $("#order-no").text("Order No #"+order_no);
        $("#hidden-order-no").val(order_no);

        var formdata = new FormData();
        formdata.append("courier_list","courier_list");
        $.ajax({
        processData:false,
        contentType:false,
        data:formdata,
        type:"post",
        url:"data.php",
        success:function(data)
        {
            $("#c-li").html(data);
            
        },
        cache:false
        });

        $("#assign-courier-modal").modal('show');
    });

}


function show_order_req() {
    var formdata = new FormData();
    formdata.append("show_order_req","show_order_req");
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        // alert(data);
        // console.log(data);
        $("#order-req").html(data);
        
    },
    cache:false
    });
}


$("#save_edit_category").click(function() {
    var category = $("#edit_category").val();
    var  id = $("#hidden_edit_category_id").val();
    var formdata = new FormData();
    formdata.append("id",id);
    formdata.append("category",category);
    formdata.append("save_category","save_category");
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        category_list();
        $('#bd-example-edit-category-modal-sm').modal("hide");
    },
    cache:false
    });
});


function edit_category(id) {
    var formdata = new FormData();
    formdata.append("category_id",id);
    formdata.append("edit_category","edit_category");
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        var all = JSON.parse(data);
        $("#edit_category").val(all.category);
        $("#hidden_edit_category_id").val(all.id);
        $('#bd-example-edit-category-modal-sm').modal("show");
    },
    cache:false
    });
}


function delete_category(id) {
    var formdata = new FormData();
    formdata.append("category_id",id);
    formdata.append("delete_category","delete_category");
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        category_list();
    },
    cache:false
    });
}



function category_list() {
    var formdata = new FormData();
    formdata.append("category_list","add_category");
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        $("#category-list").html(data);
    },
    cache:false
    });
}



$('#add-category').click(function(){
    var category = $("#add-category-name").val();
    var formdata = new FormData();
    formdata.append("category",category);
    formdata.append("add_category","add_category");
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        alert("Category added successfully");
    },
    cache:false
    });
});


$("#edit_product_save").click(function() {
    var id = $("#edit_product_id").val();
    var name =$("#edit_product_name").val();
    var price = $("#edit_product_price").val();
    var formdata = new FormData();
    formdata.append("save_Item_id",id);
    formdata.append("save_Item_name",name);
    formdata.append("save_Item_price",price);
    formdata.append("save_Item","save_Item");
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        show_items();
        $("#edit_item_modal").modal("hide");
    },
    cache:false
    });
});


function editItem(id) {
    var formdata = new FormData();
    formdata.append("edit_Item_id",id);
    formdata.append("edit_Item","edit_Item");
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        all = JSON.parse(data);
        $("#edit_product_id").val(all.id);
        $("#edit_product_name").val(all.name);
        $("#edit_product_price").val(all.price);
        $("#edit_item_modal").modal("show");
    },
    cache:false
    });
}


function show_items() {
    var formdata = new FormData();
    formdata.append("display_item","display_item");
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        $("#products").html(data);
    },
    cache:false
    });
}

$("#add_Items").click(function() {
    if ($("#add-item-name").val().lentgh == 0 || $("#add-item-description").val().length == 0 || $("#add-item-image")[0].files[0].length == 0 || $("#add-item-category").val().length == 0) {
        $("#Additems").modal("hide");
    }
    else{
    var name = $("#add-item-name").val();
    var price = $("#add-item-price").val();
    var category = $("#add-item-category").val();
    var description = $("#add-item-description").val();
    var image = $("#add-item-image")[0].files[0];
    var formdata = new FormData();
    formdata.append("name",name);
    formdata.append("price",price);
    formdata.append("category",category);
    formdata.append("description",description);
    formdata.append("image",image);
    formdata.append("add_item","add_item");
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        show_items();
        alert("Product added successfully");
    },
    cache:false
    });
    }
});

function delItem(id) {
    var formdata = new FormData();
    formdata.append("item-id",id);
    formdata.append("del_item","del_item");
    $.ajax({
    processData:false,
    contentType:false,
    data:formdata,
    type:"post",
    url:"data.php",
    success:function(data)
    {
        show_items();
    },
    cache:false
    });
}