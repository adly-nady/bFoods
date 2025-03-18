<div class="print-area-content" id="printableAreaContent">
    <div class="text-center pt-4 mb-3 w-100">
        <h2 class="custom-title"><?php echo e(\App\Model\BusinessSetting::where(['key'=>'restaurant_name'])->first()->value); ?></h2>
        <h5 class="custom-h5">
            <?php echo e(\App\Model\BusinessSetting::where(['key'=>'address'])->first()->value); ?>

        </h5>
        <h5 class="custom-phone">
            <?php echo e(translate('Phone')); ?>

            : <?php echo e(\App\Model\BusinessSetting::where(['key'=>'phone'])->first()->value); ?>

        </h5>
    </div>

    <span>--------------------------------------------</span>
    <div class="row mt-3">
        <div class="col-6">
            <h5><?php echo e(translate('Order ID')); ?> : <?php echo e($order['id']); ?></h5>
        </div>
        <div class="col-6">
            <h5 style="font-weight: lighter">
                <?php echo e(date('d/M/Y h:i a',strtotime($order['created_at']))); ?>

            </h5>
        </div>
        <?php if($order->customer): ?>
            <div class="col-12">
                <h5><?php echo e(translate('Customer Name')); ?> : <?php echo e($order->customer['f_name'].' '.$order->customer['l_name']); ?></h5>
                <h5><?php echo e(translate('Phone')); ?> : <?php echo e($order->customer['phone']); ?></h5>
            </div>
        <?php endif; ?>
    </div>
    <h5 class="text-uppercase"></h5>
    <span>--------------------------------------------</span>
    <table class="table table-bordered mt-3 custom-table">
        <thead>
        <tr>
            <th class="custom-qty"><?php echo e(translate('QTY')); ?></th>
            <th class=""><?php echo e(translate('DESC')); ?></th>
            <th class="custom-price"><?php echo e(translate('Price')); ?></th>
        </tr>
        </thead>

        <tbody>
        <?php ($itemPrice=0); ?>
        <?php ($totalTax=0); ?>
        <?php ($totalDisOnPro=0); ?>
        <?php ($addOnsCost=0); ?>
        <?php ($addOnTax=0); ?>
        <?php ($addOnsTaxCost=0); ?>
        <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($detail->product): ?>
                <?php ($addOnQtys=json_decode($detail['add_on_qtys'],true)); ?>
                <?php ($addOnPrices=json_decode($detail['add_on_prices'],true)); ?>
                <?php ($addOnTaxes=json_decode($detail['add_on_taxes'],true)); ?>
                <tr>
                    <td>
                        <?php echo e($detail['quantity']); ?>

                    </td>
                    <td>
                        <span class="custom-span"> <?php echo e(Str::limit($detail->product['name'], 200)); ?></span><br>
                        <?php if(count(json_decode($detail['variation'], true)) > 0): ?>
                            <strong><u><?php echo e(translate('variation')); ?> : </u></strong>
                            <?php $__currentLoopData = json_decode($detail['variation'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if( isset($variation['name'])  && isset($variation['values'])): ?>
                                    <span class="d-block text-capitalize">
                                                        <strong><?php echo e($variation['name']); ?> - </strong>
                                                </span>
                                    <?php $__currentLoopData = $variation['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="d-block text-capitalize">
                                            <?php echo e($value['label']); ?> :
                                                    <strong><?php echo e(Helpers::set_symbol( $value['optionPrice'])); ?></strong>
                                                    </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <?php if(isset(json_decode($detail['variation'],true)[0])): ?>
                                        <?php $__currentLoopData = json_decode($detail['variation'],true)[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 =>$variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="font-size-sm text-body">
                                                <span><?php echo e($key1); ?> :  </span>
                                                <span class="font-weight-bold"><?php echo e($variation); ?></span>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <?php break; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="font-size-sm text-body">
                                <span><?php echo e(translate('Price')); ?> : </span>
                                <span
                                    class="font-weight-bold"><?php echo e(Helpers::set_symbol($detail->price)); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php $__currentLoopData = json_decode($detail['add_on_ids'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 =>$id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php ($addon=\App\Model\AddOn::find($id)); ?>
                            <?php if($key2==0): ?><strong><u><?php echo e(translate('Addons')); ?> : </u></strong><?php endif; ?>

                            <?php if($addOnQtys==null): ?>
                                <?php ($addOnQty=1); ?>
                            <?php else: ?>
                                <?php ($addOnQty=$addOnQtys[$key2]); ?>
                            <?php endif; ?>

                            <div class="font-size-sm text-body">
                                <span><?php echo e($addon ? $addon['name'] : translate('addon deleted')); ?> :  </span>
                                <span class="font-weight-bold">
                                    <?php echo e($addOnQty); ?> x <?php echo e(Helpers::set_symbol($addOnPrices[$key2])); ?> <br>
                                </span>
                            </div>
                            <?php ($addOnsCost+=$addOnPrices[$key2] * $addOnQty); ?>
                            <?php ($addOnsTaxCost +=  $addOnTaxes[$key2] * $addOnQty); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php echo e(translate('Discount')); ?> : <?php echo e(Helpers::set_symbol($detail['discount_on_product']*$detail['quantity'])); ?>

                    </td>
                    <td class="custom-td">
                        <?php ($amount=($detail['price']-$detail['discount_on_product'])*$detail['quantity']); ?>
                        <?php echo e(Helpers::set_symbol($amount)); ?>

                    </td>
                </tr>
                <?php ($itemPrice+=$amount); ?>
                <?php ($totalTax+=$detail['tax_amount']*$detail['quantity']); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <span>--------------------------------------------</span>
    <div class="row justify-content-md-end">
        <div class="col-md-9 col-lg-9">
            <dl class="row text-right custom-dl">
                <dt class="col-8"><?php echo e(translate('Items Price')); ?>:</dt>
                <dd class="col-4"><?php echo e(Helpers::set_symbol($itemPrice)); ?></dd>
                <dt class="col-8"><?php echo e(translate('Tax')); ?> / <?php echo e(translate('VAT')); ?>:</dt>
                <dd class="col-4"><?php echo e(Helpers::set_symbol($totalTax + $addOnsTaxCost)); ?></dd>
                <dt class="col-8"><?php echo e(translate('Addon Cost')); ?>:</dt>
                <dd class="col-4"><?php echo e(Helpers::set_symbol($addOnsCost)); ?>

                    <hr>
                </dd>

                <dt class="col-8"><?php echo e(translate('Subtotal')); ?>:</dt>
                <?php ($subtotal = $addOnsCost + $itemPrice + $totalTax + $addOnsTaxCost); ?>
                <dd class="col-4"><?php echo e(Helpers::set_symbol($subtotal)); ?></dd>
                <dt class="col-8"><?php echo e(translate('Coupon Discount')); ?>:</dt>
                <dd class="col-4">
                    -<?php echo e(Helpers::set_symbol($order['coupon_discount_amount'])); ?></dd>
                <dt class="col-8"><?php echo e(translate('Extra Discount')); ?>:</dt>
                <dd class="col-4">
                    -<?php echo e(Helpers::set_symbol($order['extra_discount'])); ?></dd>

                <dt class="col-8"><?php echo e(translate('Delivery Fee:')); ?></dt>
                <dd class="col-4">
                    <?php if($order['order_type']=='take_away'): ?>
                        <?php ($deliveryCharge=0); ?>
                    <?php else: ?>
                        <?php ($deliveryCharge=$order['delivery_charge']); ?>
                    <?php endif; ?>
                    <?php echo e(Helpers::set_symbol($deliveryCharge)); ?>

                    <hr>
                </dd>

                <dt class="col-6 custom-text-size"><?php echo e(translate('Total')); ?>:</dt>
                <dd class="col-6 custom-text-size"><?php echo e(Helpers::set_symbol($subtotal-$order['coupon_discount_amount']-$order['extra_discount']+$deliveryCharge)); ?></dd>
            </dl>
        </div>
    </div>
    <div class="d-flex flex-row justify-content-between border-top">
        <span><?php echo e(translate('Paid_by')); ?>: <?php echo e(translate($order->payment_method)); ?></span>
    </div>
    <span>--------------------------------------------</span>
    <h5 class="text-center pt-3">
        """<?php echo e(translate('THANK YOU')); ?>"""
    </h5>
    <span>--------------------------------------------</span>
</div>
<?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/pos/order/invoice.blade.php ENDPATH**/ ?>