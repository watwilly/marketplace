<?php $__env->startSection('page_title', $dataType->getTranslatedAttribute('display_name_plural') . ' ' . __('voyager::bread.order')); ?>

<?php $__env->startSection('page_header'); ?>
<h1 class="page-title">
    <i class="voyager-list"></i><?php echo e($dataType->getTranslatedAttribute('display_name_plural')); ?> <?php echo e(__('voyager::bread.order')); ?>

</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <p class="panel-title" style="color:#777"><?php echo e(__('voyager::generic.drag_drop_info')); ?></p>
                </div>

                <div class="panel-body" style="padding:30px;">
                    <div class="dd">
                        <ol class="dd-list">
                            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="dd-item" data-id="<?php echo e($result->getKey()); ?>">
                                <div class="dd-handle" style="height:inherit">
                                    <?php if(isset($dataRow->details->view)): ?>
                                        <?php echo $__env->make($dataRow->details->view, ['row' => $dataRow, 'dataType' => $dataType, 'dataTypeContent' => $result, 'content' => $result->{$display_column}, 'action' => 'order'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php elseif($dataRow->type == 'image'): ?>
                                        <span>
                                            <img src="<?php if( !filter_var($result->{$display_column}, FILTER_VALIDATE_URL)): ?><?php echo e(Voyager::image( $result->{$display_column} )); ?><?php else: ?><?php echo e($result->{$display_column}); ?><?php endif; ?>" style="height:100px">
                                        </span>
                                    <?php else: ?>
                                        <span><?php echo e($result->{$display_column}); ?></span>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<script>
$(document).ready(function () {
    $('.dd').nestable({
        maxDepth: 1
    });

    /**
    * Reorder items
    */
    $('.dd').on('change', function (e) {
        $.post('<?php echo e(route('voyager.'.$dataType->slug.'.order')); ?>', {
            order: JSON.stringify($('.dd').nestable('serialize')),
            _token: '<?php echo e(csrf_token()); ?>'
        }, function (data) {
            toastr.success("<?php echo e(__('voyager::bread.updated_order')); ?>");
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('voyager::master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/saldeello.com/www/html/vendor/tcg/voyager/src/../resources/views/bread/order.blade.php ENDPATH**/ ?>