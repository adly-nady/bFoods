<?php $__env->startSection('title', translate('Payment Setup')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/third-party.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('third_party')); ?>

                </span>
            </h2>
        </div>

        <?php echo $__env->make('admin-views.business-settings.partials._3rdparty-inline-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="g-2">
            <form action="<?php echo e(route('admin.business-settings.web-app.payment-method-status')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <?php ($cod=\App\CentralLogics\Helpers::get_business_settings('cash_on_delivery')); ?>
                                <div class="form-control d-flex justify-content-between align-items-center gap-3">
                                    <label class="text-dark mb-0"><?php echo e(translate('Cash On Delivery')); ?></label>
                                    <label class="switcher">
                                        <input class="switcher_input" type="checkbox" name="cash_on_delivery" <?php echo e($cod == null || $cod['status'] == 0? '' : 'checked'); ?> id="cash_on_delivery_btn">
                                        <span class="switcher_control"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php ($dp=\App\CentralLogics\Helpers::get_business_settings('digital_payment')); ?>
                                <div class="form-control d-flex justify-content-between align-items-center gap-3">
                                    <label class="text-dark mb-0"><?php echo e(translate('Digital Payment')); ?></label>
                                    <label class="switcher">
                                        <input class="switcher_input" type="checkbox" name="digital_payment" <?php echo e($dp == null || $dp['status'] == 0? '' : 'checked'); ?>

                                            onclick="section_visibility('digital_payment_btn')" id="digital_payment_btn">
                                        <span class="switcher_control"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php ($op=\App\CentralLogics\Helpers::get_business_settings('offline_payment')); ?>
                                <div class="form-control d-flex justify-content-between align-items-center gap-3">
                                    <label class="text-dark mb-0"><?php echo e(translate('Offline Payment')); ?></label>
                                    <label class="switcher">
                                        <input class="switcher_input" type="checkbox" name="offline_payment" <?php echo e($op == null || $op['status'] == 0? '' : 'checked'); ?> id="offline_payment_btn">
                                        <span class="switcher_control"></span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="btn--container mt-2">
                            <button type="submit" class="btn btn-primary"><?php echo e(translate('save')); ?></button>
                        </div>
                    </div>
                </div>

            </form>

        </div>

        <div class="digital_payment_section">
            <div class="row g-2">
                <?php if($published_status == 1): ?>
                    <div class="col-12 mb-3">
                        <div class="card">
                            <div class="card-body d-flex justify-content-around">
                                <h4 class="text-danger pt-4">
                                    <i class="tio-info-outined"></i>
                                    <?php echo e(translate('Your current payment settings are disabled, because you have enabled
                                    payment gateway addon, To visit your currently active payment gateway settings please follow
                                    the link.')); ?>

                                </h4>
                                <span>
                            <a href="<?php echo e(!empty($payment_url) ? $payment_url : ''); ?>" class="btn btn-outline-primary"><i class="tio-settings mr-1"></i><?php echo e(translate('settings')); ?></a>
                        </span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row digital_payment_methods mt-3 g-3" id="payment-gatway-cards">
                <?php $__currentLoopData = $data_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 mb-5">
                        <div class="card">
                            <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.web-app.payment-config-update'):'javascript:'); ?>" method="POST"
                                  id="<?php echo e($payment->key_name); ?>-form" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="card-header d-flex flex-wrap align-content-around">
                                    <h5>
                                        <span class="text-uppercase"><?php echo e(str_replace('_',' ',$payment->key_name)); ?></span>
                                    </h5>
                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                        <span class="mr-2 switch--custom-label-text text-primary on text-uppercase">on</span>
                                        <span class="mr-2 switch--custom-label-text off text-uppercase">off</span>
                                        <input type="checkbox" name="status" value="1"
                                               class="toggle-switch-input" <?php echo e($payment['is_active']==1?'checked':''); ?>>
                                        <span class="toggle-switch-label text">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                    </label>
                                </div>

                                <?php ($additional_data = $payment['additional_data'] != null ? json_decode($payment['additional_data']) : []); ?>
                                <div class="card-body">
                                    <div class="payment--gateway-img">
                                        <img style="height: 80px"
                                             src="<?php echo e(asset('storage/app/public/payment_modules/gateway_image')); ?>/<?php echo e($additional_data != null ? $additional_data->gateway_image : ''); ?>"
                                             onerror="this.src='<?php echo e(asset('public/assets/admin/img/placeholder.png')); ?>'"
                                             alt="public">
                                    </div>

                                    <input name="gateway" value="<?php echo e($payment->key_name); ?>" class="d-none">

                                    <?php ($mode=$data_values->where('key_name',$payment->key_name)->first()->live_values['mode']); ?>
                                    <div class="form-floating" style="margin-bottom: 10px">
                                        <select class="js-select form-control theme-input-style w-100" name="mode">
                                            <option value="live" <?php echo e($mode=='live'?'selected':''); ?>><?php echo e(translate('live')); ?></option>
                                            <option value="test" <?php echo e($mode=='test'?'selected':''); ?>><?php echo e(translate('test')); ?></option>
                                        </select>
                                    </div>

                                    <?php ($skip=['gateway','mode','status']); ?>
                                    <?php $__currentLoopData = $data_values->where('key_name',$payment->key_name)->first()->live_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!in_array($key,$skip)): ?>
                                            <div class="form-floating mb-3">
                                                <label for="exampleFormControlInput1"
                                                       class="form-label"><?php echo e(ucwords(str_replace('_',' ',$key))); ?>

                                                    *</label>
                                                <input type="text" class="form-control"
                                                       name="<?php echo e($key); ?>"
                                                       placeholder="<?php echo e(ucwords(str_replace('_',' ',$key))); ?> *"
                                                       value="<?php echo e(env('APP_MODE')=='demo'?'':$value); ?>">
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <div class="form-floating mb-3">
                                        <label for="exampleFormControlInput1"
                                               class="form-label"><?php echo e(translate('payment_gateway_title')); ?></label>
                                        <input type="text" class="form-control"
                                               name="gateway_title"
                                               placeholder="<?php echo e(translate('payment_gateway_title')); ?>"
                                               value="<?php echo e($additional_data != null ? $additional_data->gateway_title : ''); ?>">
                                    </div>

                                    <div class="form-floating mb-3">
                                        <label for="exampleFormControlInput1"
                                               class="form-label"><?php echo e(translate('choose logo')); ?></label>
                                        <input type="file" class="form-control" name="gateway_image" accept=".jpg, .png, .jpeg|image/*">
                                    </div>

                                    <div class="text-right mt-4">
                                        <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                                class="btn btn-primary px-5 call-demo"><?php echo e(translate('save')); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>




    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>

        
        
        
        
        

        
        
        
        
        
        
        
        

        $(document).on('change', 'input[name="gateway_image"]', function () {
            var $input = $(this);
            var $form = $input.closest('form');
            var gatewayName = $form.attr('id');

            if (this.files && this.files[0]) {
                var reader = new FileReader();
                var $imagePreview = $form.find('.payment--gateway-img img'); // Find the img element within the form

                reader.onload = function (e) {
                    $imagePreview.attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });

    </script>

    <script>
        <?php if($published_status == 1): ?>
            $('#payment-gatway-cards').find('input').each(function(){
                $(this).attr('disabled', true);
            });
            $('#payment-gatway-cards').find('select').each(function(){
                $(this).attr('disabled', true);
            });
            $('#payment-gatway-cards').find('.switcher_input').each(function(){
                $(this).removeAttr('checked', true);
            });
            $('#payment-gatway-cards').find('button').each(function(){
                $(this).attr('disabled', true);
            });
        <?php endif; ?>
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/business-settings/payment-index.blade.php ENDPATH**/ ?>