<?php $__env->startSection('title', translate('Subscribed List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/subscribers.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('Subscribed_Customers')); ?>&nbsp;
                    <span class="badge badge-soft-dark rounded-50 fz-14"> <?php echo e($newsletters->total()); ?></span>
                </span>
            </h2>
        </div>

        <div class="card">

            <div class="d-flex flex-column flex-md-row flex-wrap gap-3 justify-content-md-between align-items-md-center">
                <form action="<?php echo e(url()->current()); ?>" method="GET">
                    <div class="input-group">
                        <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(translate('Search by Email')); ?>" aria-label="Search" value="<?php echo e($search); ?>" required="" autocomplete="off">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><?php echo e(translate('Search')); ?></button>
                        </div>
                    </div>
                </form>

                <div class="d-flex flex-wrap justify-content-md-end gap-3">
                    <div>
                        <button type="button" class="btn btn-outline-primary text-nowrap" data-toggle="dropdown" aria-expanded="false">
                            <i class="tio-download-to"></i>
                            Export
                            <i class="tio-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a type="submit" class="dropdown-item d-flex align-items-center gap-2" href="<?php echo e(route('admin.customer.subscribed_emails_export', ['search'=>$search])); ?>">
                                    <img width="14" src="<?php echo e(asset('public/assets/admin/img/icons/excel.png')); ?>" alt="">
                                    <?php echo e(translate('Excel')); ?>

                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="py-4">
                <div class="table-responsive datatable-custom">
                    <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>
                                <th class="">
                                    <?php echo e(translate('SL')); ?>

                                </th>
                                <th><?php echo e(translate('email')); ?></th>
                                <th><?php echo e(translate('Subscribed At')); ?></th>
                            </tr>
                        </thead>

                        <tbody id="set-rows">
                        <?php $__currentLoopData = $newsletters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$newsletter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="">
                                <td class="">
                                    <?php echo e($newsletters->firstitem()+$key); ?>

                                </td>
                                <td>
                                    <a class="text-dark" href="mailto:<?php echo e($newsletter['email']); ?>?subject=<?php echo e(translate('Mail from '). \App\Model\BusinessSetting::where(['key' => 'restaurant_name'])->first()->value); ?>"><?php echo e($newsletter['email']); ?></a>
                                </td>
                                <td><?php echo e(date('d M Y h:m A '.config('timeformat'), strtotime($newsletter->created_at))); ?></td>
                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>

                <div class="table-responsive px-3">
                    <div class="d-flex justify-content-lg-end">
                        <?php echo $newsletters->links(); ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add-point-modal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="modal-content"></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/customer/subscribed-list.blade.php ENDPATH**/ ?>