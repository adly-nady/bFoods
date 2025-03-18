<?php $__env->startSection('title', translate('Add new addon')); ?>

<?php $__env->startSection('content'); ?>
<style>
    .image-upload-container {
        position: relative;
        width: 200px;
        height: 200px;
        border: 2px dashed #ccc;
        border-radius: 10px;
        cursor: pointer;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .upload-icon {
        font-size: 50px;
        color: #ccc;
    }

    .upload-text {
        color: #666;
        margin-top: 10px;
    }

    #image-preview {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
    }

    #file-input {
        display: none;
    }
</style>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/attribute.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('Add_New_Addon')); ?> 
                </span>
            </h2>
        </div>

        <div class="row g-3">
            <div class="col-12">
                <div class="mt-3">
                    <div class="card">
                        <div class="card-top px-card pt-4">
                            <div class="d-flex flex-column flex-md-row flex-wrap gap-3 justify-content-md-between align-items-md-center">
                                <h5 class="d-flex align-items-center gap-2">
                                    <?php echo e(translate('Addon_Table')); ?>

                                    <span class="badge badge-soft-dark rounded-50 fz-12"><?php echo e($addons->total()); ?></span>
                                </h5>

                                <div class="d-flex flex-wrap justify-content-md-end gap-3">
                                    <form action="<?php echo e(url()->current()); ?>" method="GET">
                                        <div class="input-group">
                                            <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(translate('Search by Addon name')); ?>" aria-label="Search" value="<?php echo e($search); ?>" required="" autocomplete="off">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary"> <?php echo e(translate('Search')); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adAddondModal">
                                        <i class="tio-add"></i>
                                        <?php echo e(translate('Add_Addon')); ?>

                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="py-4">
                            <div class="table-responsive datatable-custom">
                                <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><?php echo e(translate('SL')); ?></th>
                                            <th><?php echo e(translate('name')); ?></th>
                                            <th><?php echo e(translate('image')); ?></th>
                                            <th><?php echo e(translate('price')); ?></th>
                                            <th class="text-center"><?php echo e(translate('tax')); ?> (%)</th>
                                            <th class="text-center"><?php echo e(translate('action')); ?></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($addons->firstitem()+$key); ?></td>
                                            <td>
                                                <div>
                                                    <?php echo e($addon['name']); ?>

                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <img src="<?php echo e(asset('public/storage/' . $addon->image)); ?>" style="width: 200px" alt="صورة الإضافة">
                                                </div>
                                            </td>
                                            
                                            <td><?php echo e(Helpers::set_symbol($addon['price'])); ?></td>
                                            <td class="text-center"><?php echo e($addon['tax']); ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a class="btn btn-outline-info btn-sm edit square-btn"
                                                        href="<?php echo e(route('admin.addon.edit',[$addon['id']])); ?>"><i class="tio-edit"></i></a>
                                                    <button class="btn btn-outline-danger btn-sm delete square-btn" type="button"
                                                        onclick="form_alert('addon-<?php echo e($addon['id']); ?>','<?php echo e(translate('Want to delete this addon')); ?> ?')"><i class="tio-delete"></i></button>
                                                </div>
                                                <form action="<?php echo e(route('admin.addon.delete',[$addon['id']])); ?>"
                                                        method="post" id="addon-<?php echo e($addon['id']); ?>">
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
                                    <?php echo $addons->links(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="adAddondModal" tabindex="-1" role="dialog" aria-labelledby="adAddondModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form action="<?php echo e(route('admin.addon.store')); ?>"  method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <?php ($data = Helpers::get_business_settings('language')); ?>
                            <?php ($defaultLang = Helpers::get_default_language()); ?>

                            

                            <?php if($data && array_key_exists('code', $data[0])): ?>
                            <ul class="nav nav-tabs w-fit-content mb-4">
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link lang_link <?php echo e($lang['default'] == true ? 'active' : ''); ?>" href="#"
                                        id="<?php echo e($lang['code']); ?>-link"><?php echo e(Helpers::get_language_name($lang['code']) . '(' . strtoupper($lang['code']) . ')'); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            
                            <div class="row">
                                
                                <div class="col-sm-12">
                                    
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-group <?php echo e($lang['default'] == false ? 'd-none' : ''); ?> lang_form" id="<?php echo e($lang['code']); ?>-form">
                                            <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('name')); ?> (<?php echo e(strtoupper($lang['code'])); ?>)</label>
                                            <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('New addon')); ?>"
                                                <?php echo e($lang['status'] == true ? 'required':''); ?> maxlength="255"
                                                <?php if($lang['status'] == true): ?> oninvalid="document.getElementById('<?php echo e($lang['code']); ?>-link').click()" <?php endif; ?>>
                                        </div>
                                        <input type="hidden" name="lang[]" value="<?php echo e($lang['code']); ?>">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                    <div class="row">
                                        <div class="col-sm-12 mb-4">
                                            <div class="form-group lang_form" id="<?php echo e($defaultLang); ?>-form">
                                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('name')); ?> (<?php echo e(strtoupper($defaultLang)); ?>)</label>
                                                <input type="text" name="name[]" class="form-control" maxlength="255" placeholder="<?php echo e(translate('New addon')); ?>" required>
                                            </div>
                                            <input type="hidden" name="lang[]" value="<?php echo e($defaultLang); ?>">
                            <?php endif; ?>
                            
                            <div class="form-group lang_form">
                                <label class="input-label"><?php echo e(translate('image')); ?></label>
                                <div class="image-upload-container" onclick="document.getElementById('file-input').click()">
                                    <svg class="upload-icon" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/>
                                    </svg>
                                    <span class="upload-text"><?php echo e(translate('click_to_upload')); ?></span>
                                    <img id="image-preview" alt="Preview">
                                </div>
                                <input type="file" name="images" id="file-input" accept="image/*">
                            </div>


                                            <input name="position" class="position-area" value="0">
                                        </div>
                                        <div class="col-sm-6 from_part_2 mb-4">
                                            <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('price')); ?></label>
                                            <input type="number" min="0" name="price" step="any" class="form-control"
                                                placeholder="100" required
                                                oninvalid="document.getElementById('en-link').click()">
                                        </div>
                                        <div class="col-sm-6 from_part_2 mb-4">
                                            <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('tax')); ?> (%)</label>
                                            <input type="number" min="0" name="tax" step="any" class="form-control"
                                                   placeholder="5" required
                                                   oninvalid="document.getElementById('en-link').click()">
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
                </div>
            </div>
        </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";

        // $(".lang_link").click(function(e){
        //     e.preventDefault();
        //     $(".lang_link").removeClass('active');
        //     $(".lang_form").addClass('d-none');
        //     $(this).addClass('active');

        //     let form_id = this.id;
        //     let lang = form_id.split("-")[0];

        //     $("#"+lang+"-form").removeClass('d-none');
        //     if(lang == '<?php echo e($defaultLang); ?>')
        //     {
        //         $(".from_part_2").removeClass('d-none');
        //     }
        //     else
        //     {
        //         $(".from_part_2").addClass('d-none');
        //     }
        // });
        
    document.getElementById('file-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('image-preview');
        const container = document.querySelector('.image-upload-container');
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                container.querySelector('.upload-icon').style.display = 'none';
                container.querySelector('.upload-text').style.display = 'none';
            }
            
            reader.readAsDataURL(file);
        }
    });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/addon/index.blade.php ENDPATH**/ ?>