<?php include __DIR__ . '/inc/header.inc.php'; ?>

<!-- Section: All Services -->
<section id="all_services">
    <div class="wrapper">

    <?php if(isset($_GET['search'])) : ?>
        <div class="search_results">
            Search Results for <span><strong><?=$utils->esc($_GET['search'])?></strong></span>:
        </div>
    <?php endif; ?>

    <h1><?=$utils->esc($title)?></h1>

    <!-- Detect IE 8 -->
    <!--[if IE 8]>
        <p>You appear to be using an ancient Internet Explorer 8 browser. Upgrade to the most recent version to stay on trend ;)</p>
    <![endif]-->

    <div class="sub_menu">
        <a class="<?=$utils->escAttr(!isset($_GET['category']) && !isset($_GET['search'])) ? 'active' : '' ?>" href="/?p=all-services">All</a>
        <?php foreach($categories as $category) : ?>
            <a class="<?=$utils->escAttr(isset($_GET['category']) && $_GET['category'] == $category['id']) ? 'active' : '' ?>" 
                href="/?p=all-services&category=<?= $utils->escAttr($category['id']) ?>">
                <?= $utils->esc($category['title']) ?>
            </a>
        <?php endforeach; ?>
    </div>
    
    <?php if(isset($_GET['search']) && empty($productResults)) : ?>
        <p class="no_result">Opppppsss! No result for search item <span><?=$utils->esc($_GET['search'])?></span>. <br />Please search again :(</p>
    <?php elseif(isset($_GET['category']) && empty($productResults)) : ?>
        <p class="no_result">Opppppsss! Category does not exist. Please select from the yellow button above :(</p>
    <?php else : ?>
        <?php foreach($productResults as $categoryKey => $categoryGroup) : ?><!-- loop category -->

            <h3><?= $utils->esc($categoryKey) ?></h3>

            <table>
                <tr>
                    <th>Services</th>
                    <th>Summary</th>
                    <th>Price</th>
                    <th></th>
                </tr>

                <?php foreach($categoryGroup as $product) : ?><!-- loop product -->
                    <tr>
                        <th><?= $utils->esc($product['product_title']) ?></th>

                        <td>
                            <p><?= $utils->html($product['summary']) ?></p>
                        </td>

                        <td>
                            <?php if($product['discount_available'] == '1') : ?>
                                <span class="old_price crossout">$<?= $utils->esc($product['price']) ?></span>
                            <?php endif; ?>

                            <span>
                                <strong>$<?= $utils->esc(number_format(floatval($product['price']) * (1 - floatval($product['discount_rate'])), 2)) ?></strong>
                            </span>
                        </td>

                        <td>
                            <span class="action_btn">
                                <a class="details_btn" href="/?p=service-details&id=<?= $utils->escAttr($product['id']) ?>">View Details</a>

                                <form action="/?p=process-cart" method="post">
                                    <input type="hidden" name="id" value="<?= $utils->escAttr($product['id']) ?>" />
                                    <button class="add_btn"  type="submit">Add to Cart</button>
                                </form>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?><!-- End loop product -->

            </table>

        <?php endforeach; ?><!-- End loop category -->

    <?php endif; ?>

    </div>
</section>

<div id="back_to_top">
    <span class="circle"></span>
    <span class="arrow"></span>
    <span class="arrow_rectangle"></span>
</div>

<?php include __DIR__ . '/inc/footer.inc.php'; ?>