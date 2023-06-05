<?php $__env->startSection('meta'); ?>
  <title>Bienvenido a <?php echo e(Voyager::setting('site.title')); ?></title>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
  
<div class="container bg-white " style="padding: 19px;" >
    <div class="col-md-12 col-sm-12 col-xs-12   ">
      <div class="col-md-12 mb-5 p-3 col-sm-12 col-xs-12  text-center" style=" margin-bottom: 15px;    background: white;border-radius: 7px;">
        <h2 style="font-size: 24px;margin-top: 15px;">Te damos la bienvenida, a <b>saldeello.com</b></h2>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 row welcome" style=" margin-bottom: 15px;">
        
        <div class="col-md-6 mb-5">
          <div class="col-md-12 cont  text-center b-white">
            <div class="col-md-12">
              <i class="fa fa-bookmark"></i>
            </div>
            <div class="col-md-12">
              <h2><a href="/comercio" class="c-black">Crear tienda digital</a></h2>
            </div>
          </div>
        </div>

        <div class="col-md-6  mb-5 ">
          <div class="col-md-12 cont text-center   b-white">
            <div class="col-md-12">
              <i class="fa fa-cart-plus"></i>
            </div>
            <div class="col-md-12">
              <h2><a href="/vender" class="c-black">Publicar Productos o servicios</a></h2>
            </div>
          </div>
        </div>
        <div class="col-md-6  " style="margin: auto;float: initial;">
          <div class="col-md-12 cont text-center   b-white">
            <div class="col-md-12">
              <i class="fa fa-user fa-2x "></i>
            </div>
            <div class="col-md-12">
              <h2><a href="/dashboard" class="c-black">Ir al Administrador</a></h2>
            </div>
          </div>
        </div>
      </div>

  </div>
</div>

<?php $__env->startSection('jsheader'); ?>
 
<?php $__env->appendSection(); ?>


<?php $__env->startSection('jsfooter'); ?>

 
<?php $__env->appendSection(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/shared/first.blade.php ENDPATH**/ ?>