<?php $__env->startSection('title', translate('Order List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex align-items-center gap-1">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/all_orders.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('POS_Orders')); ?>

                </span>
            </h2>
            <span class="badge badge-soft-dark rounded-50 fz-14"><?php echo e($orders->total()); ?></span>
        </div>

        <div class="card">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(url()->current()); ?>" id="form-data" method="GET">
                        <input type="hidden" name="filter">
                        <div class="row gy-3 gx-2 align-items-end">
                            <div class="col-12 pb-0">
                                <h4 class="mb-0"><?php echo e(translate('Select Date Range')); ?></h4>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <select name="branch_id" class="form-control">
                                        <option value="all"
                                            <?php echo e($branch_id == 'all'? 'selected' : ''); ?>

                                        ><?php echo e(translate('All Branch')); ?></option>
                                    <?php $__empty_1 = true; $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <option value="<?php echo e($branch->id); ?>"
                                            <?php echo e($branch_id == $branch->id? 'selected' : ''); ?>

                                        ><?php echo e($branch->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <option><?php echo e(translate('No Branch Found')); ?></option>
                                    <?php endif; ?>

                                </select>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group mb-0">
                                    <label class="text-dark">Start Date</label>
                                    <input type="date" name="from" id="from_date" class="form-control" value="<?php echo e($from); ?>" >
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group mb-0">
                                    <label class="text-dark">End Date</label>
                                    <input type="date" name="to" id="to_date" class="form-control" value="<?php echo e($to); ?>" >
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <button type="submit" class="btn btn-primary btn-block"><?php echo e(translate('Show Data')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-top px-card pt-4">
                <div class="row justify-content-between align-items-center gy-2">
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <form action="<?php echo e(url()->current()); ?>" method="GET">
                            <div class="input-group">
                                <input id="datatableSearch_" type="search" name="search"
                                        class="form-control"
                                        placeholder="<?php echo e(translate('Search by ID, customer or payment status')); ?>" aria-label="Search"
                                        value="<?php echo e($search); ?>" required autocomplete="off">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo e(translate('Search')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4 col-md-6 col-lg-8 d-flex justify-content-end">
                        <div>
                            <button type="button" class="btn btn-outline-primary" data-toggle="dropdown" aria-expanded="false">
                                <i class="tio-download-to"></i>
                                <?php echo e(translate('export')); ?>

                                <i class="tio-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a type="submit" class="dropdown-item d-flex align-items-center gap-2" href="<?php echo e(route('admin.pos.export-excel')); ?>?branch_id=<?php echo e($branch_id); ?>&from=<?php echo e($from); ?>&to=<?php echo e($to); ?>&search=<?php echo e($search); ?>">
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
                <div class="table-responsive datatable-custom">
                    <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>
                                <th>
                                    <?php echo e(translate('SL')); ?>

                                </th>
                                <th><?php echo e(translate('Order_ID')); ?></th>
                                <th><?php echo e(translate('Order_Date')); ?></th>
                                <th><?php echo e(translate('Customer_Info')); ?></th>
                                <th><?php echo e(translate('Branch')); ?></th>
                                <th><?php echo e(translate('Total_Amount')); ?></th>
                                <th><?php echo e(translate('Order_Status')); ?></th>
                                <th><?php echo e(translate('Order_Type')); ?></th>
                                <th class="text-center"><?php echo e(translate('actions')); ?></th>
                            </tr>
                        </thead>

                        <tbody id="set-rows">
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="status-<?php echo e($order['order_status']); ?> class-all">
                                <td><?php echo e($key+$orders->firstItem()); ?></td>
                                <td>
                                    <a class="text-dark" href="<?php echo e(route('admin.pos.order-details',['id'=>$order['id']])); ?>"><?php echo e($order['id']); ?></a>
                                </td>
                                <td>
                                    <div><?php echo e(date('d M Y',strtotime($order['created_at']))); ?></div>
                                    <div><?php echo e(date("h:i A",strtotime($order['created_at']))); ?></div>
                                </td>
                                <td>
                                    <?php if($order->customer): ?>
                                        <h6 class="text-capitalize mb-1"><?php echo e($order->customer['f_name'].' '.$order->customer['l_name']); ?></h6>
                                        <a class="text-dark fz-12" href="tel:<?php echo e($order->customer['phone']); ?>"><?php echo e($order->customer['phone']); ?></a>
                                    <?php elseif($order['user_id'] == null): ?>
                                        <h6 class="text-capitalize text-muted"><?php echo e(translate('walk_in_customer')); ?></h6>
                                    <?php else: ?>
                                        <h6 class="text-capitalize text-muted"><?php echo e(translate('Customer_Unavailable')); ?></h6>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($order->branch?->name); ?></td>
                                <td>
                                    <div><?php echo e(Helpers::set_symbol($order['order_amount'])); ?></div>
                                    <?php if($order->payment_status=='paid'): ?>
                                        <span class="text-success"><?php echo e(translate('paid')); ?></span>
                                    <?php else: ?>
                                        <span class="text-danger"><?php echo e(translate('unpaid')); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-capitalize">
                                    <?php if($order['order_status']=='pending'): ?>
                                        <span class="badge-soft-info px-2 rounded"><?php echo e(translate('pending')); ?></span>
                                    <?php elseif($order['order_status']=='confirmed'): ?>
                                        <span class="badge-soft-info px-2 rounded"><?php echo e(translate('confirmed')); ?></span>
                                    <?php elseif($order['order_status']=='processing'): ?>
                                        <span class="badge-soft-warning px-2 rounded"><?php echo e(translate('processing')); ?></span>
                                    <?php elseif($order['order_status']=='picked_up'): ?>
                                        <span class="badge-soft-warning px-2 rounded"><?php echo e(translate('out_for_delivery')); ?></span>
                                    <?php elseif($order['order_status']=='delivered'): ?>
                                        <span class="badge-soft-success px-2 rounded"><?php echo e(translate('delivered')); ?></span>
                                    <?php else: ?>
                                        <span class="badge-soft-danger px-2 rounded"><?php echo e(str_replace('_',' ',$order['order_status'])); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-capitalize">
                                    <span class="badge-soft-success px-2 py-1 rounded"><?php echo e(translate($order['order_type'])); ?></span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a class="btn btn-sm btn-outline-primary square-btn" href="<?php echo e(route('admin.pos.order-details',['id'=>$order['id']])); ?>">
                                            <i class="tio-invisible"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-success square-btn print-invoice-button" data-order-id="<?php echo e($order->id); ?>" type="button">
                                            <i class="tio-print"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="table-responsive mt-4 px-3">
                <div class="d-flex justify-content-lg-end">
                    <?php echo $orders->links(); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="print-invoice" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(translate('print')); ?> <?php echo e(translate('invoice')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row custom-modal-body">
                    <div class="col-md-12">
                        <center>
                            <input type="button" class="btn btn-primary non-printable print-button" value="<?php echo e(translate('Proceed, If thermal printer is ready..')); ?>" />
                            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger non-printable"><?php echo e(translate('Back')); ?></a>
                        </center>
                        <hr class="non-printable">
                    </div>
                    <div class="row custom-print-area-auto" id="printableArea">

                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/loyalty-point.js')); ?>"></script>
    <script>
        "use strict";

        $('.print-button').click(function() {
            printDiv('printableArea');
        });

        $('.print-invoice-button').click(function() {
            var orderId = $(this).data('order-id');
            print_invoice(orderId);
        });

        function print_invoice(order_id) {
            $.get({
                url: '<?php echo e(url('/')); ?>/admin/pos/invoice/'+order_id,
                dataType: 'json',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    console.log("success...")
                    $('#print-invoice').modal('show');
                    $('#printableArea').empty().html(data.view);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

    function printDiv(divName) {

        if($('html').attr('dir') === 'rtl') {
            $('html').attr('dir', 'ltr')
            var printContents = document.getElementById(divName).innerHTML;
            document.body.innerHTML = printContents;
            $('#printableAreaContent').attr('dir', 'rtl')
            window.print();
            $('html').attr('dir', 'rtl')
            location.reload();
        }else{
            var printContents = document.getElementById(divName).innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            location.reload();
        }

    }
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/pos/order/list.blade.php ENDPATH**/ ?>