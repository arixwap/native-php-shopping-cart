<div class="container">
    <div class="row">
        <div class="col s12 m4 l3 m-b-1">
            <a class="waves-effect waves-light btn blue lighten-2 btn-block" href="<?=baseurl('admin/product')?>">
                <i class="material-icons left">assignment</i>Product List
            </a>
        </div>
        <div class="col s12 m4 l3 m-b-1">
            <a class="waves-effect waves-light btn blue lighten-2 btn-block" href="<?=baseurl('admin/category')?>">
                <i class="material-icons left">border_all</i>Category List
            </a>
        </div>
        <div class="col s12 m4 l3 m-b-1">
            <a class="waves-effect waves-light btn blue lighten-2 btn-block" href="<?=baseurl('admin/order')?>">
                <i class="material-icons left">receipt</i>Order List
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <hr class="m-t-0"/>
            <div class="row font-big">
                <div class="col s12 l2 w3-text-grey">
                    <span>Name</span>
                </div>
                <div class="col s12 l10">
                    <span><?=$order['name']?></span>
                </div>
            </div>
            <hr class="m-t-0"/>
            <div class="row font-big">
                <div class="col s12 l2 w3-text-grey">
                    <span>Address</span>
                </div>
                <div class="col s12 l10">
                    <p class="m-t-0"><?=$order['address']?></p>
                </div>
            </div>
            <ul class="collection cart">
                <?php $totalPrice = 0 ?>
                <?php foreach($order['detail'] as $product) : ?>
                    <li class="collection-item avatar cart-item">
                        <img src="<?=getImage($product['images'])?>" alt="<?=toKebabCase($product['name'])?>" class="circle">
                        <span class="title bold"><?=$product['name']?></span>
                        <br>
                        <?php if ($product['category_name']) : ?>
                            <small><?=$product['category_name']?></small>
                            <br>
                        <?php endif; ?>
                        <span>Rp. <?=number_format($product['price'])?></span>
                        <br>
                        <span>Qty : <?=$product['quantity']?></span>
                        <div class="right">
                            <span class="item-total-price bold">Rp. <?=number_format( $product['price'] * $product['quantity'] )?></span>
                        </div>
                    </li>
                    <?php $totalPrice += ( $product['price'] * $product['quantity'] ) ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col s12 right-align m-t-1">
            <small class="total-price-title">Total Price</small>
            <hr class="m-t-1 m-b-1">
            <div class="right-align m-b-1">
                <span class="total-price bold">Rp. <?=number_format($totalPrice)?></span>
            </div>
        </div>
    </div>
</div>