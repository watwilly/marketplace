<?php $__env->startSection("meta"); ?>
<title><?php echo e($nota->titulo); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="min-height">
    <div class="p-6 bg-dark bars-primary-3 d-flex flex-wrap align-items-center">
        <h2 class="text-center text-lg-start ms-0 ms-lg-6 section__title section__title--5 text-light text-shadow"><?php echo e($nota->titulo); ?></h2>
    </div>
    <div class="container my-4">
        <article class="card">
            <div class="card-body fs-5" style="text-align: justify;">
                <?php echo $nota->texto; ?>       
                <hr>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                            <img src="/assets/img/logo.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/notas/show.blade.php ENDPATH**/ ?>