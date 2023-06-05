<header class="header shadow-sm sticky-top bg-white">
    <div class="container py-2 py-lg-4">
        <div class="d-flex align-items-center">
            <a href="/" class="header__brand me-auto">
                <img src="/storage/<?php echo e(Voyager::setting('site.logo')); ?>" alt="" class="img-fluid">
            </a>
			<?php echo e(menu('menu', 'bootstrap')); ?>

            <button class="btn" data-bs-toggle="collapse" data-bs-target="#header__searchbox">
                <i class="fas fa-search"></i>
            </button>
         
            <button class="sidemenu__open btn"><i class="fas fa-bars"></i></button>
        </div>
    </div>
    <div class="bg-light collapse" id="header__searchbox">
        <div class="container py-4">
                <form action="/search" method="get">
            <div class="row g-2 flex-column justify-content-center align-items-center">
	                <div class="col-12 col-md-8 col-lg-4">
	                    <div class="form-floating">
	                        <input type="search"  name="data"  class="form-control" id="input_search" placeholder="Ejemplo">
	                        <label for="input_search">¿Qué estás buscando?</label>
	                    </div>
	                </div>
	                <div class="col-6 col-md-4 col-lg-2">
	                    <button type="submit" class="btn btn-outline-secondary w-100">Buscar</button>
	                </div>
            </div>
                </form>
        </div>
    </div>
</header><?php /**PATH /var/www/saldeello.com/www/html/resources/views/layouts/header.blade.php ENDPATH**/ ?>