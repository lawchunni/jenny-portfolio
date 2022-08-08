<p>
    <label for="category">Category</label>
    <select name="category" id="category">
        <option value="">Select</option>
        <?php foreach($categories as $category) : ?>
            <option value="<?=$utils->escAttr($category['id'])?>" 
                <?=$utils->escAttr(isset($product['category']) && ($product['category'] ==$category['id'] ) ) 
                ? 'selected=selected' 
                : '' ?> 
            >
                <?=$utils->esc($category['title'])?>
            </option>

        <?php endforeach; ?>
    </select>
    <span class="error"><?=$utils->esc($errors['category'][0] ?? '') ?></span>
</p>

<p>
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?=$utils->escAttr($product['title'] ?? '') ?>" />
    <span class="error"><?=$utils->esc($errors['title'][0] ?? '') ?></span>
</p>

<p> 
    <label for="product_img">Image</label>
    <span class="upload_img">
        <input type="file" name="product_img" id="product_img" />
        <?php if(isset($product['image'])) : ?>
            <input type="hidden" name="existing_img" value="<?=$utils->escAttr($product['image'])?>"/>
            <img src="../images/products/<?=$utils->escAttr($product['image'])?>" 
                alt="<?=$utils->escAttr($product['title'])?> image" width="200" height="100"/>
        <?php endif; ?>
    </span>
    <span class="error"><?=$utils->esc($errors['product_img'][0] ?? '') ?></span>
</p>

<p>
    <label for="summary">Summary</label>
    <textarea name="summary" id="summary" cols="30" rows="5"><?=$utils->esc($product['summary'] ?? '') ?></textarea>
    <span class="reminder">Limit: 200 words</span>
    <span class="error"><?=$utils->esc($errors['summary'][0] ?? '') ?></span>
</p>

<p>
    <label for="description">Description</label>
    <textarea name="description" id="description" cols="30" rows="10"><?=$utils->esc($product['description'] ?? '') ?></textarea>
    <span class="reminder">Limit: 900 words</span>
    <span class="error"><?=$utils->esc($errors['description'][0] ?? '') ?></span>
</p>

<p>
    <label for="technology">Technology</label>
    <input type="text" name="technology" id="technology"  value="<?=$utils->escAttr($product['technology'] ?? '') ?>" />
    <span class="reminder">Please use | as seperator. e.g. Photoshop|Adobe XD|Adobe Illustrator</span>
    <span class="error"><?=$utils->esc($errors['technology'][0] ?? '') ?></span>
</p>

<p>
    <label for="price">Price</label>
    <input type="text" name="price" id="price" value="<?=$utils->escAttr($product['price'] ?? '') ?>" />
    <span class="reminder">e.g. 100 / 100.00</span>
    <span class="error"><?=$utils->esc($errors['price'][0] ?? '') ?></span>
</p>

<p>
    <label for="discount_rate">Discount Rate</label>
    <select name="discount_rate" id="discount_rate">
        <?php for($i = 0; $i <= 100; $i++) : ?>
            <?php if(($i % 5 == 0)) : ?>
                <option value="<?=$utils->escAttr($i)?>"
                    <?=$utils->escAttr(isset($product['discount_rate']) && ($product['discount_rate'] == $i) ) ? 'selected=selected' : '' ?>
                ><?=$i?></option>
            <?php endif; ?>
        <?php endfor; ?>
    </select>
    <span>% off</span>
</p>

<p>
    <label for="status">Status</label>
    <select name="status" id="status">
        <?php foreach($status as $val) : ?>
            <option value="<?=$utils->escAttr($val)?>"
                <?=$utils->escAttr(isset($product['status']) && ($product['status'] == $val ) ) ? 'selected=selected' : '' ?>
            >
                <?=$utils->escAttr(ucwords($val))?>
            </option>
        <?php endforeach; ?>
    </select>
</p>

<?php if($_GET['p'] == 'product-edit') : ?>
    <p>
        <label>Delete</label>
        <input type="radio" name="deleted" id="no" value="0" 
            <?=$utils->escAttr(isset($product['deleted']) && ($product['deleted'] == '0' ) ) ? 'checked=checked' : '' ?>
        />
        <label for="no">No</label>
        <input type="radio" name="deleted" id="yes" value="1" 
            <?=$utils->escAttr(isset($product['deleted']) && ($product['deleted'] == '1' ) ) ? 'checked=checked' : '' ?>
        />
        <label for="yes">Yes</label>
    </p>
<?php endif; ?>

<p class="action_btn">
    <button class="add_btn" type="submit">Submit</button>
</p>
