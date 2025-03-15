<?php $__env->startSection('title', translate('Add new table')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/table.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('Add_New_Table')); ?>

                </span>
            </h2>
        </div>

        <div class="row g-2">
            <div class="col-12">
                <form action="<?php echo e(route('admin.table.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="number"><?php echo e(translate('Table_Number')); ?> <span class="text-danger">*</span></label>
                                        <input type="number" name="number" class="form-control" id="number"
                                            placeholder="<?php echo e(translate('Ex')); ?> : <?php echo e(translate('1')); ?>" value="<?php echo e(old('number')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(translate('Table Capacity')); ?> <span class="text-danger">*</span></label>
                                        <input type="number" name="capacity" class="form-control" id="capacity"
                                            placeholder="<?php echo e(translate('Ex')); ?> : <?php echo e(translate('4')); ?>" min="1" max="99" value="<?php echo e(old('capacity')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlSelect1"><?php echo e(translate('Select_Branch')); ?> <span class="text-danger">*</span></label>
                                        <select name="branch_id" class="custom-select" required>
                                            <option value="" selected><?php echo e(translate('--select--')); ?></option>
                                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($branch['id']); ?>"><?php echo e($branch['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-3">
                                <button type="reset" class="btn btn-secondary"><?php echo e(translate('reset')); ?></button>
                                <button type="submit" class="btn btn-primary"><?php echo e(translate('submit')); ?></button>
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
                                <h5 class="d-flex gap-2">
                                    <?php echo e(translate('Table_List')); ?>

                                    <span class="badge badge-soft-dark rounded-50 fz-12"><?php echo e($tables->total()); ?></span>
                                </h5>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <form action="<?php echo e(url()->current()); ?>" method="GET">
                                    <div class="input-group">
                                        <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(translate('Search by Table Number')); ?>" aria-label="Search" value="<?php echo e($search); ?>" required="" autocomplete="off">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary"><?php echo e(translate('Search')); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="py-4">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(translate('QRCode')); ?></th>
                                    <th><?php echo e(translate('SL')); ?></th>
                                    <th><?php echo e(translate('Table Number')); ?></th>
                                    <th><?php echo e(translate('Table Capacity')); ?></th>
                                    <th><?php echo e(translate('Branch')); ?></th>
                                    <th><?php echo e(translate('Status')); ?></th>
                                    <th class="text-center"><?php echo e(translate('action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            
                                            <img src="<?php echo e(asset('public/storage/'.$table->qr_code)); ?>" style="width: 80px" alt="" srcset="">
                                        </td>
                                        <th scope="row"><?php echo e($tables->firstitem()+$k); ?></th>
                                        <td><?php echo e($table['number']); ?></td>
                                        <td><?php echo e($table['capacity']); ?></td>
                                        <td class="<?php echo e($table?->branch?->name? '' : 'text-danger'); ?>"><?php echo e($table?->branch?->name ?? translate('Branch Deleted')); ?></td>
                                        <td>
                                            <label class="switcher">
                                                <input type="checkbox" class="switcher_input redirect-url"
                                                       data-url="<?php echo e(route('admin.table.status',[$table['id'],$table->is_active?0:1])); ?>"
                                                        class="toggle-switch-input" <?php echo e($table->is_active?'checked':''); ?>>
                                                <span class="switcher_control"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-3">
                                                <a href="<?php echo e(route('admin.table.update',[$table['id']])); ?>"
                                                    class="btn btn-outline-info btn-sm square-btn"
                                                    title="<?php echo e(translate('Edit')); ?>">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger btn-sm square-btn form-alert" title="<?php echo e(translate('Delete')); ?>"
                                                        data-id="table-<?php echo e($table['id']); ?>"
                                                        data-message="<?php echo e(translate('Want to delete this table ?')); ?>">
                                                    <i class="tio-delete"></i>
                                                </button>
                                            </div>
                                            <form action="<?php echo e(route('admin.table.delete',[$table['id']])); ?>"
                                                    method="post" id="table-<?php echo e($table['id']); ?>">
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
                                <?php echo e($tables->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/bFoods/resources/views/admin-views/table/list.blade.php ENDPATH**/ ?>