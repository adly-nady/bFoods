<?php $__env->startSection('title', translate('Sale Report')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/sales.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('Sale_Report')); ?>

                </span>
            </h2>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="media flex-column flex-sm-row flex-wrap align-items-sm-center gap-4">
                    <div class="avatar avatar-xl">
                        <img class="avatar-img" src="<?php echo e(asset('public/assets/admin')); ?>/svg/illustrations/credit-card.svg"
                            alt="<?php echo e(translate('sale_report')); ?>">
                    </div>

                    <div class="media-body">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div class="">
                                <h2 class="page-header-title"><?php echo e(translate('sale')); ?> <?php echo e(translate('report')); ?> <?php echo e(translate('overview')); ?></h2>

                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span><?php echo e(translate('admin')); ?>:</span>
                                        <a href="#"><?php echo e(auth('admin')->user()->f_name.' '.auth('admin')->user()->l_name); ?></a>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex">
                                <a class="btn btn-icon btn-primary rounded-circle px-2" href="<?php echo e(route('admin.dashboard')); ?>">
                                    <i class="tio-home-outlined"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <form action="javascript:" id="search-form" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row g-2">
                        <div class="col-sm-6 col-md-4">
                            <select class="custom-select custom-select" name="branch_id" id="branch_id" required>
                                <option  disabled><?php echo e(translate('Select Branch')); ?></option>
                                <option value="all">All</option>
                                <?php $__currentLoopData = \App\Model\Branch::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($branch['id']); ?>" <?php echo e(session('branch_filter')==$branch['id']?'selected':''); ?>><?php echo e($branch['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <input type="date" name="from" id="from_date" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <input type="date" name="to" id="to_date" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <button type="submit" class="btn btn-primary btn-block"><?php echo e(translate('show')); ?></button>
                        </div>

                        <div class="col-md-6 d-flex flex-column gap-2">
                            <div>
                                <strong>
                                    <?php echo e(translate('total_Orders')); ?> :
                                    <span id="order_count"> </span>
                                </strong>
                            </div>
                            <div>
                                <strong>
                                    <?php echo e(translate('total_Item_Qty')); ?>

                                    : <span
                                        id="item_count"> </span>
                                </strong>
                            </div>
                            <div>
                                <strong><?php echo e(translate('total')); ?>  <?php echo e(translate('amount')); ?> : <span
                                        id="order_amount"></span>
                                </strong>
                            </div>
                        </div>
                    </div>
                </form>

                <hr>

                <div class="table-responsive datatable_wrapper_row mt-5" id="set-rows">
                    <?php echo $__env->make('admin-views.report.partials._table',['data'=>[]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        $('#search-form').on('submit', function () {
            $.post({
                url: "<?php echo e(route('admin.report.sale-report-filter')); ?>",
                data: $('#search-form').serialize(),

                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#order_count').html(data.order_count);
                    $('#order_amount').html(data.order_sum);
                    $('#item_count').html(data.item_qty);
                    $('#set-rows').html(data.view);
                    $('.card-footer').hide();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });

        $('#from_date,#to_date').change(function () {
            let fr = $('#from_date').val();
            let to = $('#to_date').val();
            if (fr != '' && to != '') {
                if (fr > to) {
                    $('#from_date').val('');
                    $('#to_date').val('');
                    toastr.error('Invalid date range!', Error, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('input').addClass('form-control');
        });


        var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
            dom: 'Bfrtip',
            language: {
                zeroRecords: '<div class="text-center p-4">' +
                    '<img class="mb-3" src="<?php echo e(asset('public/assets/admin')); ?>/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
                    '<p class="mb-0"><?php echo e(translate('No data to show')); ?></p>' +
                    '</div>'
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/report/sale-report.blade.php ENDPATH**/ ?>