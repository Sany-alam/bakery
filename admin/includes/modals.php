<!-- Add Item Modal -->
<div class="modal fade" id="Additems">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add item</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="add-item-name">Item name</label>
                    <input placeholder="Enter item name"type="text" class="form-control" id="add-item-name">
                </div>
                <div class="form-group">
                    <label for="add-item-category">Item category</label>
                    <select id="add-item-category" class="form-control form-control-sm">
                        <option value="">Category</option>
                        <option value="cakes">Cakes</option>
                        <option value="coockies">Coockies</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="add-item-price">Item price</label>
                    <input placeholder="Enter item price" type="number" class="form-control" id="add-item-price">
                </div>
                <div class="form-group">
                    <label for="add-item-description">Item description</label>
                    <input placeholder="Enter item description" type="text" class="form-control" id="add-item-description">
                </div>
                <div class="form-group">
                    <label for="add-item-image">Item image</label>
                    <input type="file" class="form-control" id="add-item-image">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add_Items">Add</button>
            </div>
        </div>
    </div>
</div>