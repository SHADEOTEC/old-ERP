<?php $__env->startSection('content'); ?>

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6"><?php echo e(translate('Add New Status')); ?></h5>
</div>

<div class="col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6"><?php echo e(translate('Status Information')); ?></h5>
        </div>
        <div class="card-body">
            <form action="<?php echo e(url('admin/store')); ?>" method="POST">
            	<?php echo csrf_field(); ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name"><?php echo e(translate('Status')); ?></label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="<?php echo e(translate('Order Status')); ?>" id="name" name="name" class="form-control" required>
                    </div>
                </div>
                

                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary"><?php echo e(translate('Save')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp7\htdocs\ERP\resources\views/backend/orderstatus/create.blade.php ENDPATH**/ ?>