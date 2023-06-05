<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">


<url>
  <loc>https://www.saldeello.com/promociones</loc>
  <lastmod>{{ $now->toAtomString() }}</lastmod>
  <priority>1.00</priority>
</url>
<url>
  <loc>https://www.saldeello.com/</loc>
  <lastmod>{{ $now->toAtomString() }}</lastmod>
  <priority>1.00</priority>
</url>
<url>
  <loc>https://www.saldeello.com/auth/user/register</loc>
  <lastmod>{{ $now->toAtomString() }}</lastmod>
  <priority>1.00</priority>
</url>
<url>
  <loc>https://www.saldeello.com/auth/user/login</loc>
  <lastmod>{{ $now->toAtomString() }}</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.saldeello.com/buenos-precios</loc>
  <lastmod>{{ $now->toAtomString() }}</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.saldeello.com/todas-las-categorias</loc>
  <lastmod>{{ $now->toAtomString() }}</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.saldeello.com/ventas/comercios/tiendas</loc>
  <lastmod>{{ $now->toAtomString() }}</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.saldeello.com/contratar/servicios</loc>
  <lastmod>{{ $now->toAtomString() }}</lastmod>
  <priority>0.80</priority>
</url>
@foreach($pub as $pubs)
	<url>
	  <loc>https://www.saldeello.com/rd-{{$pubs->id}}/{{str_slug($pubs->name)}}/{{$pubs->condicion}}/{{str_slug($pubs->title, '-')}}</loc>
	  <lastmod>{{ $now->toAtomString() }}</lastmod>
	  <priority>0.80</priority>
	</url>

@endforeach
@foreach($comercios as $comercio)
	<url>
	  <loc>https://www.saldeello.com/comercio/{{str_slug($comercio->titulo, '-')}}/{{$comercio->id}}</loc>
	  <lastmod>{{ $now->toAtomString() }}</lastmod>
	  <priority>0.80</priority>
	</url>
@endforeach
@foreach($categorias as $categoria)
	<url>
	  <loc>https://www.saldeello.com/categoria/{{$categoria->id}}/{{str_slug($categoria->name, '-')}}</loc>
	  <lastmod>{{ $now->toAtomString() }}</lastmod>
	  <priority>0.80</priority>
	</url>
@endforeach
</urlset>