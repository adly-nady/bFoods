<?php $__env->startSection('title', translate('Add new cuisine')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/category.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('Add_New_Cuisine')); ?>

                </span>
            </h2>
        </div>

        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="<?php echo e(route('admin.cuisine.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card">
                        <?php ($data = Helpers::get_business_settings('language')); ?>
                        <?php ($defaultLang = Helpers::get_default_language()); ?>

                        <?php if($data && array_key_exists('code', $data[0])): ?>
                            <ul class="nav w-fit-content nav-tabs mb-4 ml-3">
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link lang_link <?php echo e($lang['default'] == true ? 'active' : ''); ?>" href="#"
                                           id="<?php echo e($lang['code']); ?>-link"><?php echo e(Helpers::get_language_name($lang['code']) . '(' . strtoupper($lang['code']) . ')'); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="<?php echo e($lang['default'] == false ? 'd-none':''); ?> lang_form" id="<?php echo e($lang['code']); ?>-form">
                                            <div class="form-group">
                                                <label class="input-label" for="<?php echo e($lang['code']); ?>_name"><?php echo e(translate('name')); ?> (<?php echo e(strtoupper($lang['code'])); ?>)</label>
                                                <input type="text" name="name[]" id="<?php echo e($lang['code']); ?>_name" class="form-control"
                                                       placeholder="<?php echo e(translate('Thai')); ?>" <?php echo e($lang['status'] == true ? 'required':''); ?>

                                                       <?php if($lang['status'] == true): ?> oninvalid="document.getElementById('<?php echo e($lang['code']); ?>-link').click()" <?php endif; ?>>
                                            </div>
                                            <input type="hidden" name="lang[]" value="<?php echo e($lang['code']); ?>">
                                            <div class="form-group">
                                                <label class="input-label"
                                                       for="<?php echo e($lang['code']); ?>_sub_title"><?php echo e(translate('sub_title')); ?>  (<?php echo e(strtoupper($lang['code'])); ?>)</label>
                                                <input type="text" name="sub_title[]" class="form-control" placeholder="Ex:<?php echo e(translate('The national dish of Thailand')); ?>"
                                                       maxlength="255" id="<?php echo e($lang['code']); ?>_hiddenArea"
                                                       <?php if($lang['status'] == true): ?> oninvalid="document.getElementById('<?php echo e($lang['code']); ?>-link').click()" <?php endif; ?>
                                                    <?php echo e($lang['status'] == true ? 'required':''); ?>>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <div class="" id="<?php echo e($defaultLang); ?>-form">
                                            <div class="form-group">
                                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('name')); ?> (EN)</label>
                                                <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('Thai')); ?>" required>
                                            </div>
                                            <input type="hidden" name="lang[]" value="en">
                                            <div class="form-group">
                                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('sub_title')); ?> (EN)</label>
                                                <input type="text" name="sub_title[]" class="form-control" id="hiddenArea"  maxlength="255" placeholder="Ex:<?php echo e(translate('The national dish of Thailand')); ?>"></input>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <label class="mb-0"><?php echo e(translate('Image')); ?></label>
                                            <small class="text-danger">* ( <?php echo e(translate('ratio 1:1')); ?> )</small>
                                        </div>
                                        <div class="d-flex justify-content-center mt-4">
                                            <div class="upload-file cuisine-image">
                                                <input type="file" name="image" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" class="upload-file__input" required>
                                                <div class="upload-file__img_drag upload-file__img width-300px max-h-200px overflow-hidden">
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

        <div class="row g-3">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-top px-card pt-4">
                        <div class="row justify-content-between align-items-center gy-2">
                            <div class="col-sm-4 col-md-6 col-lg-8">
                                <h5 class="d-flex gap-1 mb-0">
                                    <?php echo e(translate('cuisine_Table')); ?>

                                    <span class="badge badge-soft-dark rounded-50 fz-12"><?php echo e($cuisines->total()); ?></span>
                                </h5>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <form action="<?php echo e(url()->current()); ?>" method="GET">
                                    <div class="input-group">
                                        <input id="datatableSearch_" type="search" name="search"
                                            class="form-control"
                                            placeholder="<?php echo e(translate('Search by cuisine name')); ?>" aria-label="Search"
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
                                        <th><?php echo e(translate('cuisine_Image')); ?></th>
                                        <th><?php echo e(translate('name')); ?></th>
                                        <th><?php echo e(translate('sub_title')); ?></th>
                                        <th><?php echo e(translate('status')); ?></th>
                                        <th><?php echo e(translate('priority')); ?></th>
                                        <th class="text-center"><?php echo e(translate('action')); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php $__currentLoopData = $cuisines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$cuisine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($cuisines->firstitem()+$key); ?></td>
                                        <td>
                                            <div>
                                                <img width="50" class="avatar-img rounded" src="<?php echo e($cuisine->imageFullPath); ?>" alt="">
                                            </div>
                                        </td>
                                        <td><div class="text-capitalize text-wrap"><?php echo e($cuisine['name']); ?></div></td>
                                        <td><div class="text-capitalize text-wrap"><?php echo e($cuisine['sub_title']); ?></div></td>
                                        <td>
                                            <div>
                                                <label class="switcher">
                                                    <input class="switcher_input status-change" type="checkbox" <?php echo e($cuisine['is_active']==1? 'checked' : ''); ?> id="cuisine-<?php echo e($cuisine['id']); ?>"
                                                           data-url="<?php echo e(route('admin.cuisine.status',[$cuisine['id'],1])); ?>">
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="max-w100 min-w80px">
                                                <select name="priority" class="custom-select redirect-url-value"
                                                        data-url="<?php echo e(route('admin.cuisine.priority', ['id' => $cuisine['id'], 'priority' => ''])); ?>">
                                                    <?php for($i = 1; $i <= 10; $i++): ?>
                                                        <option value="<?php echo e($i); ?>" <?php echo e($cuisine->priority == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-info btn-sm edit square-btn"
                                                href="<?php echo e(route('admin.cuisine.edit',[$cuisine['id']])); ?>">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger btn-sm delete square-btn form-alert"
                                                    data-id="cuisine--<?php echo e($cuisine['id']); ?>" data-message="<?php echo e(translate('Want to delete this cuisine?')); ?>">
                                                    <i class="tio-delete"></i>
                                                </button>
                                            </div>
                                            <form action="<?php echo e(route('admin.cuisine.delete',[$cuisine['id']])); ?>"
                                                method="post" id="cuisine--<?php echo e($cuisine['id']); ?>">
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
                                <?php echo $cuisines->links(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/read-url.js')); ?>"></script>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/cuisine/index.blade.php ENDPATH**/ ?>