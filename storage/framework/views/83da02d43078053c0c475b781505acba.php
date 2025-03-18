<?php $__env->startSection('title', translate('Offline Payment Method')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/business_setup2.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('Add Offline Payment Method Setup')); ?>

                </span>
            </h2>
        </div>

        <div class="row g-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="justify-content-between align-items-center gy-2">
                            <form action="<?php echo e(url()->current()); ?>" method="GET">
                                <div class="input-group">
                                    <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(translate('Search_by_method_name')); ?>" aria-label="Search" value="<?php echo e($search); ?>" required="" autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">
                                            <?php echo e(translate('Search')); ?>

                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div>
                            <a href="<?php echo e(route('admin.business-settings.web-app.third-party.offline-payment.add')); ?>" type="button" class="btn btn-primary"><i class="tio-add"></i><?php echo e(translate('Add New Method')); ?></a>
                        </div>
                    </div>

                    <div class="py-4">
                        <div class="table-responsive datatable-custom">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(translate('SL')); ?></th>
                                    <th><?php echo e(translate('Payment Method Name')); ?></th>
                                    <th><?php echo e(translate('Payment Info')); ?></th>
                                    <th><?php echo e(translate('Required Info from Customer')); ?></th>
                                    <th><?php echo e(translate('status')); ?></th>
                                    <th class="text-center"><?php echo e(translate('action')); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($methods->firstitem()+$key); ?></td>
                                        <td>
                                            <div class="max-w300 text-wrap">
                                                <?php echo e($method['method_name']); ?>

                                            </div>
                                        </td>
                                        <td>
                                            <?php $__currentLoopData = $method['method_fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="border border-white max-w300 text-wrap text-left">
                                                    <?php echo e($fields['field_name']); ?> : <?php echo e(translate($fields['field_data'])); ?>

                                                </span><br/>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <td>
                                            <?php $__currentLoopData = $method['method_informations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$informations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="border border-white max-w300 text-wrap text-left">
                                                     <?php echo e(translate($informations['information_name'])); ?> |
                                                </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <div class="max-w300 text-wrap">
                                                <?php echo e(translate('Payment note')); ?>

                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <label class="switcher">
                                                    <input class="switcher_input" type="checkbox" <?php echo e($method['status']==1? 'checked' : ''); ?> id="<?php echo e($method['id']); ?>"
                                                           onchange="status_change(this)" data-url="<?php echo e(route('admin.business-settings.web-app.third-party.offline-payment.status',[$method['id'],1])); ?>">
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-info btn-sm edit square-btn"
                                                   href="<?php echo e(route('admin.business-settings.web-app.third-party.offline-payment.edit', [$method['id']])); ?>"><i class="tio-edit"></i>
                                                </a>
                                                <button class="btn btn-outline-danger btn-sm delete square-btn delete-item" data-id="<?php echo e($method->id); ?>">
                                                    <i class="tio-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-4 px-3">
                            <div class="d-flex justify-content-lg-end">
                                <?php echo $methods->links(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>

    <script>
        $('.delete-item').on('click', function (){
            let id = $(this).data('id');
            deleteItem(id)
        });
        function deleteItem(id) {
            Swal.fire({
                title: '<?php echo e(translate('Are you sure')); ?>?',
                text: "<?php echo e(translate('You will not be able to revert this')); ?>!",
                showCancelButton: true,
                confirmButtonColor: '#FC6A57',
                cancelButtonColor: '#EA295E',
                confirmButtonText: '<?php echo e(translate('Yes, delete it')); ?>!'
            }).then((result) => {
                if (result.value) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "<?php echo e(route('admin.business-settings.web-app.third-party.offline-payment.delete')); ?>",
                        method: 'POST',
                        data: {
                                id: id,
                                "_token": "<?php echo e(csrf_token()); ?>",
                            },
                        success: function () {
                            toastr.success('<?php echo e(translate('Removed successfully')); ?>');
                            location.reload();
                        }
                    });
                }
            })
        }
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/business-settings/offline-payment/list.blade.php ENDPATH**/ ?>