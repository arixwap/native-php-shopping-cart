<div class="container">
    <div class="row">
        <form class="col l8 s12 offset-l2" action="<?=$submitUrl?>" method="post" enctype="multipart/form-data">
            <?php if ($error) : ?>
                <div class="red-text"><?=dump($error)?></div>
            <?php endif; ?>
            <h5 class="grey-text"><?=$title?></h5>
            <br>
            <div class="row">
                <div id="container-preview-image">
                    <!-- Example Images - -->
                    <div class="hide col s6 l4 preview-image master">
                        <div class="card">
                            <div class="card-image">
                                <img src="" alt="" class="responsive-img">
                                <a class="btn-floating btn-delete halfway-fab waves-effect waves-light red darken-1"><i class="material-icons">clear</i></a>
                            </div>
                        </div>
                    </div>
                    <!-- End - Example Preview Image -->
                    <?php foreach (getImage($product['images'], true, null) as $key => $image) : ?>
                        <div class="col s6 l4 preview-image">
                            <div class="card">
                                <div class="card-image">
                                    <img src="<?=$image?>" alt="<?=$product['slug']?>" class="responsive-img">
                                    <a class="btn-floating btn-delete halfway-fab waves-effect waves-light red darken-1"><i class="material-icons">clear</i></a>
                                </div>
                            </div>
                            <input type="hidden" name="prev_images[]" value="<?=$image?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                <label>
                    <div class="col s6 l4">
                        <div class="square square-upload-image valign-wrapper materialize-tooltip" data-position="right" data-tooltip="Upload Product Images">
                            <div><i class="material-icons">add</i></div>
                        </div>
                    </div>
                    <input type="file" class="hide input-image" target="container-preview-image" accept="image/x-png,image/gif,image/jpeg">
                <label>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input name="name" type="text" class="validate character-counter" id="name" value="<?=$product['name']?>" data-length="100" autocomplete="off" required>
                    <label for="name">Product Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select name="category_id" class="materialize-select">
                        <option value="0">No Category</option>
                        <?php foreach ($categories as $key => $category) : ?>
                            <option value="<?=$category['id']?>" <?= ($product['category_id'] == $category['id']) ? 'selected' : '' ?>><?=$category['name']?></option>
                        <?php endforeach; ?>
                    </select>
                    <label>Select Category</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea name="description" class="materialize-textarea char-counter" data-length="250"><?=$product['description']?></textarea>
                    <label>Description</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col l8 s12">
                    <input name="price" type="number" class="validate" id="price" value="<?=$product['price']?>" min="0" required>
                    <label for="price">Price</label>
                </div>
                <div class="input-field col l4 s12">
                    <input name="quantity" type="number" class="validate" id="quantity" value="<?=$product['quantity']?>" min="0" required>
                    <label for="quantity">Quantity</label>
                </div>
            </div>
            <div class="row">
                <div class="col l4 s6">
                    <button type="submit" class="blue waves-effect waves-light btn btn-block">Submit</button>
                </div>
                <div class="col l4 s6">
                    <a href="<?=baseurl('admin/product')?>" class="grey waves-effect waves-light btn btn-block">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>