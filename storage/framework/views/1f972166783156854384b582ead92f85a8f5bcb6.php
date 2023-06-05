<?php $__env->startSection('content'); ?>
    <div class="container">
    <div class="flex row jcenter">
        <div class="modal-body col-md-5 col-xs-12 recupera-clave">
            <h3>¿Perdiste tu contraseña?</h3>
            <p>Sigue los siguientes pasos para recuperarla:</p>
            <ol>
                <li>Introduce tu correo electrónico</li>
                <li>Recibirás un email con el link de recuperación</li>
                <li>Una vez en el link, introduce tu nueva contraseña</li>
            </ol>
            <form action="<?php echo e(route('password.email')); ?>" method="post" >
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"></input>
        
                <div class="form-floating">
                    <input type="email" required name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>" placeholder="Email">
                    <label for="input_email">Email</label>
                </div>
                <div class="form-group">
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
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12  mt-6">
                    <button type="submit" class="btn btn-success mx-auto">Enviar email</button>
                </div>
            </form>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>