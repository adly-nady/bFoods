<div class="mt-5 mb-5">
    <div class="inline-page-menu my-4">
        <ul class="list-unstyled">
            <li class="<?php echo e(Request::is('admin/business-settings/page-setup/about-us')? 'active': ''); ?>"><a href="<?php echo e(route('admin.business-settings.page-setup.about-us')); ?>"><?php echo e(translate('About Us')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/business-settings/page-setup/terms-and-conditions')?'active':''); ?>"><a href="<?php echo e(route('admin.business-settings.page-setup.terms-and-conditions')); ?>"><?php echo e(translate('Terms and Condition')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/business-settings/page-setup/privacy-policy')?'active':''); ?>"><a href="<?php echo e(route('admin.business-settings.page-setup.privacy-policy')); ?>"><?php echo e(translate('Privacy Policy')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/business-settings/page-setup/return-page*')?'active':''); ?>"><a href="<?php echo e(route('admin.business-settings.page-setup.return_page_index')); ?>"><?php echo e(translate('Return Policy')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/business-settings/page-setup/refund-page*')?'active':''); ?>"><a href="<?php echo e(route('admin.business-settings.page-setup.refund_page_index')); ?>"><?php echo e(translate('Refund Policy')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/business-settings/page-setup/cancellation-page*')?'active':''); ?>"><a href="<?php echo e(route('admin.business-settings.page-setup.cancellation_page_index')); ?>"><?php echo e(translate('Cancellation Policy')); ?></a></li>
        </ul>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/business-settings/partials/_page-setup-inline-menu.blade.php ENDPATH**/ ?>