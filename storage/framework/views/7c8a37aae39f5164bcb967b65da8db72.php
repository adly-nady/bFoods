<?php $__env->startSection('title', translate('Create Role')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <link href="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/employee.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('employee_role_setup')); ?>

                </span>
            </h2>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><?php echo e(translate('Role_Form')); ?></h5>
            </div>
            <div class="card-body">
                <form id="submit-create-role" method="post" action="<?php echo e(route('admin.custom-role.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="name"><?php echo e(translate('role_name')); ?></label>
                        <input type="text" name="name" class="form-control" id="name"
                                aria-describedby="emailHelp"
                                placeholder="<?php echo e(translate('Ex')); ?> : <?php echo e(translate('Store')); ?>" required>
                    </div>

                    <div class="mb-5 d-flex flex-wrap align-items-center gap-3">
                        <h5 class="mb-0"><?php echo e(translate('Module_Permission')); ?> : </h5>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="select-all-btn">
                            <label class="form-check-label" for="select-all-btn"><?php echo e(translate('Select_All')); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = MANAGEMENT_SECTION; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xl-4 col-lg-4 col-sm-6">
                                <div class="form-group form-check">
                                    <input type="checkbox" name="modules[]" value="<?php echo e($section); ?>" class="form-check-input select-all-associate"
                                            id="<?php echo e($section); ?>">
                                    <label class="form-check-label ml-2" for="<?php echo e($section); ?>"><?php echo e(translate($section)); ?></label>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <button type="reset" class="btn btn-secondary"><?php echo e(translate('reset')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(translate('Submit')); ?></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-top px-card pt-4">
                <div class="d-flex flex-column flex-md-row flex-wrap gap-3 justify-content-md-between align-items-md-center">
                    <h5 class="d-flex gap-2 mb-0">
                        <?php echo e(translate('Employee_Role_Table')); ?>

                        <span class="badge badge-soft-dark rounded-50 fz-12"><?php echo e($roles->count()); ?></span>
                    </h5>

                    <div class="d-flex flex-wrap justify-content-md-end gap-3">
                        <form action="" method="GET">
                            <div class="input-group">
                                <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(translate('Search by Role Name')); ?>" aria-label="<?php echo e(translate('Search')); ?>" value="<?php echo e($search); ?>" required="" autocomplete="off">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><?php echo e(translate('Search')); ?></button>
                                </div>
                            </div>
                        </form>
                        <div>
                            <button type="button" class="btn btn-outline-primary text-nowrap" data-toggle="dropdown" aria-expanded="false">
                                <i class="tio-download-to"></i>
                                <?php echo e(translate('export')); ?>

                                <i class="tio-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a type="submit" class="dropdown-item d-flex align-items-center gap-2" href="<?php echo e(route('admin.custom-role.excel-export')); ?>">
                                        <img width="14" src="<?php echo e(asset('public/assets/admin/img/icons/excel.png')); ?>" alt="">
                                        <?php echo e(translate('Excel')); ?>

                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-4">
                <div class="table-responsive">
                    <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table" id="dataTable">
                        <thead class="thead-light">
                        <tr>
                            <th><?php echo e(translate('SL')); ?></th>
                            <th><?php echo e(translate('role_name')); ?></th>
                            <th><?php echo e(translate('modules')); ?></th>
                            <th><?php echo e(translate('created_at')); ?></th>
                            <th><?php echo e(translate('status')); ?></th>
                            <th class="text-center"><?php echo e(translate('action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($role['name']); ?></td>
                                <td class="text-capitalize">
                                    <div class="max-w300 text-wrap">
                                        <?php if($role['module_access']!=null): ?>
                                            <?php ($comma = ''); ?>
                                            <?php $__currentLoopData = (array)json_decode($role['module_access']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($comma); ?><?php echo e(str_replace('_',' ',$module)); ?>

                                                <?php ($comma = ', '); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td><?php echo e(date('d-M-Y',strtotime($role['created_at']))); ?></td>
                                <td>
                                    <label class="switcher">
                                        <input type="checkbox" name="status" class="switcher_input status-change" <?php echo e($role['status'] == true? 'checked' : ''); ?>

                                        data-url="<?php echo e(route('admin.custom-role.change-status', ['id' => $role['id']])); ?>" id="<?php echo e($role['id']); ?>"
                                        >
                                        <span class="switcher_control"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="<?php echo e(route('admin.custom-role.update',[$role['id']])); ?>"
                                        class="btn btn-outline-info btn-sm square-btn"
                                        title="<?php echo e(translate('Edit')); ?>">
                                        <i class="tio-edit"></i>
                                        </a>
                                        <a data-id="role-<?php echo e($role->id); ?>" data-message="<?php echo e(translate('want_to_delete_this_employee?')); ?>"
                                           class="btn btn-outline-danger btn-sm delete square-btn form-alert"
                                           title="<?php echo e(translate('delete')); ?>">
                                            <i class="tio-delete"></i>
                                        </a>
                                    </div>
                                </td>
                                <form action="<?php echo e(route('admin.custom-role.delete')); ?>" method="post" id="role-<?php echo e($role->id); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <input type="hidden" name="id" value="<?php echo e($role->id); ?>">
                                </form>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/role.js')); ?>"></script>

    <script>
        "use strict";

        $('#submit-create-role').on('submit',function(e){

            var fields = $("input[name='modules[]']").serializeArray();
            if (fields.length === 0)
            {
                toastr.warning('<?php echo e(translate('select_minimum_one_selection_box')); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                return false;
            }else{
                $('#submit-create-role').submit();
            }
        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/custom-role/create.blade.php ENDPATH**/ ?>