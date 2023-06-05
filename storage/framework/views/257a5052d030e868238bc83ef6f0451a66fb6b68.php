<footer class="bg-dark text-light">
    <div class="container py-6">
        <div class="row gy-5 justify-content-center">
            <div class="col-12 text-center col-md-6 col-lg-3">
                <figure>
                    <img style="width: 64px;" src="/storage/<?php echo e(Voyager::setting('site.lf')); ?>" alt="" class="img-fluid">
                </figure>

                <hr class="my-5">

                <h4 class="text-center lead mb-5">Siguenos en nuestras redes sociales</h4>

                <div class="d-flex justify-content-evenly">
                    <a href="https://www.facebook.com/saldeello.20" target="_blank" class="link-light">
                        <i class="fab fa-2x fa-facebook-square"></i>
                    </a>
                    <a href="https://www.instagram.com/saldeello" target="_blank" class="link-light">
                        <i class="fab fa-2x fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <h4 class="text-center text-primary">saldeello.com</h4>
                <ul class="nav flex-column text-center">
                    <li class="nav-item">
                        <?php if(Auth::check()): ?>
                            <a href="/tiendas-digitales" class="nav-link link-light">Tiendas</a>
                        <?php else: ?>
                            <a href="/auth/user/login" class="nav-link link-light">Iniciar Sesión</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <?php if(Auth::check()): ?>
                            <a href="/promociones" class="nav-link link-light">Promociones</a>
                        <?php else: ?>
                            <a href="/auth/user/register" class="nav-link link-light">Registrarse</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <a href="/contacto" class="nav-link link-light">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a href="/novedades" class="nav-link link-light">Novedades</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-3">
                <h4 class="text-center text-primary">¿Cómo trabajamos?</h4>

                <ul class="nav flex-column text-center">
                    <li class="nav-item">
                        <a href="/nota/1/condiciones-de-uso-online" class="nav-link link-light">Términos y Condiciones</a>
                    </li>
                    <li class="nav-item">
                        <a href="/nota/2/politica-de-privacidad" class="nav-link link-light">Politicas de Privacidad</a>
                    </li>
                    <li class="nav-item">
                        <a href="/nota/3/quienes-somos" class="nav-link link-light">Quienes Somos</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-3">
                <div class="row h-100 align-items-center justify-content-evenly">
                    <div class="col-12">
                        <img src="/assets/img/positivessl_trust_seal_md_167x42.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-3 bg-black text-light">
        <h6 class="text-center m-0">Marketplace desarrollado por <a href="https://www.idedicado.com.ar/" target="_blank">Idedicado - Expertos en Tecnología Web</a></h6>
    </div>
</footer>
<a href="#" id="back-to-top" class="btn btn-primary back-to-top"><i class="fas fa-angle-up"></i></a><?php /**PATH /var/www/saldeello.com/www/html/resources/views/layouts/footer.blade.php ENDPATH**/ ?>