<?php $__env->startSection('title', translate('Branch List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <style>
        .alert--container .alert:not(.active) {
            display: none;
        }

        .alert--message-2 {
            border-left: 3px solid var(--primary);
            border-radius: 6px;
            position: fixed;
            right: 20px;
            top: 80px;
            z-index: 9999;
            background: #FFFFFF;
            width: 80vw;
            display: flex;
            max-width: 380px;
            align-items: center;
            gap: 12px;
            padding: 16px;
            font-size: 12px;
            transition: all ease 0.5s;
            box-shadow: 0 0 2rem rgba(0, 0, 0, 0.15);
        }

        .alert--message-2 h6 {
            font-size: 1rem;
        }

        .alert--message-2:not(.active) {
            transform: translateX(calc(100% + 40px));
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <?php if(session('branch-store')): ?>
            <div class="d-flex align-items-center gap-2 alert--message-2 fade show active" id="branch-alert">
                <img width="28" class="align-self-start image"
                     src="<?php echo e(asset('public/assets/admin/svg/components/CircleWavyCheck.svg')); ?>" alt="">
                <div class="">
                    <h6 class="title mb-2 text-truncate"><?php echo e(translate('Branch Created Successfully')); ?>!</h6>
                    <p class="message"><?php echo e(translate('By default delivery charge type is set to fixed. Kindly configure the delivery charge from Delivery fee setup')); ?> <a
                            href="<?php echo e(route('admin.business-settings.restaurant.delivery-fee-setup')); ?>"
                            class="c1"><?php echo e(translate('Delivery Fee Setup')); ?></a>
                    </p>
                </div>
                <button type="button" class="close position-relative p-0" aria-label="Close" id="close-alert">
                    <i class="tio-clear"></i>
                </button>
            </div>
        <?php endif; ?>

        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/branch.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('branch_list')); ?>

                </span>
            </h2>
        </div>

        <div class="card">
            <div class="card-top px-card pt-4">
                <div class="row justify-content-between align-items-center gy-2">
                    <div class="col-sm-4 col-md-6 col-lg-8">
                        <h5 class="d-flex align-items-center gap-2 mb-0">
                            <?php echo e(translate('Branch_List')); ?>

                            <span class="badge badge-soft-dark rounded-50 fz-12"><?php echo e($branches->total()); ?></span>
                        </h5>
                    </div>
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <form action="#" method="GET">
                            <div class="input-group">
                                <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(translate('search by ID or branch name')); ?>" aria-label="Search" value="<?php echo e($search??''); ?>" required="" autocomplete="off">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo e(translate('Search')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body px-0 pb-0">
                <div class="table-responsive datatable-custom">
                    <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                        <tr>
                            <th><?php echo e(translate('SL')); ?></th>
                            <th><?php echo e(translate('Branch_Name')); ?></th>
                            <th><?php echo e(translate('Branch_Type')); ?></th>
                            <th><?php echo e(translate('Contact_Info')); ?></th>
                            <th><?php echo e(translate('Delivery Charge Type')); ?></th>
                            <th><?php echo e(translate('Promotion_campaign')); ?></th>
                            <th><?php echo e(translate('status')); ?></th>
                            <th class="text-center"><?php echo e(translate('action')); ?></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($branches->firstItem()+$key); ?></td>
                                <td>
                                    <div class="media align-items-center gap-3 px-3">
                                        <img width="50" class="rounded"
                                             src="<?php echo e($branch->imageFullPath); ?>">
                                        <div class="media-body d-flex align-items-center flex-wrap">
                                            <span> <?php echo e($branch['name']); ?></span>
                                            <?php if($branch['id']==1): ?>
                                                <span class="badge badge-soft-danger"><?php echo e(translate('main')); ?></span>
                                            <?php else: ?>
                                                <span class="badge badge-soft-info"><?php echo e(translate('sub')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo e($branch->id == 1 ? translate('main_branch') : translate('sub_branch')); ?></td>
                                <td>
                                    <div>
                                        <strong><a href="mailto:<?php echo e($branch['email']); ?>" class="mb-0 text-dark bold fz-12"><?php echo e($branch['email']); ?></a></strong><br>
                                        <a href="tel:<?php echo e($branch['phone']); ?>" class="text-dark fz-12"><?php echo e($branch['phone']); ?></a>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-success"> <?php echo e($branch?->delivery_charge_setup?->delivery_charge_type); ?> </span>
                                </td>
                                <td>
                                    <label class="switcher">
                                        <input class="switcher_input redirect-url" data-url="<?php echo e(route('admin.promotion.status',[$branch['id'],$branch->branch_promotion_status?0:1])); ?>" type="checkbox" <?php echo e($branch->branch_promotion_status?'checked':''); ?>>
                                        <span class="switcher_control"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switcher">
                                        <input class="switcher_input redirect-url" type="checkbox" data-url="<?php echo e(route('admin.branch.status',[$branch['id'],$branch->status?0:1])); ?>" <?php echo e($branch->status?'checked':''); ?>>
                                        <span class="switcher_control"></span>
                                    </label>
                                </td>
                                <td>
                                    <?php if(env('APP_MODE')!='demo' || $branch['id']!=1): ?>
                                        <div class="d-flex justify-content-center gap-3">
                                            <a class="btn btn-outline-secondary btn-sm square-btn"
                                               href="<?php echo e(route('admin.business-settings.restaurant.delivery-fee-setup')); ?>">
                                                <i class="tio-settings"></i>
                                            </a>
                                            <a class="btn btn-outline-info btn-sm edit square-btn"
                                                href="<?php echo e(route('admin.branch.edit',[$branch['id']])); ?>"><i class="tio-edit"></i></a>
                                            <?php if($branch['id']!=1): ?>
                                                <button type="button" class="btn btn-outline-danger btn-sm delete square-btn form-alert"
                                                        data-id="branch-<?php echo e($branch['id']); ?>" data-message="<?php echo e(translate('Want to delete this branch ?')); ?>"><i class="tio-delete"></i></button>
                                            <?php endif; ?>
                                        </div>
                                        <form action="<?php echo e(route('admin.branch.delete',[$branch['id']])); ?>"
                                                method="post" id="branch-<?php echo e($branch['id']); ?>">
                                            <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                        </form>
                                    <?php else: ?>
                                        <label class="badge badge-soft-danger"><?php echo e(translate('Not Permitted')); ?></label>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive mt-4 px-3">
                    <div class="d-flex justify-content-lg-end">
                        <?php echo $branches->links(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        $(document).ready(function () {
            let alert = $('.alert--message-2');

            setTimeout(function () {
                alert.removeClass('show active').addClass('fade');
            }, 5000);

            alert.find('.close').on('click', function () {
                alert.removeClass('show active').addClass('fade');
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/branch/list.blade.php ENDPATH**/ ?>