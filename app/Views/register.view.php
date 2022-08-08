<?php include __DIR__ . '/inc/header.inc.php'; ?>

<section id="register" class="submit_form">
    <div class="wrapper">
        <div class="content">
            <h1><?=$utils->esc($title)?></h1>

            <P>Please register before purchasing any web services.</P>

            <form action="/?p=process_register" method="post" novalidate>
                
                <input type="hidden" name="csrf_token" value="<?=csrf()?>" />

                <p class="col col-6 required">
                    <input type="text" id="first_name" name="first_name" placeholder="First Name" value="<?=$utils->escAttr($post['first_name'] ?? '' )?>" />
                    <span class="error"><?=$utils->esc($errors['first_name'][0] ?? '') ?></span>
                </p>
                
                <p class="col col-6 required">
                    <input type="text" id="last_name" name="last_name" placeholder="Last Name" value="<?=$utils->escAttr($post['last_name'] ?? '') ?>"/>
                    <span class="error"><?=$utils->esc($errors['last_name'][0] ?? '') ?></span>
                </p>

                <p class="col col-12 required">
                    <input type="text" id="street" name="street" placeholder="Street" value="<?=$utils->escAttr($post['street'] ?? '') ?>" />
                    <span class="error"><?=$utils->esc($errors['street'][0] ?? '') ?></span>
                </p>

                <p class="col col-8 required">
                    <input type="text" id="city" name="city" placeholder="City" value="<?=$utils->escAttr($post['city'] ?? '') ?>" />
                    <span class="error"><?=$utils->esc($errors['city'][0] ?? '') ?></span>
                </p>

                <p class="col col-4 required">
                    <input type="text" id="postal_code" name="postal_code" placeholder="Postal Code" value="<?=$utils->escAttr($post['postal_code'] ?? '') ?>" />
                    <span class="error"><?=$utils->esc($errors['postal_code'][0] ?? '') ?></span>
                </p>

                <p class="col col-6 required">
                    <input type="text" id="province" name="province" placeholder="Province" value="<?=$utils->escAttr($post['province'] ?? '')?>" />
                    <span class="error"><?=$utils->esc($errors['province'][0] ?? '') ?></span>
                </p>

                <p class="col col-6 required">
                    <input type="text" id="country" name="country" placeholder="Country" value="<?=$utils->escAttr($post['country'] ?? '' ) ?>" />
                    <span class="error"><?=$utils->esc($errors['country'][0] ?? '') ?></span>
                </p>

                <p class="col col-12 required">
                    <input type="text" id="phone" name="phone" placeholder="Phone" value="<?=$utils->escAttr($post['phone'] ?? '') ?>" />
                    <span class="error"><?=$utils->esc($errors['phone'][0] ?? '') ?></span>
                </p>

                <p class="col col-12 required">
                    <input type="text" id="email" name="email" placeholder="Email Address" value="<?=$utils->escAttr($post['email'] ?? '') ?>"/>
                    <span class="error"><?=$utils->esc($errors['email'][0] ?? '') ?></span>
                </p>

                <p class="col col-12 required">
                    <input type="password" id="password" name="password" placeholder="Password" />
                    <span class="error"><?=$utils->html($errors['password'][0] ?? '') ?></span>
                </p>

                <p class="col col-12 required">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" />
                    <span class="error"><?=$utils->esc($errors['confirm_password'][0] ?? '') ?></span>
                </p>

                <p>
                    <input type="checkbox" name="terms" id="terms" <?=$utils->esc(isset($post['terms'])? 'checked = "checked"' : '') ?> />
                    <label for="terms">I accept the 
                        <a href="#" target="_blank">Terms of Use</a> & <a href="#" target="_blank">Privacy Policy</a> .<span class="highlight">*</span></label>
                    <span class="error"><?=$utils->esc($errors['terms'][0] ?? '') ?></span>
                </p>

                <p>
                    <input type="checkbox" name="subscribe_to_newsletter" id="subscribe_to_newsletter" 
                        <?=$utils->esc(isset($post['subscribe_to_newsletter'])? 'checked = "checked"' : '') ?> />
                    <label for="subscribe_to_newsletter">Subscribe to our Newsletter.</label>
                </p>
                
                <p>
                    <button class="submit_button">Register</button>
                </p>

                <p class="highlight">* Required fields.</p>

            </form>

        </div>

    </div>
</section>

<?php include __DIR__ . '/inc/footer.inc.php'; ?>
