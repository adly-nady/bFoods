<select onchange="change_mail_route(this.value)" class="custom-select w-auto min-width-170px">
    <option value="user" <?php echo e(Request::is('admin/business-settings/email-setup/user*') ? 'selected' : ''); ?>><?php echo e(translate('Customer_Mail_Templates')); ?></option>
    <option value="dm" <?php echo e(Request::is('admin/business-settings/email-setup/dm*') ? 'selected' : ''); ?>><?php echo e(translate('Deliveryman_Mail_Templates')); ?></option>
</select>
<?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/business-settings/email-format-setting/partials/email-template-options.blade.php ENDPATH**/ ?>