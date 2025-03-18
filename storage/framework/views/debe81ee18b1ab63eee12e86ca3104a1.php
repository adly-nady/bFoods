<?php $__env->startSection('title', translate('email_template')); ?>


<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="">
            <div class="d-flex flex-wrap justify-content-between align-items-center __gap-15px">
                <h1 class="page-header-title mr-3 mb-0">
                    <span class="page-header-icon">
                        <img src="<?php echo e(asset('public/assets/admin/img/email-setting.png')); ?>" class="w--26" alt="">
                    </span>
                    <span class="ml-2">
                        <?php echo e(translate('Email_Templates')); ?>

                    </span>
                </h1>
                <?php echo $__env->make('admin-views.business-settings.email-format-setting.partials.email-template-options', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <?php echo $__env->make('admin-views.business-settings.email-format-setting.partials.user-email-template-setting-links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active">
                <div class="card mb-3">
                    <?php ($mail_status=\App\Model\BusinessSetting::where('key','place_order_mail_status_user')->first()); ?>
                    <?php ($mail_status = $mail_status ? $mail_status->value : '0'); ?>
                    <div class="card-body">
                        <div class="maintainance-mode-toggle-bar d-flex flex-wrap justify-content-between border rounded align-items-center p-2">
                            <h5 class="text-capitalize m-0 text--primary pl-2">
                                <?php echo e(translate('Send_Mail_On_Order_Placement')); ?>

                                <span class="input-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Customers_will_receive_an_automated_email_after_a_successful_order_placement.')); ?>">
                                    <img src="<?php echo e(asset('/public/assets/admin/img/info-circle.svg')); ?>" alt="<?php echo e(translate('show_hide_food_menu')); ?>">
                                 </span>
                            </h5>
                            <label class="toggle-switch toggle-switch-sm">
                                <input type="checkbox" class="status toggle-switch-input" onclick="toogleStatusModal(event,'mail-status','place-order-on.png','place-order-off.png','<?php echo e(translate('Want_to_enable_the')); ?> <strong><?php echo e(translate('Order_Placement')); ?></strong> <?php echo e(translate('mail')); ?> ?','<?php echo e(translate('Want_to_disable_the')); ?> <strong><?php echo e(translate('Order_Placement')); ?></strong> <?php echo e(translate('mail')); ?> ?',`<p><?php echo e(translate('If_enabled,_customers_will_get_an_automatic_confirmation_mail_for_successful_Order_Placement_with_an_invoice.')); ?></p>`,`<p><?php echo e(translate('If_disabled,_customers_will_NOT_get_any_Order_Placement_email.')); ?></p>`)" id="mail-status" <?php echo e($mail_status == '1'?'checked':''); ?>>
                                <span class="toggle-switch-label text mb-0">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </div>
                        <form action="<?php echo e(route('admin.business-settings.email-status',['user','place-order',$mail_status == '1'?0:1])); ?>" method="get" id="mail-status_form"></form>
                    </div>
                </div>
                <?php ($data=\App\Models\EmailTemplate::where('type','user')->where('email_type', 'new_order')->first()); ?>
                <?php ($template=$template?$template:($data?$data->email_template:3)); ?>
                <form action="<?php echo e(route('admin.business-settings.email-setup.update', ['user','new-order'])); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="email-format-wrapper">
                                <div class="left-content">
                                    <div class="d-inline-block">
                                        <?php echo $__env->make('admin-views.business-settings.email-format-setting.partials.email-template-section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <?php echo $__env->make('admin-views.business-settings.email-format-setting.templates.email-format-'.$template, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="right-content">
                                    <div class="d-flex flex-wrap justify-content-between __gap-15px mt-2 mb-5">
                                        <?php ($data=\App\Models\EmailTemplate::withoutGlobalScope('translate')->with('translations')->where('type','user')->where('email_type', 'new_order')->first()); ?>

                                        <?php ($language=\App\Model\BusinessSetting::where('key','language')->first()); ?>
                                        <?php ($language = $language->value ?? null); ?>
                                        <?php ($default_lang = str_replace('_', '-', app()->getLocale())); ?>
                                        <?php if($language): ?>
                                            <ul class="nav nav-tabs m-0 border-0">
                                                <li class="nav-item">
                                                    <a class="nav-link lang_link active"
                                                    href="#"
                                                    id="default-link"><?php echo e(translate('default')); ?></a>
                                                </li>
                                                <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link lang_link"
                                                            href="#"
                                                            id="<?php echo e($lang->code); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang->code) . '(' . strtoupper($lang->code) . ')'); ?></a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                        <div class="d-flex justify-content-end">
                                            <div class="text-primary py-1 d-flex flex-wrap align-items-center py-1" type="button" data-toggle="modal" data-target="#instructions">
                                                <strong class="mr-2"><?php echo e(translate('Read_Instructions')); ?></strong>
                                                <div class="blinkings">
                                                    <i class="tio-info-outined"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-3">
                                            <?php echo e(translate('Logo')); ?>   <span class="input-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Logo_must_be_1:1')); ?>">
                                                <img src="<?php echo e(asset('/public/assets/admin/img/info-circle.svg')); ?>" alt="<?php echo e(translate('show_hide_food_menu')); ?>">
                                            </span>
                                        </h5>
                                        <label class="custom-file">
                                            <input type="file" name="logo" id="mail-logo" class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                            <span class="custom-file-label"><?php echo e(translate('Choose_File')); ?></span>
                                        </label>
                                    </div>
                                    <br>
                                    <div>
                                        <h5 class="card-title mb-3">
                                            <img src="<?php echo e(asset('public/assets/admin/img/pointer.png')); ?>" class="mr-2" alt="">
                                            <?php echo e(translate('Header_Content')); ?>

                                        </h5>
                                        <?php if($language): ?>
                                            <div class="__bg-F8F9FC-card default-form lang_form" id="default-form">
                                                <div class="form-group">
                                                    <label class="form-label"><?php echo e(translate('Main_Title')); ?>(<?php echo e(translate('default')); ?>)
                                                        <span class="input-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Write_the_main_title_within_45_characters')); ?>">
                                                            <img src="<?php echo e(asset('/public/assets/admin/img/info-circle.svg')); ?>" alt="<?php echo e(translate('show_hide_food_menu')); ?>">
                                                        </span>
                                                    </label>
                                                    <input type="text" maxlength="45" name="title[]" value="<?php echo e($data?->getRawOriginal('title')); ?>" data-id="mail-title" placeholder="<?php echo e(translate('Order_has_been_placed_successfully.')); ?>" class="form-control">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="form-label">
                                                        <?php echo e(translate('Mail_Body_Message')); ?>(<?php echo e(translate('default')); ?>)
                                                        <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Write_the_mail_body_message_within_75_words')); ?>">
                                                            <i class="tio-info-outined"></i>
                                                        </span>
                                                    </label>
                                                    <textarea class="form-control" id="ckeditor" data-id="mail-body" name="body[]">
                                                        <?php echo $data?->getRawOriginal('body'); ?>

                                                    </textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" name="lang[]" value="default">
                                            <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $lang_code = $lang->code;
                                            if($data && count($data['translations'])){
                                                $translate = [];
                                                foreach($data['translations'] as $t)
                                                {
                                                    if($t->locale == $lang_code && $t->key=="title"){
                                                        $translate[$lang_code]['title'] = $t->value;
                                                    }
                                                    if($t->locale == $lang_code && $t->key=="body"){
                                                        $translate[$lang_code]['body'] = $t->value;
                                                    }
                                                }
                                            }
                                                ?>

                                                <div class="__bg-F8F9FC-card d-none lang_form" id="<?php echo e($lang->code); ?>-form">
                                                    <div class="form-group">
                                                       <label class="form-label"><?php echo e(translate('Main_Title')); ?>(<?php echo e(strtoupper($lang->code)); ?>)
                                                            <span class="input-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Write_the_title_within_45_characters')); ?>">
                                                                <img src="<?php echo e(asset('/public/assets/admin/img/info-circle.svg')); ?>" alt="<?php echo e(translate('show_hide_food_menu')); ?>">
                                                            </span>
                                                        </label>
                                                        <input type="text" maxlength="45" name="title[]"  placeholder="<?php echo e(translate('Order_has_been_placed_successfully.')); ?>" class="form-control" value="<?php echo e($translate[$lang->code]['title']??''); ?>">
                                                    </div>
                                                    <div class="form-group mb-0">
                                                       <label class="form-label">
                                                            <?php echo e(translate('Mail_Body_Message')); ?>(<?php echo e(strtoupper($lang->code)); ?>)
                                                            <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Write_the_mail_body_message_within_75_words')); ?>">
                                                                <i class="tio-info-outined"></i>
                                                            </span>
                                                        </label>
                                                        <textarea class="ckeditor form-control" name="body[]">
                                                           <?php echo $translate[$lang->code]['body']??''; ?>

                                                        </textarea>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="lang[]" value="<?php echo e($lang->code); ?>">
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <div class="__bg-F8F9FC-card default-form">
                                                <div class="form-group">
                                                    <label class="form-label"><?php echo e(translate('Main_Title')); ?>

                                                    <span class="input-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Write_the_title_within_45_characters')); ?>">
                                                                <img src="<?php echo e(asset('/public/assets/admin/img/info-circle.svg')); ?>" alt="<?php echo e(translate('show_hide_food_menu')); ?>">
                                                            </span></label>
                                                    <input type="text" maxlength="45" name="title[]" placeholder="<?php echo e(translate('Order_has_been_placed_successfully.')); ?>"class="form-control">
                                                </div>
                                                <div class="form-group mb-0">
                                                      <label class="form-label">
                                                        <?php echo e(translate('Mail_Body_Message')); ?>

                                                         <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Write_the_mail_body_message_within_75_words')); ?>">
                                                                <i class="tio-info-outined"></i>
                                                            </span>
                                                    </label>
                                                    <textarea class="ckeditor form-control" name="body[]">
                                                        Hi Sabrina,
                                                    </textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" name="lang[]" value="default">
                                        <?php endif; ?>

                                    </div>
                                    <br>
                                    <div>
                                        <h5 class="card-title mb-3">
                                            <img src="<?php echo e(asset('public/assets/admin/img/pointer.png')); ?>" class="mr-2" alt="">
                                            <?php echo e(translate('Button_Content')); ?>

                                        </h5>
                                        <div class="__bg-F8F9FC-card">
                                            <div class="row g-3">
                                                <div class="col-sm-6">
                                                    <?php if($language): ?>
                                                        <div class="form-group m-0 lang_form default-form">
                                                            <label class="form-label text-capitalize">
                                                                <?php echo e(translate('Button_Name')); ?>(<?php echo e(translate('default')); ?>)
                                                                <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Write_the_button_name_within_15_characters.')); ?>">
                                                                    <i class="tio-info-outined"></i>
                                                                </span>
                                                            </label>
                                                            <input type="text" maxlength="15" data-id="mail-button" name="button_name[]"  placeholder="<?php echo e(translate('Ex:_Order_now')); ?>" class="form-control h--45px" value="<?php echo e($data?->getRawOriginal('button_name')); ?>">
                                                        </div>
                                                    <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                    $lang_code = $lang->code;
                                                    if($data && count($data['translations'])){
                                                        $translate = [];
                                                        foreach($data['translations'] as $t)
                                                        {
                                                            if($t->locale == $lang_code && $t->key=="button_name"){
                                                                $translate[$lang_code]['button_name'] = $t->value;
                                                            }
                                                        }
                                                        }
                                                        ?>
                                                        <div class="form-group m-0 d-none lang_form" id="<?php echo e($lang->code); ?>-form1">
                                                            <label class="form-label text-capitalize">
                                                                <?php echo e(translate('Button_Name')); ?>(<?php echo e(strtoupper($lang->code)); ?>)
                                                                <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Write_the_button_name_within_15_characters.')); ?>">
                                                                    <i class="tio-info-outined"></i>
                                                                </span>
                                                            </label>
                                                            <input type="text" maxlength="15" name="button_name[]"  placeholder="<?php echo e(translate('Ex:_Order_now')); ?>" class="form-control h--45px" value="<?php echo e($translate[$lang->code]['button_name']??''); ?>">
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                <div class="form-group m-0">
                                                     <label class="form-label text-capitalize">
                                                        <?php echo e(translate('Button_Name')); ?>

                                                        <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Write_the_button_name_within_15_characters.')); ?>">
                                                            <i class="tio-info-outined"></i>
                                                        </span>
                                                    </label>
                                                    <input type="text" maxlength="15" placeholder="<?php echo e(translate('Ex:_Order_now')); ?>" class="form-control h--45px" name="button_name[]" value="">
                                                </div>
                                                <?php endif; ?>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group m-0">
                                                          <label class="form-label">
                                                            <?php echo e(translate('Redirect_Link')); ?>

                                                            <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Link_to_your_preferred_destination_that_will_work_when_someone_clicks_on_the_Button_Name._Add_the_link_where_the_button_will_redirect_users.')); ?>">
                                                                <i class="tio-info-outined"></i>
                                                            </span>
                                                        </label>
                                                        <input type="url" name="button_url" placeholder="<?php echo e(translate('Please_contact_us_for_any_queries_we_are_always_happy_to_help')); ?>"  class="form-control" value="<?php echo e($data['button_url']??''); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <h5 class="card-title mb-3">
                                            <img src="<?php echo e(asset('public/assets/admin/img/pointer.png')); ?>" class="mr-2" alt="">
                                            <?php echo e(translate('Footer_Content')); ?>

                                        </h5>
                                        <div class="__bg-F8F9FC-card">
                                                <?php if($language): ?>
                                                        <div class="form-group lang_form default-form">
                                                            <label class="form-label">
                                                                <?php echo e(translate('Section_Text')); ?>(<?php echo e(translate('default')); ?>)
                                                                <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Write_the_footer_text_within_75_characters')); ?>">
                                                                    <i class="tio-info-outined"></i>
                                                                </span>
                                                            </label>
                                                            <input type="text" maxlength="75" data-id="mail-footer" name="footer_text[]"  placeholder="<?php echo e(translate('Please_contact_us_for_any_queries_we_are_always_happy_to_help')); ?>"  class="form-control" value="<?php echo e($data?->getRawOriginal('footer_text')); ?>">
                                                        </div>
                                                    <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $lang_code = $lang->code;
                                                    if($data && count($data['translations'])){
                                                        $translate = [];
                                                        foreach($data['translations'] as $t)
                                                        {
                                                            if($t->locale == $lang_code && $t->key=="footer_text"){
                                                                $translate[$lang_code]['footer_text'] = $t->value;
                                                            }
                                                        }
                                                        }
                                                        ?>
                                                        <div class="form-group d-none lang_form" id="<?php echo e($lang->code); ?>-form2">
                                                           <label class="form-label">
                                                                <?php echo e(translate('Section_Text')); ?>(<?php echo e(strtoupper($lang->code)); ?>)
                                                                <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Write_the_footer_text_within_75_characters')); ?>">
                                                                    <i class="tio-info-outined"></i>
                                                                </span>
                                                            </label>
                                                            <input type="text" maxlength="75" name="footer_text[]"  placeholder="<?php echo e(translate('Please_contact_us_for_any_queries_we_are_always_happy_to_help')); ?>"  class="form-control" value="<?php echo e($translate[$lang->code]['footer_text']??''); ?>">
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                <div class="form-group">
                                                  <label class="form-label">
                                                        <?php echo e(translate('Section_Text')); ?>

                                                        <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Write_the_footer_text_within_75_characters')); ?>">
                                                            <i class="tio-info-outined"></i>
                                                        </span>
                                                    </label>
                                                    <input type="text"  maxlength="75" placeholder="<?php echo e(translate('Please_contact_us_for_any_queries_we_are_always_happy_to_help')); ?>"  class="form-control" name="footer_text[]" value="">
                                                </div>
                                                <?php endif; ?>
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <?php echo e(translate('Page_Links')); ?>

                                                </label>
                                                <ul class="page-links-checkgrp">
                                                    <li>
                                                        <label class="form-check form--check">
                                                            <input class="form-check-input privacy-check" onchange="checkMailElement('privacy-check')" type="checkbox" name="privacy" value ="1" <?php echo e((isset($data['privacy']) && $data['privacy'] == 1)?'checked':''); ?>>
                                                            <span class="form-check-label"><?php echo e(translate('Privacy_Policy')); ?></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="form-check form--check">
                                                            <input class="form-check-input refund-check" onchange="checkMailElement('refund-check')" type="checkbox" name="refund" value ="1" <?php echo e((isset($data['refund']) && $data['refund'] == 1)?'checked':''); ?>>
                                                            <span class="form-check-label"><?php echo e(translate('Refund_Policy')); ?></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="form-check form--check">
                                                            <input class="form-check-input cancelation-check" onchange="checkMailElement('cancelation-check')" type="checkbox" name="cancelation" value ="1" <?php echo e((isset($data['cancelation']) && $data['cancelation'] == 1)?'checked':''); ?>>
                                                            <span class="form-check-label"><?php echo e(translate('Cancelation_Policy')); ?></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="form-check form--check">
                                                            <input class="form-check-input contact-check" onchange="checkMailElement('contact-check')" type="checkbox" name="contact" value ="1" <?php echo e((isset($data['contact']) && $data['contact'] == 1)?'checked':''); ?>>
                                                            <span class="form-check-label"><?php echo e(translate('Contact_Us')); ?></span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <?php echo e(translate('Social_Media_Links')); ?>

                                                </label>
                                                <ul class="page-links-checkgrp">
                                                    <li>
                                                        <label class="form-check form--check">
                                                            <input class="form-check-input facebook-check" type="checkbox" onchange="checkMailElement('facebook-check')" name="facebook" value="1" <?php echo e((isset($data['facebook']) && $data['facebook'] == 1)?'checked':''); ?>>
                                                            <span class="form-check-label"><?php echo e(translate('Facebook')); ?></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="form-check form--check">
                                                            <input class="form-check-input instagram-check" type="checkbox" onchange="checkMailElement('instagram-check')" name="instagram" value="1" <?php echo e((isset($data['instagram']) && $data['instagram'] == 1)?'checked':''); ?>>
                                                            <span class="form-check-label"><?php echo e(translate('Instagram')); ?></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="form-check form--check">
                                                            <input class="form-check-input twitter-check" type="checkbox" onchange="checkMailElement('twitter-check')" name="twitter" value="1" <?php echo e((isset($data['twitter']) && $data['twitter'] == 1)?'checked':''); ?>>
                                                            <span class="form-check-label"><?php echo e(translate('Twitter')); ?></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="form-check form--check">
                                                            <input class="form-check-input linkedin-check" type="checkbox" onchange="checkMailElement('linkedin-check')" name="linkedin" value="1" <?php echo e((isset($data['linkedin']) && $data['linkedin'] == 1)?'checked':''); ?>>
                                                            <span class="form-check-label"><?php echo e(translate('LinkedIn')); ?></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="form-check form--check">
                                                            <input class="form-check-input pinterest-check" type="checkbox" onchange="checkMailElement('pinterest-check')" name="pinterest" value="1" <?php echo e((isset($data['pinterest']) && $data['pinterest'] == 1)?'checked':''); ?>>
                                                            <span class="form-check-label"><?php echo e(translate('Pinterest')); ?></span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="form-group mb-0">
                                                <?php if($language): ?>
                                                       <div class="form-group lang_form default-form">
                                                            <label class="form-label">
                                                                <?php echo e(translate('Copyright_Content')); ?>(<?php echo e(translate('default')); ?>)
                                                                <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Write_the_Copyright_Content_within_50_characters')); ?>">
                                                                    <i class="tio-info-outined"></i>
                                                                </span>
                                                            </label>
                                                            <input type="text" maxlength="50" data-id="mail-copyright" name="copyright_text[]"  placeholder="<?php echo e(translate('Ex:_Copyright_2023_eFood._All_right_reserved')); ?>" class="form-control" value="<?php echo e($data?->getRawOriginal('copyright_text')); ?>">
                                                        </div>
                                                    <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                           $translate = [];
                                           if($data && count($data['translations'])){
                                                        foreach($data['translations'] as $t)
                                                        {
                                                            if($t->locale == $lang->code && $t->key=="copyright_text"){
                                                                $translate[$lang->code]['copyright_text'] = $t->value;
                                                            }
                                                        }
                                                        }
                                                        ?>
                                                        <div class="form-group d-none lang_form" id="<?php echo e($lang->code); ?>-form3">
                                                            <label class="form-label">
                                                                <?php echo e(translate('Copyright_Content')); ?>(<?php echo e(strtoupper($lang->code)); ?>)
                                                                <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Write_the_Copyright_Content_within_50_characters')); ?>">
                                                                    <i class="tio-info-outined"></i>
                                                                </span>
                                                            </label>
                                                            <input type="text" maxlength="50" name="copyright_text[]"  placeholder="<?php echo e(translate('Ex:_Copyright_2023_eFood._All_right_reserved')); ?>" class="form-control" value="<?php echo e($translate[$lang->code]['copyright_text']??''); ?>">
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                <div class="form-group">
                                                     <label class="form-label">
                                                        <?php echo e(translate('Copyright_Content')); ?>

                                                        <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Write_the_Copyright_Content_within_50_characters')); ?>">
                                                            <i class="tio-info-outined"></i>
                                                        </span>
                                                    </label>
                                                    <input type="text" maxlength="50"  placeholder="<?php echo e(translate('Ex:_Copyright_2023_eFood._All_right_reserved')); ?>"class="form-control" name="copyright_text[]" value="">
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn--container justify-content-end mt-3">
                                        <button type="reset" id="reset_btn" class="btn btn-secondary"><?php echo e(translate('Reset')); ?></button>
                                        <button type="submit" class="btn btn-primary"><?php echo e(translate('Save')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>


        <!-- Instructions Modal -->
<?php echo $__env->make('admin-views.business-settings.email-format-setting.partials.email-template-instructions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
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
            $("#"+lang+"-form1").removeClass('d-none');
            $("#"+lang+"-form2").removeClass('d-none');
            $("#"+lang+"-form3").removeClass('d-none');
            if(lang == '<?php echo e($default_lang); ?>')
            {
                $(".from_part_2").removeClass('d-none');
            }
            if(lang == 'default')
            {
                $(".default-form").removeClass('d-none');
            }
            else
            {
                $(".from_part_2").addClass('d-none');
            }
        });
    </script>
    <script>

        var editor = CKEDITOR.replace('ckeditor');

        editor.on( 'change', function( evt ) {
            $('#mail-body').empty().html(evt.editor.getData());
        });

        $('input[data-id="mail-title"]').on('keyup', function() {
            var dataId = $(this).data('id');
            var value = $(this).val();
            $('#'+dataId).text(value);
        });
        $('input[data-id="mail-button"]').on('keyup', function() {
            var dataId = $(this).data('id');
            var value = $(this).val();
            $('#'+dataId).text(value);
        });
        $('input[data-id="mail-footer"]').on('keyup', function() {
            var dataId = $(this).data('id');
            var value = $(this).val();
            $('#'+dataId).text(value);
        });
        $('input[data-id="mail-copyright"]').on('keyup', function() {
            var dataId = $(this).data('id');
            var value = $(this).val();
            $('#'+dataId).text(value);
        });

        function readURL(input, viewer) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + viewer).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#mail-logo").change(function() {
            readURL(this, 'logoViewer');
        });

        $("#mail-banner").change(function() {
            readURL(this, 'bannerViewer');
        });

        $("#mail-icon").change(function() {
            readURL(this, 'iconViewer');
        });


    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/business-settings/email-format-setting/user-email-formats/place-order-format.blade.php ENDPATH**/ ?>