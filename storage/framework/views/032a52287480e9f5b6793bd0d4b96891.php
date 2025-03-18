<div class="d-flex flex-wrap justify-content-between align-items-center mb-5 mt-4 __gap-12px">
    <div class="js-nav-scroller hs-nav-scroller-horizontal mt-2">
        <!-- Nav -->
        <ul class="nav nav-tabs border-0 nav--tabs nav--pills">

            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/business-settings/email-setup/user/new-order') ? 'active' : ''); ?>"
                   href="<?php echo e(route('admin.business-settings.email-setup', ['user','new-order'])); ?>"><?php echo e(translate('Order_Placement')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/business-settings/email-setup/user/forgot-password') ? 'active' : ''); ?>"
                   href="<?php echo e(route('admin.business-settings.email-setup', ['user','forgot-password'])); ?>">
                    <?php echo e(translate('Forgot_Password')); ?>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/business-settings/email-setup/user/registration-otp') ? 'active' : ''); ?>"
                   href="<?php echo e(route('admin.business-settings.email-setup', ['user','registration-otp'])); ?>">
                    <?php echo e(translate('Registration_OTP')); ?>

                </a>
            </li>
        </ul>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/business-settings/email-format-setting/partials/user-email-template-setting-links.blade.php ENDPATH**/ ?>