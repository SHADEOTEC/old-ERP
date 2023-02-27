<?php $__env->startSection('mystyles'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
    ?>

    <div class="card">
        <form class="" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col text-md-left text-center">
                    <h5 class="mb-md-0 h6">Orders</h5>
                </div>
                <div class="col-lg-2">
                </div>
                <div class="col-lg-2">
                    <div class="form-group mb-0">
                        <select class="form-control form-control-sm aiz-selectpicker mb-md-0 mb-2" id="seller_id" name="seller_id">
                            <option value=""><?php echo e(translate('All Dealers')); ?></option>
                            <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" <?php if($seller_id == $item->id): ?> selected <?php endif; ?>><?php echo e($item->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary"><?php echo e(translate('Filter')); ?></button>
                    </div>
                </div>
            </div>
        </form>


        <!-- Xzt Order Display for Admin-->
        <div class="card-body">
            <table class="m-0 mb-0 table p-0" id="main-order-table" style="font-size:12px; width:100%;">
                <thead>
                    <tr>
                        <th style="vertical-align:middle;">Order#</th>
                        <th style="vertical-align:middle;">Status</th>
                        <th style="vertical-align:middle;">Dealer</th>
                        <th>Tag</th>
                        <th style="vertical-align:middle;">Grand Total</th>
                        <th style="vertical-align:middle;">Date</th>
                        <th style="vertical-align:middle;">Options</th>
                        <th style="vertical-align:middle;">Delivery Note</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $main_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="vertical-align:middle;">
                                <a href="#" class="" title="" data-toggle="modal" data-target="#edit-model-order-<?php echo e($item->id); ?>"><?php echo e($item->order_no); ?></a>
                            </td>
                            <td style="vertical-align:middle;"><?php echo e($item->status); ?></td>
                            <td style="vertical-align:middle;"><?php echo e($item->user->name); ?></td>
                            <td style="vertical-align:middle;"><?php echo e($item->xztcarts[0]['project_tag']); ?></td>
                            <td style="vertical-align:middle;">$ <?php echo e(number_format($item->grand_total, 2, '.', '')); ?></td>
                            <td style="vertical-align:middle;"><?php echo e($item->created_at); ?></td>
                            <td style="vertical-align:middle;">
                                <a href="<?php echo e(route('seller_orders.get_lineitems', $item->id)); ?>" class="" title="">Order Items</a>
                                |
                                <a href="<?php echo e(route('production.items', $item->id)); ?>" class="" title="">Production</a>
                                |
                                <a href="<?php echo e(route('production.view', $item->id)); ?>" class="" title="" target="_blank">View</a>
                                |
                                <a href="<?php echo e(route('orders.labels.all', $item->id)); ?>" target="_blank">Labels</a>
                            </td>
                            <td>
                                <?php if($item->status != 'Pending'): ?>
                                    <a href="<?php echo e(route('seller_orders.main_ord_delivery_note', $item->id)); ?>" class="" title="">View Note</a>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <div class="modal fade" id="edit-model-order-<?php echo e($item->id); ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="card">
                                        <div class="card-header row gutters-5">
                                            <div class="col text-md-left text-center">
                                                <h5 class="mb-md-0 h6">Order Status</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="<?php echo e(route('seller_orders.status_upd')); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <div class="form-group">
                                                    <h6>Order Number</h6>
                                                    <p><?php echo e($item->order_no); ?></p>
                                                </div>

                                                <div class="form-group">
                                                    <h6>Total Price</h6>
                                                    <p>$ <?php echo e($item->grand_total); ?></p>
                                                </div>

                                                <div class="form-group">
                                                    <h6>Update Status</h6>
                                                    <select class="form-control" id="status" name="status">
                                                        <?php $__currentLoopData = $order_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($status->name); ?>" <?php if($item->status == $status->name): ?> selected <?php endif; ?>><?php echo e($status->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        
                                                    </select>
                                                </div>

                                                <input type="hidden" class="form-control" id="order_number" name="order_number" value="<?php echo e($item->order_no); ?>">

                                                <button type="submit" class="btn btn-primary">Update</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
    <?php echo $__env->make('modals.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        function sort_orders(el) {
            $('#sort_orders').submit();
        }

        $(document).ready(function() {
            let table = new DataTable('#main-order-table', {
                columnDefs: [{
                    orderable: false,
                    targets: [-1, -2]
                }],
                order: [
                    [0, 'desc']
                ],
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp7\htdocs\ERP\resources\views/backend/sales/seller_orders/index.blade.php ENDPATH**/ ?>