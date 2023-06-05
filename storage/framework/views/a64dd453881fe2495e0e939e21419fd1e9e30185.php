
<?php if($marca->count() > 0): ?>
  <option value="">Seleccione</option>
  <?php $__currentLoopData = $marca; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marcas_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $get_marca = $marcas_id->marcasId()->first(); ?>
      <option value="<?php echo e($get_marca->id); ?>" ><?php echo e($get_marca->name); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
  <option value="">Sin marca</option>
<?php endif; ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/shared/listadoMarcas.blade.php ENDPATH**/ ?>