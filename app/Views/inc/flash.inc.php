<div class="flash_container">
    <?php if(!empty($flash['success'])) : ?>
        <div class="flash success">
            <?=$utils->esc($flash['success'])?>
        </div>
    <?php endif; ?>

    <?php if(!empty($flash['error'])) : ?>
        <div class="flash error">
            <?=$utils->esc($flash['error'])?>
        </div>
    <?php endif; ?>
</div>

