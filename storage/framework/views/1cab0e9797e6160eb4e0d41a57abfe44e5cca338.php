<?php $__currentLoopData = $consultas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consulta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="alert alert-gray">
        <h6 class="text-black"><?php echo e($consulta->mensaje); ?></h6>
        <?php if($consulta->answered): ?>
        <p class="ms-4" style="word-break: break-all;"><?php echo e($consulta->answered); ?></p>
        <?php endif; ?>
        <span class="d-block text-end"><?php echo e($consulta->created_at->todateString()); ?></span>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/interesados/autoload.blade.php ENDPATH**/ ?>