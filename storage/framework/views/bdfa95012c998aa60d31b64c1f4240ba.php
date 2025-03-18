<?php $__env->startSection('title', translate('Add new notification')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <i class="tio-notifications"></i>
                <span class="page-header-title">
                    <?php echo e(translate('send_Notification')); ?>

                </span>
            </h2>
        </div>

        <div class="row g-2">
            <div class="col-12">
                <form action="<?php echo e(route('admin.notification.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label"><?php echo e(translate('title')); ?>

                                            <i class="tio-info text-danger" data-toggle="tooltip" data-placement="right"
                                               title="<?php echo e(translate('not_more_than_100_characters')); ?>">
                                            </i>
                                        </label>
                                        <input type="text" name="title" maxlength="100" class="form-control" value="<?php echo e(old('title')); ?>" placeholder="<?php echo e(translate('New notification')); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-label"><?php echo e(translate('description')); ?>

                                            <i class="tio-info text-danger" data-toggle="tooltip" data-placement="right"
                                               title="<?php echo e(translate('not_more_than_255_characters')); ?>">
                                            </i>
                                        </label>
                                        <textarea name="description" maxlength="255" class="form-control" rows="3" placeholder="<?php echo e(translate('Description...')); ?>" required><?php echo e(old('description')); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <label class="mb-0"><?php echo e(translate('notification_Banner')); ?></label>
                                            <small class="text-danger">* ( <?php echo e(translate('ratio')); ?> 3:1 )</small>
                                        </div>
                                        <div class="d-flex justify-content-center mt-4">
                                            <div class="upload-file">
                                                <input type="file" name="image" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" class="upload-file__input">
                                                <div class="upload-file__img_drag upload-file__img max-h-200px overflow-hidden">
                                                    <img width="465" id="viewer" src="<?php echo e(asset('public/assets/admin/img/icons/upload_img2.png')); ?>" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-3">
                                <button type="reset" id="reset" class="btn btn-secondary"><?php echo e(translate('reset')); ?></button>
                                <button type="submit" class="btn btn-primary"><?php echo e(translate('send_notification')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-top px-card pt-4">
                        <div class="row justify-content-between align-items-center gy-2">
                            <div class="col-sm-4 col-md-6 col-lg-8">
                                <h5 class="d-flex align-items-center gap-2 mb-0">
                                    <?php echo e(translate('Notification_Table')); ?>

                                    <span class="badge badge-soft-dark rounded-50 fz-12"><?php echo e($notifications->total()); ?></span>
                                </h5>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <form action="<?php echo e(url()->current()); ?>" method="GET">
                                    <div class="input-group">
                                        <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(translate('Search by title or description')); ?>" aria-label="Search" value="<?php echo e($search); ?>" required="" autocomplete="off">
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


                    <div class="py-3">
                        <div class="table-responsive datatable-custom">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(translate('SL')); ?></th>
                                    <th><?php echo e(translate('image')); ?></th>
                                    <th><?php echo e(translate('title')); ?></th>
                                    <th><?php echo e(translate('description')); ?></th>
                                    <th><?php echo e(translate('status')); ?></th>
                                    <th class="text-center"><?php echo e(translate('action')); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($notifications->firstitem()+$key); ?></td>
                                        <td>
                                            <?php if($notification['image']!=null): ?>
                                                <img class="img-vertical-150" src="<?php echo e($notification['imageFullPath']); ?>" alt="<?php echo e(translate('notification')); ?>">
                                            <?php else: ?>
                                                <label class="badge badge-soft-warning"><?php echo e(translate('No')); ?> <?php echo e(translate('image')); ?></label>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="max-w300 text-wrap">
                                                <?php echo e(substr($notification['title'],0,25)); ?> <?php echo e(strlen($notification['title'])>25?'...':''); ?>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="max-w300 text-wrap">
                                                <?php echo e(substr($notification['description'],0,25)); ?> <?php echo e(strlen($notification['description'])>25?'...':''); ?>

                                            </div>
                                        </td>
                                        <td>
                                            <label class="switcher">
                                                <input class="switcher_input status-change" type="checkbox" id="<?php echo e($notification['id']); ?>"
                                                    data-url="<?php echo e(route('admin.notification.status',[$notification['id'],0])); ?>" <?php echo e($notification['status'] == 1? 'checked' : ''); ?>>
                                                <span class="switcher_control"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-info btn-sm edit square-btn"
                                                href="<?php echo e(route('admin.notification.edit',[$notification['id']])); ?>"><i class="tio-edit"></i></a>
                                                <button type="button" class="btn btn-outline-danger btn-sm delete square-btn notification-delete-btn" data-id="<?php echo e($notification['id']); ?>">
                                                    <i class="tio-delete"></i>
                                                </button>
                                            </div>
                                            <form
                                                action="<?php echo e(route('admin.notification.delete',[$notification['id']])); ?>"
                                                method="post" id="notification-<?php echo e($notification['id']); ?>">
                                                <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-4 px-3">
                            <div class="d-flex justify-content-lg-end">
                                <?php echo $notifications->links(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/read-url.js')); ?>"></script>

    <script>
        "use strict";

        $('.notification-delete-btn').click(function() {
            var notificationId = $(this).data('id');
            $('#notification-' + notificationId).submit();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/notification/index.blade.php ENDPATH**/ ?>