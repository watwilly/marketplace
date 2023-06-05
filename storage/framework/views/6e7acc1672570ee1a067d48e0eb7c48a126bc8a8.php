
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('meta'); ?>
    <meta  name=title content=" En marketplace Republica Dominicana | Tenemos los mejores precios" >
    <meta  name=description content="Descubre los mejores precios de republica dominicana en el marketplace saldeello.com ">
    <meta  name=keywords content="buenos precios, negocios Dominicanos, autos, motos, servicios">
    <meta  property=og:locale content="es_ar" >
    <meta  property=og:description content="Descubre los mejores precios de republica dominicana en el marketplace saldeello.com" >
    <meta  property=og:site_name content="En marketplace Republica Dominicana | Tenemos los mejores precios" >
    <title>En marketplace Repubblica Dominicana | Tenemos los mejores precios </title>
<?php $__env->stopSection(); ?>
<?php 
   $url = url()->full();
?>
<section class="min-height">
    <div class="banner">
        <div class="banner__background" style=" background-image: url('/assets/img/banners/b002.jpg');
                    background-attachment: fixed;
                    background-size: cover;
                    background-position: center center;
                    background-repeat: no-repeat;">
        </div>
        <div class="banner__foreground text-center">
            <h1 class="section__title fw-bold banner__title banner__title--primary">En marketplace Republica Dominicana | Tenemos los mejores precios</h1>
            <h4 class="fw-normal banner__title banner__title--light">Somos la mejor compra venta digital</h4>
          
        </div>
    </div>
    <div class="container mt-4">
        <div class="row g-3">
            <?php if($categorias): ?>
                <div class="col-12 col-md-4">
                    <div class="form-floating">
                        <select class="form-select" id="input_category" aria-label="Floating label select example">
                            <option value="">Seleccione</option>
                            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($categoria["id"]); ?>"><?php echo e($categoria["name"]); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <label for="input_addressType">Categoría</label>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-12 col-md-4">
                <div class="form-floating">
                    <select class="form-select" id="input_condicion" aria-label="Floating label select example">
                        <option value="">Seleccione</option>
                        <option value="nuevo">Nuevo</option>
                        <option value="usado">Usado</option>
                    </select>
                    <label for="input_addressType">Condicion</label>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating">
                    <select class="form-select" id="input_orden" aria-label="Floating label select example">
                        <option value="">Seleccione</option>
                        <option value="ASC">Menor precio</option>
                        <option value="DESC">Mayor precio</option>
                        <option value="AAZ">Alfabéticamente (A - Z)</option>
                        <option value="ZAA">Alfabéticamente (Z - A)</option>
                    </select>
                    <label for="input_addressType">Ordenar por</label>
                </div>
            </div>
            <div class="col-12 d-flex">
                <button id="promocione-filter" class="btn btn-outline-secondary mx-auto">Buscar ofertas</button>
            </div>
        </div>
        <div class="row gy-3 gx-2 justify-content-center my-4">
            <div class="col-12">
                <h2 class="text-center">Productos con mejores precios de República Dominicana</h2>
            </div>
                <?php $n=1; ?>
                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e(Voyager::h_listview($post["title"], $post["id"], $post["imagen"], $post["storage"], $post["precios"], 'small', $post["prdcatname"], $post['condicion'])); ?>

                    <?php if($n==4): ?>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-4090153222985235"
                                 data-ad-slot="2625104399"
                                 data-ad-format="auto"
                                 data-full-width-responsive="true"></ins>
                            <script>
                                 (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>                             
                        </div>
                      
                    <?php endif; ?>
                    <?php if($n==12): ?>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-8375200710331851"
                                 data-ad-slot="2652893581"
                                 data-ad-format="auto"
                                 data-full-width-responsive="true"></ins>
                            <script>
                                 (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>              
                        </div>      
                    <?php endif; ?>

                    <?php
                        $n++;
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <nav aria-label="Page navigation">
                      <ul class="pagination">
                        <?php echo e($paginate->links()); ?>

                      </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->startSection('jsfooter'); ?>
 <script>
$(document).ready(function() {
    $("#promocione-filter").click(function(){
        var condicion = $("#input_condicion").val();
        var category_id = $("#input_category").val();
        var orden = $("#input_orden").val();

        var uri = null;

        if (condicion && category_id && orden){
            uri = "/promociones/"+condicion+"/"+category_id+"/"+orden;
        
        }else if (condicion && category_id=="" && orden=="" ){
            uri="/promociones/condicion/"+condicion;

        }else if (category_id  && orden=="" && condicion=="" ){
            uri="/promociones/categoria/"+category_id;

        }else if (orden && condicion=="" && category_id==""){
            uri="/promociones/orden/"+orden;
        
        }else if (condicion && category_id){
            uri = "/promociones/condicion-"+orden+"/category-"+category_id;
        
        }else if (condicion && orden){
            uri = "/promociones/condicion-"+orden+"/orden-"+orden;

        }else if (orden && category_id){
            uri = "/promociones/orden-"+orden+"/category-"+category_id;

        } 
        if (uri){
            location.href = uri;
        }

    });
});
 </script>
<?php $__env->appendSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/home/buenosprecios.blade.php ENDPATH**/ ?>