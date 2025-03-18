<?php $__env->startSection('title', translate('Product List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/product.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('Product_List')); ?>

                </span>
            </h2>
            <span class="badge badge-soft-dark rounded-50 fz-14"><?php echo e($products->total()); ?></span>
        </div>


        <div class="row g-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-top px-card pt-4">
                        <div class="row justify-content-between align-items-center gy-2">
                            <div class="col-lg-4">
                                <form action="<?php echo e(url()->current()); ?>" method="GET">
                                    <div class="input-group">
                                        <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(translate('search_by_product_name')); ?>" aria-label="Search" value="<?php echo e($search); ?>" required="" autocomplete="off">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary"><?php echo e(translate('Search')); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-8">
                                <div class="d-flex gap-3 justify-content-end text-nowrap flex-wrap">
                                    <div>
                                        <button type="button" class="btn btn-outline-primary" data-toggle="dropdown" aria-expanded="false">
                                            <i class="tio-download-to"></i>
                                            Export
                                            <i class="tio-chevron-down"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a type="submit" class="dropdown-item d-flex align-items-center gap-2" href="<?php echo e(route('admin.product.excel-import', ['search' => $search])); ?>">
                                                    <img width="14" src="<?php echo e(asset('public/assets/admin/img/icons/excel.png')); ?>" alt="">
                                                    <?php echo e(translate('Excel')); ?>

                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="<?php echo e(route('admin.product.add-new')); ?>" class="btn btn-primary">
                                        <i class="tio-add"></i> <?php echo e(translate('add_New_Product')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-4">
                        <div class="table-responsive datatable-custom">
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(translate('SL')); ?></th>
                                    <th><?php echo e(translate('product_name')); ?></th>
                                    <th><?php echo e(translate('selling_price')); ?></th>
                                    <th class="text-center"><?php echo e(translate('total_sale')); ?></th>
                                    <th><?php echo e(translate('stock')); ?></th>
                                    <th><?php echo e(translate('status')); ?></th>
                                    <th><?php echo e(translate('recommended')); ?></th>
                                    <th class="text-center"><?php echo e(translate('action')); ?></th>
                                </tr>
                                </thead>

                                <tbody id="set-rows">
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($products->firstitem()+$key); ?></td>
                                        <td>
                                            <div class="media align-items-center gap-3">
                                                <div class="avatar">
                                                    <img src="<?php echo e($product['imageFullPath']); ?>" class="rounded img-fit" alt="<?php echo e(translate('product')); ?>">
                                                </div>

                                                <div class="media-body">
                                                    <a class="text-dark" href="<?php echo e(route('admin.product.view',[$product['id']])); ?>">
                                                        <?php echo e(Str::limit($product['name'], 30)); ?>

                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo e(\App\CentralLogics\Helpers::set_symbol($product['price'])); ?></td>
                                        <td class="text-center"><?php echo e(\App\Model\OrderDetail::whereHas('order', function ($q){
                                                    $q->where('order_status', 'delivered');
                                                })->where('product_id', $product->id)->sum('quantity')); ?>

                                        </td>
                                        <td>
                                            <div><span class=""><?php echo e(translate('Stock Type')); ?> : <?php echo e(ucfirst($product->main_branch_product?->stock_type)); ?></span></div>
                                            <?php if(isset($product->main_branch_product) && $product->main_branch_product->stock_type != 'unlimited'): ?>
                                                <div><span class=""><?php echo e(translate('Stock')); ?> : <?php echo e($product->main_branch_product->stock - $product->main_branch_product->sold_quantity); ?></span></div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div>
                                                <label class="switcher">
                                                    <input id="<?php echo e($product['id']); ?>" class="switcher_input status-change" type="checkbox" <?php echo e($product['status']==1? 'checked' : ''); ?>

                                                        data-url="<?php echo e(route('admin.product.status',[$product['id'],0])); ?>">
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <label class="switcher">
                                                    <input id="recommended-<?php echo e($product['id']); ?>" class="switcher_input recommended-status-change" type="checkbox" <?php echo e($product['is_recommended']==1? 'checked' : ''); ?>

                                                    data-url="<?php echo e(route('admin.product.recommended',[$product['id'],0])); ?>">
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-info btn-sm edit square-btn"
                                                href="<?php echo e(route('admin.product.edit',[$product['id']])); ?>"><i class="tio-edit"></i></a>
                                                <button type="button" class="btn btn-outline-danger btn-sm delete square-btn form-alert"
                                                        data-id="product-<?php echo e($product['id']); ?>"
                                                        data-message="<?php echo e(translate('Want to delete this item ?')); ?>">
                                                    <i class="tio-delete"></i>
                                                </button>
                                            </div>
                                            <form action="<?php echo e(route('admin.product.delete',[$product['id']])); ?>"
                                                method="post" id="product-<?php echo e($product['id']); ?>">
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
                                <?php echo $products->links(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";

        $(".recommended-status-change").change(function() {
            var value = $(this).val();
            let url = $(this).data('url');
            console.log(value, url);
            status_change(this, url);
        });

        function recommended_status_change(t) {
            let url = $(t).data('url');
            let checked = $(t).prop("checked");
            let status = checked === true ? 1 : 0;

            Swal.fire({
                title: 'Are you sure?',
                text: 'Want to change the recommended status',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FC6A57',
                cancelButtonColor: 'default',
                cancelButtonText: '<?php echo e(translate("No")); ?>',
                confirmButtonText: '<?php echo e(translate("Yes")); ?>',
                reverseButtons: true
            }).then((result) => {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: url,
                            data: {
                                status: status
                            },
                            success: function (data, status) {
                                toastr.success("<?php echo e(translate('updated successfully')); ?>");
                            },
                            error: function (data) {
                                toastr.error("<?php echo e(translate('updated failed')); ?>");
                            }
                        });
                    }
                    else if (result.dismiss) {
                        if (status == 1) {
                            $('#' + t.id).prop('checked', false)

                        } else if (status == 0) {
                            $('#'+ t.id).prop('checked', true)
                        }
                        toastr.info("<?php echo e(translate("recommended status has not changed")); ?>");
                    }
                }
            )
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/product/list.blade.php ENDPATH**/ ?>