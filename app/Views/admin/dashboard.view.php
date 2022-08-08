<?php include __DIR__ . '/inc/header.inc.php'; ?>

<section id="admin_dashboard" class="section_white">
    <div class="wrapper">
        <div class="content">

            <h1><?=$utils->esc($title)?></h1>

            <div class="row">
                <div class="col col-4">
                    <h4>Overview</h4>
                    <div class="container">
                        <P><strong>Total Active Products: <?=$utils->esc($glance['books'])?></strong></P>
                        <P><strong>Total Users: <?=$utils->esc($glance['users'])?></strong></P>
                        <P><strong>Total Orders: <?=$utils->esc($glance['orders'])?></strong></P>
                    </div>
                </div>

                <div class="col col-4">
                    <h4>Products (Active)</h4>
                    <div class="container">
                        <P><strong>Maximum Price: <?=$utils->esc(number_format($glance['product']['max_price'], 2))?></strong></P>
                        <P><strong>Minimum Price: <?=$utils->esc(number_format($glance['product']['min_price'], 2))?></strong></P>
                        <P><strong>Average Price: <?=$utils->esc(number_format($glance['product']['avg_price'], 2))?></strong></P>
                    </div>
                </div>

                <div class="col col-4">
                    <h4>Orders</h4>
                    <div class="container">
                        <P><strong>Maximum Order: $<?=$utils->esc(number_format($glance['invoice']['max_amount'], 2))?></strong></P>
                        <P><strong>Minimum Order: $<?=$utils->esc(number_format($glance['invoice']['min_amount'], 2))?></strong></P>
                        <P><strong>Average Order: $<?=$utils->esc(number_format($glance['invoice']['avg_amount'], 2))?></strong></P>
                    </div>
                </div>
            </div>

            <h3>Log Event (newest first)</h3>
            
            <div class="log_messages">
                <table>
                    <?php foreach($logEvent as $value) : ?>
                        <tr>
                            <td><?=$utils->esc($value['event'])?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            
        </div>
    </div>
</section>

<?php include __DIR__ . '/inc/footer.inc.php'; ?>
