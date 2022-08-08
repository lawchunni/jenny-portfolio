<?php include __DIR__ . '/inc/header.inc.php'; ?>

<section id="admin_logs" class="section_white">
    <div class="wrapper">
        <div class="content">

            <h1><?=$utils->esc($title)?></h1>

            <h3>Log Event (Latest 100 records)</h3>

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
