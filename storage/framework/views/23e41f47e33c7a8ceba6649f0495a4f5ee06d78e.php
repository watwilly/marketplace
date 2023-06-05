<?php $__env->startSection("meta"); ?>
<title><?php echo e($category->name); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="mb-5"  >
    <div class="p-6 bg-dark bars-primary-3 d-flex flex-wrap align-items-center">
        <h2 class="text-center text-lg-start ms-0 ms-lg-6 section__title section__title--5 text-light text-shadow"><?php echo e($category->name); ?></h2>
    </div>
</section>
<section class="container">
    <div class="row mb-5">
    <?php $__currentLoopData = $notas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3">
           <a href="/nota/<?php echo e($nota->id); ?>/<?php echo e(str_slug($nota->titulo,'-')); ?>">
            <img src="/storage/<?php echo e($nota->imagen); ?>" class="img-fluid mb-3">
            <h6><?php echo e($nota->titulo); ?></h6>
            </a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/notas/index.blade.php ENDPATH**/ ?>