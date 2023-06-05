<?php $__env->startSection('content'); ?>

<?php $__env->startSection('meta'); ?>
    <meta  name=title content="Todas las categorias en saldeello.com" >
    <meta  name=description content="En nuestro sitio web puedes comprar y vender todo lo que quieras.">
    <meta  property=og:locale content="es_ar" >
    <meta  property=og:description content="En nuestro sitio web puedes comprar y vender todo lo que quieras." >
    <meta  property=og:site_name content="Categorias de saldeello.com" >
    <meta  name=keywords content="Autos, motos, computadoras, servicios, celulares,jardineria">
    <meta  name="author" content="Ventas Tucumán">
    <title>Todas las categorías en saldeello.com</title>
<?php $__env->stopSection(); ?>

<section class="min-height">
    <div class="banner">
        <div class="banner__background" style=" background-image: url('assets/img/hero/h005.jpg');
                    background-attachment: fixed;
                    background-size: cover;
                    background-position: center center;
                    background-repeat: no-repeat;">
        </div>
        <div class="banner__foreground text-center">
            <h1 class="section__title fw-bold banner__title banner__title--primary">Todas las categorías</h1>
            <h4 class="fw-normal banner__title banner__title--light">Encontrá el producto o servicio que buscas</h4>
        </div>
    </div>
    <div class="container my-4">
		<?php $__currentLoopData = $parent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php 
				$children = $category->subcategoryId()->take(12)->get();
			?>

	        <div class="card my-3 shadow">
	            <div class="card-header bg-primary p-0">
	                <a href="/categoria/<?php echo e($category->id); ?>/<?php echo e(str_slug($category->name, '-')); ?>" class="link-dark h6 m-0 p-3 d-block">
	                    <?php echo e($category->name); ?>

	                </a>
	            </div>
	            <div class="card-body">
	                <div class="row g-0">
						<?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childrens): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                    <div class="col-12 col-md-6 col-lg-4">
		                        <a href="/categoria/<?php echo e($childrens->id); ?>/<?php echo e(str_slug($childrens->name, '-')); ?>" class="link-dark link-block"><?php echo e($childrens->name); ?></a>
		                    </div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                </div>
	            </div>
	        </div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/category/all.blade.php ENDPATH**/ ?>