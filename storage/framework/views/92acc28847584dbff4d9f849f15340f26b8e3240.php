<?php if(!is_null($haveAtribute)): ?>

<div class="col-12 col-md-6 col-lg-6">
   <div class="form-floating">
		<select class="form-control inputstl" name="talle[]" id="dom_talles" multiple  style="height: 151px;">
			<?php $__currentLoopData = $talles->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $talle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($talle->id); ?>"><?php echo e($talle->talle); ?></option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
		<label>Talles</label>
	</div>
</div>

<div class="col-12 col-md-6 col-lg-6">
    <div class="form-floating">
		<select class="form-control" name="colore[]" id="dom_colores" multiple style="height: 151px;">
			<?php $__currentLoopData = $colores->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	            <option value="<?php echo e($color->id); ?>" style="background-color: <?php echo e($color->color); ?>;"></option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
		<label>Colores</label>
	</div>
</div>	
<?php endif; ?><?php /**PATH /var/www/saldeello.com/www/html/resources/views/shared/getAtributos.blade.php ENDPATH**/ ?>