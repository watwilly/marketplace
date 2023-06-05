
<?php if($categoria->count() >  0): ?>
  <?php $__currentLoopData = $categoria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorias): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($categorias->id); ?>"><?php echo e($categorias->name); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/shared/subCategory.blade.php ENDPATH**/ ?>