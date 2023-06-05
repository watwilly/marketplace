		
<option value="">Sub categoría</option>
<?php $__currentLoopData = $categoria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorias): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($categorias->id); ?>" <?php if(isset($_POST['subcategoryId']) && $_POST['subcategoryId'] == $categorias->id): ?><?php echo e('selected="selected"'); ?><?php endif; ?>><?php echo e($categorias->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /var/www/saldeello.com/www/html/vendor/tcg/voyager/src/../resources/views/posts/subcategory.blade.php ENDPATH**/ ?>