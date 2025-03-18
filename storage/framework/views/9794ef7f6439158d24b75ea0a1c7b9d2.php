<?php $__env->startSection('title', translate('Review List')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/rating.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('review_List')); ?>

                </span>
            </h2>
        </div>

        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-top px-card pt-4">
                        <div class="row justify-content-between align-items-center gy-2">
                            <div class="col-sm-4 col-md-6 col-lg-8">
                                <h5 class="d-flex align-items-center gap-2">
                                    <?php echo e(translate('Delivery_Men_Review_Table')); ?>

                                    <span class="badge badge-soft-dark rounded-50 fz-12"><?php echo e($reviews->total()); ?></span>
                                </h5>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <form action="<?php echo e(url()->current()); ?>" method="GET">
                                    <div class="input-group">
                                        <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(translate('Search by Name')); ?>" aria-label="Search" value="<?php echo e($search); ?>" required="" autocomplete="off">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary"><?php echo e(translate('Search')); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="py-3">
                        <div class="table-responsive datatable-custom">
                            <table id="columnSearchDatatable"
                                class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                data-hs-datatables-options='{
                                    "order": [],
                                    "orderCellsTop": true
                                }'>
                                <thead class="thead-light">
                                    <tr>
                                        <th><?php echo e(translate('SL')); ?></th>
                                        <th><?php echo e(translate('deliveryman')); ?></th>
                                        <th><?php echo e(translate('customer')); ?></th>
                                        <th><?php echo e(translate('review')); ?></th>
                                        <th class="text-center"><?php echo e(translate('rating')); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($reviews->firstitem()+$key); ?></td>
                                        <td>
                                            <?php if(isset($review->delivery_man)): ?>
                                                <div>
                                                    <a class="text-dark" href="<?php echo e(route('admin.delivery-man.preview',[$review['delivery_man_id']])); ?>">
                                                        <?php echo e($review->delivery_man->f_name.' '.$review->delivery_man->l_name); ?>

                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted small">
                                                        <?php echo e(translate('Deliveryman_Unavailable')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(isset($review->customer)): ?>
                                                <div>
                                                    <a class="text-dark" href="<?php echo e(route('admin.customer.view',[$review->user_id])); ?>">
                                                        <?php echo e($review->customer->f_name." ".$review->customer->l_name); ?>

                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted small">
                                                    <?php echo e(translate('Customer unavailable')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="max-w300 line-limit-3">
                                                <?php echo e($review->comment??''); ?>

                                            </div>
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <div class="badge badge-soft-info d-inline-flex align-items-center gap-1">
                                                <?php echo e($review->rating??0); ?> <i class="tio-star"></i>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-4 px-3">
                            <div class="d-flex justify-content-lg-end">
                                <?php echo $reviews->links(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/review-list.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/delivery-man/reviews-list.blade.php ENDPATH**/ ?>