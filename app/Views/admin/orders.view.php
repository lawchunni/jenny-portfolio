<?php include __DIR__ . '/inc/header.inc.php'; ?>

<section id="admin_orders" class="section_white">
    <div class="wrapper">
        <div class="content">

            <h1><?=$utils->esc($title)?></h1>
            
            <div class="view_list">
                <div class="row header">
                    <div class="col id">ID</div>
                    <div class="col col-3">Order Date</div>
                    <div class="col col-2">Name</div>
                    <div class="col col-2">Email</div>
                    <div class="col col-1">No. of Items</div>
                    <div class="col col-1">Subtotal</div>
                    <div class="col col-1">GST Amount</div>
                    <div class="col col-1">PST Amount</div>
                    <div class="col col-1">Total</div>
                </div>

                <?php foreach($result as $order) : ?>
                    <div class="row">
                        <div class="col id">
                            <?=$utils->esc($order['id'])?>
                        </div>

                        <div class="col col-3">
                            <?=$utils->esc($order['created_at'])?>
                        </div>

                        <div class="col col-2">
                            <?=$utils->esc($order['user_information']['name'])?>
                        </div>

                        <div class="col col-2">
                            <?=$utils->esc($order['user_information']['email'])?>
                        </div>

                        <div class="col col-1">
                            <?=$utils->esc($order['quantity'])?>
                        </div>

                        <div class="col col-1">
                            $<?=$utils->esc($order['subtotal'])?>
                        </div>

                        <div class="col col-1">
                            $<?=$utils->esc($order['gst_amount'])?>
                        </div>

                        <div class="col col-1">
                            $<?=$utils->esc($order['pst_amount'])?>
                        </div>

                        <div class="col col-1">
                            <strong>$<?=$utils->esc($order['total_amount'])?></strong>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/inc/footer.inc.php'; ?>
