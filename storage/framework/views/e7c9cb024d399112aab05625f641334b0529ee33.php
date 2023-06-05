
<?php $__env->startSection('meta'); ?>
    <title>Editando publicacion</title>
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
                        <h2 class="m-0">Editar/Nueva Publicación</h2>
                    </div>
                    <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                        <a href="#" onclick="history.back()" class="section__link section__link--secondary">Volver</a>
                    </div>
                </div>

                <div class="row g-3 mt-6">
                  <div id="alertset"></div>
                  <form method="POST" action="/update_ventas/<?php echo e($edit->id); ?>" accept-charset="UTF-8" enctype="multipart/form-data" class="row">
                    <?php echo csrf_field(); ?>
                    <div class="col-12">
                        <h4 class="lead text-center text-lg-start">Estado de la publicación</h4>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" id="input_visible" <?php if($edit->status=="PUBLISHED"): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="input_visible">Publicación Visible</label>
                        </div>
                    </div> 
                    <!--<div class="col-12 col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="input_disccount">
                            <label class="form-check-label" for="input_disccount">Aplicar descuento</label>
                        </div>
                    </div>-->

                    <div class="col-12">
                        <h4 class="lead mt-6 text-center text-lg-start">Detalle de tu publicación</h4>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-floating">
                            <select class="form-select" id="input_condition" name="condicion" aria-label="Floating label select example">
                              <option value="NUEVO" <?php if($edit->condicion == 'NUEVO'): ?> selected <?php endif; ?>>Nuevo</option>
                              <option value="USADO" <?php if($edit->condicion == 'USADO'): ?> selected <?php endif; ?>>Usado</option>
                              <option value="like-new" <?php if($edit->condicion == 'like-new'): ?> selected <?php endif; ?>>Usado Como nuevo</option>
                            </select>
                            <label for="input_condition">Condición</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-floating">
                            <input type="number" class="form-control" name="precio" <?php if($edit->precios > 1): ?> value="<?php echo e($edit->precios); ?>" <?php endif; ?> id="input_price" placeholder="Ejemplo">
                            <label for="input_price">Precio</label>
                             <input type="checkbox" name="withoutprice" <?php if($edit->precios == 1): ?> checked <?php endif; ?> class="form-copntrol"> Marque aquí para publicar sin precio
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-floating">
                            <input type="number" name="cantidad" class="form-control" value="<?php echo e($edit->cantidad); ?>" id="input_stock" placeholder="Ejemplo">
                            <label for="input_stock">Cantidad</label>
                        </div>
                    </div>
                    <?php if($tiendas->count()>0): ?>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-floating">
                            <select required class="form-select" id="input_tienda_id" name="tienda_id" aria-label="Floating label select example">
                                <option value="">Seleccione</option>
                                <?php $__currentLoopData = $tiendas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tienda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tienda->id); ?>" <?php if($edit->tienda_id == $tienda->id): ?> selected <?php endif; ?>><?php echo e($tienda->titulo); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label for="input_condition">Tienda</label>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($vehiculos->count() > 0): ?>
                      <?php $getVehiculo =  $vehiculos->first(); ?>
                      <div class="col-12 col-md-6 col-lg-3">
                          <div class="form-floating">
                              <input type="number" name="kilometros" class="form-control" value="<?php echo e($getVehiculo->kilometros); ?>" id="input_stock" placeholder="Ejemplo">
                              <label for="input_stock">Kilometros</label>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-3">
                          <div class="form-floating">
                              <input type="number"  name="anio" class="form-control" value="<?php echo e($getVehiculo->anio); ?>" id="input_stock" placeholder="Ejemplo">
                              <label for="input_stock">Años</label>
                          </div>
                      </div>
                    <?php endif; ?>

                    <!--<div class="col-12 col-md-6 col-lg-3">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="input_disccount_amount" placeholder="Ejemplo">
                            <label for="input_disccount_amount">Descuento</label>
                        </div>
                    </div> -->


                    <div class="col-12">
                        <div class="form-floating mt-6">
                            <input type="text" name="title" class="form-control" value="<?php echo e($edit->title); ?>" id="input_title" placeholder="Ejemplo">
                            <label for="input_title">Título de la publicación </label>
                            <small class="ms-3 text-muted section__lead">(Max. 70 caracteres)</small>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea   name="body"  type="text" class="form-control" id="input_details" placeholder="Ejemplo" style="height: 200px;"><?php if(isset($edit->body)): ?><?php echo e($edit->body); ?><?php endif; ?></textarea>
                            <label for="input_details">Descripción de la publicación</label>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="grid mt-6 rows-2 rows-lg-1 cols-1 cols-lg-2 justify-content-stretch align-items-center">
                            <div class="grid-item p-0 justify-self-center justify-self-lg-start">
                                <h4 class="lead">Fotos e imágenes</h4>
                            </div>
                            <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                                <input type="file" id="input_images"  name="image_edit[]" multiple class="d-none">
                                <label for="input_images" class="section__link section__link--primary">Subir fotos</label>
                                <a href="/auth/<?php echo e($edit->id); ?>/order-image" class="btn btn-info mx-auto">Ordenar Fotos</a>
                            </div>
                        </div>
                        <?php if($imagenes->count() > 0): ?>
                            <div id="input_preview" class="grid g-2 rows-1 cols-2 cols-sm-3 cols-md-4 cols-lg-5 cols-xl-6">
                                <?php $__currentLoopData = $imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <div class="grid-item p-0" id="editImagen<?php echo e($imagen->id); ?>">
                                      <img src="<?php echo e(Voyager::get_image($imagen->imagen, 'small', $imagen->storage)); ?>" alt="" class="img-preview">
                                      <a class="btn btn-danger img-preview-remove"  onclick="delete_image(<?php echo e($imagen->id); ?>);"><i class="fas fa-trash-alt"></i></a>
                                  </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12 d-flex mt-6">
                        <button class="btn btn-success mx-auto" type="submit">Guardar cambios</button>
                    </div>
                  </form>
                </div>

            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/auth/publicaciones/edit.blade.php ENDPATH**/ ?>