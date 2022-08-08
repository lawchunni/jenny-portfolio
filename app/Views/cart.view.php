<?php include __DIR__ . '/inc/header.inc.php'; ?>

<section id="cart" class="section_white">
    <div class="wrapper">
        <div class="content">
        
            <h1><?=$utils->esc($title)?></h1>

            <?php if(!empty($cart)) : ?>
                <div class="cart_list">
                    <div class="item title">
                        <span class="col col-4">Item</span>
                        <span class="col col-2">Quantity</span>
                        <span class="col col-2">Discount</span>
                        <span class="col col-2">Price</span>
                    </div>
                    <?php foreach($cart as $item) : ?>
                        <div class="item list">

                            <!-- Service title -->
                            <span class="col col-4">
                                <a href="/?p=service-details&id=<?= $utils->escAttr($item['id']) ?>"><?= $utils->esc($item['title']) ?></a>
                            </span>

                            <!-- Service quantity -->
                            <span class="col col-2">
                                <form action="/?p=process-cart" method="post">
                                    <input type="hidden" name="id" value="<?= $utils->escAttr($item['id']) ?>" />
                                    <select name="quantity" id="quantity" onchange="this.form.submit()">
                                        <?php for($i = 1; $i <= 10; $i++) : ?>
                                            <option value="<?=$utils->escAttr($i)?>" <?= ($utils->escAttr($i == $item['quantity']) ? 'selected' : '' ) ?>>
                                                <?=$utils->esc($i)?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </form>
                                
                            </span>

                            <!-- Service discount -->
                            <span class="col col-2">
                                <?php if($item['discount_available'] == '1') : ?>
                                    <?= $utils->esc($item['discount_rate']) ?>% off
                                <?php else : ?>
                                    NA
                                <?php endif; ?>
                            </span>

                            <!-- Service line price -->
                            <span class="col col-2"><?= number_format($utils->esc($item['price']), 2) ?></span>

                            <!-- Delete button -->
                            <span class="action_btn delete">
                                <form action="/?p=process-cart" method="post" class="col col-2">
                                    <input type="hidden" name="delete_id" value="<?= $utils->escAttr($item['id']) ?>" />
                                    <button class="del_btn"  type="submit">Delete</button>
                                </form>
                            </span>
                            
                        </div>
                    <?php endforeach; ?>

                    <div class="item total">
                        <div class="row">
                            Total Discount: $<?= number_format($utils->esc($total['discount_amount']), 2) ?>
                        </div>

                        <div class="row">
                            Subtotal (<?= $utils->esc($total['quantity']) ?> items): 
                            <span class="sum">$<?= number_format($utils->esc($total['subtotal']), 2) ?></span>
                        </div>
                    </div>

                </div>

                <div class="action_btn checkout">
                    <a href="/?p=cart&clear=1" class="clear">Clear Cart</a>
                    <a href="/?p=checkout" class="add_btn">Checkout</a>
                </div>

            <?php else : ?>
                <div class="message">
                    <p>Oppppsss! Seems you haven't added any item to your shopping cart. </p>
                    <p>Go to <a href="/?p=all-services">All Services</a> for our Design & Web Services ;)</p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php include __DIR__ . '/inc/footer.inc.php'; ?>
