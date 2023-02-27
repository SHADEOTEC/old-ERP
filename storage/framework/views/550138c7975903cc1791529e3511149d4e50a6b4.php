<?php $__env->startSection('content'); ?>
    <?php
        $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
    ?>

    <div class="card">
        <form class="" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col text-md-left text-center">
                    <h5 class="mb-md-0 h6"><?php echo e(translate('Dealer Orders')); ?></h5>
                </div>
                <div class="col-lg-2">
                    <div class="form-group mb-0">

                    </div>
                </div>
                <!-- <div class="col-lg-2">
                            <div class="form-group mb-0">
                                <select class="form-control form-control-sm aiz-selectpicker mb-md-0 mb-2" id="seller_id" name="seller_id">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="search" name="search"<?php if(isset($sort_search)): ?> value="<?php echo e($sort_search); ?>" <?php endif; ?> placeholder="<?php echo e(translate('Type Order# & hit Enter')); ?>">
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary"><?php echo e(translate('Filter')); ?></button>
                            </div>
                        </div> -->
            </div>
        </form>

        <!-- Xzt Order Display for Admin-->
        <div class="card-body">
            <table class="aiz-table w-100 m-0 mb-0 table p-0" style="font-size:12px; width:100%;">
                <thead>
                    <tr>
                        <th style="vertical-align:middle;">Item#</th>
                        <th style="vertical-align:middle;">Date</th>
                        <!--th style="vertical-align:middle;">Product ID</th-->
                        <th data-breakpoints="lg" style="vertical-align:middle;">Dealer Name</th>
                        <!--th style="vertical-align:middle;">Tags</th-->
                        <th style="vertical-align:middle;">Quantity</th>
                        <th style="vertical-align:middle;">Product Name</th>
                        <!--th style="vertical-align:middle;">Width</th-->
                        <!--th style="vertical-align:middle;">Length</th-->
                        <th style="vertical-align:middle;">Total Price</th>
                        <th style="vertical-align:middle;">Details</th>
                        <th style="vertical-align:middle;text-align:center;">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="table-row-each-order-item">
                            <td style="width:16%;vertical-align:middle;"><?php echo e($item->order_number); ?></td>
                            <!--td style="vertical-align:middle;"><?php echo e($item->product_id); ?></td-->
                            <td style="vertical-align:middle;"><?php echo e($item->date); ?></td>
                            <td style="vertical-align:middle;"><?php echo e($item->dealer_name); ?></td>
                            <td style="vertical-align:middle;"><?php echo e($item->quantity); ?></td>
                            <td style="vertical-align:middle;"><?php echo e($item->product->name); ?></td>
                            <!--td style="vertical-align:middle;"><?php echo e($item->width); ?></td-->
                            <!--td style="vertical-align:middle;"><?php echo e($item->length); ?></td-->
                            <td style="width:9%;vertical-align:middle;">$ <?php echo e(number_format($item->total_price, 2, '.', '')); ?></td>
                            <td style="vertical-align:middle;">
                                <a href="<?php echo e(route('seller_orders.specs', $item->order_number)); ?>" class="" title="">Details</a>
                            </td>
                            <td style="vertical-align:middle;text-align:center;white-space: nowrap;">
                                <?php if($item->status != 'Pending'): ?>
                                    <a href="<?php echo e(route('seller_orders.delivery_note', $item->id)); ?>" class="" title="" target="_blank" >Delivery Notes</a> |
                                    <a href="<?php echo e(route('seller_orders.labels', $item->id)); ?>" class="" title="" target="_blank" >Labels</a>
                                <?php else: ?>
                                    <a href=" <?php echo e(route('seller_orders.orders.edit', ['id' => $item->id])); ?> " class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i class="las la-edit"></i> </a>
                                    <a href="#" onclick="deleteItem('<?php echo e($item->id); ?>')" data-id="<?php echo e($item->id); ?>" class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i class="las la-trash"></i> </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="aiz-pagination">
                <?php echo e($orders->appends(request()->input())->links()); ?>

            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
    <?php echo $__env->make('modals.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function sort_orders(el) {
            $('#sort_orders').submit();
        }

        function deleteItem(id) {
            let totalItemsCount = $(".table-row-each-order-item").length;
            if (totalItemsCount <= 1) {
                if (confirm("You have only one item in order. This will delete your whole order. Do you want to delete this order?")) {
                    window.location.href = `/orders/delete/${id}`;
                }
            } else {
                if (confirm("Do you want to delete item from order")) {
                    window.location.href = `/orders/delete/${id}`;
                }
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp7\htdocs\ERP\resources\views/backend/sales/seller_orders/lineitems.blade.php ENDPATH**/ ?>