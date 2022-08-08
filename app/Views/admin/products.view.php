<?php include __DIR__ . '/inc/header.inc.php'; ?>

<section id="admin_products" class="section_white">
    <div class="wrapper">
        <div class="content">

            <?php include __DIR__ . '/../inc/search.inc.php'; ?>

            <h1><?=$utils->esc($title)?>(Services) List</h1>

            <?php if(isset($_GET['search'])) : ?>
                <div class="search_results">
                    Search Results for <span><strong><?=$utils->esc($_GET['search'])?></strong></span>:
                </div>
            <?php endif; ?>

            <div class="action_btn">
                <a class="add_btn" href="/admin?p=product-add">Add Product</a>
            </div>

            <?php if(isset($_GET['search']) && empty($result)) : ?><!-- If no search result-->
                <p class="no_result">
                    Opppppsss! No result for search item 
                    <span><?=$utils->esc($_GET['search'])?></span>. <br />Please search again :(
                </p>
            <?php else : ?>
                <div class="view_list">
                    <div class="row header">
                        <div class="col id">ID</div>
                        <div class="col col-2">Title</div>
                        <div class="col col-2">Category</div>
                        <div class="col col-2">Price</div>
                        <div class="col col-2">Discount Rate</div>
                        <div class="col col-1">Status</div>
                        <div class="col col-2">Deleted</div>
                        <div class="col col-1"></div>
                    </div>
                    <?php foreach($result as $product) : ?>
                        <div class="row <?=$utils->escAttr($product['deleted'] == '1' ? 'deleted' : '')?>">
                            <div class="col id"><?=$utils->esc($product['id'])?></div>
                            <div class="col col-2"><?=$utils->esc($product['title'])?></div>
                            <div class="col col-2"><?=$utils->esc($product['category_title'])?></div>
                            <div class="col col-2">$<?=$utils->esc($product['price'])?></div>
                            <div class="col col-2">
                                <?=
                                    $utils->esc(floatval($product['discount_rate'])) > 0 ? 
                                    $utils->esc(floatval($product['discount_rate']) * 100) . '% off'
                                    : 0 
                                ?>
                            </div>
                            <div class="col col-1"><?=$utils->esc($product['status'])?></div>
                            <div class="col col-2"><?=$utils->esc($product['deleted']) == '0' ? 'No' : 'Yes' ?></div>
                            <div class="col col-1">

                                <a href="/admin?p=product-edit&id=<?=$utils->escAttr($product['id'])?>">edit</a>
                                
                                <?php if($product['deleted'] == '0') : ?>
                                    <!-- Delete product -->
                                    <form action="/admin/?p=process-product-delete" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete <?=$utils->esc($product['title'])?> from customer site?')"
                                    >
                                        <input type="hidden" name="csrf_token" value="<?=csrf()?>" />
                                        <input type="hidden" name="id" value="<?=$utils->esc($product['id'])?>" />
                                        <input type="hidden" name="title" value="<?=$utils->esc($product['title'])?>" />
                                        <input type="hidden" name="deleted" value="1" />
                                        <input class="btn delete_btn" type="submit" name="delete" value="delete" />
                                    </form>
                                <?php elseif($product['deleted'] == '1') : ?>
                                    <!-- Activate product -->
                                    <form action="/admin/?p=process-product-delete" method="post">
                                        <input type="hidden" name="csrf_token" value="<?=csrf()?>" />
                                        <input type="hidden" name="id" value="<?=$utils->esc($product['id'])?>" />
                                        <input type="hidden" name="title" value="<?=$utils->esc($product['title'])?>" />
                                        <input type="hidden" name="deleted" value="0" />
                                        <input class="btn activate_btn" type="submit" name="activate" value="activate" />
                                    </form>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>  
            
        </div>
    </div>
</section>

<?php include __DIR__ . '/inc/footer.inc.php'; ?>
