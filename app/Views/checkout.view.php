<?php include __DIR__ . '/inc/header.inc.php'; ?>

<section id="checkout" class="section_white">
    <div class="wrapper">
        <div class="content">

            <h1><?=$utils->esc($title)?> (
                <?php if(intval($total['quantity']) > 1) : ?>
                    <?= $utils->esc($total['quantity']) ?> items
                <?php else : ?>
                    1 item
                <?php endif; ?>
            )</h1>

            <!-- <div class="col col-8"> -->
                <?php if(!empty($cart)) : ?><!-- Line item details -->
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
                                    <?= $utils->escAttr($item['quantity']) ?>
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
                                
                            </div>
                        <?php endforeach; ?>

                        <div class="item total">
                            <div class="row">
                                Total Discount: $<?= number_format($utils->esc($total['discount_amount']), 2) ?>
                            </div>
                            <div class="row">
                                Subtotal (<?= $utils->esc($total['quantity']) ?> items): $<?= number_format($utils->esc($total['subtotal']), 2) ?>
                            </div>
                            <div class="row">
                                GST: 
                                $<?= number_format($utils->esc($total['gst']), 2) ?>
                            </div>
                            <div class="row">
                                PST: $<?= number_format($utils->esc($total['pst']), 2) ?>
                            </div>
                            <div class="row">
                                Total: 
                                <span class="sum">$<?= number_format($utils->esc($total['total']), 2) ?></span>
                            </div>

                        </div>

                    </div>
                
                <?php endif; ?><!-- End of line item details -->
            <!-- </div> -->
            

            <div class="payment_form"><!-- Checkout Form -->

                <h2>Payment Details</h2>
                
                <form action="/?p=process-checkout" method="post">
                    <!-- Hidden value -->
                    <input type="hidden" name="csrf_token" value="<?=csrf()?>" />
                    <input type="hidden" name="subtotal" value="<?= $utils->escAttr($total['subtotal']) ?>" />
                    <input type="hidden" name="discount_amount" value="<?= $utils->escAttr($total['discount_amount']) ?>" />
                    <input type="hidden" name="pst" value="<?= $utils->escAttr($total['pst']) ?>" />
                    <input type="hidden" name="gst" value="<?= $utils->escAttr($total['gst']) ?>" />
                    <input type="hidden" name="total" value="<?= $utils->escAttr($total['total']) ?>" />

                    <p class="required">
                        <label for="name_on_card">Name on Card</label>
                        <input type="text" name="name_on_card" value="<?=$utils->escAttr($post['name_on_card'] ?? '') ?>"/>
                        <span class="error"><?=$utils->esc($errors['name_on_card'][0] ?? '') ?></span>
                    </p>

                    <p class="required">
                        <label for="credit_card_number">Credit Card Number</label>
                        <input type="text" name="credit_card_number" value="<?=$utils->escAttr($post['credit_card_number'] ?? '') ?>"/>
                        <span class="error"><?=$utils->esc($errors['credit_card_number'][0] ?? '') ?></span>
                    </p>

                    <p class="required">
                        <label for="expiry_date">Expiry Date</label>
                        <input type="month" name="expiry_date" value="<?=$utils->escAttr($post['expiry_date'] ?? '') ?>" />
                        <span class="error"><?=$utils->esc($errors['expiry_date'][0] ?? '') ?></span>
                    </p>

                    <p class="required">
                        <label for="cvv">CVV</label>
                        <input type="text" name="cvv" value="<?=$utils->escAttr($post['cvv'] ?? '') ?>"/>
                        <span class="error"><?=$utils->esc($errors['cvv'][0] ?? '') ?></span>
                    </p>

                    <p class="action_btn">
                        <button class="pay_btn" type="">Pay Now</button>
                    </p>

                    <p class="continue"><a href="/?p=all-services">Continue Shopping</a></p>
                </form>
            </div><!-- End Checkout Form -->
            
        </div>
    </div>
</section>

<?php include __DIR__ . '/inc/footer.inc.php'; ?>
