<div class="container">
    <div class="row">
        <div class="col s12">
            <ul class="collection cart">
                <?php foreach($carts as $cart) : ?>
                    <li class="collection-item avatar cart-item">
                        <img src="<?=getImage($cart['images'])?>" alt="<?=toKebabCase($cart['name'])?>" class="circle">
                        <span class="title bold"><?=$cart['name']?></span>
                        <p><small><?=$cart['category_name']?></small></p>
                        <!-- <input class="qty w3-input w3-border" type="number" value="<?=$cart['quantity']?>" max="<?=$cart['max_qty']?>"> -->
                        <div class="secondary-content">
                            <a href="<?=baseurl('cart/process')?>" data-id="<?=$cart['product_id']?>" class="delete-item red btn btn-small btn-floating waves-effect waves-light materialize-tooltip" data-position="right" data-tooltip="Delete Item"><i class="material-icons">clear</i></a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col s12 m5 l3 offset-m7 offset-l9">
            <button type="button" class="checkout btn btn-block wave-effect waves-light">Checkout</button>
        </div>
    </div>
</div>