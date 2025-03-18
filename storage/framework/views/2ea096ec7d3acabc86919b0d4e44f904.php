<?php $__env->startSection('title', translate('Add new category')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/category.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('add_New_Category')); ?>

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
                        <ul class="nav w-fit-content nav-tabs mb-4">
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link lang_link <?php echo e($lang['default'] == true ? 'active' : ''); ?>" href="#"
                                    id="<?php echo e($lang['code']); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang['code']) . '(' . strtoupper($lang['code']) . ')'); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                        <div class="row align-items-end">
                            <div class="col-12">
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group <?php echo e($lang['default'] == false ? 'd-none' : ''); ?> lang_form"
                                        id="<?php echo e($lang['code']); ?>-form">
                                        <label class="input-label" ><?php echo e(translate('name')); ?> (<?php echo e(strtoupper($lang['code'])); ?>)</label>
                                        <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('New Category')); ?>" maxlength="255"
                                            <?php echo e($lang['status'] == true ? 'required':''); ?>

                                            <?php if($lang['status'] == true): ?> oninvalid="document.getElementById('<?php echo e($lang['code']); ?>-link').click()" <?php endif; ?>>
                                    </div>
                                    <input type="hidden" name="lang[]" value="<?php echo e($lang['code']); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <div class="row gy-4">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group lang_form" id="<?php echo e($defaultLang); ?>-form">
                                            <label class="input-label"
                                                for="exampleFormControlInput1"><?php echo e(translate('name')); ?>

                                                (<?php echo e(strtoupper($defaultLang)); ?>)</label>
                                            <input type="text" name="name[]" class="form-control" maxlength="255"
                                                placeholder="<?php echo e(translate('New Category')); ?>" required>
                                        </div>
                                        <input type="hidden" name="lang[]" value="<?php echo e($defaultLang); ?>">
                                        <?php endif; ?>
                                        <input name="position" value="0" class="d--none">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="from_part_2 mt-2">
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img width="105" class="rounded-10 border" id="viewer"
                                                        src="<?php echo e(asset('public/assets/admin/img/400x400/img2.jpg')); ?>" alt="image" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="from_part_2">
                                            <label><?php echo e(translate('category_Image')); ?></label>
                                            <small class="text-danger">* ( <?php echo e(translate('ratio')); ?> 1:1 )</small>
                                            <div class="custom-file">
                                                <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required
                                                    oninvalid="document.getElementById('en-link').click()">
                                                <label class="custom-file-label" for="customFileEg1"><?php echo e(translate('choose file')); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
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
                                </div>

                                <div class="d-flex justify-content-end gap-3">
                                    <button type="reset" id="reset" class="btn btn-secondary"><?php echo e(translate('reset')); ?></button>
                                    <button type="submit" class="btn btn-primary"><?php echo e(translate('submit')); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>

            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-top px-card pt-4">
                        <div class="row justify-content-between align-items-center gy-2">
                            <div class="col-sm-4 col-md-6 col-lg-8">
                                <h5 class="d-flex gap-1 mb-0">
                                    <?php echo e(translate('Category_Table')); ?>

                                    <span class="badge badge-soft-dark rounded-50 fz-12"><?php echo e($categories->total()); ?></span>
                                </h5>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <form action="<?php echo e(url()->current()); ?>" method="GET">
                                    <div class="input-group">
                                        <input id="datatableSearch_" type="search" name="search"
                                            class="form-control"
                                            placeholder="<?php echo e(translate('Search by category name')); ?>" aria-label="<?php echo e(translate('Search')); ?>"
                                            value="<?php echo e($search); ?>" required autocomplete="off">
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
                                        <th><?php echo e(translate('Category_Image')); ?></th>
                                        <th><?php echo e(translate('name')); ?></th>
                                        <th><?php echo e(translate('status')); ?></th>
                                        <th><?php echo e(translate('priority')); ?></th>
                                        <th class="text-center"><?php echo e(translate('action')); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($categories->firstitem()+$key); ?></td>
                                        <td>
                                            <div>
                                                <img width="50" class="avatar-img rounded" src="<?php echo e($category->imageFullPath); ?>"  alt="">
                                            </div>
                                        </td>
                                        <td><div class="text-capitalize"><?php echo e($category['name']); ?></div></td>
                                        <td>
                                            <div class="">
                                                <label class="switcher">
                                                    <input class="switcher_input status-change" type="checkbox" <?php echo e($category['status']==1? 'checked' : ''); ?> id="<?php echo e($category['id']); ?>"
                                                           data-url="<?php echo e(route('admin.category.status',[$category['id'],1])); ?>"
                                                    >
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <select name="priority" class="custom-select redirect-url-value"
                                                        data-url="<?php echo e(route('admin.category.priority', ['id' => $category['id'], 'priority' => ''])); ?>">
                                                    <?php for($i = 1; $i <= 10; $i++): ?>
                                                        <option value="<?php echo e($i); ?>" <?php echo e($category->priority == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-info btn-sm edit square-btn"
                                                href="<?php echo e(route('admin.category.edit',[$category['id']])); ?>">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger btn-sm delete square-btn form-alert"
                                                    data-id="category-<?php echo e($category['id']); ?>" data-message="<?php echo e(translate("Want to delete this")); ?>">
                                                    <i class="tio-delete"></i>
                                                </button>
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

       function change_priority(id, priority, message) {
           Swal.fire({
               title: '<?php echo e(translate("Are you sure?")); ?>',
               text: message,
               type: 'warning',
               showCancelButton: true,
               cancelButtonColor: 'default',
               confirmButtonColor: '#FC6A57',
               cancelButtonText: '<?php echo e(translate("No")); ?>',
               confirmButtonText: '<?php echo e(translate("Yes")); ?>',
               reverseButtons: true
           }).then((result) => {
               if (result.value) {
                   const csrfToken = $('meta[name="csrf-token"]').attr('content');

                   const formData = new FormData();
                   formData.append('_token', csrfToken);
                   formData.append('id', id);
                   formData.append('priority', priority);

                   $.ajax({
                       url: "<?php echo e(route('admin.category.priority')); ?>",
                       method: "POST",
                       data: formData,
                       processData: false,
                       contentType: false,
                       success: function(response) {
                           toastr.success("<?php echo e(translate('Priority changed successfully')); ?>");
                           setTimeout(function() {
                               location.reload();
                           }, 2000);
                       },
                       error: function(xhr) {
                           toastr.error("<?php echo e(translate('Priority changed failed')); ?>");
                       }
                   });
               }
           })
       }
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/category/index.blade.php ENDPATH**/ ?>