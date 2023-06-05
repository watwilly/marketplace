	<?php $__env->startSection('meta'); ?>
	    <meta  name="title" content="Clasificacion de Servicios en Republica Dominicana - saldeello tu compra venta online" >
	    <meta  name="description" content="Somos es portal de servicios online mas popular de todo el pais">
	    <meta  name=keywords content="servicios Dominicana, servicios privados, servicios informaticos, reparacion de pc, servicio de fotografia a precios, fotografia y video 15 años">
	    <meta  property=og:locale content="es_ar" >
	    <meta  property=og:description content="Somos es portal de servicios online mas popular de todo el pais">
        <meta  name=keywords content="servicios Dominicana, servicios privados, servicios informaticos, reparacion de pc, servicio de fotografia a precios, fotografia y video 15 años" >
	    <meta  property=og:site_name content="Clasificacion de Servicios" >
	    <title>Clasificacion de Servicios</title>
	<?php $__env->stopSection(); ?>
	<?php 
	   $url = url()->full();
	?>
<?php $__env->startSection('content'); ?>


<section class="min-height">
    <div class="banner">
        <div class="banner__background" style=" background-image: url('/assets/img/banners/b004.jpg');
                    background-attachment: fixed;
                    background-size: cover;
                    background-position: center center;
                    background-repeat: no-repeat;">
        </div>
        <div class="banner__foreground text-center">
            <h1 class="section__title fw-bold banner__title banner__title--primary">Servicios</h1>
            <h4 class="fw-normal banner__title banner__title--light">Todos los servicios que buscas en Republica Dominicana</h4>
            <a href="#" class="mt-3 mt-md-5 btn btn-primary">Publicar Servicios</a>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row g-3">
            <div class="col-12 col-md-4">
                <div class="form-floating">
                    <input type="text" list="addresses" class="form-control" id="input_name" placeholder="Ejemplo">
                    <datalist id="addresses">
                        <option value="Lorem ipsum dolor sit amet consectetur adipisicing.">
                        <option value="Lorem ipsum dolor sit amet consectetur adipisicing.">
                        <option value="Lorem ipsum dolor sit amet consectetur adipisicing.">
                    </datalist>
                    <label for="input_email">Nombre</label>
                </div>
            </div>
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
                <button id="service-filter" class="btn btn-outline-secondary mx-auto">Buscar servicios</button>
            </div>
        </div>

        <div class="row gy-3 gx-2 justify-content-center my-4">
            <div class="col-12">
                <h2 class="text-center">Resultados de la busqueda</h2>
            </div>
				<?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               	 	<?php echo e(Voyager::h_listview($servicio["titulo"], $servicio["id"], $servicio["foto"], $servicio["storage"], $servicio["precios"], 'small', $servicio["name"], $servicio["condicion"])); ?>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="col-12">
                <div class="d-flex justify-content-center">
					<nav aria-label="Page navigation">
					  <ul class="pagination">
						    <?php echo e($paginate->render()); ?>

					  </ul>
					</nav>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsfooter'); ?>
<script>
$(document).ready(function() {
    $("#service-filter").click(function(){
    	var name = $("#input_name").val();
    	var category_id = $("#input_category").val();
    	var orden = $("#input_orden").val();

    	var uri = null;

    	if (name && category_id && orden){
    		uri = "/servicios/"+name+"/"+category_id+"/"+orden;
    	
    	}else if (name && category_id=="" && orden=="" ){
    		uri="/servicios/name/"+name;

    	}else if (category_id  && orden=="" && name=="" ){
    		uri="/servicios/categoria/"+category_id;

    	}else if (orden && name=="" && category_id==""){
    		uri="/servicios/orden/"+orden;
    	
    	}else if (name && category_id){
    		uri = "/servicios/name-"+name+"/category-"+category_id;
    	
    	}else if (name && orden){
    		uri = "/servicios/name-"+name+"/orden-"+orden;

    	}else if (orden && category_id){
    		uri = "/servicios/orden-"+orden+"/category-"+category_id;

    	} 
    	if (uri){
    		location.href = uri;
    	}

    });
});
</script>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/servicios/index.blade.php ENDPATH**/ ?>