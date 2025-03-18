<?php if($tables != null): ?>
    <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="dropright">
            <div class="card table_hover-btn py-4 <?php echo e($table['order'] != null ? 'bg-c1' : 'bg-gray'); ?> stopPropagation"
            >
                <div class="card-body mx-3 position-relative text-center">
                    <h3 class="card-title mb-2"><?php echo e(translate('table')); ?></h3>
                    <h5 class="card-title mb-1"><?php echo e($table['number']); ?></h5>
                    <h5 class="card-title mb-1"><?php echo e(translate('capacity')); ?>: <?php echo e($table['capacity']); ?></h5>
                </div>
            </div>
            <div class="table_hover-menu px-3">
                <h3 class="mb-3"><?php echo e(translate('Table - D2 ')); ?></h3>
                <?php if(($table['order'] != null)): ?>
                    <?php $__currentLoopData = $table['order']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="fz-14 mb-1"><?php echo e(translate('order id')); ?>: <strong><?php echo e($order['id']); ?></strong></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="fz-14 mb-1"><?php echo e(translate('current status')); ?> - <strong><?php echo e(translate('empty')); ?></strong></div>
                    <div class="fz-14 mb-1"><?php echo e(translate('any reservation')); ?> - <strong><?php echo e(translate('N/A')); ?></strong></div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <div class="col-md-12 text-center">
        <h4 class=""><?php echo e(translate('This branch has no table')); ?></h4>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/table/table_available_card2.blade.php ENDPATH**/ ?>