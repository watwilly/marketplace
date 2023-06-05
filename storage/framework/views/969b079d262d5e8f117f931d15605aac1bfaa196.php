<?php $__env->startSection('meta'); ?>
    <meta  name=title content="<?php echo e(Voyager::setting('title')); ?> - Registrate y Vende mas" >
    <meta  name=description content="Compra venta en Tucuman, sitio web lider en comra venta de tucuman">
    <meta  property=og:locale content="es_ar" >
    <meta  property=og:description content="Registrate en Ventas Tucuman y compra y vende todo lo que quieras, sin intermediario ni comociones, cobra tus articulos en efectivo, o con los medios de pagos, Mercado Pago, Todo Pago" >
    <meta  property=og:site_name content="Registro de Usuario - Ventas Tucuman" >
    <meta property="og:title" content="Registro de Usuario - Ventas Tucuman"/>
    <meta  name=keywords content="Registro en Tucuman, vender en Tucuman, mil ventas tucuman, 1000 ventas tucuman, comprar en tucuman, marketplace en tucuman">
    <title><?php echo e(Voyager::setting('site.title')); ?> - Publica gratis  en Tucumán </title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="py-6" style="min-height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-5">Registrate de Forma Gratuita</h2>
            </div>
            <div class="col-12 col-lg-4">
                <div class="row g-3">
                    <div class="col-12">
                        <h3 class="lead">Ingresar con tu cuenta de:</h3>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo e(url('/auth/facebook')); ?>" class="d-block btn btn-blue"><i class="fab fa-facebook-square"></i> Facebook</a>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo e(url('/auth/google')); ?>" class="d-block btn btn-red text-white"><i class="fab fa-google-plus-g"></i> Google+</a>
                    </div>

                    <div class="col-12">
                        <hr class="my-6">
                    </div>

                    <div class="col-12">
                        <h3 class="lead">Registrate con tus datos</h3>
                    </div>
                    <form method="POST" class="row" action="<?php echo e(route('register')); ?>" >
                        <?php echo csrf_field(); ?>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="name" value="<?php echo e(old('name')); ?>" required class="form-control" id="input_name" placeholder="Ejemplo">
                                <label for="input_name">Nombre</label>
                            </div>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="apellido" value="<?php echo e(old('apellido')); ?>" required class="form-control" id="input_lastname" placeholder="Ejemplo">
                                <label for="input_lastname">Apellido</label>
                            </div>
                            <?php $__errorArgs = ['apellido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" name="email" value="<?php echo e(old('email')); ?>" required class="form-control" id="input_email" placeholder="Ejemplo">
                                <label for="input_email">E-mail</label>
                            </div>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" name="password"  required class="form-control" id="input_pass" placeholder="Ejemplo">
                                <label for="input_pass">Contraseña</label>
                            </div>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" name="password_confirmation" required  class="form-control" id="input_pass2" placeholder="Ejemplo">
                                <label for="input_pass2">Repetir Contraseña</label>
                            </div>
                            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="terminos" required id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Acepto los <a href="/nota/2/condiciones-de-uso-online">Términos y Condiciones</a> y <a href="/nota/3/condiciones-de-uso-online">Politicas de Privacidad</a>
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="g-recaptcha" data-sitekey="<?php echo e(Voyager::setting('site.ccg')); ?>"></div>
                            <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-12">
                            <div class="d-flex g-2 justify-content-center">
                                <button class="btn btn-primary w-50">Registrarme</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-12">
                        <div class="d-flex flex-column align-items-center">
                            <a href="/auth/user/login" class="section__link section__link--secondary">Ya tengo cuenta</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="d-none d-lg-flex h-100 flex-column justify-content-start align-items-center">
                    <img src="https://www.saldeello.com/storage/settings/October2021/xcQCvpXbvp4cRVboM2Q9.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/auth/register.blade.php ENDPATH**/ ?>