<?php $__env->startSection('title', translate('Earning Report')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/online-survey.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('Earning_Report')); ?>

                </span>
            </h2>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="media flex-column flex-sm-row flex-wrap align-items-sm-center gap-4 mb-4">
                    <div class="avatar avatar-xl">
                        <img class="avatar-img" src="<?php echo e(asset('public/assets/admin')); ?>/svg/illustrations/earnings.png"
                                alt="<?php echo e(translate('earning')); ?>">
                    </div>

                    <div class="media-body">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div class="">
                                <h2 class="page-header-title mb-2"><?php echo e(translate('earning_report_overview')); ?></h2>

                                <div>
                                    <div class="mb-1">
                                        <span><?php echo e(translate('admin')); ?>:</span>
                                        <a href="#"><?php echo e(auth('admin')->user()->f_name.' '.auth('admin')->user()->l_name); ?></a>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <div><?php echo e(translate('date')); ?> :</div>
                                        <div>
                                            ( <?php echo e(date('Y-m-d '. config('time_format'),strtotime(session('from_date')))); ?> - <?php echo e(date('Y-m-d '. config('time_format'),strtotime(session('to_date')))); ?> )
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex">
                                <a class="btn btn-icon btn-primary px-2 rounded-circle" href="<?php echo e(route('admin.dashboard')); ?>">
                                    <i class="tio-home-outlined"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-12">
                        <form action="<?php echo e(url()->current()); ?>" method="get">
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="">
                                        <h4 class="form-label mb-0"><?php echo e(translate('Show Data by Date Range')); ?></h4>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="">
                                        <input type="date" name="from" id="from_date" value="<?php echo e($startDate); ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="">
                                        <input type="date" name="to" id="to_date" value="<?php echo e($endDate); ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary btn-block"><?php echo e(translate('show')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

<?php
    if ($total_sold == 0) {
        $total_sold = 0.01;
    }
     if ($total_tax == 0) {
         $total_tax = 0.01;
     }

    ?>

                    <div class="col-sm-6">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="media">
                                            <i class="tio-dollar-outlined nav-icon"></i>

                                            <div class="media-body">
                                                <h4 class="mb-1"><?php echo e(translate('total')); ?> <?php echo e(translate('sold')); ?></h4>
                                                <span class="font-size-sm text-success">
                                                <i class="tio-trending-up"></i> <?php echo e(\App\CentralLogics\Helpers::set_symbol(round(abs($total_sold-$total_tax)))); ?>

                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <div class="js-circle"
                                            data-hs-circles-options='{
                                            "value": <?php echo e($total_sold=='.01'?0:round((($total_sold-$total_tax)/$total_sold)*100)); ?>,
                                            "maxValue": 100,
                                            "duration": 2000,
                                            "isViewportInit": true,
                                            "colors": ["#e7eaf3", "green"],
                                            "radius": 25,
                                            "width": 3,
                                            "fgStrokeLinecap": "round",
                                            "textFontSize": 14,
                                            "additionalText": "%",
                                            "textClass": "circle-custom-text",
                                            "textColor": "green"
                                            }'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="media">
                                            <i class="tio-money nav-icon"></i>
                                            <div class="media-body">
                                                <h4 class="mb-1"><?php echo e(translate('total')); ?> <?php echo e(translate('tax')); ?></h4>
                                                <span class="font-size-sm text-warning">
                                                <i class="tio-trending-up"></i> <?php echo e(\App\CentralLogics\Helpers::set_symbol(round(abs($total_tax)))); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <div class="js-circle"
                                            data-hs-circles-options='{
                                            "value": <?php echo e($total_tax=='0.01'?0:round(((abs($total_tax))/$total_sold)*100)); ?>,
                                            "maxValue": 100,
                                            "duration": 2000,
                                            "isViewportInit": true,
                                            "colors": ["#e7eaf3", "#ec9a3c"],
                                            "radius": 25,
                                            "width": 3,
                                            "fgStrokeLinecap": "round",
                                            "textFontSize": 14,
                                            "additionalText": "%",
                                            "textClass": "circle-custom-text",
                                            "textColor": "#ec9a3c"
                                            }'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between flex-wrap gap-2">
                <?php
                    $total_sold=\App\Model\Order::where(['order_status'=>'delivered'])->whereBetween('created_at', [date('y-01-01'), date('y-12-31')])->sum('order_amount')
                ?>
                <h6 class="d-flex align-items-center gap-2 mb-0">
                    <?php echo e(translate('Total_Sale')); ?> (<?php echo e(date('Y')); ?>) :
                    <span class="h4 mb-0"> <?php echo e(\App\CentralLogics\Helpers::set_symbol($total_sold)); ?></span>
                </h6>

                <a class="js-hs-unfold-invoker btn btn-white"
                    href="<?php echo e(route('admin.orders.list',['status'=>'all'])); ?>">
                    <i class="tio-shopping-cart-outlined"></i> <?php echo e(translate('orders')); ?>

                </a>
            </div>

            <?php
                $sold=[];
                    for ($i=1;$i<=12;$i++){
                        $from = date('Y-'.$i.'-01');
                        $to = date('Y-'.$i.'-30');
                        $sold[$i]=Helpers::set_price(\App\Model\Order::where(['order_status'=>'delivered'])->whereBetween('created_at', [$from, $to])->sum('order_amount'));
                    }
            ?>

            <?php
                $tax=[];
                    for ($i=1;$i<=12;$i++){
                        $from = date('Y-'.$i.'-01');
                        $to = date('Y-'.$i.'-30');
                        $tax[$i]=\App\Model\Order::where(['order_status'=>'delivered'])->whereBetween('created_at', [$from, $to])->sum('total_tax_amount');
                    }
            ?>

            <div class="card-body">
                <div class="chartjs-custom height-360px">
                    <canvas class="js-chart"
                            data-hs-chartjs-options='{
                        "type": "line",
                        "data": {
                           "labels": ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
                           "datasets": [{
                            "data": [<?php echo e($sold[1]); ?>,<?php echo e($sold[2]); ?>,<?php echo e($sold[3]); ?>,<?php echo e($sold[4]); ?>,<?php echo e($sold[5]); ?>,<?php echo e($sold[6]); ?>,<?php echo e($sold[7]); ?>,<?php echo e($sold[8]); ?>,<?php echo e($sold[9]); ?>,<?php echo e($sold[10]); ?>,<?php echo e($sold[11]); ?>,<?php echo e($sold[12]); ?>],
                            "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                            "borderColor": "green",
                            "borderWidth": 2,
                            "pointRadius": 0,
                            "pointBorderColor": "#fff",
                            "pointBackgroundColor": "green",
                            "pointHoverRadius": 0,
                            "hoverBorderColor": "#fff",
                            "hoverBackgroundColor": "#377dff"
                          },
                          {
                            "data": [<?php echo e($tax[1]); ?>,<?php echo e($tax[2]); ?>,<?php echo e($tax[3]); ?>,<?php echo e($tax[4]); ?>,<?php echo e($tax[5]); ?>,<?php echo e($tax[6]); ?>,<?php echo e($tax[7]); ?>,<?php echo e($tax[8]); ?>,<?php echo e($tax[9]); ?>,<?php echo e($tax[10]); ?>,<?php echo e($tax[11]); ?>,<?php echo e($tax[12]); ?>],
                            "backgroundColor": ["rgba(0, 201, 219, 0)", "rgba(255, 255, 255, 0)"],
                            "borderColor": "#ec9a3c",
                            "borderWidth": 2,
                            "pointRadius": 0,
                            "pointBorderColor": "#fff",
                            "pointBackgroundColor": "#ec9a3c",
                            "pointHoverRadius": 0,
                            "hoverBorderColor": "#fff",
                            "hoverBackgroundColor": "#00c9db"
                          }]
                        },
                        "options": {
                          "gradientPosition": {"y1": 200},
                           "scales": {
                              "yAxes": [{
                                "gridLines": {
                                  "color": "#e7eaf3",
                                  "drawBorder": false,
                                  "zeroLineColor": "#e7eaf3"
                                },
                                "ticks": {
                                  "min": 0,
                                  "max": <?php echo e(\App\CentralLogics\Helpers::max_earning()); ?>,
                                  "stepSize": <?php echo e(round(\App\CentralLogics\Helpers::max_earning()/5)); ?>,
                                  "fontColor": "#97a4af",
                                  "fontFamily": "Open Sans, sans-serif",
                                  "padding": 10,
                                  "postfix": " <?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?>"
                                }
                              }],
                              "xAxes": [{
                                "gridLines": {
                                  "display": false,
                                  "drawBorder": false
                                },
                                "ticks": {
                                  "fontSize": 12,
                                  "fontColor": "#97a4af",
                                  "fontFamily": "Open Sans, sans-serif",
                                  "padding": 5
                                }
                              }]
                          },
                          "tooltips": {
                            "prefix": "",
                            "postfix": "",
                            "hasIndicator": true,
                            "mode": "index",
                            "intersect": false,
                            "lineMode": true,
                            "lineWithLineColor": "rgba(19, 33, 68, 0.075)"
                          },
                          "hover": {
                            "mode": "nearest",
                            "intersect": true
                          }
                        }
                      }'>
                    </canvas>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin')); ?>/vendor/chart.js/dist/Chart.min.js"></script>

    <script>
        "use strict";

        $('.js-chart').each(function () {
            $.HSCore.components.HSChartJS.init($(this));
        });

        $('.js-circle').each(function () {
            var circle = $.HSCore.components.HSCircles.init($(this));
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

        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/report/earning-index.blade.php ENDPATH**/ ?>