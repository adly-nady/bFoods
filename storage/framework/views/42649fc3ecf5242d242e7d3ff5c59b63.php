<?php $__env->startSection('title', translate('Banner list')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/banner.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('Banner_Setup')); ?>

                </span>
            </h2>
        </div>

        <div class="row g-2">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="<?php echo e(route('admin.banner.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card banner-form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label"><?php echo e(translate('title')); ?><span class="text-danger ml-1">*</span></label>
                                        <input type="text" name="title" class="form-control" placeholder="<?php echo e(translate('New banner')); ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="input-label"><?php echo e(translate('item_Type')); ?><span class="text-danger ml-1">*</span></label>
                                        <select name="item_type" class="custom-select js-select2-custom">
                                            <option selected disabled><?php echo e(translate('select_item_type')); ?></option>
                                            <option value="product"><?php echo e(translate('product')); ?></option>
                                            <option value="category"><?php echo e(translate('category')); ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="type-product">
                                        <label class="input-label"><?php echo e(translate('product')); ?> <span class="text-danger ml-1">*</span></label>
                                        <select name="product_id" class="custom-select js-select2-custom">
                                            <option selected disabled><?php echo e(translate('select_a_product')); ?></option>
                                            <?php $__currentLoopData = \App\Model\Product::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($product['id']); ?>"><?php echo e($product['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group type-category" id="type-category">
                                        <label class="input-label"><?php echo e(translate('category')); ?> <span class="text-danger ml-1">*</span></label>
                                        <select name="category_id" class="custom-select js-select2-custom">
                                            <option selected disabled><?php echo e(translate('select_a_category')); ?></option>
                                            <?php $__currentLoopData = \App\Model\Category::where('parent_id', 0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category['id']); ?>"><?php echo e($category['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <label class="mb-0"><?php echo e(translate('banner_Image')); ?></label>
                                            <small class="text-danger">* ( <?php echo e(translate('ratio 2:1')); ?> )</small>
                                        </div>
                                        <div class="d-flex justify-content-center mt-4">
                                            <div class="upload-file">
                                                <input type="file" name="image" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" class="upload-file__input">
                                                <div class="upload-file__img_drag upload-file__img max-h-200px overflow-hidden">
                                                    <img width="465" id="viewer" src="<?php echo e(asset('public/assets/admin/img/icons/upload_img2.png')); ?>" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-3 mt-4">
                                <button type="reset" id="reset" class="btn btn-secondary"><?php echo e(translate('reset')); ?></button>
                                <button type="submit" class="btn btn-primary"><?php echo e(translate('submit')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-top px-card pt-4">
                        <div class="row align-items-center gy-2">
                            <div class="col-sm-4 col-md-6 col-lg-8">
                                <h5 class="d-flex align-items-center gap-2 mb-0">
                                    <?php echo e(translate('Banner_List')); ?>

                                    <span class="badge badge-soft-dark rounded-50 fz-12"><?php echo e($banners->total()); ?></span>
                                </h5>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <form action="<?php echo e(url()->current()); ?>" method="GET">
                                    <div class="input-group">
                                        <input id="datatableSearch_" type="search" name="search" value="<?php echo e($search); ?>" class="form-control" placeholder="<?php echo e(translate('Search_by_Title')); ?>" aria-label="Search" required="" autocomplete="off">
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
                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(translate('SL')); ?></th>
                                    <th><?php echo e(translate('Banner_Image')); ?></th>
                                    <th><?php echo e(translate('Title')); ?></th>
                                    <th><?php echo e(translate('Banner_Type')); ?></th>
                                    <th><?php echo e(translate('status')); ?></th>
                                    <th class="text-center"><?php echo e(translate('action')); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($banners->firstitem()+$key); ?></td>
                                        <td>
                                            <img class="img-vertical-150" src="<?php echo e($banner->imageFullPath); ?>" alt="<?php echo e(translate('banner image')); ?>">
                                        </td>
                                        <td>
                                            <div class="max-w300 text-wrap">
                                                <?php echo e($banner['title']); ?>

                                            </div>
                                        </td>
                                        <?php if(isset($banner->category_id)): ?>
                                            <td><?php echo e(translate('category')); ?>: <?php echo e(substr(\App\Model\Category::find($banner->category_id)?->name, 0, 15)); ?></td>
                                        <?php elseif(isset($banner->product_id)): ?>
                                            <td><?php echo e(translate('product')); ?>: <?php echo e(substr(\App\Model\Product::find($banner->product_id)?->name,0, 15)); ?>...</td>
                                        <?php else: ?>
                                            <td></td>
                                        <?php endif; ?>
                                        <td>
                                            <label class="switcher">
                                                <input class="switcher_input status-change" type="checkbox" <?php echo e($banner['status']==1 ? 'checked' : ''); ?> id="<?php echo e($banner['id']); ?>"
                                                    data-url="<?php echo e(route('admin.banner.status',[$banner['id'],0])); ?>">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-info btn-sm edit square-btn"
                                                    href="<?php echo e(route('admin.banner.edit',[$banner['id']])); ?>"><i class="tio-edit"></i></a>
                                                <button type="button" class="btn btn-outline-danger btn-sm delete square-btn form-alert" data-id="banner-<?php echo e($banner['id']); ?>" data-message="<?php echo e(translate('Want to delete this banner')); ?>"
                                                    ><i class="tio-delete"></i></button>
                                            </div>
                                            <form action="<?php echo e(route('admin.banner.delete',[$banner['id']])); ?>"
                                                method="post" id="banner-<?php echo e($banner['id']); ?>">
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
                                <?php echo $banners->links(); ?>

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

        $('.js-select2-custom').each(function () {
            var select2 = $.HSCore.components.HSSelect2.init($(this));
        });

        $("select[name='item_type']").change(function() {
            var selectedValue = $(this).val();
            show_item(selectedValue);
        });

        $(".status-change").change(function() {
            var selectedValue = $(this).val();
            status_change(selectedValue);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this);
        });


        function show_item(type) {
            if (type === 'product') {
                $("#type-product").show();
                $("#type-category").hide();
            } else {
                $("#type-product").hide();
                $("#type-category").show();
            }
        }

        $(".js-select2-custom").select2({
            placeholder: "Select a item",
            allowClear: true
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/banner/list.blade.php ENDPATH**/ ?>