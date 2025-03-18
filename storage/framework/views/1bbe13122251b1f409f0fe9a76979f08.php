<?php $__env->startSection('title', translate('Review List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/review.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('product_review')); ?>

                </span>
            </h2>
        </div>

        <div class="row g-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-top px-card pt-4">
                        <div class="row justify-content-between align-items-center gy-2">
                            <div class="col-sm-4 col-md-6 col-lg-8">
                                <h4><?php echo e(translate('review_list')); ?> <span id="total_count" class="badge badge-soft-dark rounded-50 fz-14"><?php echo e($reviews->total()); ?></span></h4>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <form action="" method="GET" id="search-form">
                                    <?php echo csrf_field(); ?>
                                    <div class="input-group">
                                        <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(translate('search_by_product_name')); ?>" aria-label="Search" value="<?php echo e(request()->search); ?>" required="" autocomplete="off">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary"><?php echo e(translate('search')); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="py-4">
                        <div class="table-responsive datatable-custom">
                            <table
                                class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(translate('SL')); ?></th>
                                    <th><?php echo e(translate('product_name')); ?></th>
                                    <th><?php echo e(translate('customer_info')); ?></th>
                                    <th><?php echo e(translate('review')); ?></th>
                                    <th><?php echo e(translate('rating')); ?></th>
                                </tr>
                                </thead>
                                <tbody id="set-rows">
                                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($reviews->firstitem()+$key); ?></td>
                                        <td>
                                            <div>
                                                <?php if($review->product): ?>
                                                    <a class="text-dark media align-items-center gap-2" href="<?php echo e(route('admin.product.view',[$review['product_id']])); ?>">
                                                        <div class="avatar">
                                                            <img class="rounded-circle img-fit" src="<?php echo e($review->product['imageFullPath']); ?>" alt="<?php echo e(translate('image')); ?>">
                                                        </div>
                                                        <span class="media-body max-w220 text-wrap"><?php echo e($review->product['name']); ?></span>
                                                    </a>
                                                <?php else: ?>
                                                    <span class="badge-pill badge-soft-dark text-muted small">
                                                        <?php echo e(translate('Product unavailable')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if($review->customer): ?>
                                                <div class="d-flex flex-column gap-1">
                                                    <a class="text-dark" href="<?php echo e(route('admin.customer.view',[$review->user_id])); ?>">
                                                        <?php echo e($review->customer->f_name." ".$review->customer->l_name); ?>

                                                    </a>
                                                    <a class="text-dark fz-12" href="tel:'<?php echo e($review->customer->phone); ?>'"><?php echo e($review->customer->phone); ?></a>
                                                </div>
                                            <?php else: ?>
                                                <span class="badge-pill badge-soft-dark text-muted small">
                                                    <?php echo e(translate('Customer unavailable')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="max-w300 line-limit-3"><?php echo e($review->comment); ?></div>
                                        </td>
                                        <td>
                                            <label class="badge badge-soft-info">
                                                <?php echo e($review->rating); ?> <i class="tio-star"></i>
                                            </label>
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


<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/reviews/list.blade.php ENDPATH**/ ?>