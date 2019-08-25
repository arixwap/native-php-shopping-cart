<div class="container">
    <div class="section">
        <?php foreach (chunk($products, 4) as $rows) : ?>
            <div class="row">
                <?php foreach ($rows as $product) : ?>
                    <div class="col s12 m3 m-b-2 product">
                        <div class="icon-block">
                            <div class="square valign-wrapper">
                                <div><img class="responsive-img product-card" src="<?=getImage($product['images'])?>" alt="<?=$product['slug']?>"></div>
                            </div>
                            <h5><?=$product['name']?> <i class="material-icons"></i></h5>
                            <div class="left">
                                <span class="light">Rp. <?=number_format($product['price'])?></span>
                            </div>
                            <button class="orange waves-effect waves-light btn btn-small right buy">Buy</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>