<?php include __DIR__ . '/inc/header.inc.php'; ?>

<section id="thank-you" class="section_white">
    <div class="wrapper">
        <div class="content">
        
            <h1><?=$utils->esc($title)?></h1>

            <h3>Order Details</h3>

            <!-- My company info -->
            <div class="order_summary col col-4">
                <h4>Company Information: </h4>
                <div class="info">
                    <p>
                        <span><strong>JENNY Web Services</strong></span>
                        <span>111 Harold Avenue W, <br /> Winnipeg, MB R2C 2C5</span>
                    </p>
                    <p>
                        <span><strong>Contact:</strong></span>
                        <span><strong>Tel:</strong> (204) 555-1213</span>
                        <span><strong>Fax:</strong> (204) 222-3677</span>
                        <span><strong>Email:</strong> <a href="mailto:info@jennywebservices.xyz">info@jennywebservices.xyz</a></span>
                    </p>
                </div>
                
            </div>
            <!-- Customer info -->
            <div class="order_summary col col-4">
                <h4>Customer Information: </h4>
                <div class="info">
                    <p>
                        <span><strong>Name: </strong><?=$utils->esc($customer['name'])?></span>
                        <span><strong>Street: </strong><?=$utils->esc($customer['street'])?></span>
                        <span><strong>City: </strong><?=$utils->esc($customer['city'])?></span>
                        <span><strong>province: </strong><?=$utils->esc($customer['province'])?></span>
                        <span><strong>Postal Code: </strong><?=$utils->esc($customer['postal_code'])?></span>
                        <span><strong>Country: </strong><?=$utils->esc($customer['country'])?></span>
                        <span><strong>Phone: </strong><?=$utils->esc($customer['phone'])?></span>
                        <span><strong>Email: </strong><?=$utils->esc($customer['email'])?></span>
                    </p>
                </div>
            </div>
            <!-- order info -->
            <div class="order_summary col col-4">
                <h4>Order Information: </h4>

                <div class="info">
                    <p>
                        <span><strong>Order Number: </strong><?=$utils->esc($invoice['id'])?></span>
                        <span><strong>Order Date: </strong><?=$utils->esc($invoice['created_at'])?></span>
                        <span><strong>Credit Card: </strong>****<?=$utils->esc($customer['credit_card'])?></span>
                    </p>

                    <p></p>
                </div>
            </div>

            <!-- Order Deatils -->
            <div class="cart_list">
                <div class="item title">
                    <span class="col col-4">Item</span>
                    <span class="col col-2">Quantity</span>
                    <span class="col col-2">Price</span>
                </div>
                <?php foreach($invoiceline as $item) : ?>
                    <div class="item list">

                        <!-- Service title -->
                        <span class="col col-4">
                            <a href="/?p=service-details&id=<?= $utils->escAttr($item['product_id']) ?>"><?= $utils->esc($item['product_name']) ?></a>
                        </span>

                        <!-- Service quantity -->
                        <span class="col col-2">
                            <?= $utils->escAttr($item['quantity']) ?>
                        </span>

                        <!-- Service line price -->
                        <span class="col col-2"><?= $utils->esc($item['line_price']) ?></span>
                        
                    </div>
                <?php endforeach; ?>

                <div class="item total">
                    <div class="row">
                        Total Discount: $<?= $utils->esc($invoice['discount_amount']) ?>
                    </div>
                    <div class="row">
                        Subtotal $<?= $utils->esc($invoice['subtotal']) ?>
                    </div>
                    <div class="row">
                        GST: $<?= $utils->esc($invoice['gst_amount']) ?>
                    </div>
                    <div class="row">
                        PST: $<?= $utils->esc($invoice['pst_amount']) ?>
                    </div>
                    <div class="row">
                        Total: 
                        <span class="sum">$<?= $utils->esc($invoice['total_amount']) ?></span>
                    </div>

                </div><!-- End Order Deatils -->

            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/inc/footer.inc.php'; ?>