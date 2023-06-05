<?php $__env->startSection('page_title','View '.$dataType->display_name_singular); ?>

<?php $__env->startSection('page_header'); ?>
    <h1 class="page-title">
        <i class="<?php echo e($dataType->icon); ?>"></i> Ver <?php echo e(ucfirst($dataType->display_name_singular)); ?> &nbsp;

        <a href="<?php echo e(route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey())); ?>" class="btn btn-info">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;
            Editar
        </a>
        <a href="<?php echo e(route('voyager.'.$dataType->slug.'.index')); ?>" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            Volver al listado
        </a>     

    </h1>
    <?php echo $__env->make('voyager::multilingual.language-selector', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-content container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px; ">

                    <div class="panel-heading col-md-12" style="border-bottom:0;">
                        <div class="col-md-12">
                            <h4>Administrador de la tienda</h4>
                            <div class="col-md-6">
                                <p>Nombre : <?php echo e($adm_tienda->name); ?> <?php echo e($adm_tienda->apellido); ?></p>
                                <p>Email: <?php echo e($adm_tienda->email); ?></p>                                
                            </div>
                            <div class="col-md-6">
                               <p>Cuit: <?php echo e($adm_tienda->cuit); ?></p>
                                <p><a href="">Administrar Este Usuario</a></p> 
                            </div>

                            
                        </div>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                            <div class="col-md-12">
                                <h4>Publicaciones creadas</h4>
                                <div class="panel-body table-responsive">
                                    <table id="dataTable" class="row table table-hover">
                                        <thead>
                                            <tr>
                                               
                                                <th>Id</th>
                                                <th>Titulo</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $publicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <tr>
                                                <td>
                                                    <?php echo e($post->id); ?>

                                                </td>

                                                <td>
                                                    <?php echo e($post->title); ?>


                                                </td>

                                                <td>
                                                  
                                                    <?php echo e($post->status); ?>

                                                </td>

                                                <td>
                                                    <a href="/admin/posts/<?php echo e($post->id); ?>/edit">Editar</a>
                                                </td>

                                    
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </tbody>
                                    </table>

                                        <div class="pull-left">
                                           <div role="status" class="show-res" aria-live="polite">
                                               <?php echo e($publicaciones->render()); ?>

                                           </div>
                                        </div>
                                </div> 
                            </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {
    $('#form, #fat, #fofiltropayment').submit(function(event) {
      var formData = new FormData($("#fofiltropayment")[0]);
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            contentType: false,
            processData: false,
            data: formData,
            success: function(data) {

                $("#resultSearch").html(data);
                
  
            }
       })
        
        return false;
    }); 
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('voyager::master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/vendor/tcg/voyager/src/../resources/views/tiendas/read.blade.php ENDPATH**/ ?>