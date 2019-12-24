<div class="modal fade" id="ViewItemDeteailModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body d-flex">
                            <input type="hidden" id="item-hiddenid">
                    <div class="product-single-img w-50">
                        <img id="item-img" src="" alt="">
                    </div>
                    <div class="product-single-content w-50">
                        <h3 id="item-name"></h3>
                        <div class="rating-wrap fix">
                            <span id="item-price" class="pull-left"></span>
                        </div>
                        <p id="item-des"></p>
                        <ul class="cetagory">
                            <li>Categories:</li>
                            <li id="item-cat"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="AddToCartModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body d-flex">
                            <input type="hidden" id="cart-hiddenid">
                    <div class="product-single-content w-50">
                        <h3 id="cart-name"></h3>
                        <ul class="input-style">
                            <li class="quantity cart-plus-minus">
                                <input id="quantity" type="number"/>
                            </li>
                            <li><a href="javascript:void(0)" id="addTocart">Add to Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>