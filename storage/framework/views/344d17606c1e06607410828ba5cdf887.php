<?php
$company_name = App\Model\BusinessSetting::where('key', 'restaurant_name')->first()->value;
?>
<table class="main-table">
    <tbody>
        <tr>
            <td class="main-table-td">
                <h2 class="mb-3" id="mail-title"><?php echo e($data['title']?? translate('Main_Title_or_Subject_of_the_Mail')); ?></h2>
                <div class="mb-1" id="mail-body"><?php echo $data['body']?? translate('Hi_Sabrina,'); ?></div>
                <span class="d-block text-center mb-3">
                    <a href="#" class="cmn-btn" id="mail-button"><?php echo e($data['button_name']??'Track Order'); ?></a>
                </span>
                <table class="bg-section p-10 w-100">
                    <tbody>
                        <tr>
                            <td class="p-10">
                                <span class="d-block text-center">
                                    <?php ($restaurant_logo = \App\Model\BusinessSetting::where(['key'=>'logo'])->first()->value); ?>
                                    <img class="mb-2 mail-img-2" onerror="this.src='<?php echo e(asset('storage/app/public/restaurant/' . $restaurant_logo)); ?>'"
                                    src="<?php echo e(asset('storage/app/public/email_templatee/')); ?>/<?php echo e($data['logo']??''); ?>" id="logoViewer" alt="">
                                    <h3 class="mb-3 mt-0"><?php echo e(translate('Order_Info')); ?></h3>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table class="order-table w-100">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="pl-2">
                                                    <h3 class="subtitle"><?php echo e(translate('Order_Summary')); ?></h3>
                                                    <span class="d-block"><?php echo e(translate('Order')); ?># 48573</span>
                                                    <span class="d-block">23 Jul, 2023 4:30 am</span>
                                                </div>

                                            </td>
                                            <td style="max-width:130px">
                                                <h3 class="subtitle"><?php echo e(translate('Delivery_Address')); ?></h3>
                                                <span class="d-block">Munam Shahariar</span>
                                                <span class="d-block" >4517 Washington Ave. Manchester, Kentucky 39495</span>
                                            </td>
                                        </tr>
                                        <td colspan="2">
                                            <table class="w-100">
                                                <thead class="bg-section-2">
                                                    <tr>
                                                        <th class="text-left p-1 px-3"><?php echo e(translate('Product')); ?></th>
                                                        <th class="text-right p-1 px-3"><?php echo e(translate('Price')); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-left p-2 px-3">
                                                            1. The school of life - emotional baggage tote bag - canvas tote bag (navy) x 1
                                                        </td>
                                                        <td class="text-right p-2 px-3">
                                                            <h4>
                                                                $5,465
                                                            </h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left p-2 px-3">
                                                            2. 3USB Head Phone x 1
                                                        </td>
                                                        <td class="text-right p-2 px-3">
                                                            <h4>
                                                                $354
                                                            </h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <hr class="mt-0">
                                                            <table class="w-100">
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">Item Price</td>
                                                                    <td class="text-right p-1 px-3">$85</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">Addon</td>
                                                                    <td class="text-right p-1 px-3">$85</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">Sub total</td>
                                                                    <td class="text-right p-1 px-3">$90</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">Discount</td>
                                                                    <td class="text-right p-1 px-3">$10</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">Coupon Discount</td>
                                                                    <td class="text-right p-1 px-3">$00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">VAT / Tax</td>
                                                                    <td class="text-right p-1 px-3">$15</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">Delivery Charge</td>
                                                                    <td class="text-right p-1 px-3">$20</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">
                                                                        <h4>Total</h4>
                                                                    </td>
                                                                    <td class="text-right p-1 px-3">
                                                                        <span class="text-base">$105</span>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div class="mb-2" id="mail-footer">
                    <?php echo e($data['footer_text'] ?? translate('Please_contact_us_for_any_queries,_we’re_always_happy_to_help.')); ?>

                </div>
                <div>
                    <?php echo e(translate('Thanks_&_Regards')); ?>,
                </div>
                <div class="mb-4">
                    <?php echo e($company_name); ?>

                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span class="privacy">
                    <a href="#" id="privacy-check" style="<?php echo e((isset($data['privacy']) && $data['privacy'] == 1)?'':'display:none;'); ?>"><?php echo e(translate('Privacy_Policy')); ?></a>
                    <a href="#" id="refund-check" style="<?php echo e((isset($data['refund']) && $data['refund'] == 1)?'':'display:none;'); ?>"><?php echo e(translate('Refund_Policy')); ?></a>
                    <a href="#" id="cancelation-check" style="<?php echo e((isset($data['cancelation']) && $data['cancelation'] == 1)?'':'display:none;'); ?>"><?php echo e(translate('Cancelation_Policy')); ?></a>
                    <a href="#" id="contact-check" style="<?php echo e((isset($data['contact']) && $data['contact'] == 1)?'':'display:none;'); ?>"><?php echo e(translate('Contact_us')); ?></a>
                </span>
                <span class="social" style="text-align:center">
                    <a href="#" id="facebook-check" style="margin: 0 5px;text-decoration:none;<?php echo e((isset($data['facebook']) && $data['facebook'] == 1)?'':'display:none;'); ?>">
                        <img src="<?php echo e(asset('/public/assets/admin/img/img/facebook.png')); ?>" alt="">
                    </a>
                    <a href="#" id="instagram-check" style="margin: 0 5px;text-decoration:none;<?php echo e((isset($data['instagram']) && $data['instagram'] == 1)?'':'display:none;'); ?>">
                        <img src="<?php echo e(asset('/public/assets/admin/img/img/instagram.png')); ?>" alt="">
                    </a>
                    <a href="#" id="twitter-check" style="margin: 0 5px;text-decoration:none;<?php echo e((isset($data['twitter']) && $data['twitter'] == 1)?'':'display:none;'); ?>">
                        <img src="<?php echo e(asset('/public/assets/admin/img/img/twitter.png')); ?>" alt="">
                    </a>
                    <a href="#" id="linkedin-check" style="margin: 0 5px;text-decoration:none;<?php echo e((isset($data['linkedin']) && $data['linkedin'] == 1)?'':'display:none;'); ?>">
                        <img src="<?php echo e(asset('/public/assets/admin/img/img/linkedin.png')); ?>" alt="">
                    </a>
                    <a href="#" id="pinterest-check" style="margin: 0 5px;text-decoration:none;<?php echo e((isset($data['pinterest']) && $data['pinterest'] == 1)?'':'display:none;'); ?>">
                        <img src="<?php echo e(asset('/public/assets/admin/img/img/pinterest.png')); ?>" alt="">
                    </a>
                </span>
                <span class="copyright" id="mail-copyright">
                    <?php echo e($data['copyright_text']?? translate('Copyright_2023_eFood._All_right_reserved')); ?>

                </span>
            </td>
        </tr>
    </tbody>
</table>
<?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/business-settings/email-format-setting/templates/email-format-3.blade.php ENDPATH**/ ?>