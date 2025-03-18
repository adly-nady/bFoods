<div class="">
    <div class="media align-items-center gap-3 border rounded p-2 mb-3">
        <div class="avatar">
            <img class="img-fit rounded-circle" src="<?php echo e($user->imageFullPath); ?>" alt="<?php echo e(translate('user')); ?>">
        </div>
        <div>
            <h5 class="mb-0 media-body"><?php echo e($user['f_name'].' '.$user['l_name']); ?></h5>
            <span class="fz-12"><?php echo e($user['phone']); ?></span>
        </div>
    </div>

    <div class="chat_conversation">
        <div class="chat_conversation-inner">
            <?php $__currentLoopData = $convs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$con): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(($con->message!=null && $con->reply==null) || $con->is_reply == false): ?>
                    <div class="received_msg">
                        <?php if(isset($con->message)): ?>
                            <div class="msg"><?php echo e($con->message); ?></div>
                            <span class="time_date"> <?php echo e(\Carbon\Carbon::parse($con->created_at)->format('h:m a | M d')); ?></span>
                        <?php endif; ?>
                        <?php try {?>

    
                        <?php if($con->image != null && $con->image != "null"): ?>
                                <div class="row gx-2 mt-2">
                                <?php ($image_array = json_decode($con->image, true)); ?>
                                <?php $__currentLoopData = $image_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e($image); ?>" data-lightbox="<?php echo e($con->id . $image); ?>" >
                                        <img class="rounded" src="<?php echo e($image); ?>" onerror="this.src='<?php echo e(asset('public/assets/admin/img/900x400/img1.jpg')); ?>'" />
                                    </a><br>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <span class="time_date">  <?php echo e(\Carbon\Carbon::parse($con->created_at)->format('h:m a | M d')); ?></span>
                            <?php endif; ?>
                        <?php }catch (\Exception $e) {
                        } ?>
                    </div>
                <?php endif; ?>
                <?php if(($con->reply!=null && $con->message==null) || $con->is_reply == true): ?>
                    <div class="outgoing_msg">
                        <?php if(isset($con->reply)): ?>
                            <div class="msg"><?php echo e($con->reply); ?></div>
                            <span class="time_date">  <?php echo e(\Carbon\Carbon::parse($con->created_at)->format('h:m a | M d')); ?></span>
                        <?php endif; ?>
                        <?php try {?>
    
                            <?php if($con->image != null && $con->image != "null"): ?>
                                <div class="row g-2 mt-2">
                                <?php ($image_array = json_decode($con->image, true)); ?>
                                <?php $__currentLoopData = $image_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php ($image_url = $image); ?>
                                    <div class="col-12 <?php if(count(json_decode($con->image, true)) > 1): ?> col-md-6 <?php endif; ?>">
                                        <a href="<?php echo e(asset('storage/app/public/conversation').'/'.$image_url); ?>" data-lightbox="<?php echo e($con->id . $image_url); ?>" >
                                            <img class="rounded" src="<?php echo e(asset('storage/app/public/conversation').'/'.$image_url); ?>" onerror="this.src='<?php echo e(asset('public/assets/admin/img/900x400/img1.jpg')); ?>'" />
                                        </a><br>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <span class="time_date">  <?php echo e(\Carbon\Carbon::parse($con->created_at)->format('h:m a | M d')); ?></span>
                            <?php endif; ?>
                        <?php }catch (\Exception $e) {} ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<form action="javascript:" method="post" id="reply-form">
    <?php echo csrf_field(); ?>
    <div class="card mt-2">
        <div class="p-2">
            <div class="quill-custom_">
                <textarea class="border-0 w-100" name="reply"></textarea>
            </div>

            <div id="accordion" class="d-flex gap-2 justify-content-end">
                <button class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <?php echo e(translate('Upload')); ?>

                    <i class="tio-upload"></i>
                </button>
                <button type="submit" data-url="<?php echo e(route('admin.message.store',[$user->id])); ?>" class="btn btn-sm btn-primary reply-message">
                        <?php echo e(translate('send')); ?>

                        <i class="tio-send"></i>
                </button>
            </div>

            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                 data-parent="#accordion">
                <div class="row mt-3" id="coba"></div>
            </div>
        </div>
    </div>
</form>

<script src="<?php echo e(asset('public/assets/admin')); ?>/js/tags-input.min.js"></script>
<script src="<?php echo e(asset('public/assets/admin/js/spartan-multi-image-picker.js')); ?>"></script>

<script>
    "use strict";

    $('.reply-message').click(function() {
        var url = $(this).data('url');
        replyConvs(url);
    });

    $(document).ready(function () {
        $('.chat_conversation').animate({
            scrollTop: $('.chat_conversation-inner').height()
        }, 500);
    });

    $('#collapseTwo').on('show.bs.collapse', function () {
        spartanMultiImagePicker();
    })

    $('#collapseTwo').on('hidden.bs.collapse', function () {
        document.querySelector("#coba").innerHTML = "";
    })

    function spartanMultiImagePicker() {
        document.querySelector("#coba").innerHTML = "";

        $("#coba").spartanMultiImagePicker({
            fieldName: 'images[]',
            maxCount: 4,
            rowHeight: '10%',
            groupClassName: 'col-lg-3 col-md-4 col-6',
            maxFileSize: '',
            dropFileLabel: "Drop Here",
            onAddRow: function (index, file) {

            },
            onRenderedPreview: function (index) {

            },
            onRemoveRow: function (index) {

            },
            onExtensionErr: function (index, file) {
                toastr.error('<?php echo e(translate('Please only input png or jpg type file')); ?>', {
                    CloseButton: true,
                    ProgressBar: true
                });
            },
            onSizeErr: function (index, file) {
                toastr.error('<?php echo e(translate('File size too big')); ?>', {
                    CloseButton: true,
                    ProgressBar: true
                });
            }
        });
    }
</script>
<?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/messages/partials/_conversations.blade.php ENDPATH**/ ?>