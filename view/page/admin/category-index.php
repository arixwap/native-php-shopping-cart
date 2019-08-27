<div class="container">
    <div class="row">
        <div class="col s12 m4 l3 m-b-1">
            <a class="waves-effect waves-light btn blue lighten-2 btn-block" href="<?=baseurl('admin/product')?>">
                <i class="material-icons left">assignment</i>Product List
            </a>
        </div>
        <div class="col s12 m4 l3 m-b-1">
            <a class="waves-effect waves-light btn blue lighten-2 btn-block" href="<?=baseurl('admin/category/create')?>">
                <i class="material-icons left">add</i>New Category
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
            <?php if (count($categories) > 0) : ?>
                <h5 class="grey-text">Category List</h5>
                <ul class="collection">
                    <?php foreach($categories as $key => $category) : ?>
                        <li class="collection-item">
                            <span class="title bold"><?=$category['name']?></span>
                            <div class="secondary-content">
                                <a href="<?=baseurl('admin/category/edit/'.$category['id'])?>"><i class="material-icons blue-text text-lighten-1">edit</i></a>
                                <a href="<?=baseurl('admin/category/delete/'.$category['id'])?>"><i class="material-icons red-text text-lighten-2">delete</i></a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <h5 class="grey-text">No Category List</h5>
            <?php endif; ?>
        </div>
    </div>
</div>