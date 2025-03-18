<?php $__env->startSection('title', translate('verify_offline_payments')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div>
            <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                <h2 class="h1 mb-0 d-flex align-items-center gap-1">
                    <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/all_orders.png')); ?>" alt="">
                    <span class="page-header-title">
                    <?php echo e(translate('verify_offline_payments')); ?>

                </span>
                </h2>
                <span class="badge badge-soft-dark rounded-50 fz-14"><?php echo e($orders->total()); ?></span>
            </div>
            <ul class="nav nav-tabs border-0 my-2">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('admin/verify-offline-payment/pending')?'active':''); ?>"  href="<?php echo e(route('admin.verify-offline-payment', ['pending'])); ?>"><?php echo e(translate('Pending Orders')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('admin/verify-offline-payment/denied')?'active':''); ?>"  href="<?php echo e(route('admin.verify-offline-payment', ['denied'])); ?>"><?php echo e(translate('Denied Orders')); ?></a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-top px-card pt-4">
                <div class="row justify-content-between align-items-center gy-2">
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <form action="<?php echo e(url()->current()); ?>" method="GET">
                            <div class="input-group">
                                <input id="datatableSearch_" type="search" name="search"
                                       class="form-control"
                                       placeholder="<?php echo e(translate('Search by Order ID, Order Status or Transaction Reference')); ?>" aria-label="Search"
                                       value="<?php echo e($search); ?>" required autocomplete="off">
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

            <div class="py-4">
                <div class="table-responsive datatable-custom">
                    <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                        <tr>
                            <th><?php echo e(translate('SL')); ?></th>
                            <th><?php echo e(translate('Order_ID')); ?></th>
                            <th><?php echo e(translate('Delivery_Date')); ?></th>
                            <th><?php echo e(translate('Customer_Info')); ?></th>
                            <th><?php echo e(translate('Total_Amount')); ?></th>
                            <th><?php echo e(translate('Payment_method')); ?></th>
                            <th><?php echo e(translate('Verification_status')); ?></th>
                            <th class="text-center"><?php echo e(translate('actions')); ?></th>
                        </tr>
                        </thead>

                        <tbody id="set-rows">
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="status-<?php echo e($order['order_status']); ?> class-all">
                                <td><?php echo e($orders->firstitem()+$key); ?></td>
                                <td>
                                    <a class="text-dark" href="<?php echo e(route('admin.orders.details',['id'=>$order['id']])); ?>"><?php echo e($order['id']); ?></a>
                                </td>
                                <td>
                                    <div><?php echo e(date('d M Y',strtotime($order['delivery_date']))); ?></div>
                                    <div><?php echo e(date('h:i A',strtotime($order['delivery_time']))); ?></div>
                                </td>
                                <td>
                                    <?php if($order->is_guest == 0): ?>
                                        <?php if($order->customer): ?>
                                            <h6 class="text-capitalize mb-1">
                                                <a class="text-dark" href="<?php echo e(route('admin.customer.view',[$order['user_id']])); ?>"><?php echo e($order->customer['f_name'].' '.$order->customer['l_name']); ?></a>
                                            </h6>
                                            <a class="text-dark fz-12" href="tel:<?php echo e($order->customer->phone); ?>"><?php echo e($order->customer->phone); ?></a>
                                        <?php else: ?>
                                            <span class="text-capitalize text-muted">
                                            <?php echo e(translate('Customer_Unavailable')); ?>

                                            </span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <h6 class="text-capitalize text-info">
                                            <?php echo e(translate('Guest Customer')); ?>

                                        </h6>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div><?php echo e(Helpers::set_symbol($order['order_amount'] + $order['delivery_charge'])); ?></div>
                                </td>

                                <td>
                                        <?php
                                        $paymentInfo = json_decode($order->offline_payment?->payment_info, true);
                                        ?>
                                    <?php echo e($paymentInfo['payment_name']); ?>

                                </td>
                                <td class="text-capitalize">
                                    <?php if($order->offline_payment?->status == 0): ?>
                                        <span class="badge badge-soft-info">
                                            <?php echo e(translate('pending')); ?>

                                        </span>
                                    <?php elseif($order->offline_payment?->status == 2): ?>
                                        <span class="badge badge-soft-danger">
                                            <?php echo e(translate('denied')); ?>

                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn--container justify-content-center">
                                        <button class="btn btn-primary" type="button" id="offline_details"
                                                onclick="get_offline_payment(this)" data-id="<?php echo e($order['id']); ?>"
                                                data-target="" data-toggle="modal">
                                            <?php echo e(translate('Verify_Payment')); ?>

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


    <div class="modal fade" id="quick-view" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered coupon-details modal-lg" role="document">
            <div class="modal-content" id="quick-view-modal">
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";

        function get_offline_payment(t){
            let id = $(t).data('id')

            $.ajax({
                type: 'GET',
                url: '<?php echo e(route('admin.offline-modal-view')); ?>',
                data: {
                    id: id
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#loading').hide();
                    $('#quick-view').modal('show');
                    $('#quick-view-modal').empty().html(data.view);
                }
            });
        }

        function verify_offline_payment(order_id, status) {
            $.ajax({
                type: "GET",
                url: '<?php echo e(url('/')); ?>/admin/orders/verify-offline-payment/'+ order_id+ '/' + status,
                success: function (data) {
                    location.reload();
                    if(data.status == true) {
                        toastr.success('<?php echo e(translate("offline payment verify status changed")); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }else{
                        toastr.error('<?php echo e(translate("offline payment verify status not changed")); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }

                },
                error: function () {
                }
            });
        }


    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/order/offline-payment/list.blade.php ENDPATH**/ ?>