
<?php $__env->startSection('meta'); ?>
    <title>Publicaciones</title>
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
                        <h2 class="m-0">Publicaciones</h2>
                    </div>
                    <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                        <a href="/vender" class="section__link section__link--success">Nueva publicación</a>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input <?php if(isset($_GET["buscar"])): ?> value="<?php echo e($_GET["buscar"]); ?>" <?php endif; ?> type="text" list="addresses" class="form-control" id="pubname" placeholder="Ejemplo">
                            <label for="input_email">Nombre</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" id="pubcategory" aria-label="Floating label select example">
                                <option value="">Seleccione</option>
                                <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($categoria->id); ?>" <?php if(isset($_GET["category_id"])&&$_GET["category_id"]==$categoria->id): ?> selected <?php endif; ?>><?php echo e($categoria->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label for="input_addressType">Categoría</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" id="puborden" aria-label="Floating label select example">
                                <option value="">Seleccione</option>
                                <option value="ASC" <?php if(isset($_GET["orden"])&&$_GET["orden"]=="ASC"): ?> selected <?php endif; ?>>Menor precio</option>
                                <option value="DESC" <?php if(isset($_GET["orden"])&&$_GET["orden"]=="DESC"): ?> selected <?php endif; ?>>Mayor precio</option>
                            </select>
                            <label for="input_addressType">Ordenar por</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex">
                        <button class="btn btn-outline-secondary mx-auto" onclick="adminsearch();">Filtrar publicaciones</button>
                    </div>
                </div>

                <div class="row gy-3 gx-2 justify-content-center mt-4">
                  <?php if($publicaciones->count()>0): ?>
                    <?php $__currentLoopData = $publicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php
                        $estado = '<span class="badge bg-success h5">Activa</span>';
                        if($publicacion->status !== "PUBLISHED"){
                            $estado = '<span class="badge bg-info h5">En Revision</span>';
                        }
                        if($publicacion->status == "CANCELLED"){
                            $estado = ' <span class="badge bg-danger h5">Cancelada</span>';
                        }
                        if($publicacion->status == "PENDING"){
                            $estado = '<span class="badge bg-secondary h5">Suspendida</span>';
                        }
                        $imagenes = $publicacion->postimagenes()->orderBy("orden","ASC")->take(1)->first();
                        $imagen = !is_null($imagenes) ? $imagenes->imagen : NULL;
                        $talles = $publicacion->poststalles()->first();
                        $color = $publicacion->postscolores()->first();
                      ?>
                        <div class="col-12 col-md-6 hideEvento<?php echo e($publicacion->id); ?>">
                            <div class="card card-hover mx-2">
                                <div class="card-body d-flex flex-column justify-content-between align-items-start">
                                    <div class="row gx-2 gx-lg-3">
                                        <div class="col-12 d-flex">
                                            <h5 class="card-title m-0 text-truncate h6"><?php echo e(str_limit($publicacion->title, 38)); ?></h5>
                                            <div class="dropdown ms-auto">
                                                <button class="btn btn-sm p-0 lh-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-sm fa-ellipsis-v"></i></button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                  <?php if($publicacion->status == "PUBLISHED"): ?>
                                                    <li><a class="dropdown-item" href="#" onclick="change_status('<?php echo e($publicacion->id); ?>', 1)" ><i class="fas fa-pause-circle"></i> Suspender</a></li>
                                                  <?php elseif($publicacion->status == "PENDING"): ?>
                                                    <li><a class="dropdown-item" href="#" onclick="change_status('<?php echo e($publicacion->id); ?>', 1)" ><i class="fas fa-play-circle"></i> Habilitar</a></li>
                                                  <?php endif; ?>
                                                  <?php if(!is_null($talles) or !is_null($color)): ?>
                                                    <li><a class="dropdown-item" href="/publicacion/<?php echo e($publicacion->id); ?>/atributos"><i class="fas fa-edit"></i>Atributos</a></li>
                                                  <?php endif; ?>
                                                  <li><a class="dropdown-item" href="/publicacion/edit/<?php echo e($publicacion->id); ?>/<?php echo e(str_slug($publicacion->title, '-')); ?>"><i class="fas fa-edit"></i> Editar</a></li>
                                                  <li><a class="dropdown-item" href="/rd-<?php echo e($publicacion->id); ?>/vista-previa/<?php echo e($publicacion->condicion); ?>/<?php echo e(str_slug($publicacion->title, '-')); ?>" target="_blank"><i class="fas fa-clone"></i> Ver</a></li>
                                                  <li><a class="dropdown-item" href="/auth/<?php echo e($publicacion->id); ?>/order-image" ><i class="fas fa-align-right"></i> Ordenar Fotos</a></li>
                                                  <li><a class="dropdown-item" href="#" onclick="deletepublication('<?php echo e($publicacion->id); ?>')"><i class="fas fa-trash"></i> Eliminar</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-3 col-lg-2">
                                             <?php if($imagenes): ?><img src="<?php echo e(Voyager::get_image($imagen, 'small', $imagenes->storage)); ?>" class="img-fluid" alt="..."><?php endif; ?>
                                        </div>
                                        <div class="col-9 col-lg-10">
                                            <?php /*<br>
                                            <small class="text-success section__title fw-bold"><?php echo $disccount ?>% OFF</small>
                                            <p class="card-text m-0 section__title fw-bold">
                                                ARS $<?php echo $final ?>
                                                <small class="text-decoration-line-through text-muted">$<?php echo $price ?></small>
                                            </p>  */ ?>
                                            <?php echo $estado; ?>

                                           
                                            <br>
                                            <p class="card-text m-0 section__title fw-bold">
                                                RD $<?php echo e($publicacion->precios); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12">
                          <div class="d-flex justify-content-center">
                            <?php echo e($publicaciones->render()); ?>

                          </div>
                    </div>
                  <?php else: ?>
                    <div class="alert alert-info">No se encontraron publicaciones</div>
                  <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/auth/publicaciones/index.blade.php ENDPATH**/ ?>