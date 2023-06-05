<?php 
   $url = url()->full();

    if($tienda->banner):
        $banner =  Voyager::get_image($tienda->banner, NULL, 'storage'); 
    else:
        $banner = '/img/p1.png'; 
    endif

?>
<?php $__env->startSection('meta'); ?>
    <meta  name="title" content="<?php echo e($tienda->titulo); ?> " >
    <meta  name="description" content="<?php if($tienda->descripcion): ?> <?php echo e(str_limit($tienda->descripcion, 80)); ?> <?php else: ?> compra al mejor precio en <?php echo e($tienda->titulo); ?> el comercio digital en Republica Dominicana <?php endif; ?> ">
    <meta  property=og:locale content="es_ar" >
    <meta  property=og:description content="<?php if($tienda->descripcion): ?> <?php echo e(str_limit($tienda->descripcion, 80)); ?> <?php else: ?> compra al mejor precio en <?php echo e($tienda->titulo); ?> el comercio digital en Republica Dominicana <?php endif; ?>" >
    <meta  property=og:site_name content="<?php echo e($tienda->titulo); ?>" >
    <title><?php echo e($tienda->titulo); ?> en <?php echo e(Voyager::setting('site.title')); ?> </title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 <section class="min-height">
    <div class="banner">
        <div class="banner__background" style=" background-image: url('<?php echo e($banner); ?>');background-attachment: fixed;background-size: cover;background-position: center center;background-repeat: no-repeat;"></div>
        <div class="banner__foreground banner__foreground--curtain text-center text-lg-end">
            <h1 class="section__title fw-bold banner__title banner__title--primary"><?php echo e($tienda->titulo); ?></h1>
            <h4 class="d-none d-lg-block fw-normal banner__title banner__title--light"><?php if($tienda->name): ?><?php echo e($tienda->name); ?><?php endif; ?></h4>
        </div>
        <img src="<?php echo e(Voyager::get_image($tienda->logo, 'cropped', 'storage')); ?>" alt="" class="banner__brand rounded border border-light">
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-3 p-0">
                <?php echo $__env->make('comerciosTiendas.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <?php if(count($publicaciones) > 0): ?>
                <div class="col-12 col-lg-8 col-xl-9 py-5">
                    <div class="row gy-3 gx-2 justify-content-center">
                        <div class="col-12">
                            <h2 class="text-center">Publicaciones de la tienda</h2>
                        </div>
                        <?php $__currentLoopData = $publicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e(Voyager::h_listview($publicacion["title"], $publicacion["id"], $publicacion["imagen"], $publicacion["storage"], $publicacion["precios"], 'small', $publicacion["prdcatname"], $publicacion["condicion"])); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12">
                            <div class="d-flex justify-content-center">
                                <?php echo e($render->render()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-12 col-lg-8 col-xl-9 py-5">
                    <div class="alert alert-info">Esta tienda no tiene publicaciones</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/comerciosTiendas/show.blade.php ENDPATH**/ ?>