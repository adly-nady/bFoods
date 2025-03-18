<?php $__env->startSection('title', translate('Order Report')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/order_report.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('Order_Report')); ?>

                </span>
            </h2>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="media flex-column flex-sm-row flex-wrap align-items-sm-center gap-4">
                    <div class="avatar avatar-xl">
                        <img class="avatar-img" src="<?php echo e(asset('public/assets/admin')); ?>/svg/illustrations/order.png" alt="<?php echo e(translate('order_report')); ?>">
                    </div>

                    <div class="media-body">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div class="">
                                <h2 class="page-header-title mb-2"><?php echo e(translate('order_Report_Overview')); ?></h2>

                                <div class="">
                                    <div class="mb-1">
                                        <span><?php echo e(translate('admin')); ?>:</span>
                                        <a href="#"><?php echo e(auth('admin')->user()->f_name.' '.auth('admin')->user()->l_name); ?></a>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <div class=""><?php echo e(translate('date')); ?></div>

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

        <div class="card mt-3">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-12">
                        <form action="<?php echo e(route('admin.report.set-date')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="">
                                        <h4 class="form-label mb-0"><?php echo e(translate('Show Data by Date Range')); ?></h4>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="">
                                        <input type="date" name="from" id="from_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="">
                                        <input type="date" name="to" id="to_date"
                                            class="form-control" required>
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
                        $from = session('from_date');
                        $to = session('to_date');
                        $total=\App\Model\Order::whereBetween('created_at', [$from, $to])->count();
                        if($total==0){
                        $total=.01;
                        }
                    ?>
                    <div class="col-sm-6 col-lg-3">
                        <?php
                            $delivered=\App\Model\Order::where(['order_status'=>'delivered'])->whereBetween('created_at', [$from, $to])->count()
                        ?>
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="media">
                                            <i class="tio-shopping-cart nav-icon"></i>

                                            <div class="media-body">
                                                <h4 class="mb-1"><?php echo e(translate('delivered')); ?></h4>
                                                <span class="font-size-sm text-success">
                                                <i class="tio-trending-up"></i> <?php echo e($delivered); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <!-- Circle -->
                                        <div class="js-circle"
                                            data-hs-circles-options='{
                                            "value": <?php echo e(round(($delivered/$total)*100)); ?>,
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
                                        <!-- End Circle -->
                                    </div>
                                </div>
                                <!-- End Row -->
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <?php
                            $returned=\App\Model\Order::where(['order_status'=>'returned'])->whereBetween('created_at', [$from, $to])->count()
                        ?>
                        <!-- Card -->
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <!-- Media -->
                                        <div class="media">
                                            <i class="tio-shopping-cart-off nav-icon"></i>

                                            <div class="media-body">
                                                <h4 class="mb-1"><?php echo e(translate('returned')); ?></h4>
                                                <span class="font-size-sm text-warning">
                                                <i class="tio-trending-up"></i> <?php echo e($returned); ?>

                                                </span>
                                            </div>
                                        </div>
                                        <!-- End Media -->
                                    </div>

                                    <div class="col-auto">
                                        <!-- Circle -->
                                        <div class="js-circle"
                                            data-hs-circles-options='{
                                "value": <?php echo e(round(($returned/$total)*100)); ?>,
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
                                }'></div>
                                        <!-- End Circle -->
                                    </div>
                                </div>
                                <!-- End Row -->
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <?php
                            $failed=\App\Model\Order::where(['order_status'=>'failed'])->whereBetween('created_at', [$from, $to])->count()
                        ?>
                        <!-- Card -->
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <!-- Media -->
                                        <div class="media">
                                            <i class="tio-message-failed nav-icon"></i>

                                            <div class="media-body">
                                                <h4 class="mb-1"><?php echo e(translate('failed')); ?></h4>
                                                <span class="font-size-sm text-danger">
                                                <i class="tio-trending-up"></i> <?php echo e($failed); ?>

                                                </span>
                                            </div>
                                        </div>
                                        <!-- End Media -->
                                    </div>

                                    <div class="col-auto">
                                        <!-- Circle -->
                                        <div class="js-circle"
                                            data-hs-circles-options='{
                                "value": <?php echo e(round(($failed/$total)*100)); ?>,
                                "maxValue": 100,
                                "duration": 2000,
                                "isViewportInit": true,
                                "colors": ["#e7eaf3", "darkred"],
                                "radius": 25,
                                "width": 3,
                                "fgStrokeLinecap": "round",
                                "textFontSize": 14,
                                "additionalText": "%",
                                "textClass": "circle-custom-text",
                                "textColor": "darkred"
                                }'></div>
                                        <!-- End Circle -->
                                    </div>
                                </div>
                                <!-- End Row -->
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <?php
                            $canceled=\App\Model\Order::where(['order_status'=>'canceled'])->whereBetween('created_at', [$from, $to])->count()
                        ?>
                        <!-- Card -->
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <!-- Media -->
                                        <div class="media">
                                            <i class="tio-flight-cancelled nav-icon"></i>

                                            <div class="media-body">
                                                <h4 class="mb-1"><?php echo e(translate('canceled')); ?></h4>
                                                <span class="font-size-sm text-muted">
                                                <i class="tio-trending-up"></i> <?php echo e($canceled); ?>

                                                </span>
                                            </div>
                                        </div>
                                        <!-- End Media -->
                                    </div>

                                    <div class="col-auto">
                                        <!-- Circle -->
                                        <div class="js-circle"
                                            data-hs-circles-options='{
                                "value": <?php echo e(round(($canceled/$total)*100)); ?>,
                                "maxValue": 100,
                                "duration": 2000,
                                "isViewportInit": true,
                                "colors": ["#e7eaf3", "gray"],
                                "radius": 25,
                                "width": 3,
                                "fgStrokeLinecap": "round",
                                "textFontSize": 14,
                                "additionalText": "%",
                                "textClass": "circle-custom-text",
                                "textColor": "gray"
                                }'></div>
                                        <!-- End Circle -->
                                    </div>
                                </div>
                                <!-- End Row -->
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="card mt-3">
            <!-- Header -->
            <div class="card-header flex-wrap d-flex align-items-center gap-2">
                <?php
                    $x=1;
                    $y=12;
                    $total=\App\Model\Order::whereBetween('created_at', [date('Y-'.$x.'-01'), date('Y-'.$y.'-30')])->count()
                ?>
                <h6 class="d-flex align-items-center gap-2 mb-0"><?php echo e(translate('total')); ?> <?php echo e(translate('orders')); ?> of <?php echo e(date('Y')); ?>: <span
                        class="h4 mb-0"><?php echo e(round($total)); ?></span>
                </h6>

                <a class="js-hs-unfold-invoker btn btn-white"
                    href="<?php echo e(route('admin.orders.list',['status'=>'all'])); ?>">
                    <i class="tio-shopping-cart-outlined mr-1"></i> <?php echo e(translate('orders')); ?>

                </a>
            </div>
            <!-- End Header -->

            <?php
                $delivered=[];
                    for ($i=1;$i<=12;$i++){
                        $from = date('Y-'.$i.'-01');
                        $to = date('Y-'.$i.'-30');
                        $delivered[$i]=\App\Model\Order::where(['order_status'=>'delivered'])->whereBetween('created_at', [$from, $to])->count();
                    }
            ?>

            <?php
                $ret=[];
                    for ($i=1;$i<=12;$i++){
                        $from = date('Y-'.$i.'-01');
                        $to = date('Y-'.$i.'-30');
                        $ret[$i]=\App\Model\Order::where(['order_status'=>'returned'])->whereBetween('created_at', [$from, $to])->count();
                    }
            ?>

            <?php
                $fai=[];
                    for ($i=1;$i<=12;$i++){
                        $from = date('Y-'.$i.'-01');
                        $to = date('Y-'.$i.'-30');
                        $fai[$i]=\App\Model\Order::where(['order_status'=>'failed'])->whereBetween('created_at', [$from, $to])->count();
                    }
            ?>

            <?php
                $can=[];
                    for ($i=1;$i<=12;$i++){
                        $from = date('Y-'.$i.'-01');
                        $to = date('Y-'.$i.'-30');
                        $can[$i]=\App\Model\Order::where(['order_status'=>'canceled'])->whereBetween('created_at', [$from, $to])->count();
                    }
            ?>

            <div class="card-body">
                <div class="chartjs-custom height-18rem">
                    <canvas class="js-chart"
                            data-hs-chartjs-options='{
                        "type": "line",
                        "data": {
                           "labels": ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
                           "datasets": [{
                            "data": [<?php echo e($delivered[1]); ?>,<?php echo e($delivered[2]); ?>,<?php echo e($delivered[3]); ?>,<?php echo e($delivered[4]); ?>,<?php echo e($delivered[5]); ?>,<?php echo e($delivered[6]); ?>,<?php echo e($delivered[7]); ?>,<?php echo e($delivered[8]); ?>,<?php echo e($delivered[9]); ?>,<?php echo e($delivered[10]); ?>,<?php echo e($delivered[11]); ?>,<?php echo e($delivered[12]); ?>],
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
                            "data": [<?php echo e($ret[1]); ?>,<?php echo e($ret[2]); ?>,<?php echo e($ret[3]); ?>,<?php echo e($ret[4]); ?>,<?php echo e($ret[5]); ?>,<?php echo e($ret[6]); ?>,<?php echo e($ret[7]); ?>,<?php echo e($ret[8]); ?>,<?php echo e($ret[9]); ?>,<?php echo e($ret[10]); ?>,<?php echo e($ret[11]); ?>,<?php echo e($ret[12]); ?>],
                            "backgroundColor": ["rgba(0, 201, 219, 0)", "rgba(255, 255, 255, 0)"],
                            "borderColor": "#ec9a3c",
                            "borderWidth": 2,
                            "pointRadius": 0,
                            "pointBorderColor": "#fff",
                            "pointBackgroundColor": "#ec9a3c",
                            "pointHoverRadius": 0,
                            "hoverBorderColor": "#fff",
                            "hoverBackgroundColor": "#00c9db"
                          },
                          {
                            "data": [<?php echo e($fai[1]); ?>,<?php echo e($fai[2]); ?>,<?php echo e($fai[3]); ?>,<?php echo e($fai[4]); ?>,<?php echo e($fai[5]); ?>,<?php echo e($fai[6]); ?>,<?php echo e($fai[7]); ?>,<?php echo e($fai[8]); ?>,<?php echo e($fai[9]); ?>,<?php echo e($fai[10]); ?>,<?php echo e($fai[11]); ?>,<?php echo e($fai[12]); ?>],
                            "backgroundColor": ["rgba(0, 201, 219, 0)", "rgba(255, 255, 255, 0)"],
                            "borderColor": "darkred",
                            "borderWidth": 2,
                            "pointRadius": 0,
                            "pointBorderColor": "#fff",
                            "pointBackgroundColor": "darkred",
                            "pointHoverRadius": 0,
                            "hoverBorderColor": "#fff",
                            "hoverBackgroundColor": "#00c9db"
                          },
                          {
                            "data": [<?php echo e($can[1]); ?>,<?php echo e($can[2]); ?>,<?php echo e($can[3]); ?>,<?php echo e($can[4]); ?>,<?php echo e($can[5]); ?>,<?php echo e($can[6]); ?>,<?php echo e($can[7]); ?>,<?php echo e($can[8]); ?>,<?php echo e($can[9]); ?>,<?php echo e($can[10]); ?>,<?php echo e($can[11]); ?>,<?php echo e($can[12]); ?>],
                            "backgroundColor": ["rgba(0, 201, 219, 0)", "rgba(255, 255, 255, 0)"],
                            "borderColor": "gray",
                            "borderWidth": 2,
                            "pointRadius": 0,
                            "pointBorderColor": "#fff",
                            "pointBackgroundColor": "gray",
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
                                  "max": <?php echo e(\App\CentralLogics\Helpers::max_orders()); ?>,
                                  "stepSize": <?php echo e(round(\App\CentralLogics\Helpers::max_orders()/4)); ?>,
                                  "fontColor": "#97a4af",
                                  "fontFamily": "Open Sans, sans-serif",
                                  "padding": 10,
                                  "postfix": ""
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
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card h-100">
                    <div class="card-header flex-wrap d-flex align-items-center gap-2">
                        <h4 class="card-header-title mb-0"><?php echo e(translate('weekly')); ?> <?php echo e(translate('report')); ?></h4>

                        <ul class="nav nav-segment" id="eventsTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="this-week-tab" data-toggle="tab" href="#this-week"
                                   role="tab">
                                    <?php echo e(translate('this')); ?> <?php echo e(translate('week')); ?>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="last-week-tab" data-toggle="tab" href="#last-week" role="tab">
                                    <?php echo e(translate('last')); ?> <?php echo e(translate('week')); ?>

                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body card-body-height">
                        <?php
                            $orders= \App\Model\Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->get();
                        ?>
                        <div class="tab-content" id="eventsTabContent">
                            <div class="tab-pane fade show active" id="this-week" role="tabpanel"
                                 aria-labelledby="this-week-tab">
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a class="card card-border-left border-left-primary shadow-none rounded-0"
                                       href="<?php echo e(route('admin.orders.details',['id'=>$order['id']])); ?>">
                                        <div class="card-body py-0">
                                            <div class="row">
                                                <div class="col-sm mb-2 mb-sm-0">
                                                    <h2 class="font-weight-normal mb-1">#<?php echo e($order['id']); ?> <small
                                                            class="font-size-sm text-body text-uppercase"><?php echo e(translate('id')); ?></small>
                                                    </h2>
                                                    <h5 class="text-hover-primary mb-0"><?php echo e(translate('order')); ?> <?php echo e(translate('amount')); ?>

                                                        : <?php echo e(\App\CentralLogics\Helpers::set_symbol($order['order_amount'])); ?></h5>
                                                    <small
                                                        class="text-body"><?php echo e(date('d M Y',strtotime($order['created_at']))); ?></small>
                                                </div>

                                                <div class="col-sm-auto align-self-sm-end">
                                                    <div class="">
                                                        <?php echo e(translate('status')); ?> <strong> : <?php echo e(translate($order['order_status'])); ?> <br></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <hr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <?php
                                $orders= \App\Model\Order::whereBetween('created_at', [now()->subDays(7)->startOfWeek(), now()->subDays(7)->endOfWeek()])->get();
                            ?>

                            <div class="tab-pane fade" id="last-week" role="tabpanel" aria-labelledby="last-week-tab">
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a class="card card-border-left border-left-primary shadow-none rounded-0"
                                       href="<?php echo e(route('admin.orders.details',['id'=>$order['id']])); ?>">
                                        <div class="card-body py-0">
                                            <div class="row">
                                                <div class="col-sm mb-2 mb-sm-0">
                                                    <h2 class="font-weight-normal mb-1">#<?php echo e($order['id']); ?> <small
                                                            class="font-size-sm text-body text-uppercase"><?php echo e(translate('id')); ?></small>
                                                    </h2>
                                                    <h5 class="text-hover-primary mb-0"><?php echo e(translate('order')); ?> <?php echo e(translate('amount')); ?>

                                                        : <?php echo e(\App\CentralLogics\Helpers::set_symbol($order['order_amount'])); ?></h5>
                                                    <small
                                                        class="text-body"><?php echo e(date('d M Y',strtotime($order['created_at']))); ?></small>
                                                </div>

                                                <div class="col-sm-auto align-self-sm-end">
                                                    <div class="">
                                                        <?php echo e(translate('status')); ?> <strong> : <?php echo e($order['order_status']); ?> <br></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <hr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>

    <script src="<?php echo e(asset('public/assets/admin')); ?>/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo e(asset('public/assets/admin')); ?>/vendor/chartjs-chart-matrix/dist/chartjs-chart-matrix.min.js"></script>
    <script src="<?php echo e(asset('public/assets/admin')); ?>/js/hs.chartjs-matrix.js"></script>

    <script>
        "use strict";

            $('.js-flatpickr').each(function () {
                $.HSCore.components.HSFlatpickr.init($(this));
            });

            $('.js-nav-scroller').each(function () {
                new HsNavScroller($(this)).init()
            });

            $('.js-daterangepicker').daterangepicker();

            $('.js-daterangepicker-times').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });

            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#js-daterangepicker-predefined .js-daterangepicker-predefined-preview').html(start.format('MMM D') + ' - ' + end.format('MMM D, YYYY'));
            }

            $('#js-daterangepicker-predefined').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

            $('.js-chart').each(function () {
                $.HSCore.components.HSChartJS.init($(this));
            });

            var updatingChart = $.HSCore.components.HSChartJS.init($('#updatingData'));

            $('[data-toggle="chart"]').click(function (e) {
                let keyDataset = $(e.currentTarget).attr('data-datasets')

                updatingChart.data.datasets.forEach(function (dataset, key) {
                    dataset.data = updatingChartDatasets[keyDataset][key];
                });
                updatingChart.update();
            })

            function generateHoursData() {
                var data = [];
                var dt = moment().subtract(365, 'days').startOf('day');
                var end = moment().startOf('day');
                while (dt <= end) {
                    data.push({
                        x: dt.format('YYYY-MM-DD'),
                        y: dt.format('e'),
                        d: dt.format('YYYY-MM-DD'),
                        v: Math.random() * 24
                    });
                    dt = dt.add(1, 'day');
                }
                return data;
            }

            $.HSCore.components.HSChartMatrixJS.init($('.js-chart-matrix'), {
                data: {
                    datasets: [{
                        label: 'Commits',
                        data: generateHoursData(),
                        width: function (ctx) {
                            var a = ctx.chart.chartArea;
                            return (a.right - a.left) / 70;
                        },
                        height: function (ctx) {
                            var a = ctx.chart.chartArea;
                            return (a.bottom - a.top) / 10;
                        }
                    }]
                },
                options: {
                    tooltips: {
                        callbacks: {
                            title: function () {
                                return '';
                            },
                            label: function (item, data) {
                                var v = data.datasets[item.datasetIndex].data[item.index];

                                if (v.v.toFixed() > 0) {
                                    return '<span class="font-weight-bold">' + v.v.toFixed() + ' hours</span> on ' + v.d;
                                } else {
                                    return '<span class="font-weight-bold">No time</span> on ' + v.d;
                                }
                            }
                        }
                    },
                    scales: {
                        xAxes: [{
                            position: 'bottom',
                            type: 'time',
                            offset: true,
                            time: {
                                unit: 'week',
                                round: 'week',
                                displayFormats: {
                                    week: 'MMM'
                                }
                            },
                            ticks: {
                                "labelOffset": 20,
                                "maxRotation": 0,
                                "minRotation": 0,
                                "fontSize": 12,
                                "fontColor": "rgba(22, 52, 90, 0.5)",
                                "maxTicksLimit": 12,
                            },
                            gridLines: {
                                display: false
                            }
                        }],
                        yAxes: [{
                            type: 'time',
                            offset: true,
                            time: {
                                unit: 'day',
                                parser: 'e',
                                displayFormats: {
                                    day: 'ddd'
                                }
                            },
                            ticks: {
                                "fontSize": 12,
                                "fontColor": "rgba(22, 52, 90, 0.5)",
                                "maxTicksLimit": 2,
                            },
                            gridLines: {
                                display: false
                            }
                        }]
                    }
                }
            });

            $('.js-clipboard').each(function () {
                var clipboard = $.HSCore.components.HSClipboard.init(this);
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
                    toastr.error('<?php echo e(translate("Invalid date range!")); ?>', Error, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            }

        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/report/order-index.blade.php ENDPATH**/ ?>