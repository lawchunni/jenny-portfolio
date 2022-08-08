<?php include __DIR__ . '/inc/header.inc.php'; ?>

<section id="login" class="submit_form">
    <div class="wrapper">
        <div class="content">
            <h1><?=$utils->esc($title)?></h1>

            <form action="/?p=process_login" method="post" novalidate>
                <p class="field required">
                    <input type="text" name="email" placeholder="Email Address" value="<?=$utils->escAttr($post['email'] ?? '') ?>" />
                    <span class="error"><?=$utils->esc($errors['email'][0] ?? '') ?></span>
                </p>
                <p class="field required">
                    <input type="password" name="password"  placeholder="Password" />
                    <span class="error"><?=$utils->esc($errors['password'][0] ?? '') ?></span>
                </p>
                <p>
                    <button class="submit_button">Submit</button>
                </p>
            </form>
            <!-- <div class="forget_password"><a href="#">Forget Password?</a></div> -->
        </div>
    </div>
</section>

<?php include __DIR__ . '/inc/footer.inc.php'; ?>
