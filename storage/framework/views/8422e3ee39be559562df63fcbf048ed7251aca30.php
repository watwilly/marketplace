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
                        <h2 class="m-0">Mis empleos</h2>
                    </div>
                    <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#newofertas" class="section__link section__link--success">Publicar Empleo</a>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input <?php if(isset($_GET["buscar"])): ?> value="<?php echo e($_GET["buscar"]); ?>" <?php endif; ?> type="text" list="addresses" class="form-control" id="pubname" placeholder="Ejemplo">
                            <label for="input_email">titulo</label>
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
                        <button class="btn btn-outline-secondary mx-auto" onclick="misempleos();">Aplicar Filtro</button>
                    </div>
                </div>

                <div class="row gy-3 gx-2 justify-content-center mt-4">
                  <?php if($ofertas->count()>0): ?>
                    <?php $__currentLoopData = $ofertas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oferta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                          $postulantes = $oferta->postulanteId()->count();
                        ?>
                        <div class="col-12 col-md-6">
                            <div class="card card-hover mx-2">
                                <div class="card-body d-flex flex-column justify-content-between align-items-start">
                                    <div class="row gx-2 gx-lg-3">
                                        <div class="col-12 d-flex">
                                            <h5 class="card-title m-0 text-truncate h6"><?php echo e(str_limit($oferta->titulo, 38)); ?></h5>
                                            <div class="dropdown ms-auto">
                                                <button class="btn btn-sm p-0 lh-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-sm fa-ellipsis-v"></i></button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                  <li><a  class="dropdown-item" href="/adm/edit/<?php echo e($oferta->id); ?>/oferta"> Editar</a></li>
                                                  <li><a class="dropdown-item"  href="/adm/oferta/trash/<?php echo e($oferta->id); ?>" title="Eliminar"> Eliminar</a></li>
                                                  <li><a class="dropdown-item"  href="/adm/<?php echo e($oferta->id); ?>/postulantes" title="Eliminar"> Postulantes</a></li>
                                                  <?php if($oferta->status == 1): ?>
                                                    <li><a class="dropdown-item"  href="/adm/oferta/end/<?php echo e($oferta->id); ?>" title="Finalizar"> Finalizar</a></li>
                                                  <?php elseif($oferta->status == 0): ?>
                                                    <li><a class="dropdown-item" href="/adm/oferta/start/<?php echo e($oferta->id); ?>" title="Publicar"> Publicar</a></li>
                                                  <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-3 col-lg-2">
                                            <?php if($oferta->imagen): ?><img src="<?php echo e(Voyager::get_image($oferta->imagen, 'cropped', null)); ?>" class="img-fluid" alt="..."><?php endif; ?>
                                        </div>
                                        <div class="col-9 col-lg-10">
                                            Postulantes: <?php echo e($postulantes); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12">
                          <div class="d-flex justify-content-center">
                            <?php echo e($ofertas->render()); ?>

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
<!-- Modal -->
<div class="modal fade" id="newofertas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/addoferta" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

        
            <div class="form-group">
              <label>Titulo ( *)</label>
                <input type="text" class="form-control" name="titulo" required maxlength="120" >
            </div>

            <div class="form-group">
              <label>Puesto ( * )</label>
                <input type="text" class="form-control" name="puesto" required maxlength="60" >
            </div>
            <div class="form-group">
                <label>Vacantes</label>
                <input type="number" class="form-control" name="vacantes"  >
            </div>
            <div class="form-group">
                <label>Dirección Laboral</label>
                <input type="text" name="direccion" class="form-control" maxlength="150">
            </div>  
            <div class="form-group">
                <label>E-mail Laboral ( * ) </label>
                <input type="text" name="email" class="form-control" maxlength="80">
            </div>  
            <div class="form-group mb-3">
              <label>Seleccione una imagen ( * )</label>
              <input type="file" name="imagen" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control"></textarea>
            </div>  
            <small>(*) Para una mejor experiencia de usuario todos los datos son obligatorios</small>














      </div>
      <div class="modal-footer">
        <button  type="submit" class="btn btn-primary">Publicar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/auth/ofertas_laborales/index.blade.php ENDPATH**/ ?>