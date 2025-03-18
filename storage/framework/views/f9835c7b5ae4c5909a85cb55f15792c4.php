<?php $__env->startSection('title', translate('Add New Chef')); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/cooking.png')); ?>" alt="">
            <span class="page-header-title">
                <?php echo e(translate('Add_New_Chef')); ?>

            </span>
        </h2>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(route('admin.kitchen.add-new')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlSelect1"><?php echo e(translate('Select Branch')); ?> <span class="text-danger">*</span></label>
                                    <select name="branch_id" class="custom-select" required>
                                        <option value="" selected disabled><?php echo e(translate('--Select_Branch--')); ?></option>
                                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($branch['id']); ?>"><?php echo e($branch['name']); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name"><?php echo e(translate('First Name')); ?> <span class="text-danger">*</span></label>
                                    <input type="text" name="f_name" class="form-control" id="f_name"
                                           placeholder="<?php echo e(translate('Ex')); ?> : <?php echo e(translate('John')); ?>" value="<?php echo e(old('f_name')); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name"><?php echo e(translate('Last Name')); ?> <span class="text-danger">*</span></label>
                                    <input type="text" name="l_name" class="form-control" id="l_name"
                                           placeholder="<?php echo e(translate('Ex')); ?> : <?php echo e(translate('Doe')); ?>" value="<?php echo e(old('l_name')); ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name"><?php echo e(translate('Phone')); ?> <span class="text-danger">*</span> <?php echo e(translate('(with country code)')); ?></label>
                                    <input type="text" name="phone" value="<?php echo e(old('phone')); ?>" class="form-control" id="phone"
                                           placeholder="<?php echo e(translate('Ex')); ?> : +88017********" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name"><?php echo e(translate('Email')); ?> <span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" id="email"
                                           placeholder="<?php echo e(translate('Ex')); ?> : ex@gmail.com" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name"><?php echo e(translate('password')); ?> <span class="text-danger">*</span> <?php echo e(translate('(minimum length will be 6 character)')); ?></label>
                                <div class="input-group input-group-merge">
                                    <input type="password" name="password" class="js-toggle-password form-control form-control input-field" id="password"
                                           placeholder="<?php echo e(translate('Password')); ?>" required
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
                            <div class="col-md-6">
                                <label for="confirm_password"><?php echo e(translate('confirm_Password')); ?><span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <input type="password" name="confirm_password" class="js-toggle-password form-control form-control input-field" id="confirm_password"
                                           placeholder="<?php echo e(translate('confirm password')); ?>" required
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

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name"><?php echo e(translate('image')); ?> <span class="text-danger">*</span></label>
                                <span class="badge badge-soft-danger">( <?php echo e(translate('ratio')); ?> 1:1 )</span>
                                <div class="form-group">
                                    <div class="custom-file text-left">
                                        <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                                        <label class="custom-file-label" for="customFileUpload"><?php echo e(translate('choose')); ?> <?php echo e(translate('file')); ?></label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <img class="upload-img-view" id="viewer"
                                         src="<?php echo e(asset('public\assets\admin\img\400x400\img2.jpg')); ?>" alt="image"/>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-3">
                            <button type="reset" id="reset" class="btn btn-secondary"><?php echo e(translate('reset')); ?></button>
                            <button type="submit" class="btn btn-primary"><?php echo e(translate('Submit')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="<?php echo e(asset('public/assets/admin')); ?>/js/select2.min.js"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/image-upload.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/kitchen/add-new.blade.php ENDPATH**/ ?>