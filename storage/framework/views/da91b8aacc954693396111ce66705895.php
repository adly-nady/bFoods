<?php $__env->startSection('title', translate('Add new product')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="<?php echo e(asset('public/assets/admin/css/tags-input.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/product.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('Add_New_Product')); ?>

                </span>
            </h2>
        </div>

        <div class="row g-3">
            <div class="col-12">
                <form action="javascript:" method="post" id="product_form" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row g-2">
                        <div class="col-lg-6">
                            <div class="card card-body h-100">
                                <?php ($data = Helpers::get_business_settings('language')); ?>
                                <?php ($defaultLang = Helpers::get_default_language()); ?>

                                <?php if($data && array_key_exists('code', $data[0])): ?>
                                    <ul class="nav nav-tabs mb-4">

                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="nav-item">
                                                <a class="nav-link lang_link <?php echo e($lang['default'] == true ? 'active':''); ?>" href="#" id="<?php echo e($lang['code']); ?>-link"><?php echo e(Helpers::get_language_name($lang['code']).'('.strtoupper($lang['code']).')'); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </ul>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="<?php echo e($lang['default'] == false ? 'd-none':''); ?> lang_form" id="<?php echo e($lang['code']); ?>-form">
                                            <div class="form-group">
                                                <label class="input-label" for="<?php echo e($lang['code']); ?>_name"><?php echo e(translate('name')); ?> (<?php echo e(strtoupper($lang['code'])); ?>)</label>
                                                <input type="text" name="name[]" id="<?php echo e($lang['code']); ?>_name" class="form-control"
                                                       placeholder="<?php echo e(translate('New Product')); ?>" <?php echo e($lang['status'] == true ? 'required':''); ?>

                                                       <?php if($lang['status'] == true): ?> oninvalid="document.getElementById('<?php echo e($lang['code']); ?>-link').click()" <?php endif; ?>>
                                            </div>
                                            <input type="hidden" name="lang[]" value="<?php echo e($lang['code']); ?>">
                                            <div class="form-group">
                                                <label class="input-label"
                                                       for="<?php echo e($lang['code']); ?>_description"><?php echo e(translate('short')); ?> <?php echo e(translate('description')); ?>  (<?php echo e(strtoupper($lang['code'])); ?>)</label>
                                                <textarea name="description[]" class="form-control textarea-h-100" id="<?php echo e($lang['code']); ?>_hiddenArea"></textarea>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="" id="<?php echo e($defaultLang); ?>-form">
                                        <div class="form-group">
                                            <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('name')); ?> (EN)</label>
                                            <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('New Product')); ?>" required>
                                        </div>
                                        <input type="hidden" name="lang[]" value="en">
                                        <div class="form-group">
                                            <label class="input-label"
                                                   for="exampleFormControlInput1"><?php echo e(translate('short')); ?> <?php echo e(translate('description')); ?> (EN)</label>
                                            <textarea name="description[]" class="form-control textarea-h-100" id="hiddenArea"></textarea>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-body h-100">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark"><?php echo e(translate('product_Image')); ?></label>
                                    <small class="text-danger">* ( <?php echo e(translate('ratio')); ?> 1:1 )</small>
                                    <div class="d-flex justify-content-center mt-4">
                                        <div class="upload-file">
                                            <input type="file" name="image" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" class="upload-file__input">
                                            <div class="upload-file__img_drag upload-file__img">
                                                <img width="176" src="<?php echo e(asset('public/assets/admin/img/icons/upload_img.png')); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h4 class="mb-0 d-flex gap-2 align-items-center">
                                                <i class="tio-category"></i>
                                                <?php echo e(translate('Category')); ?>

                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="input-label" for="exampleFormControlSelect1">
                                                            <?php echo e(translate('category')); ?>

                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="category_id" class="form-control js-select2-custom"
                                                                onchange="getRequest('<?php echo e(url('/')); ?>/admin/product/get-categories?parent_id='+this.value,'sub-categories')">
                                                            <option selected disabled>---<?php echo e(translate('select')); ?>---</option>
                                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($category['id']); ?>"><?php echo e($category['name']); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="input-label" for="exampleFormControlSelect1"><?php echo e(translate('sub_category')); ?><span
                                                                class="input-label-secondary"></span></label>
                                                        <select name="sub_category_id" id="sub-categories"
                                                                class="form-control js-select2-custom"
                                                                onchange="getRequest('<?php echo e(url('/')); ?>/admin/product/get-categories?parent_id='+this.value,'sub-sub-categories')">
                                                            <option selected disabled>---<?php echo e(translate('select')); ?>---</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="input-label" for="exampleFormControlInput1">
                                                            <?php echo e(translate('item_Type')); ?>

                                                            <span class="text-danger">*</span>
                                                        </label>

                                                        <select name="item_type" class="form-control js-select2-custom">
                                                            <option selected disabled>---<?php echo e(translate('select')); ?>---</option>
                                                            <option value="0"><?php echo e(translate('product')); ?> <?php echo e(translate('item')); ?></option>
                                                            <option value="1"><?php echo e(translate('set_menu')); ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="input-label">
                                                            <?php echo e(translate('product_Type')); ?>

                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="product_type" class="form-control js-select2-custom">
                                                            <option selected disabled>---<?php echo e(translate('select')); ?>---</option>
                                                            <option value="veg"><?php echo e(translate('veg')); ?></option>
                                                            <option value="non_veg"><?php echo e(translate('nonveg')); ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h4 class="mb-0 d-flex gap-2 align-items-center">
                                                <i class="tio-dollar"></i>
                                                <?php echo e(translate('Price_Information')); ?>

                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="input-label"><?php echo e(translate('default_Price')); ?>

                                                            <span class="text-danger">*</span></label>
                                                        <input type="number" min="0" step="any" value="1" name="price" class="form-control"
                                                               placeholder="<?php echo e(translate('Ex : 100')); ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="input-label"><?php echo e(translate('discount_Type')); ?>

                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="discount_type" class="form-control js-select2-custom" id="discount_type">
                                                            <option selected disabled>---<?php echo e(translate('select')); ?>---</option>
                                                            <option value="percent"><?php echo e(translate('percentage')); ?></option>
                                                            <option value="amount"><?php echo e(translate('amount')); ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label id="discount_label" class="input-label"><?php echo e(translate('discount')); ?>

                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input id="discount_input" type="number" min="0" name="discount" class="form-control"
                                                               placeholder="<?php echo e(translate('Ex : 5%')); ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="input-label"><?php echo e(translate('tax_Type')); ?>

                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="tax_type" class="form-control js-select2-custom" id="tax_type">
                                                            <option selected disabled>---<?php echo e(translate('select')); ?>---</option>
                                                            <option value="percent"><?php echo e(translate('percentage')); ?></option>
                                                            <option value="amount"><?php echo e(translate('amount')); ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label id="tax_label" class="input-label" for="exampleFormControlInput1"><?php echo e(translate('tax_Rate')); ?>

                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input id="tax_input" type="number" min="0" step="any" name="tax" class="form-control"
                                                               placeholder="<?php echo e(translate('Ex : $100')); ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h4 class="mb-0 d-flex gap-2 align-items-center">
                                                <i class="tio-dollar"></i>
                                                <?php echo e(translate('Stock Information')); ?>

                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="input-label"><?php echo e(translate('Stock Type')); ?></label>
                                                        <select name="stock_type" class="form-control js-select2-custom" id="stock_type">
                                                            <option value="unlimited"><?php echo e(translate('unlimited')); ?></option>
                                                            <option value="daily"><?php echo e(translate('daily')); ?></option>
                                                            <option value="fixed"><?php echo e(translate('fixed')); ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 d-none" id="product_stock_div">
                                                    <div class="form-group">
                                                        <label class="input-label"><?php echo e(translate('Product Stock')); ?>

                                                        </label>
                                                        <input id="product_stock" type="number" name="product_stock" class="form-control"
                                                               placeholder="<?php echo e(translate('Ex : 10')); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <div class="text-dark"><?php echo e(translate('turning visibility off will not show this product in the user app and website')); ?></div>
                                                <div class="d-flex gap-3 align-items-center">
                                                    <h5><?php echo e(translate('Visibility')); ?></h5>
                                                    <label class="switcher">
                                                        <input class="switcher_input" type="checkbox" checked="checked" name="status">
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h4 class="mb-0 d-flex gap-2 align-items-center">
                                                <i class="tio-watches"></i>
                                                <?php echo e(translate('Availability')); ?>

                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-2">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="input-label"><?php echo e(translate('available_From')); ?></label>
                                                        <input type="time" name="available_time_starts" class="form-control" value="10:30:00"
                                                               placeholder="<?php echo e(translate('Ex : 10:30 am')); ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="input-label"><?php echo e(translate('available_Till')); ?></label>
                                                        <input type="time" name="available_time_ends" class="form-control" value="19:30:00" placeholder="<?php echo e(translate('5:45 pm')); ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h4 class="mb-0 d-flex gap-2 align-items-center">
                                                <i class="tio-puzzle"></i>
                                                <?php echo e(translate('Addons')); ?>

                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="input-label"><?php echo e(translate('Select_Addons')); ?></label>
                                                <select name="addon_ids[]" class="form-control" id="choose_addons" multiple="multiple">
                                                    <?php $__currentLoopData = \App\Model\AddOn::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($addon['id']); ?>"><?php echo e($addon['name']); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h4 class="mb-0 d-flex gap-2 align-items-center">
                                                <i class="tio-label"></i>
                                                <?php echo e(translate('tags')); ?>

                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="">
                                                        <label class="input-label"><?php echo e(translate('search_tag')); ?></label>
                                                        <input type="text" class="form-control" name="tags" placeholder="Enter tags" data-role="tagsinput">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <div class="text-dark"><?php echo e(translate('turning recommended status on will show this product in the chef recommended section in user app and website')); ?></div>
                                                <div class="d-flex gap-3 align-items-center">
                                                    <h5><?php echo e(translate('Recommended')); ?></h5>
                                                    <label class="switcher">
                                                        <input class="switcher_input" type="checkbox" checked="checked" name="is_recommended">
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h4 class="mb-0 d-flex gap-2 align-items-center">
                                                <i class="tio-label"></i>
                                                <?php echo e(translate('cuisine')); ?>

                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="">
                                                        <label class="input-label"><?php echo e(translate('select cuisine')); ?></label>
                                                        <select name="cuisines[]" class="form-control js-select2-custom" multiple>
                                                            <option value="" disabled>---<?php echo e(translate('select cuisine')); ?>---</option>
                                                            <?php $__currentLoopData = $cuisines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuisine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($cuisine['id']); ?>"><?php echo e($cuisine['name']); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h4 class="mb-0 d-flex gap-2 align-items-center">
                                <i class="tio-canvas-text"></i>
                                <?php echo e(translate('product_Variations')); ?>

                            </h4>
                        </div>
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="add_new_option">
                                    </div>
                                    <br>
                                    <div class="">
                                        <a class="btn btn-outline-success"
                                           id="add_new_option_button"><?php echo e(translate('add_New_Variation')); ?></a>
                                    </div>
                                    <br><br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <button type="reset" class="btn btn-secondary"><?php echo e(translate('reset')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(translate('submit')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/spartan-multi-image-picker.js')); ?>"></script>


    <script>
        var count = 0;
        $(document).ready(function() {

            $("#add_new_option_button").click(function(e) {
                count++;
                var add_option_view = `
                    <div class="card view_new_option mb-2" >
                        <div class="card-header">
                            <label for="" id=new_option_name_` + count + `> <?php echo e(translate('add_new')); ?></label>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-lg-3 col-md-6">
                                    <label for=""><?php echo e(translate('name')); ?></label>
                                    <input required name=options[` + count + `][name] class="form-control" type="text"
                                        onkeyup="new_option_name(this.value,` + count + `)">
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <label class="input-label text-capitalize d-flex alig-items-center"><span class="line--limit-1"><?php echo e(translate('selcetion_type')); ?> </span></label>
                                        <div class="resturant-type-group border">
                                            <label class="form-check form--check mr-2 mr-md-4">
                                                <input class="form-check-input" type="radio" value="multi "name="options[` + count + `][type]" id="type` + count +
                                                    `" checked onchange="show_min_max(` + count + `)">
                                                <span class="form-check-label"><?php echo e(translate('Multiple')); ?></span>
                                            </label>

                                            <label class="form-check form--check mr-2 mr-md-4">
                                                <input class="form-check-input" type="radio" value="single" name="options[` + count + `][type]" id="type` + count +
                                                    `" onchange="hide_min_max(` + count + `)" >
                                                <span class="form-check-label"><?php echo e(translate('Single')); ?></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="row g-2">
                                        <div class="col-sm-6 col-md-4">
                                            <label for=""><?php echo e(translate('Min')); ?></label>
                                            <input id="min_max1_` + count + `" required  name="options[` + count + `][min]" class="form-control" type="number" min="1">
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <label for=""><?php echo e(translate('Max')); ?></label>
                                            <input id="min_max2_` + count + `"   required name="options[` + count + `][max]" class="form-control" type="number" min="1">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="d-md-block d-none">&nbsp;</label>
                                        <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <input id="options[` + count + `][required]" name="options[` + count + `][required]" type="checkbox">
                                            <label for="options[` + count + `][required]" class="m-0"><?php echo e(translate('Required')); ?></label>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-danger btn-sm delete_input_button" onclick="removeOption(this)"title="<?php echo e(translate('Delete')); ?>">
                                                <i class="tio-add-to-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="option_price_` + count + `" >
                        <div class="border rounded p-3 pb-0 mt-3">
                            <div  id="option_price_view_` + count + `">
                                <div class="row g-3 add_new_view_row_class mb-3">
                                    <div class="col-md-4 col-sm-6">
                                        <label for=""><?php echo e(translate('Option_name')); ?></label>
                                        <input class="form-control" required type="text" name="options[` + count +`][values][0][label]" id="">
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label for=""><?php echo e(translate('Additional_price')); ?></label>
                                        <input class="form-control" required type="number" min="0" step="0.01" name="options[` + count + `][values][0][optionPrice]" id="">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 p-3 mr-1 d-flex "  id="add_new_button_` + count + `">
                                <button type="button" class="btn btn-outline-primary" onclick="add_new_row_button(` +
                                    count + `)" ><?php echo e(translate('Add_New_Option')); ?>

                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;

            $("#add_new_option").append(add_option_view);
            });
        });

        function show_min_max(data) {
            $('#min_max1_' + data).removeAttr("readonly");
            $('#min_max2_' + data).removeAttr("readonly");
            $('#min_max1_' + data).attr("required", "true");
            $('#min_max2_' + data).attr("required", "true");
        }

        function hide_min_max(data) {
            $('#min_max1_' + data).val(null).trigger('change');
            $('#min_max2_' + data).val(null).trigger('change');
            $('#min_max1_' + data).attr("readonly", "true");
            $('#min_max2_' + data).attr("readonly", "true");
            $('#min_max1_' + data).attr("required", "false");
            $('#min_max2_' + data).attr("required", "false");
        }

        function new_option_name(value, data) {
            $("#new_option_name_" + data).empty();
            $("#new_option_name_" + data).text(value)
            console.log(value);
        }

        function removeOption(e) {
            element = $(e);
            element.parents('.view_new_option').remove();
        }

        function deleteRow(e) {
            element = $(e);
            element.parents('.add_new_view_row_class').remove();
        }


        function add_new_row_button(data) {
            count = data;
            countRow = 1 + $('#option_price_view_' + data).children('.add_new_view_row_class').length;
            var add_new_row_view = `
                <div class="row add_new_view_row_class mb-3 position-relative pt-3 pt-sm-0">
                    <div class="col-md-4 col-sm-5">
                        <label for=""><?php echo e(translate('Option_name')); ?></label>
                        <input class="form-control" required type="text" name="options[` + count + `][values][` + countRow + `][label]" id="">
                    </div>
                    <div class="col-md-4 col-sm-5">
                        <label for=""><?php echo e(translate('Additional_price')); ?></label>
                        <input class="form-control"  required type="number" min="0" step="0.01" name="options[` + count + `][values][` + countRow + `][optionPrice]" id="">
                    </div>
                    <div class="col-sm-2 max-sm-absolute">
                        <label class="d-none d-sm-block">&nbsp;</label>
                        <div class="mt-1">
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)"title="<?php echo e(translate('Delete')); ?>">
                                    <i class="tio-add-to-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
            $('#option_price_view_' + data).append(add_new_row_view);
        }
    </script>


    <script>
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
            $('#image-viewer-section').show(1000)
        });
    </script>

    <script>
        $(".lang_link").click(function(e){
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#"+lang+"-form").removeClass('d-none');
            if(lang == '<?php echo e($defaultLang); ?>')
            {
                $("#from_part_2").removeClass('d-none');
            }
            else
            {
                $("#from_part_2").addClass('d-none');
            }


        })
    </script>

    <script>
        //Select 2
        $("#choose_addons").select2({
            placeholder: "Select Addons",
            allowClear: true
        });

    </script>

    <script>


        $('#product_form').on('submit', function () {
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.product.store')); ?>',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.errors) {
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        toastr.success('<?php echo e(translate("product added successfully!")); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        setTimeout(function () {
                            location.href = '<?php echo e(route('admin.product.list')); ?>';
                        }, 2000);
                    }
                }
            });
        });
    </script>

    <script>
        function getRequest(route, id) {
            $.get({
                url: route,
                dataType: 'json',
                success: function (data) {
                    $('#' + id).empty().append(data.options);
                },
            });
        }
    </script>

    <script>
        $(document).on('ready', function () {
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>

    <script src="<?php echo e(asset('public/assets/admin')); ?>/js/tags-input.min.js"></script>


    <script>
        function update_qty() {
            var total_qty = 0;
            var qty_elements = $('input[name^="stock_"]');
            for(var i=0; i<qty_elements.length; i++)
            {
                total_qty += parseInt(qty_elements.eq(i).val());
            }
            if(qty_elements.length > 0)
            {
                $('input[name="total_stock"]').attr("readonly", true);
                $('input[name="total_stock"]').val(total_qty);
                console.log(total_qty)
            }
            else{
                $('input[name="total_stock"]').attr("readonly", false);
            }
        }
    </script>

    <script>
        $("#discount_type").change(function(){
            if(this.value === 'amount') {
                $("#discount_label").text("<?php echo e(translate('discount_amount')); ?>");
                $("#discount_input").attr("placeholder", "<?php echo e(translate('Ex: 500')); ?>")
            }
            else if(this.value === 'percent') {
                $("#discount_label").text("<?php echo e(translate('discount_percent')); ?>")
                $("#discount_input").attr("placeholder", "<?php echo e(translate('Ex: 50%')); ?>")
            }
        });

        $("#tax_type").change(function(){
            if(this.value === 'amount') {
                $("#tax_label").text("<?php echo e(translate('tax_amount')); ?>");
                $("#tax_input").attr("placeholder", "<?php echo e(translate('Ex: 500')); ?>")
            }
            else if(this.value === 'percent') {
                $("#tax_label").text("<?php echo e(translate('tax_percent')); ?>")
                $("#tax_input").attr("placeholder", "<?php echo e(translate('Ex: 50%')); ?>")
            }
        });


        $("#stock_type").change(function(){
            if(this.value === 'daily' || this.value === 'fixed') {
               $("#product_stock_div").removeClass('d-none')
            }
            else {
                $("#product_stock_div").addClass('d-none')
            }
        });



    </script>
<?php $__env->stopPush(); ?>





<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/product/index.blade.php ENDPATH**/ ?>