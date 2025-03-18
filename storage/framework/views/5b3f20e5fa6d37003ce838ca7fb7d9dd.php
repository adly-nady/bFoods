<?php $__env->startSection('title', translate('Employee Add')); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/employee.png')); ?>" alt="">
            <span class="page-header-title">
                <?php echo e(translate('add_New_Employee')); ?>

            </span>
        </h2>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo e(route('admin.employee.add-new')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0 d-flex align-items-center gap-2"><span class="tio-user"></span> <?php echo e(translate('general_Information')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name"><?php echo e(translate('full_Name')); ?></label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="<?php echo e(translate('Ex')); ?> : <?php echo e(translate('Jhon_Doe')); ?>" value="<?php echo e(old('name')); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone"><?php echo e(translate('Phone')); ?></label>
                                    <input type="tel" name="phone" value="<?php echo e(old('phone')); ?>" class="form-control" id="phone"
                                        placeholder="<?php echo e(translate('Ex')); ?> : +88017********" required>
                                </div>

                                <div class="form-group">
                                    <label for="role_id"><?php echo e(translate('Role')); ?></label>
                                    <select class="custom-select" name="role_id">
                                        <option value="0" selected disabled>---<?php echo e(translate('select_Role')); ?>---</option>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>" <?php echo e(old('role_id')==$role->id?'selected':''); ?>><?php echo e($role->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="identity_type"><?php echo e(translate('Identity Type')); ?></label>
                                    <select class="custom-select" name="identity_type" id="identity_type" required>
                                        <option selected disabled>---<?php echo e(translate('select_Identity_Type')); ?>---</option>
                                        <option value="passport"><?php echo e(translate('passport')); ?></option>
                                        <option value="driving_license"><?php echo e(translate('driving_License')); ?></option>
                                        <option value="nid"><?php echo e(translate('NID')); ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="identity_number"><?php echo e(translate('identity_Number')); ?></label>
                                    <input type="text" name="identity_number" class="form-control" id="identity_number" required value="<?php echo e(old('identity_number')); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="text-center mb-3">
                                        <img width="180" class="rounded-10 border" id="viewer"
                                            src="<?php echo e(asset('public\assets\admin\img\400x400\img2.jpg')); ?>" alt="image"/>
                                    </div>
                                    <label for="name"><?php echo e(translate('employee_image')); ?></label>
                                    <span class="text-danger">( <?php echo e(translate('ratio')); ?> 1:1 )</span>
                                    <div class="form-group">
                                        <div class="custom-file text-left">
                                            <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                                            <label class="custom-file-label" for="customFileUpload"><?php echo e(translate('choose')); ?> <?php echo e(translate('file')); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="input-label"><?php echo e(translate('identity_Image')); ?></label>
                                    <div>
                                        <div class="row" id="coba"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0 d-flex align-items-center gap-2"><span class="tio-user"></span> <?php echo e(translate('account_Information')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email"><?php echo e(translate('Email')); ?></label>
                                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" id="email"
                                        placeholder="<?php echo e(translate('Ex')); ?> : ex@gmail.com" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password"><?php echo e(translate('password')); ?></label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="password" class="js-toggle-password form-control form-control input-field" id="password"
                                               placeholder="<?php echo e(translate('Ex: 8+ Characters')); ?>" required
                                               data-hs-toggle-password-options='{
                                        "target": "#changePassTarget",
                                        "defaultClass": "tio-hidden-outlined",
                                        "showClass": "tio-visible-outlined",
                                        "classChangeTarget": "#changePassIcon"
                                        }'>
                                        <div id="changePassTarget" class="input-group-append">
                                            <a class="input-group-text" href="javascript:">
                                                <i id="changePassIcon" class="tio-visible-outlined"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="confirm_password"><?php echo e(translate('confirm_Password')); ?></label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="confirm_password" class="js-toggle-password form-control form-control input-field"
                                               id="confirm_password" placeholder="<?php echo e(translate('confirm password')); ?>" required
                                               data-hs-toggle-password-options='{
                                                "target": "#changeConPassTarget",
                                                "defaultClass": "tio-hidden-outlined",
                                                "showClass": "tio-visible-outlined",
                                                "classChangeTarget": "#changeConPassIcon"
                                                }'>
                                        <div id="changeConPassTarget" class="input-group-append">
                                            <a class="input-group-text" href="javascript:">
                                                <i id="changeConPassIcon" class="tio-visible-outlined"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <button type="reset" id="reset" class="btn btn-secondary"><?php echo e(translate('reset')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo e(translate('submit')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/vendor.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/admin')); ?>/js/select2.min.js"></script>
    <script src="<?php echo e(asset('public/assets/admin/js/image-upload.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/admin/js/spartan-multi-image-picker.js')); ?>"></script>
    <script>
        "use strict";

        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });

        $(function () {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'identity_image[]',
                maxCount: 5,
                rowHeight: '230px',
                groupClassName: 'col-6 col-lg-4',
                maxFileSize: '',
                placeholderImage: {
                    image: '<?php echo e(asset('public/assets/admin/img/400x400/img2.jpg')); ?>',
                    width: '100%'
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error('<?php echo e(translate("Please only input png or jpg type file")); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error('<?php echo e(translate("File size too big")); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/employee/add-new.blade.php ENDPATH**/ ?>