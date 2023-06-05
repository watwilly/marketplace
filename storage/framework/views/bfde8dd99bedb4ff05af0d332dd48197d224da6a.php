<div class="sidemenu">
    <button class="btn btn-lg text-light sidemenu__close">&times;</button>
    <?php if(is_null($user)): ?>
        <h3 class="text-primary">saldeello.com</h3>
    <?php else: ?>
        <h3 class="text-primary"><?php echo e($user->name); ?></h3>
    <?php endif; ?>
    <hr class="my-5 bg-light">
    <div class="container-fluid">
        <div class="row g-2">
            <div class="col-6">
                <?php if(is_null($user)): ?>
                    <a href="/auth/user/login" class="d-block btn btn-outline-light">Iniciar Sesión</a>
                <?php else: ?>
                    <a href="/dashboard" class="d-block btn btn-outline-light">Mi Cuenta</a> 
                <?php endif; ?>
            </div>
            <div class="col-6">
                <?php if(is_null($user)): ?>
                    <a href="/auth/user/register" class="d-block btn btn-light">Registrarse</a>
                <?php else: ?>
                    <a href="/logout" class="d-block btn btn-light">Cerrar Sesión</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <hr class="my-5 bg-light">
    <?php if(Auth::check()): ?>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="/dashboard" class="nav-link link-light">Panel de Usuario</a>
            </li>
            <li class="nav-item">
                <a href="/ventas" class="nav-link link-light">Publicaciones</a>
            </li>
            <li class="nav-item">
                <a href="/interesados" class="nav-link link-light">Consultas</a>
            </li>
            <li class="nav-item">
                <a href="/comercio" class="nav-link link-light">Mis Tiendas</a>
            </li>
  
            <li class="nav-item">
                <a href="/cuenta" class="nav-link link-light">Mi Cuenta</a>
            </li>
            <!--<li class="nav-item">
                <a href="/adm/ofertas-laborales" class="nav-link link-light">Ofertas Laborales</a>
            </li>-->
            <li class="nav-item">
                <a href="/reportar-incidencia" class="nav-link link-light">Reportar un Problema</a>
            </li>
        </ul>
    <hr class="my-5 bg-light">
    <?php endif; ?>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="/todas-las-categorias" class="nav-link link-light">Categorías</a>
        </li>
        <li class="nav-item">
            <a href="/contratar/servicios" class="nav-link link-light">Servicios</a>
        </li>
        <li class="nav-item">
            <a href="/buenos-precios" class="nav-link link-light">Promociones</a>
        </li>
        <li class="nav-item">
            <a href="/tiendas-digitales" class="nav-link link-light">Tiendas</a>
        </li>
    </ul>
</div><?php /**PATH /var/www/saldeello.com/www/html/resources/views/layouts/sidebarmenu.blade.php ENDPATH**/ ?>