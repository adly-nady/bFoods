<?php if(session()->has('address')): ?>
    <?php
        $address = session()->get('address')
    ?>
    <ul>
        <li>
            <span><?php echo e(translate('Name')); ?>:</span>
            <strong><?php echo e($address['contact_person_name']); ?></strong>
        </li>
        <li>
            <span><?php echo e(translate('Contact Number')); ?>:</span>
            <strong><?php echo e($address['contact_person_number']); ?></strong>
        </li>
        <?php if( $address['area_name'] != null): ?>
            <li>
                <span><?php echo e(translate('Area')); ?>:</span>
                <strong><?php echo e($address['area_name']); ?></strong>
            </li>
        <?php endif; ?>

    </ul>
    <div class="location">
        <i class="tio-poi"></i>
        <span>
            <?php echo e($address['address']); ?>

        </span>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/pos/_address.blade.php ENDPATH**/ ?>