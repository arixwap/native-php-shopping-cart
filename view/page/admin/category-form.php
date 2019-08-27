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
                    <input name="name" type="text" class="validate character-counter" id="name" value="<?=$category['name']?>" data-length="100" autocomplete="off" required>
                    <label for="name">Category Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select name="parent_id" class="materialize-select">
                        <option value="0">No Category</option>
                        <?php foreach ($parentCategories as $key => $parentCategory) : ?>
                            <option value="<?=$parentCategory['id']?>" <?= ($category['parent_id'] == $parentCategory['id']) ? 'selected' : '' ?>><?=$parentCategory['name']?></option>
                        <?php endforeach; ?>
                    </select>
                    <label>Select Parent Category</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea name="description" class="materialize-textarea" data-length="250"><?=$category['description']?></textarea>
                    <label>Description</label>
                </div>
            </div>
            <div class="row">
                <div class="col l4 s6">
                    <button type="submit" class="blue waves-effect waves-light btn btn-block">Submit</button>
                </div>
                <div class="col l4 s6">
                    <a href="<?=baseurl('admin/category')?>" class="grey waves-effect waves-light btn btn-block">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>