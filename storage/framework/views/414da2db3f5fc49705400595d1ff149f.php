<?php $__env->startSection('title', translate('Promotional Campaign')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/campaign.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('Promotion_Setup')); ?>

                </span>
            </h2>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route('admin.promotion.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(translate('Select Branch')); ?> <span class="text-danger ml-1">*</span></label>
                                <select name="branch_id" class="custom-select" required>
                                    <option disabled selected><?php echo e(translate('--select--')); ?></option>
                                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($branch['id']); ?>"><?php echo e($branch['name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(translate('Select Banner Type')); ?> <span class="text-danger ml-1">*</span></label>
                                <select name="banner_type" id="banner_type" class="custom-select" required>
                                    <option value="" selected><?php echo e(translate('--select--')); ?></option>
                                    <option value="bottom_banner"><?php echo e(translate('Bottom Banner (1110*380 px)')); ?></option>
                                    <option value="top_right_banner"><?php echo e(translate('Top Right Banner (280*450 px)')); ?></option>
                                    <option value="bottom_right_banner"><?php echo e(translate('Bottom Right Banner (280*350 px)')); ?></option>
                                    <option value="video"><?php echo e(translate('Video')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class=" from_part_2 video_section d--none" id="video_section">
                                    <label class="input-label"><?php echo e(translate('youtube Video URL')); ?><span class="text-danger ml-1">*</span></label>
                                    <input type="text" name="video" class="form-control" placeholder="<?php echo e(translate('ex : https://youtu.be/0sus46BflpU')); ?>">
                                </div>
                                <div class=" from_part_2 image_section d--none" id="image_section">
                                    <label class="input-label"><?php echo e(translate('Image')); ?> <span class="text-danger ml-1">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                                               oninvalid="document.getElementById('en-link').click()">
                                        <label class="custom-file-label" for="customFileUpload"><?php echo e(translate('choose file')); ?></label>
                                    </div>
                                    <div class="col-12 from_part_2 mt-2">
                                        <div class="form-group">
                                            <div class="text-center">
                                                <img class="viewer-section" id="viewer"
                                                     src="<?php echo e(asset('public/assets/admin/img/400x400/img2.jpg')); ?>" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-3">
                        <button type="reset" class="btn btn-secondary"><?php echo e(translate('reset')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(translate('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-top px-card pt-4">
                <div class="row justify-content-between align-items-center gy-2">
                    <div class="col-sm-4 col-md-6 col-lg-8">
                        <h5 class="d-flex gap-2 mb-0">
                            <?php echo e(translate('Promotion_Table')); ?>

                            <span class="badge badge-soft-dark rounded-50 fz-12"><?php echo e($promotions->total()); ?></span>
                        </h5>
                    </div>
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <form action="<?php echo e(url()->current()); ?>" method="GET">
                            <div class="input-group">
                                <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(translate('Search by Type')); ?>" aria-label="Search" value="<?php echo e($search); ?>" required="" autocomplete="off">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><?php echo e(translate('Search')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="py-4">
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                        <tr>
                            <th><?php echo e(translate('SL')); ?></th>
                            <th><?php echo e(translate('Branch')); ?></th>
                            <th><?php echo e(translate('Promotion type')); ?></th>
                            <th><?php echo e(translate('Promotion_Banner')); ?></th>
                            <th class="text-center"><?php echo e(translate('action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $promotions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$promotion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row" class="align-middle"><?php echo e($promotions->firstitem() + $k); ?></th>
                                <td>
                                    <a class="text-dark" href="<?php echo e(route('admin.promotion.branch',[$promotion->branch_id])); ?>"><?php echo e($promotion->branch->name); ?></a>
                                </td>
                                <td>
                                    <?php
                                        $promotionType = $promotion['promotion_type'];
                                        echo str_replace('_', ' ', $promotionType);
                                    ?>
                                </td>
                                <td>
                                    <?php if($promotion['promotion_type'] == 'video'): ?>
                                        <?php echo e($promotion['promotion_name']); ?>

                                    <?php else: ?>
                                        <div>
                                            <img class="mx-80px" width="100" src="<?php echo e($promotion->promotionNameFullPath); ?>">
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-3">
                                        <a href="<?php echo e(route('admin.promotion.edit',[$promotion['id']])); ?>"
                                        class="btn btn-outline-info btn-sm square-btn"
                                        title="<?php echo e(translate('Edit')); ?>">
                                            <i class="tio-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm square-btn form-alert" title="<?php echo e(translate('Delete')); ?>"
                                        data-id="promotion-<?php echo e($promotion['id']); ?>" data-message="<?php echo e(translate('Want to delete this promotion ?')); ?>">
                                            <i class="tio-delete"></i>
                                        </button>
                                    </div>
                                    <form action="<?php echo e(route('admin.promotion.delete',[$promotion['id']])); ?>"
                                            method="post" id="promotion-<?php echo e($promotion['id']); ?>">
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
                        <?php echo e($promotions->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/image-upload.js')); ?>"></script>
    <script>
        "use strict";

        $(function() {
            $('#banner_type').change(function(){
                if ($(this).val() === 'video'){
                    $('#video_section').show();
                    $('#image_section').hide();
                }else{
                    $('#video_section').hide();
                    $('#image_section').show();
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/branch_promotion/create.blade.php ENDPATH**/ ?>