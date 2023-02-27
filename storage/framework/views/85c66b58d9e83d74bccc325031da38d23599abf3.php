<?php
$value = null;
for ($i = 0; $i < $child_category->level; $i++) {
    $value .= '--';
}
?>
<?php if($child_category->level == 1): ?>
    <optgroup data-value="<?php echo e($child_category->id); ?>" data-parent="<?php echo e($child_category->parent_id); ?>" label="<?php echo e($child_category->name); ?>">
        <?php if($child_category->categories): ?>
            <?php $__currentLoopData = $child_category->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('categories.child_category', ['child_category' => $childCategory], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </optgroup>
<?php else: ?>
    <option value="<?php echo e($child_category->id); ?>" data-parent="<?php echo e($child_category->parent_id); ?>"><?php echo e($child_category->name); ?></option>
<?php endif; ?>
<?php /**PATH F:\xampp7\htdocs\ERP\resources\views/categories/child_category.blade.php ENDPATH**/ ?>