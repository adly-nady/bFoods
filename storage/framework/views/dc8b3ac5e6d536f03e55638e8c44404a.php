<?php $__env->startSection('title', translate('Employee List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <link href="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/employee.png')); ?>" alt="">
            <span class="page-header-title">
                <?php echo e(translate('employee_List')); ?>

            </span>
        </h2>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-top px-card pt-4">
                    <div class="d-flex flex-column flex-md-row flex-wrap gap-3 justify-content-md-between align-items-md-center">
                        <h5 class="d-flex gap-2">
                            <?php echo e(translate('employee_table')); ?>

                            <span class="badge badge-soft-dark rounded-50 fz-12"><?php echo e($employees->total()); ?></span>
                        </h5>

                        <div class="d-flex flex-wrap justify-content-md-end gap-3">
                            <form action="<?php echo e(url()->current()); ?>" method="GET">
                                <div class="input-group">
                                    <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(translate('Search by name, email or phone')); ?>" aria-label="Search" value="" required="" autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary"><?php echo e(translate('Search')); ?></button>
                                    </div>
                                </div>
                            </form>
                            <div>
                                <button type="button" class="btn btn-outline-primary text-nowrap" data-toggle="dropdown" aria-expanded="false">
                                    <i class="tio-download-to"></i>
                                    Export
                                    <i class="tio-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a type="submit" class="dropdown-item d-flex align-items-center gap-2" href="<?php echo e(route('admin.employee.excel-export')); ?>">
                                            <img width="14" src="<?php echo e(asset('public/assets/admin/img/icons/excel.png')); ?>" alt="">
                                            <?php echo e(translate('Excel')); ?>

                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-3">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(translate('SL')); ?></th>
                                    <th><?php echo e(translate('Name')); ?></th>
                                    <th><?php echo e(translate('Contact_Info')); ?></th>
                                    <th><?php echo e(translate('Role')); ?></th>
                                    <th><?php echo e(translate('Status')); ?></th>
                                    <th class="text-center"><?php echo e(translate('action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($employee->role): ?>
                                <tr>
                                    <td><?php echo e($employees->firstitem()+$k); ?></td>
                                    <td class="text-capitalize">
                                        <div class="media align-items-center gap-3">
                                            <div class="avatar">
                                                <img class="img-fit rounded-circle" src="<?php echo e($employee->imageFullPath); ?>" alt="<?php echo e(translate('employee')); ?>">
                                            </div>
                                            <div class="media-body"><?php echo e($employee['f_name'] . ' ' . $employee['l_name']); ?></div>
                                        </div>
                                    </td>
                                    <td >
                                      <div><a class="text-dark" href="mailto:<?php echo e($employee['email']); ?>"><strong><?php echo e($employee['email']); ?></strong></a></div>
                                      <div><a href="tel:<?php echo e($employee['phone']); ?>" class="text-dark"><?php echo e($employee['phone']); ?></a></div>
                                    </td>
                                    <td><span class="badge badge-soft-info py-1 px-2"><?php echo e($employee->role['name']); ?></span></td>
                                    <td>
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher_input redirect-url"
                                                   data-url="<?php echo e(route('admin.employee.status',[$employee['id'],$employee->status?0:1])); ?>"
                                                   class="toggle-switch-input" <?php echo e($employee->status?'checked':''); ?>>
                                            <span class="switcher_control"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="<?php echo e(route('admin.employee.update',[$employee['id']])); ?>"
                                            class="btn btn-outline-info btn-sm square-btn"
                                            title="<?php echo e(translate('Edit')); ?>">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a data-id="employee-<?php echo e($employee->id); ?>" data-message="<?php echo e(translate('want_to_delete_this_employee?')); ?>"
                                               class="btn btn-outline-danger btn-sm delete square-btn form-alert"
                                               title="<?php echo e(translate('delete')); ?>">
                                                <i class="tio-delete"></i>
                                            </a>
                                        </div>
                                        <form action="<?php echo e(route('admin.employee.delete')); ?>" method="post" id="employee-<?php echo e($employee->id); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <input type="hidden" name="id" value="<?php echo e($employee->id); ?>">
                                        </form>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-4 px-3">
                        <div class="d-flex justify-content-lg-end">
                            <?php echo e($employees->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        "use strict";

        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/employee/list.blade.php ENDPATH**/ ?>