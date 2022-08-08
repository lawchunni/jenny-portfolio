<?php include __DIR__ . '/inc/header.inc.php'; ?>

<section id="profile" class="section_white">
    <div class="wrapper">
        <div class="content">
        
            <h1><?=$utils->esc($title)?></h1>

            <table>
                <?php foreach($result as $key => $value) : ?>
                    <?php if($key != 'id' && $key != 'subscribe_to_newsletter') : ?>
                        <tr>
                            <th><?=$utils->esc($utils->nameFormatter($key))?>: </th>
                            <td><?=$utils->esc($value)?></td>
                        </tr>

                    <?php elseif($key == 'subscribe_to_newsletter'): ?>
                        <tr>
                        <th><?=$utils->esc($utils->nameFormatter($key))?>: </th>
                            <td>
                                <?=$utils->esc($value) == '1' ? 'Yes' : 'No' ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach;?>
            </table>
        </div>
    </div>
</section>

<?php include __DIR__ . '/inc/footer.inc.php'; ?>