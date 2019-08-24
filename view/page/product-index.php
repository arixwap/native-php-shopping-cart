<a class="waves-effect waves-light btn blue lighten-2" href="<?=baseurl('product/create')?>">
    <i class="material-icons left">add</i>Product
</a>
<ul class="collection">
    <?php foreach($products as $key => $product) : ?>
        <li class="collection-item avatar">
            <img src="<?=$product['images']?>" alt="<?=$product['slug']?>" class="circle">
            <b><span class="title bold"><?=$product['name']?></span></b>
            <br/>
            <span class="quantity">(<?=number_format($product['quantity'])?>)</span>
            <span class="price">Rp. <?=number_format($product['price'])?></span>
            <div class="secondary-content">
                <a href="<?=baseurl('product/edit/'.$product['id'])?>"><i class="material-icons blue-text text-lighten-1">edit</i></a>
                <a href="<?=baseurl('product/delete/'.$product['id'])?>"><i class="material-icons red-text text-lighten-2">delete</i></a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>