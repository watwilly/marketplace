<div class="col-11 col-sm-6 col-md-4 col-lg-3">
    <div class="card card-hover mx-2">
        <img src="<?php echo e(Voyager::get_image($imagen, $cropp_type, $storage)); ?>" class="card-img-top" alt="<?php echo e($title); ?>" title="<?php echo e($title); ?>">
        <div class="card-body d-flex flex-column justify-content-between">
            <h5 class="card-title m-0 text-truncate h6"><?php echo e(str_limit($title, 50)); ?></h5>
                <p class="card-text m-0 section__title fw-bold">
                 <?php if($precios == 1): ?> Precio a acordar con el vendedor <?php else: ?> RD $<?php echo e($precios); ?> <?php endif; ?>
                </p>
        </div>
        <a href="/rd-<?php echo e($id); ?>/<?php echo e(str_slug($prd_catname, '-')); ?>/<?php echo e(str_slug($condicion)); ?>/<?php echo e(str_slug($title)); ?>" class="stretched-link"></a>
    </div>
</div><?php /**PATH /var/www/saldeello.com/www/html/resources/views/shared/prd_listview.blade.php ENDPATH**/ ?>