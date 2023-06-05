<?php $__env->startSection('meta'); ?>
    <title>Cuenta</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <section class="min-height">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-3 p-0 d-none d-lg-block">
              <?php echo $__env->make('auth.colder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-12 col-lg-8 col-xl-9 py-5">
                <div class="grid rows-2 rows-lg-1 cols-1 cols-lg-2 justify-content-stretch align-items-center">
                    <div class="grid-item p-0 justify-self-center justify-self-lg-start">
                        <h2 class="m-0">Mi Cuenta</h2>
                    </div>
                </div>

                <div class="row gx-3 gy-5 mt-6">
                    <?php if($user->active == 0): ?>
                        <div class="alert alert-info col-md-12 col-xs-12 col-sm-12">Tienes que validar tu email <b><a href="#" onclick="emailValidacion();">Enviar email de validacion</a></b></div>
                    <?php endif; ?>
                    <div class="col-12">
                        <h4 class="lead text-center text-lg-start">Datos de la cuenta</h4>
                    </div>
                    <form action="/user_edit" method="post" class="row gx-3 gy-5 mt-" >
                        <?php echo csrf_field(); ?>
                        <div class="col-12 col-lg-8">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="input_email" placeholder="Ejemplo" <?php if($user->email): ?> disabled readonly <?php else: ?> name="email" <?php endif; ?> value="<?php echo e($user->email); ?>">
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

                        <div class="col-4 d-none d-lg-block"></div>

                        <?php if(is_null($user->name)): ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control" id="input_name" value="<?php echo e($user->name); ?>" placeholder="Ejemplo">
                                <label for="input_name">Nombre</label>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(is_null($user->apellido)): ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-floating">
                                <input type="text" name="apellido" class="form-control" id="input_lastname" value="<?php echo e($user->apellido); ?>" placeholder="Ejemplo">
                                <label for="input_lastname">Apellido</label>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="col-12"></div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-floating">
                                <input name="telefono" type="tel" value="<?php echo e($user->telefono); ?>" class="form-control" id="input_phone" placeholder="Ejemplo">
                                <label for="input_phone">Teléfono</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" value="<?php echo e($user->cuit); ?>"  name="cuit" id="dnicuil" placeholder="Ejemplo">
                                <label for="input_dni">DNI/Cuil</label>
                            </div>
                            <?php $__errorArgs = ['cuit'];
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

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-floating">
                                <input type="text" name="direccion" value="<?php echo e($user->direccion); ?>"  class="form-control" id="input_address" placeholder="Ejemplo">
                                <label for="input_address">Domicilio</label>
                            </div>
                        </div>

                        <div class="col-12"></div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-floating">
                                <select class="form-select" name="provincia_id" id="provincia_id" aria-label="Floating label select example">
                                    <?php $__currentLoopData = $provincias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provincia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($provincia->id); ?>" <?php if(isset($user->provincia_id) && $user->provincia_id == $provincia->id): ?><?php echo e('selected="selected"'); ?><?php endif; ?>><?php echo e($provincia->provincia); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <label for="input_province">Provincia</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-floating">
                                <select class="form-select" name="localidad_id" id="localidad_id" aria-label="Floating label select example">
                                        <?php
                                            if(isset($user->localidad_id)){
                                                $localidad = $user->localidades()->first();
                                                ?><option value="<?php echo e($localidad->id); ?>" <?php if(isset($user->localidad_id) && $user->localidad_id == $localidad->id): ?><?php echo e('selected="selected"'); ?><?php endif; ?>><?php echo e($localidad->localidad); ?></option><?php
                                            }
                                        ?>
                                </select>
                                <label for="input_city">Localidad</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-floating">
                                <input type="number" name="cpa" value="<?php echo e($user->cpa); ?>" class="form-control" id="input_code" placeholder="Ejemplo">
                                <label for="input_code">Cógido postal</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <h4 class="lead mt-6 text-center text-lg-start">Cambiar contraseña
                                <br>
                                <small class="text-muted">ATENCIÓN: llene este solo campo si desea modificar su contraseña</small>
                            </h4>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-floating">
                                <input type="password" name="newPassword" class="form-control" id="input_password" placeholder="Ejemplo">
                                <label for="input_password">Nueva contraseña</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-floating">
                                <input type="password" name="password_confirmation" class="form-control" id="input_confirm" placeholder="Ejemplo">
                                <label for="input_confirm">Confirmar contraseña</label>
                            </div>
                        </div>

                        <div class="col-12 d-flex mt-6">
                            <button class="btn btn-success mx-auto">Guardar cambios</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/auth/user/cuenta.blade.php ENDPATH**/ ?>