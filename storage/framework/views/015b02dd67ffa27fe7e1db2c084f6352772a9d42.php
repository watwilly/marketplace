<?php $__env->startSection('meta'); ?>
    <title>Consultas</title>
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
                        <h2 class="m-0">Consultas de productos</h2>
                    </div>
                </div>

                <?php if($interesados->count()>0): ?>
                  <div class="row g-3 mt-2">
                      <div class="col-12 col-md-4">
                          <div class="form-floating">
                              <input type="date" <?php if(isset($_GET["fecha"])): ?> value="<?php echo e($_GET["fecha"]); ?>" <?php endif; ?> id="fecha" class="form-control">
                              <label for="fecha">Fecha</label>
                          </div>
                      </div>
                      <div class="col-12 col-md-4">
                          <div class="form-floating">
                              <input type="text" id="pub_name" <?php if(isset($_GET["name"])): ?> value="<?php echo e($_GET["name"]); ?>" <?php endif; ?> class="form-control" placeholder="Bicicleta rodado 26">
                              <label for="input_category">Publicacion</label>
                          </div>
                      </div>
                      <div class="col-12 col-md-4">
                          <div class="form-floating">
                              <select class="form-select" id="orden" aria-label="Floating label select example">
                                  <option value="">Seleccione</option>
                                  <option value="DESC" <?php if(isset($_GET["orden"])&&$_GET["orden"]=="DESC"): ?> selected <?php endif; ?>>Más reciente</option>
                                  <option value="ASC" <?php if(isset($_GET["orden"])&&$_GET["orden"]=="ASC"): ?> selected <?php endif; ?>>Más antigua</option>
                              </select>
                              <label for="input_order">Ordenar por</label>
                          </div>
                      </div>
                      <div class="col-12 d-flex">
                          <button onclick="filter_consultas();" class="btn btn-outline-secondary mx-auto">Filtrar consultas</button>
                      </div>
                  </div>

                <div class="row g-3 mt-2">
                    <?php $__currentLoopData = $interesados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consulta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="col-12 remove<?php echo e($consulta->consultaId); ?>">
                          <div class="card">
                              <div class="card-body">
                                  <h6><small class="text-muted"><?php echo e($consulta->fecha); ?></small></h6>
                                  <h6 class="text-truncate mb-4">
                                      Artículo: <a href="posts.show.php" class="link-success"><?php echo e($consulta->title); ?></a>
                                  </h6>
                                  <h5 class="card-title"><?php echo e($consulta->mensaje); ?></h5>
                                  <div class="my-3 form-floating">
                                      <textarea type="text" maxlength="255" class="form-control" id="input_answer<?php echo e($consulta->consultaId); ?>" placeholder="Ejemplo" style="height: 120px;"></textarea>
                                      <label for="input_answer">Respuesta</label>
                                  </div>
                                  <div class="d-flex justify-content-end">
                                      <a href="#contextar" onclick="answered(<?php echo e($consulta->consultaId); ?>)" class="section__link section__link--success">Contestar</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                </div>
                <?php else: ?>
                  <div class="alert alert-info">No tienes consultas a tus publicaciones</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsfooter'); ?>
<script>
  function answered(consultaId) {
    var answered = $("#input_answer"+consultaId).val();
    if (answered==""){
      var myElement = document.getElementById("input_answer"+consultaId);
      myElement.setAttribute('style', 'border: 1px solid #dc3545');
      return;
    }
    showload();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        if (response["status"]=="success"){
          $(".remove"+consultaId).hide();
        }
        hideload();
      }
    };
    xhttp.open("POST", "/interesados-answered", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("consultaId="+consultaId+"&_token="+"<?php echo e(csrf_token()); ?>&answered="+answered);

  }
</script>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/auth/intereses/index.blade.php ENDPATH**/ ?>