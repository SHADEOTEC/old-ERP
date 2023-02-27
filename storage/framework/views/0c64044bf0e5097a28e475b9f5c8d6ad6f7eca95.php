<?php $__env->startSection('mystyles'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="aiz-titlebar mt-2 mb-3 text-left">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3"><?php echo e(translate('All Dealers')); ?></h1>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="<?php echo e(route('backend.sellers.create')); ?>" class="btn btn-circle btn-info">
                    <span><?php echo e(translate('Add New Dealer')); ?></span>
                </a>
            </div>
        </div>
    </div>

    <?php if(Session::has('alert_del')): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><?php echo e(session()->get('alert_del')); ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card">
        <form class="" id="sort_sellers" action="" method="GET">

            <div class="card-body">
                <table class="mb-0 table" id="my-datatable">
                    <thead>
                        <tr>
                            <th data-breakpoints="lg">#</th>
                            <!-- <th>
                            <div class="form-group">
                                <div class="aiz-checkbox-inline">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" class="check-all">
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                            </div>
                        </th> -->
                            <th><?php echo e(translate('Name')); ?></th>
                            <th data-breakpoints="lg"><?php echo e(translate('Phone')); ?></th>
                            <th data-breakpoints="lg"><?php echo e(translate('Email Address')); ?></th>
                            <th data-breakpoints="lg">Website</th>
                            <th>State</th>
                            <th>Discount (%)</th>
                            <th width="10%"><?php echo e(translate('Options')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="vertical-align:middle;"><?php echo e($loop->iteration); ?></td>
                                <td style="vertical-align:middle;"><?php echo e($item->name); ?></td>
                                <td style="vertical-align:middle;"><?php echo e($item->phone); ?></td>
                                <td style="vertical-align:middle;"><?php echo e($item->email); ?></td>
                                <td style="vertical-align:middle;"><?php echo e($item->website); ?></td>
                                <td style="vertical-align:middle;">
                                    <?php if($item->state == 1): ?>
                                        <a href="<?php echo e(route('sellers.visibility', [$item->id, 0])); ?>" class="btn-sm btn-primary">Active</a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('sellers.visibility', [$item->id, 1])); ?>" class="btn-sm btn-danger">Inactive</a>
                                    <?php endif; ?>
                                </td>
                                <td style="vertical-align:middle;"><?php echo e($item->discountSeller->disc_percent); ?></td>
                                <td style="vertical-align:middle;">
                                    <a href="<?php echo e(route('backend.sellers.verify', $item->email)); ?>" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Verify"><i class="la la-mail-forward"></i>
                                    </a>
                                    <a href="<?php echo e(route('backend.sellers.edit', $item->id)); ?>" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Edit"><i class="las la-edit"></i>
                                    </a>
                                    <a href="<?php echo e(route('sellers.destroy', $item->id)); ?>" class="btn btn-soft-danger btn-icon btn-circle btn-sm" title="Delete" onclick='return confirm("Are you sure you want to delete this user?")'><i
                                           class="las la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>
            </from>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
    <!-- Delete Modal -->
    <?php echo $__env->make('modals.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Seller Profile Modal -->
    <div class="modal fade" id="profile_modal">
        <div class="modal-dialog">
            <div class="modal-content" id="profile-modal-content">

            </div>
        </div>
    </div>

    <!-- Seller Payment Modal -->
    <div class="modal fade" id="payment_modal">
        <div class="modal-dialog">
            <div class="modal-content" id="payment-modal-content">

            </div>
        </div>
    </div>

    <!-- Ban Seller Modal -->
    <div class="modal fade" id="confirm-ban">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h6"><?php echo e(translate('Confirmation')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <p><?php echo e(translate('Do you really want to ban this seller?')); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><?php echo e(translate('Cancel')); ?></button>
                    <a class="btn btn-primary" id="confirmation"><?php echo e(translate('Proceed!')); ?></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Unban Seller Modal -->
    <div class="modal fade" id="confirm-unban">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h6"><?php echo e(translate('Confirmation')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <p><?php echo e(translate('Do you really want to ban this seller?')); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><?php echo e(translate('Cancel')); ?></button>
                    <a class="btn btn-primary" id="confirmationunban"><?php echo e(translate('Proceed!')); ?></a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).on("change", ".check-all", function() {
            if (this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }

        });

        $(document).ready(function() {
            let table = new DataTable('#my-datatable', {
                columnDefs: [{
                    orderable: false,
                    targets: [-1]
                }],
                order: [
                    [5, 'asc']
                ],
            });
        });

        function show_seller_payment_modal(id) {
            $.post('<?php echo e(route('sellers.payment_modal')); ?>', {
                _token: '<?php echo e(@csrf_token()); ?>',
                id: id
            }, function(data) {
                $('#payment_modal #payment-modal-content').html(data);
                $('#payment_modal').modal('show', {
                    backdrop: 'static'
                });
                $('.demo-select2-placeholder').select2();
            });
        }

        function show_seller_profile(id) {
            $.post('<?php echo e(route('sellers.profile_modal')); ?>', {
                _token: '<?php echo e(@csrf_token()); ?>',
                id: id
            }, function(data) {
                $('#profile_modal #profile-modal-content').html(data);
                $('#profile_modal').modal('show', {
                    backdrop: 'static'
                });
            });
        }

        function update_approved(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('<?php echo e(route('sellers.approved')); ?>', {
                _token: '<?php echo e(csrf_token()); ?>',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '<?php echo e(translate('Approved sellers updated successfully')); ?>');
                } else {
                    AIZ.plugins.notify('danger', '<?php echo e(translate('Something went wrong')); ?>');
                }
            });
        }

        function sort_sellers(el) {
            $('#sort_sellers').submit();
        }

        function confirm_ban(url) {
            $('#confirm-ban').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('confirmation').setAttribute('href', url);
        }

        function confirm_unban(url) {
            $('#confirm-unban').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('confirmationunban').setAttribute('href', url);
        }

        function bulk_delete() {
            var data = new FormData($('#sort_sellers')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "<?php echo e(route('bulk-seller-delete')); ?>",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    }
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp7\htdocs\ERP\resources\views/backend/sellers/index.blade.php ENDPATH**/ ?>