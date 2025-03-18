<?php $__env->startSection('title', translate('Customer List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/customer.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('customers')); ?>

                </span>
            </h2>
            <span class="badge badge-soft-dark rounded-50 fz-14"><?php echo e($customers->total()); ?></span>
        </div>

        <div class="card">
            <div class="card-top px-card pt-4">
                <div class="d-flex flex-column flex-md-row flex-wrap gap-3 justify-content-md-between align-items-md-center">
                    <form action="<?php echo e(url()->current()); ?>" method="GET">
                        <div class="input-group">
                            <input id="datatableSearch_" type="search" name="search"
                                class="form-control"
                                placeholder="<?php echo e(translate('Search_By_Name_or_Phone_or_Email')); ?>" aria-label="Search"
                                value="<?php echo e($search); ?>" required autocomplete="off">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><?php echo e(translate('Search')); ?>

                                </button>
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
                                <a type="submit" class="dropdown-item d-flex align-items-center gap-2" href="<?php echo e(route('admin.customer.excel_import')); ?>">
                                    <img width="14" src="<?php echo e(asset('public/assets/admin/img/icons/excel.png')); ?>" alt="">
                                    <?php echo e(translate('Excel')); ?>

                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="py-3">
                <div class="table-responsive datatable-custom">
                    <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                        <thead class="thead-light">
                            <tr>
                                <th><?php echo e(translate('SL')); ?></th>
                                <th><?php echo e(translate('customer_Name')); ?></th>
                                <th><?php echo e(translate('Customer_Info')); ?></th>
                                <th><?php echo e(translate('total_Orders')); ?></th>
                                <th><?php echo e(translate('total_Order_Amount')); ?></th>
                                <th><?php echo e(translate('available_Points')); ?></th>
                                <th><?php echo e(translate('status')); ?></th>
                                <th class="text-center"><?php echo e(translate('actions')); ?></th>
                            </tr>
                        </thead>

                        <tbody id="set-rows">
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="">
                                <td class="">
                                    <?php echo e($customers->firstitem()+$key); ?>

                                </td>
                                <td class="max-w300">
                                    <a class="text-dark media align-items-center gap-2" href="<?php echo e(route('admin.customer.view',[$customer['id']])); ?>">
                                        <div class="avatar">
                                            <img src="<?php echo e($customer->imageFullPath); ?>" class="rounded-circle img-fit" alt="">
                                        </div>
                                        <div class="media-body text-truncate"><?php echo e($customer['f_name']." ".$customer['l_name']); ?></div>
                                    </a>
                                </td>
                                <td>
                                    <div><a href="mailto:<?php echo e($customer['email']); ?>" class="text-dark"><strong><?php echo e($customer['email']); ?></strong></a></div>
                                    <div><a class="text-dark" href="tel:<?php echo e($customer['phone']); ?>"><?php echo e($customer['phone']); ?></a></div>
                                </td>
                                <td>
                                    <label class="badge badge-soft-info py-1 px-5 mb-0">
                                        <?php echo e($customer->orders->count()); ?>

                                    </label>
                                </td>
                                <td><?php echo e($customer->orders->sum('order_amount')); ?></td>
                                <td class="show-point-<?php echo e($customer['id']); ?>-table">
                                    <?php echo e($customer['point']); ?>

                                </td>
                                <td>
                                    <label class="switcher">
                                        <input id="<?php echo e($customer['id']); ?>" data-url="<?php echo e(route('admin.customer.update_status', ['id' => $customer['id']])); ?>" type="checkbox" class="switcher_input status-change" <?php echo e($customer->is_active == 1? 'checked' : ''); ?>>
                                        <span class="switcher_control"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a class="btn btn-outline-success btn-sm square-btn"
                                           href="<?php echo e(route('admin.customer.view',[$customer['id']])); ?>">
                                            <i class="tio-visible"></i>
                                        </a>
                                        <button class="btn btn-outline-danger btn-sm square-btn form-alert"  data-id="customer-<?php echo e($customer['id']); ?>" data-message="<?php echo e(translate('delete_this_user')); ?>" >
                                            <i class="tio-delete"></i>
                                        </button>
                                        <form id="customer-<?php echo e($customer['id']); ?>" action="<?php echo e(route('admin.customer.destroy',['id' => $customer['id']])); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive mt-4 px-3">
                    <div class="d-flex justify-content-lg-end">
                        <?php echo $customers->links(); ?>

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

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";

        function add_point(form_id, route, customer_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: route,
                data: $('#' + form_id).serialize(),
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('.show-point-' + customer_id).text('( <?php echo e(translate('Available Point : ')); ?> ' + data.updated_point + ' )');
                    $('.show-point-' + customer_id + '-table').text(data.updated_point);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        function set_point_modal_data(route) {
            $.get({
                url: route,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#add-point-modal').modal('show');
                    $('#modal-content').html(data.view);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/customer/list.blade.php ENDPATH**/ ?>