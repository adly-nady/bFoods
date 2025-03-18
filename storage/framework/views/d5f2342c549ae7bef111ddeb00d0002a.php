<div class="pos-product-item card quick-view-trigger" data-product-id="<?php echo e($product->id); ?>">
    <div class="pos-product-item_thumb">
        <img src="<?php echo e($product['imageFullPath']); ?>" class="img-fit" alt="<?php echo e(translate('product')); ?>">
    </div>

    <div class="pos-product-item_content clickable">
        <div class="pos-product-item_title">
            <?php echo e(Str::limit($product['name'], 15)); ?>

        </div>

        <?php
            $pb = json_decode($product->branch_products, true);
            $discountData = [];
            if(isset($pb[0])){
                $price = $pb[0]['price'];
                $discountData =[
                    'discount_type' => $pb[0]['discount_type'],
                    'discount' => $pb[0]['discount']
                ];
            }else{
                $price = $product['price'];
                $discountType = $product['discount_type'];
                $discount = $product['discount'];
                $discountData =[
                    'discount_type' => $product['discount_type'],
                    'discount' => $product['discount']
                ];
            }
        ?>
        <div class="pos-product-item_price">
            <?php echo e(Helpers::set_symbol(($price-Helpers::discount_calculate($discountData, $price)))); ?>

        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/pos/_single_product.blade.php ENDPATH**/ ?>