<div class="col-12 col-md-6 col-lg-3">
     <div class="form-floating">
		<input id="dom_kilometros" type="text" name="kilometros" class="form-control" required>	
		<label >Kilometros</label>
	</div>
</div>
<div class="col-12 col-md-6 col-lg-3">
    <div class="form-floating">
		<input id="dom_anio" type="number" name="anio" class="form-control" required>	
		<label >Año</label>
	</div>
</div>
<div class="col-12 col-md-6 col-lg-3">
    <div class="form-floating">
		<select name="transmision" class="form-control" id="dom_transmision" required>
			<option value="">Seleccione Transmision</option>
			<option value="manual" >Manual</option>
			<option value="automatica">Automatica</option>
		</select>
		<label>Transmision</label>	
	</div>
</div>
<div class="col-12 col-md-6 col-lg-3">
    <div class="form-floating">
		<select name="colores_id" class="form-control" id="dom_colores_id" required>
			<option value="">Seleccione Color</option>
				<?php $__currentLoopData = $colores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		        	<option value="<?php echo e($color->id); ?>" style="background-color: <?php echo e($color->color); ?>;"><?php echo e($color->color); ?></option>
		        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
		<label >Color</label>	
	</div>
</div>
<div class="col-12 col-md-6 col-lg-3">
    <div class="form-floating">
		<select name="tipos_vehiculos_id" class="form-control" id="dom_tipos_vehiculos_id" required >
			<option value="">Tipo de Vehiculo</option>
				<?php $__currentLoopData = $tipo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		        	<option value="<?php echo e($tipos->id); ?>"><?php echo e($tipos->name); ?></option>
		        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
		<label>Tipo</label>
	</div>	
</div><?php /**PATH /var/www/saldeello.com/www/html/resources/views/shared/tipos_vehiculos.blade.php ENDPATH**/ ?>