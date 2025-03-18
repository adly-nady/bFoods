<div class="mt-5 mb-5">
    <div class="inline-page-menu my-4">
        <ul class="list-unstyled">
            <li class="<?php echo e(Request::is('admin/business-settings/web-app/third-party/payment-method')? 'active': ''); ?>"><a href="<?php echo e(route('admin.business-settings.web-app.payment-method')); ?>"><?php echo e(translate('Payment_Methods')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/business-settings/web-app/third-party/mail-config')? 'active': ''); ?>"><a href="<?php echo e(route('admin.business-settings.web-app.mail-config')); ?>"><?php echo e(translate('Mail_Config')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/business-settings/web-app/third-party/sms-module')? 'active': ''); ?>"><a href="<?php echo e(route('admin.business-settings.web-app.sms-module')); ?>"><?php echo e(translate('SMS_Config')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/business-settings/web-app/third-party/map-api-settings')? 'active': ''); ?>"><a href="<?php echo e(route('admin.business-settings.web-app.third-party.map_api_settings')); ?>"><?php echo e(translate('Google_Map_APIs')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/business-settings/web-app/third-party/recaptcha')? 'active': ''); ?>"><a href="<?php echo e(route('admin.business-settings.web-app.third-party.recaptcha_index')); ?>"><?php echo e(translate('Recaptcha')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/business-settings/web-app/third-party/social-login')? 'active': ''); ?>"><a href="<?php echo e(route('admin.business-settings.web-app.third-party.social-login')); ?>"><?php echo e(translate('Social_Login')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/business-settings/web-app/third-party/chat')? 'active': ''); ?>"><a href="<?php echo e(route('admin.business-settings.web-app.third-party.chat')); ?>"><?php echo e(translate('chat')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/business-settings/web-app/third-party/firebase-otp-verification')? 'active': ''); ?>"><a href="<?php echo e(route('admin.business-settings.web-app.third-party.firebase-otp-verification')); ?>"><?php echo e(translate('Firebase_Auth_verification')); ?></a></li>
        </ul>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/business-settings/partials/_3rdparty-inline-menu.blade.php ENDPATH**/ ?>