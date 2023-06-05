<?php $__env->startSection('meta'); ?>
    <meta  name="title" content="<?php echo e(Voyager::setting('site.title')); ?>" >
    <meta  name="description" content="<?php echo e(Voyager::setting('site.description')); ?>">
    <meta  name="keywords" content="<?php echo e(Voyager::setting('site.keywords')); ?>" >
    <meta  property=og:locale content="es_ar" >
    <meta  property=og:image content="https://www.saldeello.com/storage/<?php echo e(Voyager::setting('site.ogimage')); ?>" >
    <meta  property=og:title content="<?php echo e(Voyager::setting('site.title')); ?>" >
    <meta  property=og:description content="<?php echo e(Voyager::setting('site.description')); ?>" >
    <meta  property=og:site_name content="<?php echo e(Voyager::setting('site.title')); ?>" >
    <meta name="twitter:title" content="<?php echo e(Voyager::setting('site.title')); ?>" > 
    <meta name="twitter:image" content="https://www.saldeello.com/storage/<?php echo e(Voyager::setting('site.ogimage')); ?>">
    <meta name="twitter:description" content="<?php echo e(Voyager::setting('site.description')); ?>" > 

    <title><?php echo e(Voyager::setting('site.title')); ?></title>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "https://www.saldeello.com/",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://www.saldeello.com/search?data={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "url": "https://www.saldeello.com",
      "name":"Saldeello",
      "logo": "https://www.saldeello.com/storage/<?php echo e(Voyager::setting('site.logo')); ?>",
        "sameAs": [
        "https://www.facebook.com/saldeello.20",
        "https://www.instagram.com/saldeello/"
      ],
       "address": {
       "@type": "PostalAddress",
       "streetAddress": "Santo Domingo Este",
       "addressRegion": "DOM",
       "postalCode": "11605",
       "addressCountry": "DOP"
     }
    }
    </script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<?php if($sliders->count() > 0): ?>
  <div class="section slider slider--main">
      <div class="slider__container">
          <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $showSlider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="slider__item">
                <img src="/storage/<?php echo e($showSlider->image); ?>" alt="<?php echo e($showSlider->tittle); ?>" class="slider__background">
                <div class="slider__foreground text-center">
                    <h1 style="font-size: 34px;" class="display-lg-2 section__title fw-bold slider__title slider__title--primary"><?php echo e($showSlider->tittle); ?></h1>
                    <h3 style="    font-size: 22px;" class="display-lg-6 d-none d-md-block fw-normal slider__title slider__title--light">saldeello.com Tu compra venta Online</h3>
                    <a href="<?php echo e($showSlider->link); ?>" class="mt-2 mt-md-5 btn btn-primary">Tiendas Online</a>
                </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
  </div>
<?php endif; ?>
<section class="section text-center">
  <!-- Anuncio home 2 JUNIOR-->
  <ins class="adsbygoogle"
       style="display:block"
       data-ad-client="ca-pub-8375200710331851"
       data-ad-slot="1604596297"
       data-ad-format="auto"
       data-full-width-responsive="true"></ins>
  <script>
       (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
</section>

<section class="section">
    <div class="container">
        <h2 class="section__title h3 text-center">
           Marketplace compra y vende  
            <br>
            Todo lo que quieras en República Dominicana, crea tu <a href="https://www.saldeello.com/tiendas-digitales" target="_blank">tienda</a> online
        </h2>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="d-flex flex-wrap aling-items-center mb-4">
            <h4 class="section__lead">Productos más visitados</h4>
            <a href="#" class="btn btn-outline-secondary ms-auto">Ver más</a>
        </div>
        <div class="slider slick-theme slider--home">
            <div class="slider__container">
              <?php $__currentLoopData = $visitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php 
                    $imagen =  \App\Models\PostImagenes::select('imagen', 'storage')->where("posts_id",$visita->id)->orderBy('orden', 'ASC')->take(1)->first();
                  ?>
                  <?php if($imagen): ?>
                    <div class="card card-hover mx-2">
                        <img data-src-load="<?php echo e(Voyager::get_image($imagen->imagen, 'medium', $imagen->storage)); ?>" class="card-img-top index-img" alt="<?php echo e($visita->title); ?>">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title m-0 text-truncate h6"><?php echo e(str_limit($visita->title, 38)); ?></h5>
                            <p class="card-text m-0 section__title fw-bold">
                                RD $<?php echo e($visita->precios); ?>

                            </p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text text-muted">+<?php echo e($visita->cant_visita); ?> visitaron este producto</p>
                        </div>
                        <a href="/rd-<?php echo e($visita->id); ?>/<?php echo e(str_slug($visita->name,'-')); ?>/<?php echo e($visita->condicion); ?>/<?php echo e(str_slug($visita->title)); ?>" class="stretched-link"></a>
                    </div>
                  <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>

<?php if($h1): ?>
<section class="section">
  <div class="container">
    <img data-src-load="<?php echo e(Voyager::get_image($h1->banner, null, 'storage')); ?>" class="index-img img-fluid w-100">
  </div>
</section>
<?php endif; ?>
<section class="section">
    <div class="container">
        <div class="d-flex flex-wrap aling-items-center mb-4">
            <h4 class="section__lead">Tiendas Digitales</h4>
            <a href="/tiendas-digitales" class="btn btn-outline-secondary ms-auto">Ver más</a>
        </div>
        <div class="slider slick-theme slider--home">
            <div class="slider__container">
              <?php $__currentLoopData = $tiendas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tienda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card overflow-hidden card-hover mx-2">
                    <img data-src-load="<?php echo e(Voyager::get_image($tienda->logo, 'cropped','storage')); ?>" class="index-img card-img-top" alt="<?php echo e($tienda->titulo); ?>">
                    <div class="card-header-overlay">
                        <h5 class="card-title text-center m-0 section__lead h6"><?php echo e(str_limit($tienda->titulo,38)); ?></h5>
                    </div>
                    <a href="/tienda/<?php echo e(str_slug($tienda->titulo)); ?>/<?php echo e($tienda->id); ?>" class="stretched-link"></a>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<section class="section text-center">
    <!-- Horizontal Willy 1 -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-4090153222985235"
         data-ad-slot="2599220058"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</section>
<!--Item a desarrollar-->
<section class="section">
    <div class="container">
        <div class="grid rows-4 cols-1 cols-lg-4" style="min-height: 500px;">
            <div class="grid-item p-3 bRD-primary-7-lg bg-dark a-lg-4x1">
                <a <?php if($v1): ?> href="<?php echo e($v1->link); ?>" target="_blank" <?php else: ?> href="/" <?php endif; ?>>
                    <div class="d-flex flex-wrap flex-column h-100 justify-content-evenly align-items-center">
                        <?php if($v1): ?>
                          <img data-src-load="<?php echo e(Voyager::get_image($v1->banner, null, 'storage')); ?>" alt="" class="index-img img-fluid">
                        <?php else: ?>
                          <img data-src-load="assets/img/logos.png" alt="" class="index-img img-fluid">
                          <h3 class="text-shadow text-light text-center">Crea tu  tienda gratis</h3>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
            <div class="grid-item p-3 bRD-primary-3-sm bg-dark a-lg-2x3">
                <a <?php if($h2): ?> href="<?php echo e($h2->link); ?>" target="_blank" <?php else: ?> href="/" <?php endif; ?>>
                    <div class="d-flex flex-wrap h-100 justify-content-center align-items-center">
                        <?php if($h2): ?>
                          <img data-src-load="<?php echo e(Voyager::get_image($h2->banner, null, 'storage')); ?>" alt="" class="index-img img-fluid" style="height: 230px;">
                        <?php else: ?>
                          <img style="max-width: 333px;" data-src-load="/storage/<?php echo e(setting('site.logo')); ?>" alt="" class="img-fluid index-img">
                          <h3 class="lead text-light">Publica gratis y vende mas</h3>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
            <div class="grid-item p-3 bRD-primary-5-sm bg-dark r-2 a-lg-2x2">
                <div class="container-fluid">
                    <div class="row gy-2">
                        <div class="col-12 col-md-6 col-lg-8">
                            <h6 class="text-light">Creando tu tienda en nuestro sitio web podras tener todos tus productos y servicios en un solo lugar, tambien puedes crear multiples tiendas</h6>
                            <a href="/tiendas-digitales" class="btn btn-outline-primary mt-3">Ver más</a>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <img data-src-load="assets/img/cards/c002.jpg" alt="" class="index-img img-fluid rounded border shadow">
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-item p-3 bRD-primary-1-sm bg-dark r-lg-2">
                <div class="text-end">
                    <h3 class="lead text-light">Registrate con Facebook o Google.</h3>
                    <a href="/auth/user/register" class="btn btn-outline-primary mt-3">Ver más</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End item a desarrollar-->

<section class="section">
    <div class="container">
        <div class="d-flex flex-wrap aling-items-center mb-4">
            <h4 class="section__lead">Mejores Precios</h4>
            <a href="/promociones" class="btn btn-outline-secondary ms-auto">Ver más</a>
        </div>
        <div class="slider slick-theme slider--home">
            <div class="slider__container">
              <?php $__currentLoopData = $ofertas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oferta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                  $imgOfertas =  $oferta->postimagenes()->select('imagen', 'storage')->orderBy('orden', 'ASC')->take(1)->first();
                ?>
                 <?php if($imgOfertas): ?>
                    <div class="card card-hover mx-2">
                       <img data-src-load="<?php echo e(Voyager::get_image($imgOfertas->imagen, 'medium', $imgOfertas->storage)); ?>" class="card-img-top index-img" alt="<?php echo e($oferta->title); ?>">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title m-0 text-truncate h6"><?php echo e(str_limit($oferta->title, 38)); ?></h5>
                            <p class="card-text m-0 section__title fw-bold">
                                RD $<?php echo e($oferta->precios); ?>

                            </p>
                        </div>
                        <a href="/rd-<?php echo e($oferta->id); ?>/<?php echo e(str_slug($oferta->name,'-')); ?>/<?php echo e($oferta->condicion); ?>/<?php echo e(str_slug($oferta->title)); ?>" class="stretched-link"></a>
                    </div>
                    <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php 
            $n=1;
        ?>
        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         
          <?php if(!is_null($categoria->parent_id)): ?>
            <?php $pro = $categoria->postpersubCategory();?>
          <?php else: ?>
            <?php $pro = $categoria->posts(); ?>
          <?php endif; ?>

          <?php 
            $pro->select('condicion','posts.id','title', 'body', 'marca_id', 'precios', 'posts.created_at', 'pv.cant_visita');
            $pro->where('status', 'PUBLISHED');
            $pro->leftjoin('posts_visitas as pv', 'posts.id','=','pv.posts_id');
            $pro = $pro->inRandomOrder()->take(8)->get(); 
          ?>

          <div class="d-flex flex-wrap aling-items-center mb-4">
            <h4 class="section__lead"><?php echo e($categoria->name); ?></h4>
            <a href="/categoria/<?php echo e($categoria->id); ?>/<?php echo e(str_slug($categoria->name, '-')); ?>" class="btn btn-outline-secondary ms-auto">Ver más</a>
          </div>
          <div class="slider slick-theme slider--home">
              <div class="slider__container">
              <?php $__currentLoopData = $pro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                      $imagenes =  $productos->postimagenes()->select('imagen', 'storage')->orderBy('orden', 'ASC')->take(1)->first();
                    ?>
                    <?php if($imagenes): ?>
                    <div class="card card-hover mx-2">
                        <img data-src-load="<?php echo e(Voyager::get_image($imagenes->imagen, 'medium', $imagenes->storage)); ?>" class="card-img-top index-img" alt="<?php echo e($productos->title); ?>">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title m-0 text-truncate h6"><?php echo e(str_limit($productos->title, 38)); ?></h5>
                            <p class="card-text m-0 section__title fw-bold">
                                RD $<?php echo e($productos->precios); ?>

                            </p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text text-muted">+<?php echo e($productos->cant_visita); ?> visitaron este producto</p>
                        </div>
                        <a href="/rd-<?php echo e($productos->id); ?>/<?php echo e(str_slug($categoria->name,'-')); ?>/<?php echo e($productos->condicion); ?>/<?php echo e(str_slug($productos->title)); ?>" class="stretched-link"></a>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
          </div>
          <?php if($n==1): ?>
            <div class="row">
                <div class="col-md-6 text-center p-3">
                    <!-- Ventas tucuman pruducto 1 -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-4090153222985235"
                         data-ad-slot="1292236182"
                         data-ad-format="auto"
                         data-full-width-responsive="true"></ins>
                    <script>
                         (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>                
                </div>
                <div class="col-md-6 text-center p-3">
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-8375200710331851"
                         data-ad-slot="2607186321"
                         data-ad-format="auto"
                         data-full-width-responsive="true"></ins>
                    <script>
                         (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>                
            </div>

          <?php endif; ?>
          <?php if($n==4): ?>
            <div class="row">
                <div class="col-md-6 text-center p-3">
                    <ins class="adsbygoogle"
                         style="display:block; text-align:center;"
                         data-ad-layout="in-article"
                         data-ad-format="fluid"
                         data-ad-client="ca-pub-8375200710331851"
                         data-ad-slot="3702127664"></ins>
                    <script>
                         (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>                   
                </div>
                <div class="col-md-6 text-center p-3">
                    <ins class="adsbygoogle"
                         style="display:block; text-align:center;"
                         data-ad-layout="in-article"
                         data-ad-format="fluid"
                         data-ad-client="ca-pub-4090153222985235"
                         data-ad-slot="2170357567"></ins>
                    <script>
                         (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
          <?php endif; ?>

          <?php 
            $n++;
          ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<?php $position = 1; ?>
<?php $__env->startSection('jsheader'); ?>
<?php if($url_ultimos): ?>
  <script type="application/ld+json">
  {
    "@context":"https://schema.org",
    "@type":"ItemList",
    "itemListElement":[
      <?php $__currentLoopData = $url_ultimos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $geturl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        {
          "@type":"ListItem",
          "position":<?php echo e($position); ?>,
          "url":"<?php echo e($geturl); ?>"
        },
        <?php $position ++; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      {
        "@type":"ListItem",
        "position":11,
        "url":"https://www.saldeello.com/"
      }

    ]
  }
  </script>
<?php endif; ?>
<?php $__env->appendSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/web/saldeello/resources/views/home/index.blade.php ENDPATH**/ ?>