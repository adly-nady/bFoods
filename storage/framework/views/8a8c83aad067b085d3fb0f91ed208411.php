<?php $__env->startSection('title', translate('About us')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/pages.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('page_setup')); ?>

                </span>
            </h2>
        </div>

        <?php echo $__env->make('admin-views.business-settings.partials._page-setup-inline-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="row g-2">
            <div class="col-12">
                <form action="<?php echo e(route('admin.business-settings.page-setup.about-us')); ?>" method="post" id="about-us-form">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <div id="editor" class="min-h-108px"><?php echo $data['value']; ?></div>
                        <textarea name="about_us" id="hiddenArea" style="display:none;"></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-3 align-items-center">
                        <button type="reset" class="btn btn-secondary"><?php echo e(translate('reset')); ?></button>
                        <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                class="btn btn-primary call-demo"><?php echo e(translate('save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/quill-editor.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var bn_quill = new Quill('#editor', {
                theme: 'snow'
            });

            $('#about-us-form').on('submit', function () {
                var myEditor = document.querySelector('#editor');
                $('#hiddenArea').val(myEditor.children[0].innerHTML);
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/business-settings/about-us.blade.php ENDPATH**/ ?>