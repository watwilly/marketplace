<?php $__env->startSection('meta'); ?>
    <title>Ordenador de Fotos</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jsheader'); ?>
  <style>
 .dd {
    float: left;
    width: 100%;
}
.dd, .dd-list {
    position: relative;
    display: block;
    margin: 0;
    padding: 0;
    list-style: none;
}
.dd {
    font-size: 13px;
    line-height: 20px;
}  
.dd, .dd-list {
    position: relative;
    display: block;
    margin: 0;
    padding: 0;
    list-style: none;
}
ol, ul {
    margin-top: 0;
    margin-bottom: 10px;
}

.dd-empty, .dd-item, .dd-placeholder {
    display: block;
    position: relative;
    margin: 0;
    padding: 0;
    min-height: 20px;
    font-size: 13px;
    line-height: 20px;
}
.dd-handle {
    display: block;
    height: 50px;
    margin: 5px 0;
    padding: 14px 25px;
    color: #333;
    text-decoration: none;
    font-weight: 700;
    border: 1px solid #ccc;
    background: #fafafa;
    border-radius: 3px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}

.dd-handle:hover {
    color: #2ea8e5;
    background: #fff;
}

  </style>
<?php $__env->appendSection(); ?>
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
                        <h2 class="m-0">Ordenador de Fotos</h2>
                    </div>
                    <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                        <a href="#" onclick="history.back()" class="section__link section__link--secondary">Volver</a>
                    </div>
                </div>    

                <div class="col-12 col-lg-8 col-xl-9 py-5">
                <div class="dd">
                    <ol class="dd-list">
                        <?php $__currentLoopData = $imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="dd-item" data-id="<?php echo e($imagen->id); ?>">
                                <div class="dd-handle" style="height:inherit">
                                    <span>
                                        <img src="<?php echo e(Voyager::get_image($imagen->imagen, 'small', $imagen->storage)); ?>" style="height:100px">
                                        <?php echo e($post->title); ?> - Orden <?php echo e($imagen->orden); ?>

                                    </span>
                                </div>
                            </li>                            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </div>
            </div>
            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("jsfooter"); ?>
<script type="text/javascript" src="<?php echo e(voyager_asset('js/app.js')); ?>"></script>
<script>
$(document).ready(function () {
    $('.dd').nestable({
        maxDepth: 1
    });
    $('.dd').on('change', function (e) {
        $.post('', {
            order: JSON.stringify($('.dd').nestable('serialize')),
            _token: '<?php echo e(csrf_token()); ?>'
        }, function (data) {
            toastr('success','Orden actualizado');
        });
    });
});
</script>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/auth/publicaciones/orden.blade.php ENDPATH**/ ?>