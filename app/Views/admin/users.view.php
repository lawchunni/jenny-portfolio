<?php include __DIR__ . '/inc/header.inc.php'; ?>

<section id="admin_users" class="section_white">
    <div class="wrapper">
        <div class="content">

            <h1><?=$utils->esc($title)?></h1>
            
            <div class="view_list">
                <div class="row header">
                    <div class="col id">ID</div>
                    <div class="col col-2">Name</div>
                    <div class="col col-3">Address</div>
                    <div class="col col-2">Phone</div>
                    <div class="col col-2">Email</div>
                    <div class="col col-1">Privilege</div>
                    <div class="col col-1">Deleted</div>
                    <div class="col col-1">Newsletter</div>
                </div>
                <?php foreach($result as $user) : ?>
                    <div class="row <?=$utils->escAttr($user['deleted'] == '1' ? 'deleted' : '')?>">
                        <div class="col id"><?=$utils->esc($user['id'])?></div>
                        <div class="col col-2">
                            <?=$utils->esc($user['first_name'])?> 
                            <?=$utils->esc($user['last_name'])?>
                        </div>
                        <div class="col col-3">
                            <?=$utils->esc($user['street'])?>, 
                            <?=$utils->esc($user['city'])?>, 
                            <?=$utils->esc($user['province'])?> 
                            <?=$utils->esc($user['postal_code'])?>, 
                            <?=$utils->esc($user['country'])?>
                        </div>
                        <div class="col col-2">
                            <?=$utils->esc($user['phone'])?>
                        </div>
                        <div class="col col-2">
                            <?=$utils->esc($user['email'])?>
                        </div>
                        <div class="col col-1">
                            <?=$utils->esc($user['is_admin']) == '0' ? 'Customer' : 'Admin' ?>
                        </div>
                        <div class="col col-1">
                            <?=$utils->esc($user['deleted']) == '0' ? 'No' : 'Yes' ?>
                        </div>
                        <div class="col col-1">
                            <?=$utils->esc($user['subscribe_to_newsletter'])?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/inc/footer.inc.php'; ?>
