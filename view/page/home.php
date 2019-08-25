<div class="container">
    <div class="section">
        <!-- <div class="row">
            <form action="<?=baseurl()?>">
                <div class="input-field col s12 l4 offset-l4">
                    <input type="text" name="search" id="search">
                    <label for="search">Type to Search...</label>
                </div>
            </form>
        </div> -->
        <div class="row">
            <?php foreach ($products as $product) : ?>
                <div class="col s12 m3">
                    <div class="icon-block center-align">
                        <img class="responsive-img" src="<?=$product['images']?>" alt="<?=$product['slug']?>">
                        <h5 class="center"><?=$product['name']?></h5>
                        <span class="light ">Rp. <?=number_format($product['price'])?></span>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- <div class="col s12 m3">
                <div class="icon-block">
                    <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
                    <h5 class="center">Speeds up development</h5>
                    <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
                </div>
            </div> -->
        </div>
    </div>
</div>