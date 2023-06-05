

<?php $__env->startSection('content'); ?>

<?php $__env->startSection('meta'); ?>
    <meta  name=title content="Compras online republica dominicana | Tiendas digitales" >
    <meta  name=description content="Descubre las tiendas online que tenemos en República Dominicana, dealer, indumentaria, zapatos y mas">
    <meta  name=keywords content="tiendas, tiendas en Dominicana, compra venta, ventas, Dominicana ventas, comprar en santo domingo, tiendas online">
    <meta  property=og:locale content="es_do" >
    <meta  property=og:description content="Descubre las tiendas online que tenemos en República Dominicana, dealer, indumentaria, zapatos y mas " >
    <meta  property=og:site_name content="Tiendas Digitales" >
    <title>Compras online republica dominicana | Tiendas digitales</title>
<?php $__env->stopSection(); ?>
<section class="min-height">
    <div class="banner">
        <div class="banner__background" style=" background-image: url('/assets/img/hero/h005.jpg');
                    background-attachment: fixed;
                    background-size: cover;
                    background-position: center center;
                    background-repeat: no-repeat;">
        </div>
        <div class="banner__foreground text-center">
            <h1 class="section__title fw-bold banner__title banner__title--primary">Crea tu Tienda Digital totalmente gratis</h1>
            <h4 class="d-none d-md-block fw-normal banner__title banner__title--light">Conectamos compradores y vendedores en Republica Dominicana</h4>
            <a href="#" class="mt-3 mt-md-5 btn btn-primary">Crear Tienda Digital</a>
        </div>
    </div>
    <div class="container mt-4">
        <h2 class="text-center">Tiendas Digitales</h2>
        <hr class="my-4">
        <div class="row mb-4 gy-3 gx-2 justify-content-center">
            <?php $__currentLoopData = $tiendas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tienda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                    <div class="card overflow-hidden card-hover mx-2">
                        <img src="<?php echo e(Voyager::get_image($tienda->logo, 'cropped', 'storage')); ?>" class="card-img-top" alt="<?php echo e($tienda->titulo); ?>">
                        <div class="card-header-overlay">
                            <h5 class="card-title text-center m-0 section__lead section__lead--responsive h6"><?php echo e(str_limit($tienda->titulo, 38)); ?></h5>
                        </div>
                        <a href="/tienda/<?php echo e(str_slug($tienda->titulo, '-')); ?>/<?php echo e($tienda->id); ?>" class="stretched-link"></a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <?php echo e($tiendas->render()); ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/comerciosTiendas/index.blade.php ENDPATH**/ ?>