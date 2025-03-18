<?php $__env->startSection('title', translate('Add new sub category')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/category.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('add_New_Sub_Category')); ?>

                </span>
            </h2>
        </div>


        <div class="row g-3">
            <div class="col-12">
                <div class="card card-body">
                    <form action="<?php echo e(route('admin.category.store')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php ($data = Helpers::get_business_settings('language')); ?>
                        <?php ($defaultLang = Helpers::get_default_language()); ?>

                        <?php if($data && array_key_exists('code', $data[0])): ?>
                        <ul class="nav nav-tabs w-fit-content mb-4">
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link lang_link <?php echo e($lang['default'] == true? 'active':''); ?>" href="#" id="<?php echo e($lang['code']); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang['code']).'('.strtoupper($lang['code']).')'); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group <?php echo e($lang['default'] == false ? 'd-none':''); ?> lang_form" id="<?php echo e($lang['code']); ?>-form">
                                        <label class="input-label"><?php echo e(translate('sub_category')); ?> <?php echo e(translate('name')); ?> (<?php echo e(strtoupper($lang['code'])); ?>)</label>
                                        <input type="text" name="name[]" class="form-control" maxlength="255" placeholder="<?php echo e(translate('New Sub Category')); ?>" <?php echo e($lang['status'] == true ? 'required':''); ?>

                                        <?php if($lang['status'] == true): ?> oninvalid="document.getElementById('<?php echo e($lang['code']); ?>-link').click()" <?php endif; ?>>
                                    </div>
                                    <input type="hidden" name="lang[]" value="<?php echo e($lang['code']); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group lang_form" id="<?php echo e($defaultLang); ?>-form">
                                            <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('sub_category')); ?> <?php echo e(translate('name')); ?>(<?php echo e(strtoupper($defaultLang)); ?>)</label>
                                            <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('New Sub Category')); ?>" required>
                                        </div>
                                        <input type="hidden" name="lang[]" value="<?php echo e($defaultLang); ?>">
                                        <?php endif; ?>
                                        <input class="position-area" name="position" value="1">
                                        <input type="hidden" name="type" value="sub_catddsddeegory">
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" class="input-label">
                                                <?php echo e(translate('main_category')); ?>

                                                <span class="text-danger">*</span>
                                            </label>
                                            <select id="exampleFormControlSelect1" name="parent_id" class="form-control js-select2-custom" required>
                                                <option disabled selected><?php echo e(\App\CentralLogics\translate('Select a category')); ?></option>
                                            <?php $__currentLoopData = \App\Model\Category::where(['position'=>0])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category['id']); ?>"><?php echo e($category['name']); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 align-self-end">
                                        <div class="from_part_2 mt-2">
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img width="105" class="rounded-10 border" id="viewer"
                                                         src="<?php echo e(asset('public/assets/admin/img/400x400/img2.jpg')); ?>" alt="image" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="from_part_2">
                                            <label><?php echo e(translate('sub_category_Image')); ?></label>
                                            <small class="text-danger">* ( <?php echo e(translate('ratio')); ?> 1:1 )</small>
                                            <div class="custom-file">
                                                <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                                       accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required
                                                       oninvalid="document.getElementById('en-link').click()">
                                                <label class="custom-file-label" for="customFileEg1"><?php echo e(translate('choose file')); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 align-self-end">
                                        <div class="from_part_2 mb-4 px-4">
                                            <div class="form-group">
                                                <div class="text-center max-h-200px overflow-hidden">
                                                    <img width="500" class="rounded-10 border" id="viewer2"
                                                         src="<?php echo e(asset('public/assets/admin/img/900x400/img1.jpg')); ?>" alt="image" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="from_part_2">
                                            <label><?php echo e(translate('banner image')); ?></label>
                                            <small class="text-danger">* ( <?php echo e(translate('ratio')); ?> 8:1 )</small>
                                            <div class="custom-file">
                                                <input type="file" name="banner_image" id="customFileEg2" class="custom-file-input"
                                                       accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required
                                                       oninvalid="document.getElementById('en-link').click()">
                                                <label class="custom-file-label" for="customFileEg2"><?php echo e(translate('choose file')); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-3">
                                            <button type="reset" class="btn btn-secondary"><?php echo e(translate('reset')); ?></button>
                                            <button type="submit" class="btn btn-primary"><?php echo e(translate('submit')); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            <div class="mt-3">
                <div class="card">
                    <div class="card-top px-card pt-4">
                        <div class="row justify-content-between align-items-center gy-2">
                            <div class="col-sm-4 col-md-6 col-lg-8">
                                <h5 class="d-flex mb-0 gap-2 align-items-center">
                                    <?php echo e(translate('Sub_Category_Table')); ?>

                                    <span class="badge badge-soft-dark rounded-50 fz-12"><?php echo e($categories->total()); ?></span>
                                </h5>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <form action="<?php echo e(url()->current()); ?>" method="GET">
                                    <div class="input-group">
                                        <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(translate('Search by sub category name')); ?>" aria-label="Search" value="<?php echo e($search); ?>" required="" autocomplete="off">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary"><?php echo e(translate('Search')); ?></button>
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
                                    <th><?php echo e(translate('image')); ?></th>
                                    <th><?php echo e(translate('Main_Category')); ?></th>
                                    <th><?php echo e(translate('sub_Category')); ?></th>
                                    <th><?php echo e(translate('status')); ?></th>
                                    <th class="text-center"><?php echo e(translate('action')); ?></th>
                                </tr>
                                </thead>
                                <tbody id="set-rows">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($categories->firstitem()+$key); ?></td>
                                        <td>
                                            <div>
                                                <img width="50" class="avatar-img rounded" src="<?php echo e($category->imageFullPath); ?>" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <?php echo e($category->parent['name']); ?>

                                            </div>
                                        </td>

                                        <td>
                                            <div>
                                                <?php echo e($category['name']); ?>

                                            </div>
                                        </td>

                                        <td>

                                                <div>
                                                    <label class="switcher">
                                                        <input class="switcher_input status-change" type="checkbox" <?php echo e($category['status']==1? 'checked' : ''); ?> id="<?php echo e($category['id']); ?>"
                                                               data-url="<?php echo e(route('admin.category.status',[$category['id'],1])); ?>"
                                                        >
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </div>

                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-info btn-sm edit square-btn"
                                                    href="<?php echo e(route('admin.category.edit',[$category['id']])); ?>">
                                                    <i class="tio-edit"></i>
                                                </a>

                                                <button class="btn btn-outline-danger btn-sm delete square-btn form-alert"
                                                    data-id="category-<?php echo e($category['id']); ?>" data-message="<?php echo e(translate("Want to delete this sub category ?")); ?>"><i class="tio-delete"></i></button>
                                            </div>
                                            <form action="<?php echo e(route('admin.category.delete',[$category['id']])); ?>"
                                                method="post" id="category-<?php echo e($category['id']); ?>">
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
                                <?php echo $categories->links(); ?>

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
        function readURL(input, viewerId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#' + viewerId).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this, 'viewer');
        });

        $("#customFileEg2").change(function () {
            readURL(this, 'viewer2');
        });

        $(document).on('ready', function () {
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });

        $(".lang_link").click(function(e){
            e.preventDefault();

            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];

            $("#"+lang+"-form").removeClass('d-none');

            if(lang == '<?php echo e($defaultLang); ?>')
            {
                $(".from_part_2").removeClass('d-none');
            }
            else
            {
                $(".from_part_2").addClass('d-none');
            }
        });

    </script>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/category/sub-index.blade.php ENDPATH**/ ?>