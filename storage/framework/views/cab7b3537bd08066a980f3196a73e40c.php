<?php $__env->startSection('title', translate('FCM Settings')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/firebase.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('firebase_push_notification_setup')); ?>

                </span>
            </h2>
        </div>

        <div class="card">
            <div class="card-header card-header-shadow pb-0">
                <div class="d-flex flex-wrap justify-content-between w-100 row-gap-1">
                    <ul class="nav nav-tabs nav--tabs border-0 gap-2">
                        <li class="nav-item mr-2 mr-md-4">
                            <a href="<?php echo e(route('admin.business-settings.web-app.third-party.fcm-index')); ?>" class="nav-link pb-2 px-0 pb-sm-3 active" data-slide="1">
                                <img src="<?php echo e(asset('/public/assets/admin/img/notify.png')); ?>" alt="">
                                <span><?php echo e(translate('Push Notification')); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.business-settings.web-app.third-party.fcm-config')); ?>" class="nav-link pb-2 px-0 pb-sm-3" data-slide="2">
                                <img src="<?php echo e(asset('/public/assets/admin/img/firebase2.png')); ?>" alt="">
                                <span><?php echo e(translate('Firebase Configuration')); ?></span>
                            </a>
                        </li>
                    </ul>
                    <div class="py-1">
                        <div class="tab--content">
                            <div class="item show text-primary d-flex flex-wrap align-items-center" type="button" data-toggle="modal" data-target="#push-notify-modal">
                                <strong class="mr-2"><?php echo e(translate('Read Documentation')); ?></strong>
                                <div class="blinkings">
                                    <i class="tio-info-outined"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">

                    <div class="tab-pane fade show active"id="push-notify">
                        <?php ($language = Helpers::get_business_settings('language')); ?>
                        <?php ($default_lang = Helpers::get_default_language()); ?>

                        <form action="<?php echo e(route('admin.business-settings.update-fcm-messages')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-8 mb-5">
                                    <?php if($language): ?>
                                        <ul class="nav nav-tabs border-0">
                                            <li class="nav-item">
                                                <a class="nav-link lang_link active" href="#" id="default-link"><?php echo e(translate('Default')); ?></a>
                                            </li>
                                            <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link" href="#" id="<?php echo e($lang['code']); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang['code']) . '(' . strtoupper($lang['code']) . ')'); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="lang_form" id="default-form">
                                <input type="hidden" name="lang[]" value="default">

                                <div class="row">
                                    <?php ($order_pending= \App\Model\BusinessSetting::with('translations')->where(['key' => 'order_pending_message'])->first()); ?>
                                    <?php ($order_pending_data= json_decode($order_pending->value, true)); ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <label class="switcher" for="pending_status">
                                                    <input type="checkbox" name="pending_status" class="switcher_input"
                                                           value="1" id="pending_status" <?php echo e($order_pending_data['status']==1?'checked':''); ?>>
                                                    <span class="switcher_control"></span>
                                                </label>
                                                <span class="text-dark"><?php echo e(translate('order pending message')); ?></span>
                                            </div>
                                            <textarea name="pending_message" class="form-control"><?php echo e($order_pending_data['message']??''); ?></textarea>
                                        </div>
                                    </div>

                                    <?php ($order_confirm= \App\Model\BusinessSetting::with('translations')->where(['key' => 'order_confirmation_msg'])->first()); ?>
                                    <?php ($order_confirm_data= json_decode($order_confirm->value, true)); ?>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <label class="switcher" for="confirm_status">
                                                    <input type="checkbox" name="confirm_status" class="switcher_input"
                                                           value="1" id="confirm_status" <?php echo e($order_confirm_data['status']==1?'checked':''); ?>>
                                                    <span class="switcher_control"></span>
                                                </label>
                                                <span class="text-dark"><?php echo e(translate('order confirmation message')); ?></span>
                                            </div>

                                            <textarea name="confirm_message"
                                                      class="form-control"><?php echo e($order_confirm_data['message']); ?></textarea>
                                        </div>
                                    </div>

                                    <?php ($order_processing= \App\Model\BusinessSetting::with('translations')->where(['key' => 'order_processing_message'])->first()); ?>
                                    <?php ($order_processing_data= json_decode($order_processing->value, true)); ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <label class="switcher" for="processing_status">
                                                    <input type="checkbox" name="processing_status" class="switcher_input"
                                                           value="1" id="processing_status" <?php echo e($order_processing_data['status']==1?'checked':''); ?>>
                                                    <span class="switcher_control"></span>
                                                </label>
                                                <span class="text-dark"><?php echo e(translate('order processing message')); ?></span>
                                            </div>

                                            <textarea name="processing_message"
                                                      class="form-control"><?php echo e($order_processing_data['message']); ?></textarea>
                                        </div>
                                    </div>

                                    <?php ($order_out= \App\Model\BusinessSetting::with('translations')->where(['key' => 'out_for_delivery_message'])->first()); ?>
                                    <?php ($order_out_data= json_decode($order_out->value, true)); ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <label class="switcher" for="out_for_delivery">
                                                    <input type="checkbox" name="out_for_delivery_status" class="switcher_input"
                                                           value="1" id="out_for_delivery" <?php echo e($order_out_data['status']==1?'checked':''); ?>>
                                                    <span class="switcher_control"></span>
                                                </label>
                                                <span class="text-dark"><?php echo e(translate('order out for delivery message')); ?></span>
                                            </div>

                                            <textarea name="out_for_delivery_message"
                                                      class="form-control"><?php echo e($order_out_data['message']); ?></textarea>
                                        </div>
                                    </div>

                                    <?php ($order_delivered= \App\Model\BusinessSetting::with('translations')->where(['key' => 'order_delivered_message'])->first()); ?>
                                    <?php ($order_delivered_data= json_decode($order_delivered->value, true)); ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <label class="switcher" for="delivered_status">
                                                    <input type="checkbox" name="delivered_status" class="switcher_input"
                                                           value="1" id="delivered_status" <?php echo e($order_delivered_data['status']==1?'checked':''); ?>>
                                                    <span class="switcher_control"></span>
                                                </label>
                                                <span class="text-dark"><?php echo e(translate('order delivered message')); ?></span>
                                            </div>

                                            <textarea name="delivered_message"
                                                      class="form-control"><?php echo e($order_delivered_data['message']); ?></textarea>
                                        </div>
                                    </div>

                                    <?php ($assign_deliveryman= \App\Model\BusinessSetting::with('translations')->where(['key' => 'delivery_boy_assign_message'])->first()); ?>
                                    <?php ($assign_deliveryman_data= json_decode($assign_deliveryman->value, true)); ?>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <label class="switcher" for="delivery_boy_assign">
                                                    <input type="checkbox" name="delivery_boy_assign_status" class="switcher_input"
                                                           value="1" id="delivery_boy_assign" <?php echo e($assign_deliveryman_data['status']==1?'checked':''); ?>>
                                                    <span class="switcher_control"></span>
                                                </label>
                                                <span class="text-dark"><?php echo e(translate('deliveryman assign message')); ?></span>
                                            </div>

                                            <textarea name="delivery_boy_assign_message"
                                                      class="form-control"><?php echo e($assign_deliveryman_data['message']); ?></textarea>
                                        </div>
                                    </div>
                                    <?php ($customer_notify= \App\Model\BusinessSetting::with('translations')->where(['key' => 'customer_notify_message'])->first()); ?>
                                    <?php ($customer_notify_data= json_decode($customer_notify->value, true)); ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <label class="switcher" for="customer_notify">
                                                    <input type="checkbox" name="customer_notify_status" class="switcher_input"
                                                           value="1" id="customer_notify" <?php echo e(isset($customer_notify_data) && $customer_notify_data['status']==1?'checked':''); ?>>
                                                    <span class="switcher_control"></span>
                                                </label>
                                                <span class="text-dark"><?php echo e(translate('Customer notify message for deliveryman')); ?></span>
                                            </div>

                                            <textarea name="customer_notify_message"
                                                      class="form-control"><?php echo e($customer_notify_data['message']??''); ?></textarea>
                                        </div>
                                    </div>

                                    <?php ($notify_for_time_change= \App\Model\BusinessSetting::with('translations')->where(['key' => 'customer_notify_message_for_time_change'])->first()); ?>
                                    <?php ($notify_for_time_change_data= json_decode($customer_notify->value, true)); ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <label class="switcher" for="customer_notify_for_time_change">
                                                    <input type="checkbox" name="customer_notify_status_for_time_change" class="switcher_input"
                                                           value="1" id="customer_notify_for_time_change" <?php echo e(isset($notify_for_time_change_data) && $notify_for_time_change_data['status']==1?'checked':''); ?>>
                                                    <span class="switcher_control"></span>
                                                </label>
                                                <span class="text-dark"><?php echo e(translate('Customer notify message for food preparation time change')); ?></span>
                                            </div>

                                            <textarea name="customer_notify_message_for_time_change"
                                                      class="form-control"><?php echo e($notify_for_time_change_data['message']??''); ?></textarea>
                                        </div>
                                    </div>

                                    <?php ($dm_start= \App\Model\BusinessSetting::with('translations')->where(['key' => 'delivery_boy_start_message'])->first()); ?>
                                    <?php ($dm_start_data= json_decode($dm_start->value, true)); ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <label class="switcher" for="delivery_boy_start_status">
                                                    <input type="checkbox" name="delivery_boy_start_status" class="switcher_input"
                                                           value="1" id="delivery_boy_start_status" <?php echo e($dm_start_data['status']==1?'checked':''); ?>>
                                                    <span class="switcher_control"></span>
                                                </label>
                                                <span class="text-dark"><?php echo e(translate('deliveryman start message')); ?></span>
                                            </div>

                                            <textarea name="delivery_boy_start_message"
                                                      class="form-control"><?php echo e($dm_start_data['message']); ?></textarea>
                                        </div>
                                    </div>

                                    <?php ($dm_delivered= \App\Model\BusinessSetting::with('translations')->where(['key' => 'delivery_boy_delivered_message'])->first()); ?>
                                    <?php ($dm_delivered_data= json_decode($dm_delivered->value, true)); ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <label class="switcher" for="delivery_boy_delivered">
                                                    <input type="checkbox" name="delivery_boy_delivered_status" class="switcher_input"
                                                           value="1" id="delivery_boy_delivered" <?php echo e($dm_delivered_data['status']==1?'checked':''); ?>>
                                                    <span class="switcher_control"></span>
                                                </label>
                                                <span class="text-dark"><?php echo e(translate('deliveryman delivered message')); ?></span>
                                            </div>

                                            <textarea name="delivery_boy_delivered_message"
                                                      class="form-control"><?php echo e($dm_delivered_data['message']); ?></textarea>
                                        </div>
                                    </div>

                                    <?php ($return_order= \App\Model\BusinessSetting::with('translations')->where(['key' => 'returned_message'])->first()); ?>
                                    <?php ($return_order_data= json_decode($return_order->value, true)); ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <label class="switcher" for="returned_status">
                                                    <input type="checkbox" name="returned_status" class="switcher_input"
                                                           value="1" id="returned_status" <?php echo e((isset($return_order_data['status']) && $return_order_data['status']==1)?'checked':''); ?>>
                                                    <span class="switcher_control"></span>
                                                </label>
                                                <span class="text-dark"><?php echo e(translate('Order_returned_message')); ?></span>
                                            </div>

                                            <textarea name="returned_message"
                                                      class="form-control"><?php echo e($return_order_data['message']??''); ?></textarea>
                                        </div>
                                    </div>

                                    <?php ($failed_order= \App\Model\BusinessSetting::with('translations')->where(['key' => 'failed_message'])->first()); ?>
                                    <?php ($failed_order_data= json_decode($failed_order->value, true)); ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <label class="switcher" for="failed_status">
                                                    <input type="checkbox" name="failed_status" class="switcher_input"
                                                           value="1" id="failed_status" <?php echo e((isset($failed_order_data['status']) && $failed_order_data['status']==1)?'checked':''); ?>>
                                                    <span class="switcher_control"></span>
                                                </label>
                                                <span class="text-dark"><?php echo e(translate('Order_failed_message')); ?></span>
                                            </div>

                                            <textarea name="failed_message"
                                                      class="form-control"><?php echo e($failed_order_data['message']??''); ?></textarea>
                                        </div>
                                    </div>

                                    <?php ($canceled_order= \App\Model\BusinessSetting::with('translations')->where(['key' => 'canceled_message'])->first()); ?>
                                    <?php ($canceled_order_data= json_decode($canceled_order->value, true)); ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <label class="switcher" for="canceled_status">
                                                    <input type="checkbox" name="canceled_status" class="switcher_input"
                                                           value="1" id="canceled_status" <?php echo e((isset($canceled_order_data['status']) && $canceled_order_data['status']==1)?'checked':''); ?>>
                                                    <span class="switcher_control"></span>
                                                </label>
                                                <span class="text-dark"><?php echo e(translate('Order_canceled_message')); ?></span>
                                            </div>

                                            <textarea name="canceled_message"
                                                      class="form-control"><?php echo e($canceled_order_data['message']??''); ?></textarea>
                                        </div>
                                    </div>
                                    <?php ($add_wallet= \App\Model\BusinessSetting::with('translations')->where(['key' => ADD_WALLET_MESSAGE])->first()); ?>
                                    <?php ($add_wallet_data= json_decode($add_wallet->value, true)); ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <label class="switcher" for="add_wallet_status">
                                                    <input type="checkbox" name="add_wallet_status" class="switcher_input"
                                                           value="1" id="add_wallet_status" <?php echo e((isset($add_wallet_data['status']) && $add_wallet_data['status']==1)?'checked':''); ?>>
                                                    <span class="switcher_control"></span>
                                                </label>
                                                <span class="text-dark"><?php echo e(translate('add_fund_wallet_message')); ?></span>
                                            </div>

                                            <textarea name="add_wallet_message" class="form-control"><?php echo e($add_wallet_data['message']??''); ?></textarea>
                                        </div>
                                    </div>
                                    <?php ($add_wallet_bonus= \App\Model\BusinessSetting::with('translations')->where(['key' => ADD_WALLET_BONUS_MESSAGE])->first()); ?>
                                    <?php ($add_wallet_bonus_data= json_decode($add_wallet_bonus->value, true)); ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <label class="switcher" for="add_wallet_bonus_status">
                                                    <input type="checkbox" name="add_wallet_bonus_status" class="switcher_input"
                                                           value="1" id="add_wallet_bonus_status" <?php echo e((isset($add_wallet_bonus_data['status']) && $add_wallet_bonus_data['status']==1)?'checked':''); ?>>
                                                    <span class="switcher_control"></span>
                                                </label>
                                                <span class="text-dark"><?php echo e(translate('add_fund_wallet_bonus_message')); ?></span>
                                            </div>

                                            <textarea name="add_wallet_bonus_message" class="form-control"><?php echo e($add_wallet_bonus_data['message']??''); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <?php if($language): ?>
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="lang_form d-none" id="<?php echo e($lang['code']); ?>-form">
                                        <div class="row" >
                                            <input type="hidden" name="lang[]" value="<?php echo e($lang['code']); ?>">

                                                <?php
                                                    $notification_message_array = [
                                                      [
                                                          'field_name' => 'order_pending',
                                                          'object' => $order_pending
                                                      ],[
                                                          'field_name' => 'order_confirmation',
                                                          'object' => $order_confirm
                                                      ],[
                                                          'field_name' => 'order_processing',
                                                          'object' => $order_processing
                                                      ],[
                                                          'field_name' => 'order_out_for_delivery',
                                                          'object' => $order_out
                                                      ],[
                                                          'field_name' => 'order_delivered',
                                                          'object' => $order_delivered
                                                      ],[
                                                          'field_name' => 'assign_deliveryman',
                                                          'object' => $assign_deliveryman
                                                      ],[
                                                          'field_name' => 'customer_notification',
                                                          'object' => $customer_notify
                                                      ],[
                                                          'field_name' => 'notify_for_time_change',
                                                          'object' => $notify_for_time_change
                                                      ],[
                                                          'field_name' => 'deliveryman_start',
                                                          'object' => $dm_start
                                                      ],[
                                                          'field_name' => 'deliveryman_delivered',
                                                          'object' => $dm_delivered
                                                      ],[
                                                          'field_name' => 'return_order',
                                                          'object' => $return_order
                                                      ],[
                                                          'field_name' => 'failed_order',
                                                          'object' => $failed_order
                                                      ],[
                                                          'field_name' => 'canceled_order',
                                                          'object' => $canceled_order
                                                      ],[
                                                          'field_name' => 'add_fund_wallet',
                                                          'object' => $add_wallet
                                                      ],[
                                                          'field_name' => 'add_fund_wallet_bonus',
                                                          'object' => $add_wallet_bonus
                                                      ],
                                                    ];

                                                    $translation_holder = [];
                                                    $translate = [];
                                                    $temporary = [];
                                                    $lang_code = $lang['code'];
                                                ?>

                                            <?php $__currentLoopData = $notification_message_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               <?php
                                                    $temporary = []; // Reset $temporary for each $item

                                                    if(isset($item['object']->translations) && count($item['object']->translations)){
                                                        foreach($item['object']->translations as $t) {
                                                            if($t->locale == $lang['code'] && $t->key == $item['field_name'].'_message'){
                                                                $temporary[$lang_code]['message'] = $t->value;
                                                            }
                                                        }
                                                    }
//                                                    $translate_holder[$key] = $translate;
//                                                    $temporary = $translate;
                                               ?>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="d-flex align-items-center gap-3 mb-3">
                                                            <span class="text-dark"><?php echo e(translate($item['field_name'].' message')); ?></span>
                                                        </div>
                                                        <textarea name="<?php echo e($item['field_name']); ?>_message[]" class="form-control" placeholder="<?php echo e(translate('Ex : Your order have been place')); ?>"><?php echo !empty($temporary) ? $temporary[$lang_code]['message'] : ''; ?></textarea>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary"><?php echo e(translate('submit')); ?></button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- Firebase Modal -->
        <div class="modal fade" id="push-notify-modal">
            <div class="modal-dialog status-warning-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true" class="tio-clear"></span>
                        </button>
                    </div>
                    <div class="modal-body pb-5 pt-0">
                        <div class="single-item-slider owl-carousel">
                            <div class="item">
                                <div class="mb-20">
                                    <div class="text-center">
                                        <img src="<?php echo e(asset('/public/assets/admin/img/firebase/slide-1.png')); ?>" alt="" class="mb-20">
                                        <h5 class="modal-title"><?php echo e(translate('Go_to_Firebase_Console')); ?></h5>
                                    </div>
                                    <ul>
                                        <li>
                                            <?php echo e(translate('Open_your_web_browser_and_go_to_the_Firebase_Console')); ?>

                                            <a href="#" class="text--underline">
                                                <?php echo e(translate('(https://console.firebase.google.com/)')); ?>

                                            </a>
                                        </li>
                                        <li>
                                            <?php echo e(translate("Select_the_project_for_which_you_want_to_configure_FCM_from_the_Firebase_Console_dashboard.")); ?>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="item">
                                <div class="mb-20">
                                    <div class="text-center">
                                        <img src="<?php echo e(asset('/public/assets/admin/img/firebase/slide-2.png')); ?>" alt="" class="mb-20">
                                        <h5 class="modal-title"><?php echo e(translate('Navigate_to_Project_Settings')); ?></h5>
                                    </div>
                                    <ul>
                                        <li>
                                            <?php echo e(translate('In_the_left-hand_menu,_click_on_the_"Settings"_gear_icon,_and_then_select_"Project_settings"_from_the_dropdown.')); ?>

                                        </li>
                                        <li>
                                            <?php echo e(translate('In_the_Project_settings_page,_click_on_the_"Cloud_Messaging"_tab_from_the_top_menu.')); ?>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="item">
                                <div class="mb-20">
                                    <div class="text-center">
                                        <img src="<?php echo e(asset('/public/assets/admin/img/firebase/slide-3.png')); ?>" alt="" class="mb-20">
                                        <h5 class="modal-title"><?php echo e(translate('Obtain_All_The_Information_Asked!')); ?></h5>
                                    </div>
                                    <ul>
                                        <li>
                                            <?php echo e(translate('In_the_Firebase_Project_settings_page,_click_on_the_"General"_tab_from_the_top_menu.')); ?>

                                        </li>
                                        <li>
                                            <?php echo e(translate('Under_the_"Your_apps"_section,_click_on_the_"Web"_app_for_which_you_want_to_configure_FCM.')); ?>

                                        </li>
                                        <li>
                                            <?php echo e(translate('Then_Obtain_API_Key')); ?>

                                        </li>
                                    </ul>
                                    <p>
                                        <?php echo e(translate('Note:_Please_make_sure_to_use_the_obtained_information_securely_and_in_accordance_with_Firebase_and_FCM_documentation,_terms_of_service,_and_any_applicable_laws_and_regulations.')); ?>

                                    </p>

                                </div>
                            </div>

                            <div class="item">
                                <div class="mb-20">
                                    <div class="text-center">
                                        <img src="<?php echo e(asset('/public/assets/admin/img/email-templates/3.png')); ?>" alt="" class="mb-20">
                                        <h5 class="modal-title"><?php echo e(translate('Write_a_message_in_the_Notification_Body')); ?></h5>
                                    </div>
                                    <p>
                                        <?php echo e(translate('you_can_add_your_message_using_placeholders_to_include_dynamic_content._Here_are_some_examples_of_placeholders_you_can_use:')); ?>

                                    </p>
                                    <ul>
                                        <li>
                                            {userName}: <?php echo e(translate('the_name_of_the_user.')); ?>

                                        </li>
                                        <li>
                                            {orderId}: <?php echo e(translate('the_order_id.')); ?>

                                        </li>
                                        <li>
                                            {restaurantName}: <?php echo e(translate('restaurant_name.')); ?>

                                        </li>
                                        <li>
                                            {deliveryManName}: <?php echo e(translate('deliveryman_name.')); ?>

                                        </li>
                                    </ul>
                                    <div class="btn-wrap">
                                        <button type="submit" class="btn btn-primary w-100" data-dismiss="modal" data-toggle="modal" data-target="#firebase-modal-2"><?php echo e(translate('Got It')); ?></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="slide-counter"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        $('[data-slide]').on('click', function(){
            let serial = $(this).data('slide')
            $(`.tab--content .item`).removeClass('show')
            $(`.tab--content .item:nth-child(${serial})`).addClass('show')
        })
    </script>

    <script>
        $(".lang_link").click(function(e){
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.substring(0, form_id.length - 5);
            console.log(lang);
            $("#"+lang+"-form").removeClass('d-none');
            if(lang == '<?php echo e($default_lang); ?>')
            {
                $("#from_part_2").removeClass('d-none');
            }
            else
            {
                $("#from_part_2").addClass('d-none');
            }
        })
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/business-settings/fcm-index.blade.php ENDPATH**/ ?>