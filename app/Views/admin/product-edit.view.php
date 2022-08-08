<?php include __DIR__ . '/inc/header.inc.php'; ?>

<section id="admin_products_edit" class="section_white">
    <div class="wrapper">
        <div class="content">

            <?php include __DIR__ . '/../inc/search.inc.php'; ?>
            
            <h1><?=$utils->esc($title)?></h1>
            
            <div class="admin_form">
                <form action="/admin/?p=process-product-edit" method="post"  enctype="multipart/form-data" novalidate>
                    
                    <input type="hidden" name="csrf_token" value="<?=csrf()?>" />

                    <input type="hidden" name="id" value="<?=$utils->escAttr($product['id'])?>" />

                    <?php include __DIR__ . '/inc/product-form.inc.php'; ?>
                    
                </form>
            </div>
            
        </div>
    </div>
</section>

<?php include __DIR__ . '/inc/footer.inc.php'; ?>
