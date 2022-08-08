<?php include __DIR__ . '/inc/header.inc.php'; ?>

<section id="service_details">
    <div class="wrapper">
        <div class="content">

            <div class="image" style="background-image: url('images/products/<?= $utils->escAttr($product['image']) ?>')"></div>

            <h1><?= $utils->esc($product['title']) ?></h1>

            <div class="summary"><?= $utils->html($product['summary']) ?></div>

            <div class="technology tags">
                <?php foreach($utils->tagFormatter($product['technology']) as $tech) : ?>
                    <span><?= $utils->esc($tech) ?></span>
                <?php endforeach; ?>
            </div>

            <table>
                <tr>
                    <th>Category</th>
                    <td><?= $utils->esc($product['category_title']) ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><div class="summary"><?= $utils->html($product['description']) ?></div></td>
                </tr>

                <tr>
                    <th>price</th>
                    
                    <td>
                        <?php if($product['discount_available'] == '1') : ?>
                            <span class="old_price">was </span>
                            <span class="old_price crossout">$<?= $utils->esc($product['price']) ?></span>
                        <?php endif; ?>
                        <strong>$<?= $utils->esc(number_format(floatval($product['price']) * (1 - floatval($product['discount_rate'])), 2)) ?>*</strong>
                    </td>
                </tr>

                <tr>
                    <th>Discount Applied</th>
                    <?php if($product['discount_available'] == '1'): ?>
                        <td><?= $utils->esc(floatval($product['discount_rate']) * 100) ?>% off</td>
                    <?php else : ?>
                        <td>NA</td>
                    <?php endif; ?>
                </tr>
                
            </table>

            <div class="action_btn">
                <form action="/?p=process-cart" method="post">
                    <input type="hidden" name="id" value="<?= $utils->escAttr($product['id']) ?>" />
                    <button class="add_btn"  type="submit">Add to Cart</button>
                </form>
            </div>

            <div class="remark">
                * Price is based on the basic items of the service. Additional cost would be applied depending on the complexity of the requirement.
            </div>

        </div>
    </div>
</section>

<?php include __DIR__ . '/inc/footer.inc.php'; ?>
