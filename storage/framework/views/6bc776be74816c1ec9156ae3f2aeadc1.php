<?php $__env->startSection('title', translate('New Joining Request')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/deliveryman.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('New Joining Request')); ?>

                </span>
            </h2>
            <span class="badge badge-soft-dark rounded-circle fz-12"><?php echo e($deliverymen->total()); ?></span>
        </div>
        <div class="mb-4">
            <ul class="nav nav-tabs border-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('admin/delivery-man/pending/list')?'active':''); ?>"  href="<?php echo e(route('admin.delivery-man.pending')); ?>"><?php echo e(translate('Pending Delivery Man')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('admin/delivery-man/denied/list')?'active':''); ?>"  href="<?php echo e(route('admin.delivery-man.denied')); ?>"><?php echo e(translate('Denied Delivery Man')); ?></a>
                </li>
            </ul>
        </div>


        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-top px-card pt-4">
                        <div class="d-flex flex-column flex-md-row flex-wrap gap-3 justify-content-md-between align-items-md-center">
                            <form action="<?php echo e(url()->current()); ?>" method="GET">
                                <div class="input-group">
                                    <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(translate('Search by Name or Phone or Email')); ?>" aria-label="Search" value="<?php echo e($search); ?>" required="" autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">
                                        <?php echo e(translate('Search')); ?>

                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="py-4">
                        <div class="table-responsive datatable-custom">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th><?php echo e(translate('SL')); ?></th>
                                        <th><?php echo e(translate('name')); ?></th>
                                        <th><?php echo e(translate('Contact_Info ')); ?></th>
                                        <th class="text-center"><?php echo e(translate('Branch')); ?></th>
                                        <th class="text-center"><?php echo e(translate('Identity Type')); ?></th>
                                        <th class="text-center"><?php echo e(translate('Identity Number')); ?></th>
                                        <th class="text-center"><?php echo e(translate('Identity Image')); ?></th>
                                        <th class="text-center"><?php echo e(translate('Status')); ?></th>
                                        <th class="text-center"><?php echo e(translate('action')); ?></th>
                                    </tr>
                                </thead>

                                <tbody id="set-rows">
                                <?php $__currentLoopData = $deliverymen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$dm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($deliverymen->firstitem()+$key); ?></td>
                                        <td>
                                            <div class="media gap-3 align-items-center">
                                                <div class="avatar">
                                                    <img width="60" class="img-fit rounded-circle"
                                                         src="<?php echo e($dm->imageFullPath); ?>" alt="<?php echo e(translate('deliveryman')); ?>">
                                                </div>
                                                <div class="media-body">
                                                    <?php echo e($dm['f_name'].' '.$dm['l_name']); ?>

                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column gap-1">
                                                <div>
                                                    <a class="text-dark" href="mailto:<?php echo e($dm['email']); ?>">
                                                        <strong><?php echo e($dm['email']); ?></strong>
                                                    </a>
                                                </div>
                                                <a class="text-dark" href="tel:<?php echo e($dm['phone']); ?>"><?php echo e($dm['phone']); ?></a>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <?php if($dm->branch_id == 0): ?>
                                                <label class="badge badge-soft-primary"><?php echo e(translate('All Branch')); ?></label>
                                            <?php else: ?>
                                                <label class="badge badge-soft-primary"><?php echo e($dm->branch?$dm->branch->name:'Branch deleted!'); ?></label>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center"><?php echo e(translate($dm->identity_type)); ?></td>
                                        <td class="text-center"><?php echo e($dm->identity_number); ?></td>
                                        <td class="text-center">
                                            <div class="d-flex gap-2" data-toggle="" data-placement="top" title="<?php echo e(translate('click for bigger view')); ?>">
                                                <?php $__currentLoopData = json_decode($dm['identity_image'], true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $identification_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php ($image_full_path = asset('storage/app/public/delivery-man'). '/' .$identification_image); ?>
                                                    <div class="overflow-hidden">
                                                        <img class="cursor-pointer rounded img-fit custom-img-fit image-preview"
                                                             onerror="this.src='<?php echo e(asset('public/assets/admin/img/160x160/img1.jpg')); ?>'"
                                                             src="<?php echo e($image_full_path); ?>">
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <strong class="text-info text-capitalize"><?php echo e(translate($dm->application_status)); ?></strong>
                                        </td>
                                        <td class="text-center">
                                            <div class="justify-content-center">
                                                <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                                   data-toggle="tooltip" data-placement="top" title="<?php echo e(translate('Approve')); ?>"
                                                   data-url="<?php echo e(route('admin.delivery-man.application', [$dm['id'], 'approved'])); ?>"
                                                   data-message="<?php echo e(translate('you_want_to_approve_this_application')); ?>"
                                                   href="#"><i class="tio-done font-weight-bold"></i></a>
                                                <?php if($dm->application_status != 'denied'): ?>
                                                    <a class="btn btn-sm btn--danger btn-outline-danger action-btn"
                                                       data-toggle="tooltip" data-placement="top" title="<?php echo e(translate('Deny')); ?>"
                                                       data-url="<?php echo e(route('admin.delivery-man.application', [$dm['id'], 'denied'])); ?>"
                                                       data-message="<?php echo e(translate('you_want_to_deny_this_application')); ?>"
                                                       href="#"><i class="tio-clear"></i></a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="table-responsive px-3 mt-3">
                            <div class="d-flex justify-content-end">
                                <?php echo $deliverymen->links(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-lg" id="identification_image_view_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div data-dismiss="modal">
                            <img onerror="this.src='<?php echo e(asset('public/assets/admin/img/160x160/img1.jpg')); ?>'" alt=""
                                 class="" id="identification_image_element" width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";

        $('.action-btn').click(function() {
            var url = $(this).data('url');
            var message = $(this).data('message');
            request_alert(url, message);
        });

        function request_alert(url, message) {
            Swal.fire({
                title: '<?php echo e(translate('are_you_sure')); ?>',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: '<?php echo e(translate('no')); ?>',
                confirmButtonText: '<?php echo e(translate('yes')); ?>',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            })
        }

        $('.image-preview').click(function() {
            var imagePath = $(this).attr('src');
            show_modal(imagePath);
        });

        function show_modal(image_location) {
            $('#identification_image_view_modal').modal('show');
            if(image_location != null || image_location !== '') {
                $('#identification_image_element').attr("src", image_location);
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/delivery-man/pending-list.blade.php ENDPATH**/ ?>