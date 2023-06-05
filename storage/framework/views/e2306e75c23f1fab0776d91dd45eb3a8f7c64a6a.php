<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">


<url>
  <loc>https://www.saldeello.com/promociones</loc>
  <lastmod><?php echo e($now->toAtomString()); ?></lastmod>
  <priority>1.00</priority>
</url>
<url>
  <loc>https://www.saldeello.com/</loc>
  <lastmod><?php echo e($now->toAtomString()); ?></lastmod>
  <priority>1.00</priority>
</url>
<url>
  <loc>https://www.saldeello.com/auth/user/register</loc>
  <lastmod><?php echo e($now->toAtomString()); ?></lastmod>
  <priority>1.00</priority>
</url>
<url>
  <loc>https://www.saldeello.com/auth/user/login</loc>
  <lastmod><?php echo e($now->toAtomString()); ?></lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.saldeello.com/buenos-precios</loc>
  <lastmod><?php echo e($now->toAtomString()); ?></lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.saldeello.com/todas-las-categorias</loc>
  <lastmod><?php echo e($now->toAtomString()); ?></lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.saldeello.com/ventas/comercios/tiendas</loc>
  <lastmod><?php echo e($now->toAtomString()); ?></lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.saldeello.com/contratar/servicios</loc>
  <lastmod><?php echo e($now->toAtomString()); ?></lastmod>
  <priority>0.80</priority>
</url>
<?php $__currentLoopData = $pub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pubs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<url>
	  <loc>https://www.saldeello.com/rd-<?php echo e($pubs->id); ?>/<?php echo e(str_slug($pubs->name)); ?>/<?php echo e($pubs->condicion); ?>/<?php echo e(str_slug($pubs->title, '-')); ?></loc>
	  <lastmod><?php echo e($now->toAtomString()); ?></lastmod>
	  <priority>0.80</priority>
	</url>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__currentLoopData = $comercios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comercio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<url>
	  <loc>https://www.saldeello.com/comercio/<?php echo e(str_slug($comercio->titulo, '-')); ?>/<?php echo e($comercio->id); ?></loc>
	  <lastmod><?php echo e($now->toAtomString()); ?></lastmod>
	  <priority>0.80</priority>
	</url>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<url>
	  <loc>https://www.saldeello.com/categoria/<?php echo e($categoria->id); ?>/<?php echo e(str_slug($categoria->name, '-')); ?></loc>
	  <lastmod><?php echo e($now->toAtomString()); ?></lastmod>
	  <priority>0.80</priority>
	</url>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</urlset><?php /**PATH /var/www/saldeello.com/www/html/resources/views/home/sitemap.blade.php ENDPATH**/ ?>