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
                <?php echo e(translate($status)); ?> <?php echo e(translate('Orders')); ?>

                </span>
            </h2>
            <span class="badge badge-soft-dark rounded-50 fz-14"><?php echo e($orders->total()); ?></span>
        </div>

        <div class="card">
            <div class="card">
                <div class="card-body">
                    <form action="#" id="form-data" method="GET">
                        <input type="hidden" name="search" value="<?php echo e($search); ?>">
                        <div class="row gy-3 gx-2 align-items-end">
                            <div class="col-12 pb-0">
                                <h4 class="mb-0"><?php echo e(translate('select_date_range')); ?></h4>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <label for="select_branch"><?php echo e(translate('Select_Branch')); ?></label>
                                <select class="form-control select-branch" name="branch_id" id="select_branch">
                                    <option disabled selected>--- <?php echo e(translate('select')); ?> <?php echo e(translate('branch')); ?> ---</option>
                                    <option value="0" <?php echo e($branchId==0?'selected':''); ?>><?php echo e(translate('all')); ?> <?php echo e(translate('branch')); ?></option>
                                    <?php $__currentLoopData = \App\Model\Branch::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($branch['id']); ?>" <?php echo e($branchId==$branch['id']?'selected':''); ?>><?php echo e($branch['name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="form-group mb-0">
                                    <label class="text-dark"><?php echo e(translate('Start Date')); ?></label>
                                    <input type="date" name="from" value="<?php echo e($from); ?>" id="from_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="form-group mb-0">
                                    <label class="text-dark"><?php echo e(translate('End Date')); ?></label>
                                    <input type="date" value="<?php echo e($to); ?>" name="to" id="to_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 d-flex gap-2">
                                <a href="<?php echo e(route('admin.orders.list',['all'])); ?>" class="btn btn-secondary flex-grow-1"><?php echo e(translate('Clear')); ?></a>
                                <button type="submit" class="btn btn-primary text-nowrap flex-grow-1"><?php echo e(translate('Show Data')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php if($status == 'all'): ?>
                <div class="px-4 mt-4">
                    <div class="row g-2">

                        <div class="col-sm-6 col-lg-3">
                            <a class="order--card h-100" href="<?php echo e(route('admin.orders.list', ['status' => 'confirmed'])); ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                        <img src="<?php echo e(asset('public/assets/admin/img/icons/confirmed.png')); ?>" alt="" class="oder--card-icon">
                                        <span><?php echo e(translate('confirmed')); ?></span>
                                    </h6>
                                    <span class="card-title text-107980">
                                <?php echo e($orderCount['confirmed']); ?> 
                            </span>
                                </div>
                            </a>
                        </div>
                        
                        


                        <div class="col-sm-6 col-lg-3">
                            <a class="order--card h-100" href="<?php echo e(route('admin.orders.list', ['status' => 'pending'])); ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                        <img src="<?php echo e(asset('public/assets/admin/img/icons/pending.png')); ?>" alt="" class="oder--card-icon">
                                        <span><?php echo e(translate('Pending')); ?></span>
                                    </h6>
                                    <span class="card-title text-0661CB">
                                    <?php echo e($orderCount['pending']); ?>

                            </span>
                                </div>
                            </a>
                        </div>


                        <div class="col-sm-6 col-lg-3">
                            <a class="order--card h-100" href="<?php echo e(route('admin.orders.list', ['status' => 'processing'])); ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                        <img src="<?php echo e(asset('public/assets/admin/img/icons/packaging.png')); ?>" alt="" class="oder--card-icon">
                                        <span><?php echo e(translate('processing')); ?></span>
                                    </h6>
                                    <span class="card-title text-danger">
                                <?php echo e($orderCount['processing']); ?>

                            </span>
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <a class="order--card h-100" href="<?php echo e(route('admin.orders.list', ['status' => 'out_for_delivery'])); ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                        <img src="<?php echo e(asset('public/assets/admin/img/icons/out_for_delivery.png')); ?>" alt="" class="oder--card-icon">
                                        <span><?php echo e(translate('out_for_delivery')); ?></span>
                                    </h6>
                                    <span class="card-title text-00B2BE">
                                <?php echo e($orderCount['out_for_delivery']); ?>

                            </span>
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <a class="order--card h-100" href="<?php echo e(route('admin.orders.list', ['status' => 'delivered'])); ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                        <img src="<?php echo e(asset('public/assets/admin/img/icons/delivered.png')); ?>" alt="" class="oder--card-icon">
                                        <span><?php echo e(translate('delivered')); ?></span>
                                    </h6>
                                    <span class="card-title text-success">
                                <?php echo e($orderCount['delivered']); ?>

                            </span>
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <a class="order--card h-100" href="<?php echo e(route('admin.orders.list', ['status' => 'canceled'])); ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                        <img src="<?php echo e(asset('public/assets/admin/img/icons/canceled.png')); ?>" alt="" class="oder--card-icon">
                                        <span><?php echo e(translate('canceled')); ?></span>
                                    </h6>
                                    <span class="card-title text-danger">
                                <?php echo e($orderCount['canceled']); ?>

                            </span>
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <a class="order--card h-100" href="<?php echo e(route('admin.orders.list', ['status' => 'returned'])); ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                        <img src="<?php echo e(asset('public/assets/admin/img/icons/returned.png')); ?>" alt="dashboard" class="oder--card-icon">
                                        <span><?php echo e(translate('returned')); ?></span>
                                    </h6>
                                    <span class="card-title text-warning">
                                <?php echo e($orderCount['returned']); ?>

                            </span>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <a class="order--card h-100" href="<?php echo e(route('admin.orders.list', ['status' => 'failed'])); ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                        <img src="<?php echo e(asset('public/assets/admin/img/icons/failed_to_deliver.png')); ?>" alt="dashboard" class="oder--card-icon">
                                        <span><?php echo e(translate('failed_to_deliver')); ?></span>
                                    </h6>
                                    <span class="card-title text-danger">
                                <?php echo e($orderCount['failed']); ?>

                            </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card-top px-card pt-4">
                <div class="row justify-content-between align-items-center gy-2">
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <form action="<?php echo e(url()->current()); ?>" method="GET">
                            <input type="hidden" name="branch_id" value="<?php echo e($branchId); ?>">
                            <input type="hidden" name="from" value="<?php echo e($from); ?>">
                            <input type="hidden" name="to" value="<?php echo e($to); ?>">
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
                    <div class="col-sm-4 col-md-6 col-lg-8 d-flex justify-content-end">
                        <div>
                            <button type="button" class="btn btn-outline-primary" data-toggle="dropdown" aria-expanded="false">
                                <i class="tio-download-to"></i>
                                <?php echo e(translate('export')); ?>

                                <i class="tio-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a type="submit" class="dropdown-item d-flex align-items-center gap-2" href="<?php echo e(route('admin.orders.export-excel', ['search'=>$search, 'from' =>$from, 'to' => $to, 'status'=> $status, 'branch_id' => $branchId])); ?>">
                                        <img width="14" src="<?php echo e(asset('public/assets/admin/img/icons/excel.png')); ?>" alt="">
                                        <?php echo e(translate('excel')); ?>

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
                                <th><?php echo e(translate('SL')); ?></th>
                                <th><?php echo e(translate('Order_ID')); ?></th>
                                <th><?php echo e(translate('Delivery_Date')); ?></th>
                                <th><?php echo e(translate('Customer_Info')); ?></th>
                                <th><?php echo e(translate('branch')); ?></th>
                                <th><?php echo e(translate('Total_Amount')); ?></th>
                                <th><?php echo e(translate('Order_Status')); ?></th>
                                <th><?php echo e(translate('Order_Type')); ?></th>
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
                                    <span class="badge-soft-info px-2 py-1 rounded"><?php echo e($order->branch?$order->branch->name:'Branch deleted!'); ?></span>
                                </td>
                                <td>
                                    <div><?php echo e(Helpers::set_symbol($order['order_amount'] + $order['delivery_charge'])); ?></div>
                                    <?php if($order->payment_status=='paid'): ?>
                                        <span class="text-success"><?php echo e(translate('paid')); ?></span>
                                    <?php else: ?>
                                        <span class="text-danger"><?php echo e(translate('unpaid')); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-capitalize">
                                    <?php if($order['order_status']=='pending'): ?>
                                        <span class="badge-soft-info px-2 py-1 rounded"><?php echo e(translate('pending')); ?></span>
                                    <?php elseif($order['order_status']=='confirmed'): ?>
                                        <span class="badge-soft-info px-2 py-1 rounded"><?php echo e(translate('confirmed')); ?></span>
                                    <?php elseif($order['order_status']=='processing'): ?>
                                        <span class="badge-soft-warning px-2 py-1 rounded"><?php echo e(translate('processing')); ?></span>
                                    <?php elseif($order['order_status']=='out_for_delivery'): ?>
                                        <span class="badge-soft-warning px-2 py-1 rounded"><?php echo e(translate('out_for_delivery')); ?></span>
                                    <?php elseif($order['order_status']=='delivered'): ?>
                                        <span class="badge-soft-success px-2 py-1 rounded"><?php echo e(translate('delivered')); ?></span>
                                    <?php elseif($order['order_status']=='failed'): ?>
                                        <span class="badge-soft-danger px-2 py-1 rounded"><?php echo e(translate("failed_to_deliver")); ?></span>
                                    <?php else: ?>
                                        <span class="badge-soft-danger px-2 py-1 rounded"><?php echo e(str_replace('_',' ',$order['order_status'])); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge-soft-success px-2 py-1 rounded"><?php echo e(translate($order['order_type'])); ?></span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a class="btn btn-sm btn-outline-primary square-btn" href="<?php echo e(route('admin.orders.details',['id'=>$order['id']])); ?>">
                                            <i class="tio-invisible"></i>
                                        </a>
                                        <a href="<?php echo e(route('admin.orders.generate-invoice',[$order['id']])); ?>" class="btn btn-sm btn-outline-success square-btn" target="_blank">
                                            <i class="tio-print"></i>
                                        </a>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>













<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/order/list.blade.php ENDPATH**/ ?>