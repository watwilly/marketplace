<div class="filter p-3 text-light">
    <button class="w-100 d-lg-none btn btn-outline-light" data-bs-toggle="collapse" data-bs-target="#filter-container">Filtrar Resultados</button>
    <div class="filter__container mt-4 collapse" id="filter-container">
        <div class="filter__header">
            <h4 class="section__lead section__lead--5 border-bottom border-light">Filtros aplicados</h4>
            <div class="border-bottom border-light pb-2">
                <?php $__currentLoopData = Session::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($key == 'catCondicion'): ?>
                        <a href="#" onclick="drop_filtro('<?php echo e($key); ?>');" class="filter__applied"><?php echo e($value); ?> <i class="fas fa-times"></i></a>
                    <?php endif; ?>
                    <?php if($key == 'catModelo'): ?>
                        <a href="#" onclick="drop_filtro('<?php echo e($key); ?>');" class="filter__applied"><?php echo e(Session::get('catModelo_name')); ?><i class="fas fa-times"></i></a>
                    <?php endif; ?>

                    <?php if($key == 'catMarca'): ?>
                        <a href="#" onclick="drop_filtro('<?php echo e($key); ?>');" class="filter__applied"><?php echo e(Session::get('catMarca_name')); ?><i class="fas fa-times"></i></a>
                    <?php endif; ?>
                    <?php if($key == 'catPriceRangue'): ?>
                        <a href="#" onclick="drop_filtro('<?php echo e($key); ?>');" class="filter__applied">Hasta $<?php echo e(Session::get('catPriceRangue')); ?> <i class="fas fa-times"></i></a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($_GET['category'])) {?>
                    <a href="/categoria/<?php echo e($category->id); ?>/<?php echo e(str_slug($category->name, '-')); ?>" class="filter__applied"><?php echo e($_GET['name']); ?>  <i class="fas fa-times"></i></a>
                <?php } ?>
            </div>
        </div>
        <div class="filter__form mt-3">
            <div class="row gy-3">
                <div class="col-12">
                    <h4 class="section__lead section__lead--6">Ordenar publicaciones</h4>
                    <ul class="nav flex-column regular">
                        <li class="nav-item">
                            <a href="#" onclick="orderatribute('ASC');" class="orden nav-link link-light custom-link custom-link-primary">
                                Menor precio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" onclick="orderatribute('DESC');" class="orden nav-link link-light custom-link custom-link-primary">
                                Mayor precio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#"  onclick="orderatribute('AAZ');" class="orden nav-link link-light custom-link custom-link-primary">
                                Alfabéticamente (A - Z)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#"  onclick="orderatribute('ZAA');" class="orden nav-link link-light custom-link custom-link-primary">
                                Alfabéticamente (Z - A)
                            </a>
                        </li>
                    </ul>
                </div>
                <?php if($categorias): ?>
                    <div class="col-12">
                        <h4 class="section__lead section__lead--6">Categoría</h4>
                        <ul class="nav flex-column regular">
                            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                    $pos = strpos($url, "category");
                                ?>
                                <li class="nav-item">
                                    <?php if($pos === false): ?>
                                        <a href="<?php echo e($url); ?>?category=<?php echo e($categoria["id"]); ?>&name=<?php echo e(str_slug($categoria["name"], '-')); ?>" class="nav-link link-light custom-link custom-link-primary">
                                            <?php echo e($categoria["name"]); ?>

                                        </a>
                                    <?php else: ?>
                                        <a href="/categoria/<?php echo e($category->id); ?>/<?php echo e(str_slug($category->name, '-')); ?>?category=<?php echo e($categoria["id"]); ?>&name=<?php echo e($categoria["name"]); ?>" class="nav-link link-light custom-link custom-link-primary">
                                            <?php echo e($categoria["name"]); ?>

                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if($marcas): ?>
                    <div class="col-12">
                        <h4 class="section__lead section__lead--6">Marcas</h4>
                        <ul class="nav flex-column regular">
                            <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a href="#" onclick="filtro_search('catMarca', '<?php echo e($marca["name"]); ?>', <?php echo e($marca["id"]); ?>);" class="nav-link link-light custom-link custom-link-primary">
                                   <?php echo e($marca["name"]); ?>

                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if($modelos): ?>
                    <div class="col-12">
                        <h4 class="section__lead section__lead--6">Marcas</h4>
                        <ul class="nav flex-column regular">
                            <?php $__currentLoopData = $modelos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modelo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a href="#" onclick="filtro_search('catModelo', '<?php echo e($modelo["name"]); ?>', <?php echo e($modelo["id"]); ?>);" class="nav-link link-light custom-link custom-link-primary">
                                   <?php echo e($modelo["name"]); ?>

                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="col-12">
                    <h4 class="section__lead section__lead--6">Condición</h4>
                    <ul class="nav flex-column regular">
                        <li class="nav-item">
                            <a href="#Nuevo" onclick="filtro_search('catCondicion', 'nuevo');" class="nav-link link-light custom-link custom-link-primary">
                                Nuevo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#Usado" onclick="filtro_search('catCondicion', 'usado');" class="nav-link link-light custom-link custom-link-primary">
                                Usado
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-12">
                    <h4 class="section__lead section__lead--6">Precio máximo</h4>
                    <h5 class="lead">RD $<span id="price-show"></span></h5>
                    <input type="range" name="price_rangue" class="form-range" min="0" max="20000" step="100" id="price-change" value="<?php if(Session::get('catPriceRangue')): ?><?php echo e(Session::get('catPriceRangue')); ?><?php else: ?> 100 <?php endif; ?>">
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /var/www/saldeello.com/www/html/resources/views/category/filter.blade.php ENDPATH**/ ?>