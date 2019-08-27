<div class="container">
    <div class="row">
        <?php if (count($carts) > 0) : ?>
            <div class="cart-container">
                <div class="col s12">
                    <ul class="collection cart">
                        <?php foreach($carts as $cart) : ?>
                            <li class="collection-item avatar cart-item" data-id="<?=$cart['product_id']?>" data-url="<?=baseurl('cart/process')?>">
                                <img src="<?=getImage($cart['images'])?>" alt="<?=toKebabCase($cart['name'])?>" class="circle">
                                <span class="title bold"><?=$cart['name']?></span>
                                <p><small><?=$cart['category_name']?></small></p>
                                <div class="row m-t-1 m-b-0">
                                    <div class="col s7 l4">
                                        <span class="price">Rp. <?=number_format($cart['price'])?></span>
                                    </div>
                                    <div class="col s5 l2 right-align">
                                        <span class="bold grey-text">&times; &nbsp;</span>
                                        <input class="qty w3-input w3-input-small w3-border" type="number" value="<?=$cart['quantity']?>" min="1" max="<?=$cart['max_qty']?>" data-price="<?=$cart['price']?>">
                                    </div>
                                    <div class="col s12 l6 right-align">
                                        <span class="item-total-price bold">Rp. <?=number_format($cart['total_item_price'])?></span>
                                    </div>
                                </div>
                                <div class="secondary-content">
                                    <button type="button" class="delete-item red btn btn-small btn-floating waves-effect waves-light materialize-tooltip" data-position="right" data-tooltip="Delete Item"><i class="material-icons">clear</i></button>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="right-align m-b-1">
                        <span class="cart-total-price total-price bold">Rp. <?=number_format($total_price)?></span>
                    </div>
                </div>
                <div class="col s12 m6 l3 offset-l6 m-b-1">
                    <a href="<?=baseurl()?>" class="grey waves-effect waves-light btn btn-block">Get Another Product</a>
                </div>
                <div class="col s12 m6 l3 m-b-1">
                    <button type="button" class="btn-checkout btn btn-block wave-effect waves-light">Checkout</button>
                </div>
            </div>
            <div class="checkout-preloader col s12 center-align hide" style="padding: 50px">
                <div class="preloader-wrapper small active" style="width: 5em; height: 5em;">
                    <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 form-checkout hide">
                <form class="col l8 s12 offset-l2" action="<?=baseurl('cart/checkout')?>" method="post">
                    <h5 class="grey-text">Write Your Data</h5>
                    <br>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="name" type="text" class="validate character-counter" id="name" data-length="100" autocomplete="off" required>
                            <label for="name">Full Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea name="address" class="materialize-textarea" data-length="250" required></textarea>
                            <label>Address</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l4 s6">
                            <button type="submit" class="blue waves-effect waves-light btn btn-block">Submit</button>
                        </div>
                        <div class="col l4 s6">
                            <button class="back-to-cart grey waves-effect waves-light btn btn-block">Back</button>
                        </div>
                    </div>
                </form>
            </div>
        <?php else : ?>
            <div class="cart-container">
                <div class="row center-align">
                    <div class="col s12">
                        <h1 class="title">No Cart List</h1>
                        <br><br>
                    </div>
                    <div class="col s12 l4 offset-l4">
                        <a href="<?=baseurl()?>" class="grey waves-effect waves-light btn btn-block">Get Product</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>