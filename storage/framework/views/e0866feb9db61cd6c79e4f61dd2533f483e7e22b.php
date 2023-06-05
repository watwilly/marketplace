<?php $__env->startSection('content'); ?>

<?php $__env->startSection('meta'); ?>
    <title>Panel de Usuario</title>
<?php $__env->stopSection(); ?>
<section class="min-height">
    <div class="container my-4">
        <h2 class="text-center mb-5">Panel de Usuario</h2>
        <div class="grid equal-cells gap-3 rows-8 rows-md-4 rows-lg-3 cols-1 cols-md-2 cols-lg-3 justify-items-stretch align-items-stretch">
            <div class="grid-item p-3 card-hover bg-white border-start border-4 border-primary rounded">
                <h4 class="h5 mb-3 text-dark">
                    Publicaciones
                    <i class="fas float-end fa-boxes"></i>
                </h4>
                <h6 class="lead">Crear y administrar productos y servicios</h6>
                <a href="/ventas" class="link-secondary stretched-link"></a>
            </div>
            <div class="grid-item p-3 card-hover bg-white border-start border-4 border-primary rounded">
                <h4 class="h5 mb-3 text-dark">
                    Consultas
                    <i class="far float-end fa-comments"></i>
                </h4>
                <h6 class="lead">Ver consultas pendientes y realizadas</h6>
                <a href="/interesados" class="link-secondary stretched-link"></a>
            </div>
            <div class="grid-item p-3 card-hover bg-white border-start border-4 border-primary rounded">
                <h4 class="h5 mb-3 text-dark">
                    Mis Tiendas
                    <i class="fas float-end fa-store-alt"></i>
                </h4>
                <h6 class="lead">Crear y administrar mis tiendas digitales</h6>
                <a href="/comercio" class="link-secondary stretched-link"></a>
            </div>
         
        
            <div class="grid-item p-3 card-hover bg-white border-start border-4 border-primary rounded">
                <h4 class="h5 mb-3 text-dark">
                    Mi Cuenta
                    <i class="fas float-end fa-user-cog"></i>
                </h4>
                <h6 class="lead">Administrar datos de contacto y credenciales</h6>
                <a href="/cuenta" class="link-secondary stretched-link"></a>
            </div>
            <?php if(Auth::user()->role_id == 1): ?><div class="grid-item p-3 card-hover bg-white border-start border-4 border-primary rounded">
                <h4 class="h5 mb-3 text-dark">
                    Ofertas Laborales
                    <i class="far float-end fa-handshake"></i>
                </h4>
                <h6 class="lead">Publica ofertas laborales</h6>
                <a href="/adm/ofertas-laborales" class="link-secondary stretched-link"></a>
            </div><?php endif; ?>

            <div class="grid-item p-3 card-hover bg-white border-start border-4 border-primary rounded">
                <h4 class="h5 mb-3 text-dark">
                    Reportar Problemas
                    <i class="fas float-end fa-exclamation-triangle"></i>
                </h4>
                <h6 class="lead">Informar un inconveniente sobre el sitio</h6>
                <a href="/reportar-incidencia" class="link-secondary stretched-link"></a>
            </div>
          
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/dashboard/index.blade.php ENDPATH**/ ?>