<?php $__env->startSection('title', translate('Social_Media_Links')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="<?php echo e(asset('public/assets/admin/img/icons/social.png')); ?>" alt="">
                <span class="page-header-title">
                    <?php echo e(translate('Social_Media')); ?>

                </span>
            </h2>
        </div>

        <div class="card">
            <div class="card-body">
                <form>
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="name" class=""><?php echo e(translate('Social_Media_Name')); ?></label>
                            <select class="custom-select" name="name" id="name">
                                <option selected disabled>---<?php echo e(translate('select')); ?>---</option>
                                <option value="instagram"><?php echo e(translate('Instagram')); ?></option>
                                <option value="facebook"><?php echo e(translate('Facebook')); ?></option>
                                <option value="twitter"><?php echo e(translate('Twitter')); ?></option>
                                <option value="linkedin"><?php echo e(translate('LinkedIn')); ?></option>
                                <option value="pinterest"><?php echo e(translate('Pinterest')); ?></option>
                            </select>
                        </div>
                        <div class="col-sm-6 form-group">
                            <input type="hidden" id="id">
                            <label for="link" class="ml-1"><?php echo e(translate('social_media_link')); ?></label>
                            <input type="text" name="link" class="form-control" id="link"
                                    placeholder="<?php echo e(translate('Enter Social Media Link')); ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="id">
                        </div>
                        <div class="col-12">
                            <div class="btn--container">
                                <button type="reset" class="btn btn-secondary"><?php echo e(translate('reset')); ?></button>
                                <button id="add" class="btn btn-primary"><?php echo e(translate('save')); ?></button>
                                <a id="update" class="btn btn-primary" style="display: none"><?php echo e(translate('update')); ?></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table" id="dataTable" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-top-0"><?php echo e(translate('SL')); ?></th>
                                <th class="border-top-0"><?php echo e(translate('name')); ?></th>
                                <th class="border-top-0"><?php echo e(translate('link')); ?></th>
                                <th class="border-top-0"><?php echo e(translate('status')); ?></th>
                                <th class="border-top-0"><?php echo e(translate('action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script>
        fetch_social_media();

        function fetch_social_media() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('admin.business-settings.web-app.third-party.fetch')); ?>",
                method: 'GET',
                success: function (data) {

                    if (data.length != 0) {
                        var html = '';
                        for (var count = 0; count < data.length; count++) {
                            html += '<tr>';
                            html += '<td class="column_name" data-column_name="sl" data-id="' + data[count].id + '">' + (count + 1) + '</td>';
                            html += '<td class="column_name" data-column_name="name" data-id="' + data[count].id + '">' + data[count].name + '</td>';
                            html += '<td class="column_name" data-column_name="slug" data-id="' + data[count].id + '">' + data[count].link + '</td>';
                            html += `<td class="column_name" data-column_name="status" data-id="${data[count].id}">
                                <label class="switcher">
                                    <input type="checkbox" onclick="status_change_sm(this)" class="switcher_input" id="${data[count].id}" ${data[count].status == 1 ? "checked" : ""} >
                                    <span class="switcher_control"></span>
                                </label>
                            </td>`;
                            // html += '<td><a type="button" class="btn btn-primary btn-xs edit" id="' + data[count].id + '"><i class="fa fa-edit text-white"></i></a> <a type="button" class="btn btn-danger btn-xs delete" id="' + data[count].id + '"><i class="fa fa-trash text-white"></i></a></td></tr>';
                            html += '<td><a type="button" class="btn btn-outline-info btn-xs square-btn edit" id="' + data[count].id + '"> <i class="tio-edit"></i> </a> </td></tr>';
                        }
                        $('tbody').html(html);
                    }
                }
            });
        }

        $('#add').on('click', function () {
            // $('#add').attr("disabled", true);
            var name = $('#name').val();
            var link = $('#link').val();
            if (name == "") {
                toastr.error('<?php echo e(translate('Social Name Is Requeired')); ?>.');
                return false;
            }
            if (link == "") {
                toastr.error('<?php echo e(translate('Social Link Is Requeired')); ?>.');
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('admin.business-settings.web-app.third-party.social-media-store')); ?>",
                method: 'POST',
                data: {
                    name: name,
                    link: link
                },
                success: function (response) {
                    if (response.error == 1) {
                        toastr.error('<?php echo e(translate('Social Media Already taken')); ?>');
                    } else {
                        toastr.success('<?php echo e(translate('Social Media inserted Successfully')); ?>.');
                    }
                    $('#name').val('');
                    $('#link').val('');
                    fetch_social_media();
                }
            });
        });
        $('#update').on('click', function () {
            $('#update').attr("disabled", true);
            var id = $('#id').val();
            var name = $('#name').val();
            var link = $('#link').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('admin.business-settings.web-app.third-party.social-media-update')); ?>",
                method: 'POST',
                data: {
                    id: id,
                    name: name,
                    link: link,
                },
                success: function (data) {
                    $('#name').val('');
                    $('#link').val('');

                    toastr.success('<?php echo e(translate('Social info updated Successfully')); ?>.');
                    $('#update').hide();
                    $('#add').show();
                    fetch_social_media();

                }
            });
            $('#save').hide();
        });
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            if (confirm("<?php echo e(translate('Are you sure delete this social media')); ?>?")) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "<?php echo e(route('admin.business-settings.web-app.third-party.social-media-delete')); ?>",
                    method: 'POST',
                    data: {id: id},
                    success: function (data) {
                        fetch_social_media();
                        toastr.success('<?php echo e(translate('Social media deleted Successfully')); ?>.');
                    }
                });
            }
        });
        $(document).on('click', '.edit', function () {
            $('#update').show();
            $('#add').hide();
            var id = $(this).attr("id");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('admin.business-settings.web-app.third-party.social-media-edit')); ?>",
                method: 'POST',
                data: {id: id},
                success: function (data) {
                    $(window).scrollTop(0);
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#link').val(data.link);
                    fetch_social_media()
                }
            });
        });
        $(document).on('change', '.status', function () {
            var id = $(this).attr("id");
            if ($(this).prop("checked") == true) {
                var status = 1;
            } else if ($(this).prop("checked") == false) {
                var status = 0;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('admin.business-settings.web-app.third-party.social-media-status-update')); ?>",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function () {
                    toastr.success('<?php echo e(translate('Status updated successfully')); ?>');
                }
            });
        });
    </script>

    <script>
        function status_change_sm(t) {
            console.log(t.id)
            let url = "<?php echo e(route('admin.business-settings.web-app.third-party.social-media-status-update')); ?>" + "?id=" + t.id;
            console.log(url)
            let checked = $(t).prop("checked");
            let status = checked === true ? 1 : 0;

            Swal.fire({
                title: 'Are you sure?',
                text: 'Want to change status',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FC6A57',
                cancelButtonColor: 'default',
                cancelButtonText: '<?php echo e(translate("No")); ?>',
                confirmButtonText: '<?php echo e(translate("Yes")); ?>',
                reverseButtons: true
            }).then((result) => {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: url,
                            data: {
                                status: status
                            },
                            success: function (data, status) {
                                toastr.success("<?php echo e(translate('Status changed successfully')); ?>");
                            },
                            error: function (data) {
                                toastr.error("<?php echo e(translate('Status changed failed')); ?>");
                            }
                        });
                    }
                    else if (result.dismiss) {
                        if (status == 1) {
                            $('#' + t.id).prop('checked', false)

                        } else if (status == 0) {
                            $('#'+ t.id).prop('checked', true)
                        }
                        toastr.info("<?php echo e(translate("Status hasn't changed")); ?>");
                    }
                }
            )
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task\laraval2\resources\views/admin-views/business-settings/social-media.blade.php ENDPATH**/ ?>