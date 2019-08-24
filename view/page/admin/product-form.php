<div class="container">
    <div class="row">
        <form class="col l8 s12 offset-l2" action="<?=$submitUrl?>" method="post">
            <?php if ($error) : ?>
                <div class="red-text"><?=$error?></div>
            <?php endif; ?>
            <h5 class="grey-text"><?=$title?></h5>
            <br>
            <div class="row">
                <div class="input-field col s12">
                    <input name="name" type="text" class="validate" id="name" value="<?=$product['name']?>" data-length="100" autocomplete="off">
                    <label for="name">Product Name</label>
                </div>
            </div>
            <!-- <div class="row">
                <div class="input-field col s12">
                    <textarea name="description" class="materialize-textarea" data-length="250"><?=$product['description']?></textarea>
                    <label>Description</label>
                </div>
            </div> -->
            <div class="row">
                <div class="input-field col l8 s12">
                    <input name="price" type="number" class="validate" id="price" value="<?=$product['price']?>" min="0">
                    <label for="price">Price</label>
                </div>
                <div class="input-field col l4 s12">
                    <input name="quantity" type="number" class="validate" id="quantity" value="<?=$product['quantity']?>" min="0">
                    <label for="quantity">Quantity</label>
                </div>
            </div>
            <div class="row">
                <div class="col l4 s6">
                    <button type="submit" class="waves-effect waves-light btn btn-block">Submit</button>
                </div>
                <div class="col l4 s6">
                    <a href="<?=baseurl('admin/product')?>" class="grey waves-effect waves-light btn btn-block">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>