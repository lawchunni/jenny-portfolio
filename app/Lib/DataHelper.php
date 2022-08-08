<?php

/**
 * This function is used to count the total quantity and calculate the total amount in the shopping cart
 *
 * @param array $cart
 * @return array
 */
function checkoutTotal(array $cart): array
{
    // count the total quantity from cart array
    $qty_array = array_column($cart, 'quantity');
    $qty_count = array_sum($qty_array);

    // calc the total amount from cart array
    $subtotal_array = array_column($cart, 'price');
    $subtotal_sum = array_sum($subtotal_array);

    // calc the total amount from cart array
    $discount_array = array_column($cart, 'discount_amount');
    $discount_amount = array_sum($discount_array);

    $pst = $subtotal_sum * PST;

    $gst = $subtotal_sum * GST;

    $total_amt = $subtotal_sum + $pst + $gst;

    $total = [
        'quantity' => $qty_count,
        'subtotal' => $subtotal_sum,
        'discount_amount' => $discount_amount,
        'pst' => $pst,
        'gst' => $gst,
        'total' => $total_amt
    ];

    return !empty($total) ? $total : [];
}

/**
 * Image upload for admin form
 *
 * @param array $files
 * @param string $field
 * @return array
 */
function imageUpload(array $files, string $field): array
{
    $tmpName = $files[$field]['tmp_name'];

    if(empty($tmpName)) return [];

    $imgDate = getimagesize($tmpName);

    $allowed = [
        'image/jpg',
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp'
    ];

    $mime = $imgDate['mime'] ?? false;
    
    if(!$mime || !in_array($mime, $allowed)) {
        return [
            'errors' => "The image format is incompatible. Please chooose an image from .jpg, .jpeg, .gif, png or .webp"
        ];
    }

    $fileName = uniqid() . '_' . $files[$field]['name'];
    $targetDir = __DIR__ . '/../../public/images/products/' . $fileName;

    //move image to image folder
    move_uploaded_file($tmpName, $targetDir);
    
    return [
        'file_name' => $fileName
    ];
    
}

