<?php $__env->startSection('meta'); ?>
    <meta  name="title" content="<?php echo e($post->title); ?>" >
    <meta  name="description" content="Precio:$<?php echo e($post->precios); ?> <?php echo e(str_replace('-', '',  str_limit($post->body, 130))); ?>" />
    <meta  property=og:description content="Precio:$<?php echo e($post->precios); ?>  <?php echo e(str_replace('-', '',  str_limit($post->body, 130))); ?>" />
    <meta  property=og:site_name content="<?php echo e($post->title); ?>" >
    <meta property="og:title" content="<?php echo e($post->title); ?>" />
    <meta  name="keywords" content="<?php echo e($post->category_name); ?>, <?php echo e($post->subcategory_name); ?>" />
    <title><?php echo e($post->title); ?> </title>
    <meta name="twitter:title" content="<?php echo e($post->title); ?>" /> 
    <meta name="twitter:description" content="<?php echo e(str_replace('-', '',  str_limit($post->body, 130))); ?>" /> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="min-height">
    <div class="container">
        <div class="col-12 mt-3 d-none d-md-block">
            <nav aria-label="breadcrumb" class="bg-secondary rounded-pill py-3 px-5">
                <ol class="breadcrumb m-0">
                    <?php if(!is_null($post->category_id)): ?>
                      <li class="breadcrumb-item section__title fw-bold"><a href="/categoria/<?php echo e($post->category_id); ?>/<?php echo e(str_slug($post->category_name)); ?>"><?php echo e($post->category_name); ?></a></li>
                    <?php endif; ?>
                    <?php if(!is_null($post->subcategoryId)): ?>
                      <li class="breadcrumb-item section__title fw-bold"><a href="/categoria/<?php echo e($post->subcategoryId); ?>/<?php echo e(str_slug($post->subcategory_name)); ?>"><?php echo e($post->subcategory_name); ?></a></li>
                    <?php endif; ?>
                    <?php if(!is_null($post->ma_name)): ?>
                      <li class="breadcrumb-item section__title fw-bold active" aria-current="page"><?php echo e($post->ma_name); ?></li>
                    <?php endif; ?>
                    <?php if(!is_null($post->mo_name)): ?>
                      <li class="breadcrumb-item section__title fw-bold active" aria-current="page"><?php echo e($post->mo_name); ?></li>
                    <?php endif; ?>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-4090153222985235"
                 data-ad-slot="9339845963"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>

        <div class="product my-3">
            <?php if($imagenes->count() > 0): ?>
              <div class="product__view">
                  <div class="container-fluid shadow rounded bg-white">
                      <div class="slider slider--main slider-show">
                        <?php $__currentLoopData = $imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <img src="<?php echo e(Voyager::get_image($imagen->imagen, NULL, $imagen->storage)); ?>" alt="<?php echo e($post->title); ?>" class="slider__frame slider__frame--slide">
                          <?php $thubnail[] = $imagen; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                      <div class="slider slider-nav">
                        <?php $__currentLoopData = $thubnail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $th): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <img src="<?php echo e(Voyager::get_image($th->imagen, 'small', $imagen->storage)); ?>" alt="<?php echo e($post->title); ?>" class="slider__frame slider__frame--nav">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                  </div>
              </div>
            <?php endif; ?>
            <div class="product__price">
                <div class="container-fluid py-3 h-100 shadow rounded bg-white">
                    <?php if($tienda): ?>
                    <div class="row align-items-center">
                        <div class="col-3 col-sm-2 col-lg-3">
                            <a href="/comercio/<?php echo e(str_slug($tienda->titulo, '-')); ?>/<?php echo e($tienda->id); ?>">
                                <img src="<?php echo e(Voyager::get_image($tienda->logo, 'cropped', 'storage')); ?>" alt="" class="rounded-circle shadow img-fluid">
                            </a>
                        </div>
                        <div class="col-9 col-sm-10 col-lg-9">
                            <a href="stores.show.php" class="custom-link link-secondary">
                                <h4 class="section__lead h6 text-truncate"><?php echo e(str_limit($tienda->titulo, 25)); ?></h4>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <hr class="my-4">
                    <h4 class="mb-4"><?php echo e($post->title); ?></h4>
                    <h5 class="mb-4 section__title fw-bold">
                        <?php if($post->precios == 1 or $post->precios == 0): ?> PRECIO A CONVENIR <?php else: ?> RD $<?php echo e($post->precios); ?> <?php endif; ?>
                    </h5>
                    <?php if($post->condicion=='like-new'): ?> 
                      <span class="rounded-pill bg-secondary text-light section__title h6 fw-bold px-5 py-2"> Usado como nuevo </span>
                    <?php elseif($post->condicion=='nuevo'): ?> 
                      <span class="rounded-pill bg-success text-light section__title h6 fw-bold px-5 py-2">NUEVO</span>
                    <?php else: ?>
                      <span class="rounded-pill bg-secondary text-light section__title h6 fw-bold px-5 py-2"><?php echo e($post->condicion); ?></span>
                    <?php endif; ?>
                    <hr class="my-4">

                    <h6>Información del vendedor:</h6>
                    <?php if($post->provincia): ?>
                    <div class="d-block rounded-pill bg-light border border-gray h6 fw-bold px-3 py-2">
                        <i class="fas fa-map-marker-alt"></i>
                        <?php echo e($post->provincia); ?>, <?php echo e($post->localidad); ?>

                    </div>
                    <?php endif; ?>
                    <?php if(!is_null($post->telefono)): ?>
                      <div class="d-block rounded-pill bg-light border border-gray h6 fw-bold px-3 py-2">
                          <i class="fas fa-phone-alt"></i>
                          <?php echo e($post->telefono); ?>

                      </div>
                    <?php endif; ?>

                    <?php if($colores->count() !== 0): ?>
                      <hr class="my-4"> 
                      <h6>Colores disponibles:</h6>
                      <div class="d-flex flex-wrap justify-content-center">
                          <?php $__currentLoopData = $colores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $colores): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                              $atributo_color = $colores->colores()->first();
                            ?>
                            <a href="#" id="color<?php echo e($atributo_color->id); ?>" onclick="get_atribute(<?php echo e($atributo_color->id); ?>, 'color', <?php echo e($post->id); ?> )" class="picker-color rounded-circle border border-3 border-dark card-hover" style="background-color: <?php echo e($atributo_color->color); ?>;"></a>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if($talles->count() !== 0): ?>
                      <hr class="my-4">
                      <h6>Talles disponibles:</h6>
                      <div class="d-flex flex-wrap justify-content-center">
                        <?php $__currentLoopData = $talles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $talles): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php
                            $atributo_talle = $talles->talles()->first();
                          ?>
                          <a href="#" id="talle<?php echo e($atributo_talle->id); ?>"  onclick="get_atribute(<?php echo e($atributo_talle->id); ?>, 'talle', <?php echo e($post->id); ?> )" data-toast="1" class="toast-btn-toggle rounded bg-dark text-light h6 p-2 me-2 mb-2"><?php echo e($atributo_talle->talle); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                    <?php endif; ?>
                    <hr class="my-4">
                        <!-- Anuncio Home saldeello.com -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-8375200710331851"
                             data-ad-slot="1758379272"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                             (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    <hr class="my-4">
                      <div class="d-grid gap-2">
                          <?php if($tienda): ?>
                            <a href="/tienda/<?php echo e(str_slug($tienda->titulo)); ?>/<?php echo e($tienda->id); ?>" class="btn btn-outline-success">Ver más publicaciones del vendedor</a>
                          <?php endif; ?>
                          <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-report">Denunciar publicación</button>
                      </div>
                      <?php if($v1): ?>
                      <div class="d-grid gap-2">
                        <hr class="my-4">
                        <a href="<?php echo e($v1->link); ?>" target="_blank"><img src="<?php echo e(Voyager::get_image($v1->banner, null, 'storage')); ?>" class="img-fluid"></a>
                      </div>
                      <?php endif; ?>
                </div>
            </div>
            <div class="product__description">
                <div class="container-fluid py-3 shadow rounded bg-white">
                  <h5 class="border-bottom border-gray mb-3">Descripción de la publicación</h5>
                   
                      <ul class="list-group list-group-flush h5 mb-3">
                          <?php if(!is_null($post->ma_name)): ?>
                            <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                <span class="text-muted fw-normal">Marca</span>
                                <b><?php echo e($post->ma_name); ?></b>
                            </li>
                          <?php endif; ?>

                          <?php if(!is_null($post->mo_name)): ?>
                          <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                              <span class="text-muted fw-normal">Modelo</span>
                              <b><?php echo e($post->mo_name); ?></b>
                          </li>
                          <?php endif; ?>
                          <?php if(!is_null($post->category_id) && $post->category_id == 6): ?>
                            <?php $vehiculo =  $post->postsvehiculos()->first(); ?>

                                <?php if(!is_null($vehiculo->tipos_vehiculos_id)): ?>
                                  <?php $tipoVehiculos = $vehiculo->tiposvehiculos()->first(); ?>
                                  <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                      <span class="text-muted fw-normal">Tipo</span>
                                      <b><?php echo e($tipoVehiculos->name); ?></b>
                                  </li>
                                <?php endif; ?>
                                <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                    <span class="text-muted fw-normal">Año</span>
                                    <b><?php echo e($vehiculo->anio); ?></b>
                                </li>
                                <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                    <span class="text-muted fw-normal">Kilometraje</span>
                                    <b><?php echo e($vehiculo->kilometros); ?></b>
                                </li>
                                <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                    <span class="text-muted fw-normal">Transmisión</span>
                                    <b><?php echo e($vehiculo->transmision); ?></b>
                                </li>
                                <?php if(!is_null($vehiculo->colores_id)): ?>
                                  <?php $color = $vehiculo->colores()->first(); ?>
                                  <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                      <span class="text-muted fw-normal">Color</span>
                                      <b style="border: 1px solid <?php echo e($color->color); ?>;">color</b>
                                  </li>
                                <?php endif; ?>
                          <?php endif; ?>
                      </ul>

                    <?php
                      $body = str_replace("\n", "<p>", $post->body);
                    ?>
                    <p><?php echo $body; ?></p>

                    <div class="row g-3 mt-3">
                        <div class="col-12 col-md-6 col-lg-4">
                            <a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo e(url()->current()); ?>','Compartir', 'toolbar=0, status=0, width=650, height=450');" class="d-block w-100 btn btn-blue">
                                <i class="fab fa-facebook-square"></i> Compartir
                            </a>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <a href=" https://api.whatsapp.com/send?text= Mira que bueno esta, <?php echo e(url()->current()); ?>" class="d-block w-100 btn btn-green text-white">
                                <i class="fab fa-whatsapp"></i> Compartir
                            </a>
                        </div>
                    </div>
                    <?php if($h1): ?>
                      <div class="row g-3 mt-3">
                        <div class="col-12 col-md-6 col-lg-12">
                            <a href="<?php echo e($h1->link); ?>" target="_blank"><img src="<?php echo e(Voyager::get_image($h1->banner, null, 'storage')); ?>" class="img-fluid"></a>
                        </div>
                      </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="product__questions">
                <div class="container-fluid py-3 shadow rounded bg-white">
                    <h5 class="border-bottom border-gray mb-3">Consultas al vendedor</h5>
                    <div class="mb-3 row g-2 align-items-center">
                        <div class="col-12 col-md-8 col-lg-10">
                            <input type="text" name="consulta" maxlength="255" id="consulta" class="form-control" placeholder="Escribí aquí tu consulta...">
                        </div>
                        <div class="col-12 col-md-4 col-lg-2">
                          <?php if(Auth::check()): ?>
                            <button class="btn btn-outline-info w-100" onclick="btnbconsulta();">Enviar</button>
                          <?php else: ?>
                            <a href="/auth/user/login" class="btn btn-outline-info w-100">Enviar</a>
                          <?php endif; ?>
                        </div>
                    </div>

                    <h5 class="mb-3 mt-5">Últimas Consultas </h5>
                    <div id="autoload">
                      <?php if($consultas->count()>0): ?>
                        <?php $__currentLoopData = $consultas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consulta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="alert alert-gray">
                                <h6 class="text-black"><?php echo e($consulta->mensaje); ?></h6>
                                <?php if($consulta->answered): ?>
                                <p class="ms-4" style="word-break: break-all;"><?php echo e($consulta->answered); ?></p>
                                <?php endif; ?>
                                <span class="d-block text-end"><?php echo e($consulta->created_at->todateString()); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <div class="alert alert-info">Nadie ha comentado nada, se el primero en hacerlo.</div>
                      <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="product__similars">
                <div class="container-fluid py-3 shadow rounded bg-white">
                    <h5 class="border-bottom border-gray mb-3">Publicaciones Similares</h5>

                    <div class="slider slick-theme slider--home">
                        <div class="slider__container">
                          <?php if($simil->count()>0): ?>
                            <?php $__currentLoopData = $simil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $simils): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php 
                                $imgsimil = $simils->postimagenes()->limit(1)->first();
                                $las_storage = NULL;
                                $laspImg = NULL;
                                if ($imgsimil) {
                                    $laspImg = $imgsimil->imagen;
                                    $las_storage = $imgsimil->storage;
                                }
                              ?>
                                <div class="card card-hover mx-2">
                                    <img src="<?php echo e(voyager::get_image($laspImg,'small',$las_storage)); ?>" class="card-img-top" alt="<?php echo e($simils->title); ?>">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h5 class="card-title m-0 text-truncate h6"><?php echo e(str_limit($simils->title,37)); ?></h5>
                                            <p class="card-text m-0 section__title fw-bold">
                                                RD $<?php echo e($simils->precios); ?>

                                            </p>
                                    </div>
                                    <a href="/rd-<?php echo e($simils->id); ?>/<?php echo e(str_slug($simils->name,'-')); ?>/<?php echo e(str_slug($simils->condicion)); ?>/<?php echo e(str_slug($simils->title)); ?>" class="stretched-link"></a>
                                </div>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="modal-report" tabindex="-1" aria-labelledby="modal-report-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-light">
                <h5 class="modal-title" id="modal-report-label">Denunciar publicación</h5>
                <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <form action="/reportaraviso" method="post">
            <input type="hidden" name="post_id" value="<?php echo e($post->id); ?>">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <div class="modal-body">
                <h6 class="mb-5"><?php echo e($post->title); ?></h6>
                <textarea name="detalle_reporte" maxlength="200" class="form-control" id="modal-report-text" rows="5" placeholder="Escribí aquí el motivo de la denuncia. Se admiten hasta 200 caracteres."></textarea>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger text-light">Enviar</button>
            </div>
          </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsheader'); ?>
   <?php if($imagenes->count() > 0): ?>
    <meta property="og:image" content="<?php if($imagen->storage !='online'): ?> https://www.saldeello.com<?php echo e(Voyager::get_image($imagen->imagen, 'small', $imagen->storage)); ?> <?php else: ?> <?php echo e(Voyager::get_image($imagen->imagen, 'small', $imagen->storage)); ?>  <?php endif; ?>"/>
    <meta name="twitter:image" content="<?php if($imagen->storage !='online'): ?> https://www.saldeello.com<?php echo e(Voyager::get_image($imagen->imagen, 'small', $imagen->storage)); ?> <?php else: ?> <?php echo e(Voyager::get_image($imagen->imagen, 'small', $imagen->storage)); ?>  <?php endif; ?>">
  <?php endif; ?> 
  <script type='application/ld+json'> 
      {
        "@context": "http://www.schema.org",
        "@type": "product",
         "sku": "<?php echo e(str_slug($post->title,'-')); ?>-<?php echo e($post->id); ?>-<?php echo e(str_slug($post->category_name,'-')); ?>",
        "brand": "<?php if(!is_null($post->ma_name)): ?><?php echo e($post->ma_name); ?> <?php else: ?> saldeello <?php endif; ?>",
        "name": "<?php echo e($post->title); ?>",
        <?php if($imagenes->count() > 0): ?> "image": <?php if($imagen->storage !='online'): ?> "https://www.saldeello.com/storage/<?php echo e($imagen->imagen); ?>" <?php else: ?> "<?php echo e($imagen->imagen); ?>" <?php endif; ?> , <?php endif; ?>
        "description": "<?php echo e(str_replace('-', '',  str_limit($post->body, 130))); ?>",
        "aggregateRating": {
          "@type": "aggregateRating",
          "ratingValue": "5.0",
          "reviewCount": "<?php echo e($cant_visitas); ?>"
        },

        "review": {
          "@type": "Review",
          "reviewRating": {
            "@type": "Rating",
            "ratingValue": "4",
            "bestRating": "5"
          },
          "author": {
            "@type": "Person",
            "name": "Willy Arredondo"
          }

          },
        "offers": {
          "@type": "Offer",
          "url": "https://www.saldeello.com/rd-<?php echo e($post->id); ?>/<?php echo e((str_slug($post->category_name,'-'))); ?>/<?php echo e(str_slug($post->title)); ?>",
          "priceCurrency": "ARS",
          "price": "<?php echo e($post->precios); ?>",
          "priceValidUntil": "<?php echo e($post->created_at->format("Y-m-d")); ?>",
          "itemCondition": "https://www.saldeello.com/nota/2/condiciones-de-uso-online",
          "availability": "InStock",
          "seller": {
            "@type": "Organization",
            "name": "saldeello"
          }
        }
      }
  </script>
<?php $__env->appendSection(); ?>

<?php $__env->startSection('jsfooter'); ?>
<script>

  function autoload(postId) {
    var request = new XMLHttpRequest();

    request.open('GET', '/autload-consultas/'+postId, true);

    request.onload = function() {
      if (request.status >= 200 && request.status < 400) {
        var resp = request.responseText;
        document.querySelector('#autoload').innerHTML = resp;
      }
    };

    request.send();
  }

  function btnbconsulta() {
   var consulta = $("#consulta").val();

   if (consulta==""){
    var myElement = document.getElementById("consulta");
    myElement.setAttribute('style', 'border: 1px solid #dc3545');
    return;
   }
    showload();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        if (response["status"]=="success"){
          autoload(<?php echo e($post->id); ?>);
        }
        toastr(response["status"],response["msg"]);
        hideload();
      }
    };
    xhttp.open("POST", "/interesados-consultas", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("consulta="+consulta+"&_token="+"<?php echo e(csrf_token()); ?>&postId="+<?php echo e($post->id); ?>);
 
 }
 function get_atribute(a, b, c) {
    showload();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (b=="talle"){
          d="Talle";
        }else{
          d="Color";
        }
        toastr("success","El "+d+" ha sido seleccionado");
        var myElement = document.getElementById(b+a);
        hideload();
      }
    };
    xhttp.open("POST", "/select-post-atribute", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("atributo_id="+a+"&_token="+"<?php echo e(csrf_token()); ?>&atributo="+b+"&post_Id="+c);
 }

 function addCart(i,rightnow=null) {
   var cantidad = $("#cantidad").val();
   var now = rightnow

   if (cantidad==""){
    var myElement = document.getElementById("cantidad");
    myElement.setAttribute('style', 'border: 1px solid #dc3545');
    toastr("warning","Seleccione la cantidad");
    return;
   }
    showload();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        toastr(response["status"],response["msg"]);
        
        if(now){
          window.location = response["url"];
        }

        hideload();
      }
    };
    xhttp.open("POST", "/addtoCart", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("post_id="+i+"&_token="+"<?php echo e(csrf_token()); ?>&cantidad="+cantidad+"&rightnow="+now);
 }

 function buynow(pubId) {
   addCart(pubId,true);
 }
</script>
<?php $__env->appendSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/post/show.blade.php ENDPATH**/ ?>