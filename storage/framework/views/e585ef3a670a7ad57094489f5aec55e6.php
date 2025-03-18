<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">

<table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100 mt-3" id="datatable">
    <thead class="thead-light">
        <tr>
            <th><?php echo e(translate('SL')); ?> </th>
            <th><?php echo e(translate('order')); ?></th>
            <th><?php echo e(translate('date')); ?></th>
            <th><?php echo e(translate('qty')); ?></th>
            <th><?php echo e(translate('amount')); ?></th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="">
                <?php echo e($key+1); ?>

            </td>
            <td class="">
                <a href="<?php echo e(route('admin.orders.details',['id'=>$row['order_id']])); ?>"><?php echo e($row['order_id']); ?></a>
            </td>
            <td><?php echo e(date('d M Y',strtotime($row['date']))); ?></td>
            <td><?php echo e($row['quantity']); ?></td>
            <td><?php echo e(\App\CentralLogics\Helpers::set_symbol($row['price'])); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function () {
        $('input').addClass('form-control');
    });
    var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
        dom: 'Bfrtip',
        "iDisplayLength": 25,
    });
</script>
<?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/report/partials/_table.blade.php ENDPATH**/ ?>