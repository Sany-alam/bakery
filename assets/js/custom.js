$(function(){
    show_items();
});

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
            $("#item").html(data);
        },
        cache:false
    });
}

$("#add_Items").click(function() {
    if ($("#add-item-name").val().lentgh == 0 || $("#add-item-description").val().length == 0 || $("#add-item-image")[0].files[0].length == 0) {
        $("#Additems").modal("hide");
    }
    var name = $("#add-item-name").val();
    var description = $("#add-item-description").val();
    var image = $("#add-item-image")[0].files[0];
    var formdata = new FormData();
    formdata.append("name",name);
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
        // alert(data);
        show_items();
    },
    cache:false
    });
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