<br>
<?php $checked = false; ?>
<?php if(isset($dataTypeContent->{$row->field}) || old($row->field)): ?>
    <?php $checked = old($row->field, $dataTypeContent->{$row->field}); ?>
<?php else: ?>
    <?php $checked = isset($options->checked) &&
        filter_var($options->checked, FILTER_VALIDATE_BOOLEAN) ? true: false; ?>
<?php endif; ?>

<?php $class = $options->class ?? "toggleswitch"; ?>

<?php if(isset($options->on) && isset($options->off)): ?>
    <input type="checkbox" name="<?php echo e($row->field); ?>" class="<?php echo e($class); ?>"
        data-on="<?php echo e($options->on); ?>" <?php echo $checked ? 'checked="checked"' : ''; ?>

        data-off="<?php echo e($options->off); ?>">
<?php else: ?>
    <input type="checkbox" name="<?php echo e($row->field); ?>" class="<?php echo e($class); ?>"
        <?php if($checked): ?> checked <?php endif; ?>>
<?php endif; ?>
<?php /**PATH /var/www/saldeello.com/www/html/vendor/tcg/voyager/src/../resources/views/formfields/checkbox.blade.php ENDPATH**/ ?>