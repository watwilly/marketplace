<?php $__env->startSection('meta'); ?>
    <title>Tienda</title>
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
                        <h2 class="m-0">Mis Tiendas</h2>
                    </div>
                    <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                        <a href="/tiendas/nuevo" class="section__link section__link--success">Nueva tienda</a>
                    </div>
                </div>
                <div id="alertset"></div>
                <form action="" method="get">
                  <div class="row g-3 mt-2">
                      <div class="col-12 col-md-4">
                          <div class="form-floating">
                              <input type="text" list="addresses" name="titulo" class="form-control" id="input_email" placeholder="Ejemplo">
                              <datalist id="addresses">
                                  <option value="Lorem ipsum dolor sit amet consectetur adipisicing.">
                                  <option value="Lorem ipsum dolor sit amet consectetur adipisicing.">
                                  <option value="Lorem ipsum dolor sit amet consectetur adipisicing.">
                              </datalist>
                              <label for="input_email">Nombre</label>
                          </div>
                      </div>
                      <div class="col-12 col-md-4">
                          <div class="form-floating">
                              <select name="category_id" class="form-select" id="input_addressType" aria-label="Floating label select example">
                                <?php if(count($categorias)>0): ?>
                                  <option value="">Seleccione</option>
                                  <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($categoria["id"]); ?>"><?php echo e($categoria["name"]); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                              </select>
                              <label for="input_addressType">Categoría</label>
                          </div>
                      </div>
                      <div class="col-12 col-md-4">
                          <div class="form-floating">
                              <select class="form-select" name="orden" id="input_addressType" aria-label="Floating label select example">
                                  <option value="ASC">Alfabéticamente (A - Z)</option>
                                  <option value="DESC">Alfabéticamente (Z - A)</option>
                              </select>
                              <label for="input_addressType">Ordenar por</label>
                          </div>
                      </div>
                      <div class="col-12 d-flex">
                          <button class="btn btn-outline-secondary mx-auto">Filtrar publicaciones</button>
                      </div>
                  </div>
                </form>

                <div class="row gy-3 gx-2 mt-4">
                  <?php $__currentLoopData = $tiendas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tienda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="card card-hover mx-2">
                                <div class="card-body">
                                    <div class="dropdown position-absolute top-0 end-0" style="z-index: 1000;">
                                        <button class="btn btn-sm px-3 py-2 lh-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-sm fa-ellipsis-v"></i></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <?php if($tienda["status"] <> "rev"): ?>
                                              <?php if($tienda["status"]==1): ?>
                                                  <li><a class="dropdown-item" href="#" onclick="tupdate(<?php echo e($tienda["id"]); ?>,0);"><i class="fas fa-pause-circle"></i> Suspender</a></li>
                                              <?php elseif($tienda["status"]==0): ?>
                                                  <li><a class="dropdown-item" href="#" onclick="tupdate(<?php echo e($tienda["id"]); ?>,1);"><i class="fas fa-play-circle"></i> Habilitar</a></li>
                                              <?php endif; ?>
                                            <?php endif; ?>
                                            
                                            <li><a class="dropdown-item" href="/tienda-edit/<?php echo e($tienda["id"]); ?>/<?php echo e(str_slug($tienda["titulo"])); ?>"><i class="fas fa-edit"></i> Editar</a></li>
                                            <li><a class="dropdown-item" href="/deletestore/<?php echo e($tienda["id"]); ?>/trash"><i class="fas fa-trash"></i> Eliminar</a></li>
                                        </ul>
                                    </div>
                                    <div class="row gx-2 align-content-center">
                                        <div class="col-4">
                                            <img src="<?php echo e(Voyager::get_image($tienda["logo"], 'cropped', 'storage')); ?>" class="img-fluid" alt="...">
                                        </div>
                                        <div  class="col-8 d-flex flex-column justify-content-evenly align-content-start">
                                            <h5 class="m-0 h6"><?php echo e(str_limit($tienda["titulo"],38)); ?></h5>
                                            <div id="status<?php echo e($tienda["id"]); ?>">
                                              <?php if($tienda["status"]==1): ?>
                                                  <span class="badge bg-success h5">Activa</span>
                                              <?php elseif($tienda["status"]=="0"): ?>
                                                  <span class="badge bg-secondary h5">Suspendida</span>
                                              <?php elseif($tienda["status"]=="rev"): ?>
                                                  <span class="badge bg-danger h5">En revision</span>
                                              <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!--<div class="col-12">
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn btn-primary">Cargando más tiendas...</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsfooter'); ?>
<script>
  function tupdate(id,status) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        toastr(response["status"],response["msg"]);

        if (status==1){
          $("#status"+id).html('<span class="badge bg-success h5">Activa</span>');
        }else{
          $("#status"+id).html('<span class="badge bg-secondary h5">Suspendida</span>');

        }
      }
    };
    xhttp.open("POST", "/tienda-status/"+id+"/"+status+"", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("_token="+"<?php echo e(csrf_token()); ?>");
  }
</script>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/auth/tiendas/index.blade.php ENDPATH**/ ?>