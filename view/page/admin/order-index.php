<div class="container">
    <div class="row">
        <div class="col l3 s12 m-b-1">
            <a class="waves-effect waves-light btn blue lighten-2 btn-block" href="<?=baseurl('admin/product')?>">
                <i class="material-icons left">assignment</i>Product List
            </a>
        </div>
        <div class="col l3 s12 m-b-1">
            <a class="waves-effect waves-light btn blue lighten-2 btn-block" href="<?=baseurl('admin/category')?>">
                <i class="material-icons left">border_all</i>Category List
            </a>
        </div>
        <div class="col l3 s12 m-b-1">
            <a class="waves-effect waves-light btn blue lighten-2 btn-block" href="<?=baseurl('admin/order')?>">
                <i class="material-icons left">receipt</i>Order List
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <?php if (count($orders) > 0) : ?>
                <?= dump($orders) ?>
            <?php else : ?>
                <h5 class="grey-text">No Order List</h5>
            <?php endif; ?>
        </div>
    </div>
</div>