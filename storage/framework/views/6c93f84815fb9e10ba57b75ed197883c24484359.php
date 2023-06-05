<?php $__env->startSection('content'); ?>
<?php $__env->startSection('meta'); ?>
    <meta  name=title content="Contactate con el mejor sitio de compra online" >
    <meta  name=description content="Contactate con el mejor sitio de compra online">
    <title>Contactate con el mejor sitio de compra online</title>
<?php $__env->stopSection(); ?>
<section class="min-height">
    <div class="container mt-4">
        <h2 class="text-center">¡Hablanos! Estamos para ayudarte</h2>
        <h6 class="lead text-center my-5">Nos preocupa la experiencia que nuestros usuario pueden tener navegando en nuestro sitio web, por eso nos interesa tu opinión. Gracias a ella podemos seguir creciendo y mejorando nuestra plataforma para brindarte un mejor servicio y atención.</h6>

        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-5">
                <div class="container-fluid py-3 h-100 shadow rounded bg-white">
                    <h4 class="section__lead">Información de contacto</h4>
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                            <b><i class="fas fa-phone"></i> Teléfono</b>
                            <span> +1 (849) 360-2754</span>
                        </li>
                        <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                            <b><i class="far fa-envelope"></i> E-mail</b>
                            <span>info@saldeello.com</span>
                        </li>
                        <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                            <b><i class="fab fa-facebook-square"></i> Facebook</b>
                            <a href="https://www.facebook.com/saldeello.20" target="_blank" class="link-blue">saldeello.20</a>
                        </li>
                     
                        <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                            <b><i class="fab fa-instagram"></i> Instagram</b>
                            <a href="https://www.instagram.com/saldeello" target="_blank" class="link-violet">saldeello</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="container-fluid py-3 h-100 shadow rounded bg-white">
                    <h4 class="section__lead">Enviar un mensaje</h4>
                    <div class="row g-3">
                  <form action="/form-contacto" role="form" method="post" >
                      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"></input>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="name" required  class="form-control" id="input_name" placeholder="Ejemplo">
                                <label for="input_name">Nombre y Apellido</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" name="email" required class="form-control" id="input_email" placeholder="Ejemplo">
                                <label for="input_email">E-mail</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea type="text" name="detalle" required  class="form-control" id="input_message" placeholder="Ejemplo" style="height: 200px;"></textarea>
                                <label for="input_message">¿Cuál es tu consulta?</label>
                            </div>
                        </div>
                        <div class="col-12">
                          <div class="g-recaptcha" data-sitekey="<?php echo e(Voyager::setting('site.ccg')); ?>"></div>
                        </div>

                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-primary">Enviar mensaje</button>
                        </div>
                  </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/home/contacto.blade.php ENDPATH**/ ?>